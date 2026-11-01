
<?php

require_once __DIR__ . '/BaseDao.php';

class TrainingSessionDao extends BaseDao {

    public function __construct() {
        parent::__construct('training_sessions');
    }

    public function create($data) {
        $stmt = $this->connection->prepare(
            "INSERT INTO training_sessions
            (coach_id, court_id, title, session_date,
             start_time, end_time, price, capacity)
            VALUES
            (:coach_id, :court_id, :title, :session_date,
             :start_time, :end_time, :price, :capacity)"
        );

        return $stmt->execute([
            'coach_id' => $data['coach_id'],
            'court_id' => $data['court_id'],
            'title' => $data['title'],
            'session_date' => $data['session_date'],
            'start_time' => $data['start_time'],
            'end_time' => $data['end_time'],
            'price' => $data['price'],
            'capacity' => $data['capacity']
        ]);
    }

    public function update($id, $data) {
        $stmt = $this->connection->prepare(
            "UPDATE training_sessions SET
                coach_id = :coach_id,
                court_id = :court_id,
                title = :title,
                session_date = :session_date,
                start_time = :start_time,
                end_time = :end_time,
                price = :price,
                capacity = :capacity
            WHERE id = :id"
        );

        return $stmt->execute([
            'id' => $id,
            'coach_id' => $data['coach_id'],
            'court_id' => $data['court_id'],
            'title' => $data['title'],
            'session_date' => $data['session_date'],
            'start_time' => $data['start_time'],
            'end_time' => $data['end_time'],
            'price' => $data['price'],
            'capacity' => $data['capacity']
        ]);
    }
}
