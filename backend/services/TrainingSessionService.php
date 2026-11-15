<?php

require_once __DIR__ . '/BaseService.php';
require_once __DIR__ . '/../dao/TrainingSessionDao.php';
require_once __DIR__ . '/../dao/CoachDao.php';
require_once __DIR__ . '/../dao/CourtDao.php';
require_once __DIR__ . '/../dao/BookingDao.php';

class TrainingSessionService extends BaseService {

    private $coachDao;
    private $courtDao;
    private $bookingDao;

    public function __construct() {
        parent::__construct(new TrainingSessionDao());

        $this->coachDao = new CoachDao();
        $this->courtDao = new CourtDao();
        $this->bookingDao = new BookingDao();
    }

    public function create($data) {

        $session = [
            'coach_id' => $data['coach_id'] ?? null,
            'court_id' => $data['court_id'] ?? null,
            'title' => $data['title'] ?? null,
            'session_date' => $data['session_date'] ?? null,
            'start_time' => $data['start_time'] ?? null,
            'end_time' => $data['end_time'] ?? null,
            'price' => $data['price'] ?? null,
            'capacity' => $data['capacity'] ?? null
        ];

        $this->validateSession($session);

        $this->checkScheduleConflict($session);

        return parent::create($session);
    }

    public function update($id, $data) {

        $existingSession = $this->getById($id);

        $updatedSession = [
            'coach_id' => $data['coach_id']
                ?? $existingSession['coach_id'],

            'court_id' => $data['court_id']
                ?? $existingSession['court_id'],

            'title' => $data['title']
                ?? $existingSession['title'],

            'session_date' => $data['session_date']
                ?? $existingSession['session_date'],

            'start_time' => $data['start_time']
                ?? $existingSession['start_time'],

            'end_time' => $data['end_time']
                ?? $existingSession['end_time'],

            'price' => $data['price']
                ?? $existingSession['price'],

            'capacity' => $data['capacity']
                ?? $existingSession['capacity']
        ];

        $this->validateSession($updatedSession);

        $this->checkScheduleConflict($updatedSession, $id);

        $this->checkExistingBookings(
            $id,
            $updatedSession['capacity']
        );

        return parent::update($id, $updatedSession);
    }

    private function validateSession($data) {

        // Validate coach

        if (filter_var(
            $data['coach_id'],
            FILTER_VALIDATE_INT
        ) === false || $data['coach_id'] <= 0) {
            throw new Exception("Valid coach ID is required", 400);
        }

        if (!$this->coachDao->getById($data['coach_id'])) {
            throw new Exception("Coach not found", 404);
        }

        // Validate court

        if (filter_var(
            $data['court_id'],
            FILTER_VALIDATE_INT
        ) === false || $data['court_id'] <= 0) {
            throw new Exception("Valid court ID is required", 400);
        }

        $court = $this->courtDao->getById($data['court_id']);

        if (!$court) {
            throw new Exception("Court not found", 404);
        }

        if ($court['is_available'] != 1) {
            throw new Exception("Court is not available", 400);
        }

        // Validate title

        if (!is_string($data['title']) ||
            trim($data['title']) === '') {
            throw new Exception("Training title is required", 400);
        }

        if (strlen($data['title']) > 150) {
            throw new Exception(
                "Title cannot exceed 150 characters",
                400
            );
        }

        // Validate date

        if (!is_string($data['session_date'])) {
            throw new Exception("Invalid session date", 400);
        }

        $date = DateTime::createFromFormat(
            '!Y-m-d',
            $data['session_date']
        );

        if (!$date ||
            $date->format('Y-m-d') !== $data['session_date']) {
            throw new Exception("Invalid session date", 400);
        }

        // Validate start and end time

        if (!$this->isValidTime($data['start_time']) ||
            !$this->isValidTime($data['end_time'])) {
            throw new Exception("Invalid session time", 400);
        }

        if (strtotime($data['end_time']) <=
            strtotime($data['start_time'])) {
            throw new Exception(
                "End time must be after start time",
                400
            );
        }

        // Validate price

        if (!is_numeric($data['price']) ||
            $data['price'] <= 0 ||
            $data['price'] > 99999999.99) {
            throw new Exception(
                "Price must be a valid positive number",
                400
            );
        }

        // Validate capacity

        if (filter_var(
            $data['capacity'],
            FILTER_VALIDATE_INT
        ) === false ||
            $data['capacity'] <= 0 ||
            $data['capacity'] > 2147483647) {
            throw new Exception(
                "Capacity must be a positive integer",
                400
            );
        }
    }

    private function isValidTime($time) {

        if (!is_string($time)) {
            return false;
        }

        return preg_match(
            '/^([01]\d|2[0-3]):[0-5]\d(:[0-5]\d)?$/',
            $time
        ) === 1;
    }

    private function checkScheduleConflict($data, $id = null) {

        $sessions = $this->dao->getAll();

        foreach ($sessions as $session) {

            // Ignore the session currently being updated

            if ($id !== null && $session['id'] == $id) {
                continue;
            }

            // Only compare sessions on the same date

            if ($session['session_date'] !==
                $data['session_date']) {
                continue;
            }

            $newStart = strtotime($data['start_time']);
            $newEnd = strtotime($data['end_time']);

            $existingStart = strtotime($session['start_time']);
            $existingEnd = strtotime($session['end_time']);

            // Check whether the times overlap

            if ($newStart < $existingEnd &&
                $newEnd > $existingStart) {

                if ($session['court_id'] == $data['court_id']) {
                    throw new Exception(
                        "Court is already booked for this time",
                        400
                    );
                }

                if ($session['coach_id'] == $data['coach_id']) {
                    throw new Exception(
                        "Coach already has a session at this time",
                        400
                    );
                }
            }
        }
    }

    private function checkExistingBookings($sessionId, $capacity) {

        $bookings = $this->bookingDao->getAll();

        $activeBookings = 0;

        foreach ($bookings as $booking) {

            if (
                $booking['training_session_id'] == $sessionId &&
                in_array(
                    $booking['status'],
                    ['pending', 'confirmed'],
                    true
                )
            ) {
                $activeBookings++;
            }
        }

        if ($capacity < $activeBookings) {
            throw new Exception(
                "Capacity cannot be lower than the number of active bookings",
                400
            );
        }
    }
}
