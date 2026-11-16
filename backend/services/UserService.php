<?php

require_once __DIR__ . '/BaseService.php';
require_once __DIR__ . '/../dao/UserDao.php';

class UserService extends BaseService {

    public function __construct() {
        parent::__construct(new UserDao());
    }

    public function getAll() {
        $users = parent::getAll();

        foreach ($users as &$user) {
            unset($user['password_hash']);
        }

        return $users;
    }

    public function getById($id) {
        $user = parent::getById($id);

        unset($user['password_hash']);

        return $user;
    }

    public function create($data) {
        $this->validateUser($data);

        $this->checkDuplicateEmail($data['email']);

        if (empty($data['password']) || strlen($data['password']) < 8) {
            throw new Exception(
                "Password must be at least 8 characters long",
                400
            );
        }

        $user = [
            'full_name' => $data['full_name'],
            'email' => $data['email'],
            'password_hash' => password_hash(
                $data['password'],
                PASSWORD_DEFAULT
            ),
            'phone' => $data['phone'] ?? null,
            'role' => $data['role']
        ];

        return parent::create($user);
    }

    public function update($id, $data) {
        $existingUser = $this->dao->getById($id);

        if (!$existingUser) {
            throw new Exception("User not found", 404);
        }

        $updatedUser = [
            'full_name' => $data['full_name'] ?? $existingUser['full_name'],
            'email' => $data['email'] ?? $existingUser['email'],
            'password_hash' => $existingUser['password_hash'],
            'phone' => array_key_exists('phone', $data)
                ? $data['phone']
                : $existingUser['phone'],
            'role' => $data['role'] ?? $existingUser['role']
        ];

        $this->validateUser($updatedUser);

        $this->checkDuplicateEmail($updatedUser['email'], $id);

        if (isset($data['password'])) {
            if (strlen($data['password']) < 8) {
                throw new Exception(
                    "Password must be at least 8 characters long",
                    400
                );
            }

            $updatedUser['password_hash'] = password_hash(
                $data['password'],
                PASSWORD_DEFAULT
            );
        }

        return parent::update($id, $updatedUser);
    }

    private function validateUser($data) {
        if (empty($data['full_name'])) {
            throw new Exception("Full name is required", 400);
        }

        if (strlen($data['full_name']) > 100) {
            throw new Exception(
                "Full name cannot exceed 100 characters",
                400
            );
        }

        if (empty($data['email']) ||
            !filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            throw new Exception("Invalid email address", 400);
        }

        if (strlen($data['email']) > 150) {
            throw new Exception(
                "Email cannot exceed 150 characters",
                400
            );
        }

        if (!isset($data['role']) ||
            !in_array($data['role'], ['admin', 'coach', 'student'], true)) {
            throw new Exception("Invalid user role", 400);
        }

        if (isset($data['phone']) && strlen($data['phone']) > 30) {
            throw new Exception(
                "Phone cannot exceed 30 characters",
                400
            );
        }
    }

    private function checkDuplicateEmail($email, $id = null) {
        $users = $this->dao->getAll();

        foreach ($users as $user) {
            if (strcasecmp($user['email'], $email) === 0 &&
                ($id === null || $user['id'] != $id)) {
                throw new Exception("Email already exists", 400);
            }
        }
    }
}
