
<?php

require_once __DIR__ . '/BaseDao.php';

class UserDao extends BaseDao {

    public function __construct() {
        parent::__construct('users');
    }

    public function create($data) {
        $stmt = $this->connection->prepare(
            "INSERT INTO users
            (full_name, email, password_hash, phone, role)
            VALUES
            (:full_name, :email, :password_hash, :phone, :role)"
        );

        return $stmt->execute([
            'full_name' => $data['full_name'],
            'email' => $data['email'],
            'password_hash' => $data['password_hash'],
            'phone' => $data['phone'],
            'role' => $data['role']
        ]);
    }

    public function update($id, $data) {
        $stmt = $this->connection->prepare(
            "UPDATE users SET
                full_name = :full_name,
                email = :email,
                password_hash = :password_hash,
                phone = :phone,
                role = :role
            WHERE id = :id"
        );

        return $stmt->execute([
            'id' => $id,
            'full_name' => $data['full_name'],
            'email' => $data['email'],
            'password_hash' => $data['password_hash'],
            'phone' => $data['phone'],
            'role' => $data['role']
        ]);
    }
}
