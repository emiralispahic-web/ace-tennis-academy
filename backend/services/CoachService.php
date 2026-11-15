<?php

require_once __DIR__ . '/BaseService.php';
require_once __DIR__ . '/../dao/CoachDao.php';
require_once __DIR__ . '/../dao/UserDao.php';

class CoachService extends BaseService {

    private $userDao;

    public function __construct() {
        parent::__construct(new CoachDao());
        $this->userDao = new UserDao();
    }

    public function create($data) {
        $this->validateCoach($data);

        $this->checkDuplicateCoach($data['user_id']);

        $coach = [
            'user_id' => $data['user_id'],
            'specialization' => $data['specialization'],
            'experience_years' => $data['experience_years'] ?? null,
            'bio' => $data['bio'] ?? null
        ];

        return parent::create($coach);
    }

    public function update($id, $data) {
        $existingCoach = $this->getById($id);

        $updatedCoach = [
            'user_id' => $data['user_id'] ?? $existingCoach['user_id'],
            'specialization' => $data['specialization']
                ?? $existingCoach['specialization'],
            'experience_years' => array_key_exists('experience_years', $data)
                ? $data['experience_years']
                : $existingCoach['experience_years'],
            'bio' => array_key_exists('bio', $data)
                ? $data['bio']
                : $existingCoach['bio']
        ];

        $this->validateCoach($updatedCoach);

        $this->checkDuplicateCoach($updatedCoach['user_id'], $id);

        return parent::update($id, $updatedCoach);
    }

    private function validateCoach($data) {
        if (empty($data['user_id']) ||
            filter_var($data['user_id'], FILTER_VALIDATE_INT) === false ||
            $data['user_id'] <= 0) {
            throw new Exception("Valid user ID is required", 400);
        }

        $user = $this->userDao->getById($data['user_id']);

        if (!$user) {
            throw new Exception("User not found", 404);
        }

        if ($user['role'] !== 'coach') {
            throw new Exception(
                "User must have the coach role",
                400
            );
        }

        if (empty($data['specialization']) ||
            !is_string($data['specialization'])) {
            throw new Exception(
                "Specialization is required",
                400
            );
        }

        if (strlen($data['specialization']) > 100) {
            throw new Exception(
                "Specialization cannot exceed 100 characters",
                400
            );
        }

        if (isset($data['experience_years'])) {
            if (filter_var(
                $data['experience_years'],
                FILTER_VALIDATE_INT
            ) === false || $data['experience_years'] < 0) {
                throw new Exception(
                    "Experience years must be a non-negative integer",
                    400
                );
            }
        }

        if (isset($data['bio']) && !is_string($data['bio'])) {
            throw new Exception("Bio must be text", 400);
        }
    }

    private function checkDuplicateCoach($userId, $id = null) {
        $coaches = $this->dao->getAll();

        foreach ($coaches as $coach) {
            if ($coach['user_id'] == $userId &&
                ($id === null || $coach['id'] != $id)) {
                throw new Exception(
                    "This user already has a coach profile",
                    400
                );
            }
        }
    }
}
