<?php

require_once __DIR__ . '/BaseService.php';
require_once __DIR__ . '/../dao/BookingDao.php';
require_once __DIR__ . '/../dao/UserDao.php';
require_once __DIR__ . '/../dao/TrainingSessionDao.php';

class BookingService extends BaseService {

    private $userDao;
    private $trainingSessionDao;

    public function __construct() {
        parent::__construct(new BookingDao());

        $this->userDao = new UserDao();
        $this->trainingSessionDao = new TrainingSessionDao();
    }

    public function create($data) {

        $booking = [
            'user_id' => $data['user_id'] ?? null,
            'training_session_id' =>
                $data['training_session_id'] ?? null,
            'status' => $data['status'] ?? 'pending'
        ];

        $this->validateBooking($booking);

        $this->checkDuplicateBooking($booking);

        $this->checkCapacity($booking);

        return parent::create($booking);
    }

    public function update($id, $data) {

        $existingBooking = $this->getById($id);

        $updatedBooking = [
            'user_id' => $data['user_id']
                ?? $existingBooking['user_id'],

            'training_session_id' =>
                $data['training_session_id']
                ?? $existingBooking['training_session_id'],

            'status' => $data['status']
                ?? $existingBooking['status']
        ];

        $this->validateBooking($updatedBooking);

        $this->checkDuplicateBooking($updatedBooking, $id);

        $this->checkCapacity($updatedBooking, $id);

        return parent::update($id, $updatedBooking);
    }

    private function validateBooking($data) {

        // Validate user ID

        if (filter_var(
            $data['user_id'],
            FILTER_VALIDATE_INT
        ) === false || $data['user_id'] <= 0) {
            throw new Exception(
                "Valid user ID is required",
                400
            );
        }

        $user = $this->userDao->getById($data['user_id']);

        if (!$user) {
            throw new Exception("User not found", 404);
        }

        if ($user['role'] !== 'student') {
            throw new Exception(
                "Only students can book training sessions",
                400
            );
        }

        // Validate training session ID

        if (filter_var(
            $data['training_session_id'],
            FILTER_VALIDATE_INT
        ) === false || $data['training_session_id'] <= 0) {
            throw new Exception(
                "Valid training session ID is required",
                400
            );
        }

        $session = $this->trainingSessionDao->getById(
            $data['training_session_id']
        );

        if (!$session) {
            throw new Exception(
                "Training session not found",
                404
            );
        }

        // Validate booking status

        if (!in_array(
            $data['status'],
            ['pending', 'confirmed', 'cancelled'],
            true
        )) {
            throw new Exception(
                "Status must be pending, confirmed or cancelled",
                400
            );
        }
    }

    private function checkDuplicateBooking($data, $id = null) {

        $bookings = $this->dao->getAll();

        foreach ($bookings as $booking) {

            if ($id !== null && $booking['id'] == $id) {
                continue;
            }

            if ($booking['user_id'] == $data['user_id'] &&
                $booking['training_session_id'] ==
                    $data['training_session_id']) {

                throw new Exception(
                    "Student already has a booking for this session",
                    400
                );
            }
        }
    }

    private function checkCapacity($data, $id = null) {

        // Cancelled bookings do not occupy a place

        if ($data['status'] === 'cancelled') {
            return;
        }

        $session = $this->trainingSessionDao->getById(
            $data['training_session_id']
        );

        $bookings = $this->dao->getAll();

        $activeBookings = 0;

        foreach ($bookings as $booking) {

            // Ignore the booking currently being updated

            if ($id !== null && $booking['id'] == $id) {
                continue;
            }

            if ($booking['training_session_id'] ==
                    $data['training_session_id'] &&
                in_array(
                    $booking['status'],
                    ['pending', 'confirmed'],
                    true
                )) {

                $activeBookings++;
            }
        }

        if ($activeBookings >= $session['capacity']) {
            throw new Exception(
                "Training session is fully booked",
                400
            );
        }
    }
}
