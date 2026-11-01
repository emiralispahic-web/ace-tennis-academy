
<?php

require_once __DIR__ . '/BaseDao.php';

class BookingDao extends BaseDao {

    public function __construct() {
        parent::__construct('bookings');
    }

    public function create($data) {
        $stmt = $this->connection->prepare(
            "INSERT INTO bookings
            (user_id, training_session_id, status)
            VALUES
            (:user_id, :training_session_id, :status)"
        );

        return $stmt->execute([
            'user_id' => $data['user_id'],
            'training_session_id' => $data['training_session_id'],
            'status' => $data['status']
        ]);
    }

    public function update($id, $data) {
        $stmt = $this->connection->prepare(
            "UPDATE bookings SET
                user_id = :user_id,
                training_session_id = :training_session_id,
                status = :status
            WHERE id = :id"
        );

        return $stmt->execute([
            'id' => $id,
            'user_id' => $data['user_id'],
            'training_session_id' => $data['training_session_id'],
            'status' => $data['status']
        ]);
    }
}
