<?php

require_once __DIR__ . '/BaseService.php';
require_once __DIR__ . '/../dao/CourtDao.php';

class CourtService extends BaseService {

    public function __construct() {
        parent::__construct(new CourtDao());
    }

    public function create($data) {
        $court = [
            'name' => $data['name'] ?? null,
            'surface' => $data['surface'] ?? null,
            'court_type' => $data['court_type'] ?? null,
            'hourly_price' => $data['hourly_price'] ?? null,
            'is_available' => $data['is_available'] ?? 1
        ];

        $this->validateCourt($court);

        return parent::create($court);
    }

    public function update($id, $data) {
        $existingCourt = $this->getById($id);

        $updatedCourt = [
            'name' => $data['name']
                ?? $existingCourt['name'],

            'surface' => $data['surface']
                ?? $existingCourt['surface'],

            'court_type' => $data['court_type']
                ?? $existingCourt['court_type'],

            'hourly_price' => $data['hourly_price']
                ?? $existingCourt['hourly_price'],

            'is_available' => $data['is_available']
                ?? $existingCourt['is_available']
        ];

        $this->validateCourt($updatedCourt);

        return parent::update($id, $updatedCourt);
    }

    private function validateCourt($data) {

        if (!is_string($data['name']) ||
            trim($data['name']) === '') {
            throw new Exception(
                "Court name is required",
                400
            );
        }

        if (strlen($data['name']) > 100) {
            throw new Exception(
                "Court name cannot exceed 100 characters",
                400
            );
        }

        if (!in_array(
            $data['surface'],
            ['Clay', 'Hard', 'Grass'],
            true
        )) {
            throw new Exception(
                "Surface must be Clay, Hard or Grass",
                400
            );
        }

        if (!in_array(
            $data['court_type'],
            ['Indoor', 'Outdoor'],
            true
        )) {
            throw new Exception(
                "Court type must be Indoor or Outdoor",
                400
            );
        }

        if (!is_numeric($data['hourly_price']) ||
            $data['hourly_price'] <= 0 ||
            $data['hourly_price'] > 99999999.99) {
            throw new Exception(
                "Hourly price must be a valid positive number",
                400
            );
        }

        if (!in_array(
            $data['is_available'],
            [0, 1, '0', '1'],
            true
        )) {
            throw new Exception(
                "Availability must be 0 or 1",
                400
            );
        }
    }
}
