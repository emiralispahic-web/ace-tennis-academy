
<?php

require_once __DIR__ . '/BaseDao.php';

class CoachDao extends BaseDao {

    public function __construct() {
        parent::__construct('coaches');
    }

    public function create($data) {
        $stmt = $this->connection->prepare(
            "INSERT INTO coaches
            (user_id, specialization, experience_years, bio)
            VALUES
            (:user_id, :specialization, :experience_years, :bio)"
        );

        return $stmt->execute([
            'user_id' => $data['user_id'],
            'specialization' => $data['specialization'],
            'experience_years' => $data['experience_years'],
            'bio' => $data['bio']
        ]);
    }

    public function update($id, $data) {
        $stmt = $this->connection->prepare(
            "UPDATE coaches SET
                user_id = :user_id,
                specialization = :specialization,
                experience_years = :experience_years,
                bio = :bio
            WHERE id = :id"
        );

        return $stmt->execute([
            'id' => $id,
            'user_id' => $data['user_id'],
            'specialization' => $data['specialization'],
            'experience_years' => $data['experience_years'],
            'bio' => $data['bio']
        ]);
    }
}
