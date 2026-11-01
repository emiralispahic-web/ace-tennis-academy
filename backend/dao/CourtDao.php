
<?php

require_once __DIR__ . '/BaseDao.php';

class CourtDao extends BaseDao {

    public function __construct() {
        parent::__construct('courts');
    }

    public function create($data) {
        $stmt = $this->connection->prepare(
            "INSERT INTO courts
            (name, surface, court_type, hourly_price, is_available)
            VALUES
            (:name, :surface, :court_type, :hourly_price, :is_available)"
        );

        return $stmt->execute([
            'name' => $data['name'],
            'surface' => $data['surface'],
            'court_type' => $data['court_type'],
            'hourly_price' => $data['hourly_price'],
            'is_available' => $data['is_available']
        ]);
    }

    public function update($id, $data) {
        $stmt = $this->connection->prepare(
            "UPDATE courts SET
                name = :name,
                surface = :surface,
                court_type = :court_type,
                hourly_price = :hourly_price,
                is_available = :is_available
            WHERE id = :id"
        );

        return $stmt->execute([
            'id' => $id,
            'name' => $data['name'],
            'surface' => $data['surface'],
            'court_type' => $data['court_type'],
            'hourly_price' => $data['hourly_price'],
            'is_available' => $data['is_available']
        ]);
    }
}
