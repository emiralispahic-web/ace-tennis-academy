<?php

require_once __DIR__ . '/../services/BookingService.php';

// GET all bookings
Flight::route('GET /bookings', function () {

    try {
        $bookingService = new BookingService();

        Flight::json($bookingService->getAll());

    } catch (Throwable $error) {
        handleApiError($error);
    }
});

// GET booking by ID
Flight::route('GET /bookings/@id:[0-9]+', function ($id) {

    try {
        $bookingService = new BookingService();

        Flight::json($bookingService->getById($id));

    } catch (Throwable $error) {
        handleApiError($error);
    }
});

// POST - Create booking
Flight::route('POST /bookings', function () {

    try {
        $bookingService = new BookingService();

        $data = Flight::request()->data->getData();

        $bookingService->create($data);

        Flight::json([
            'message' => 'Booking created successfully'
        ], 201);

    } catch (Throwable $error) {
        handleApiError($error);
    }
});

// PUT - Update booking
Flight::route('PUT /bookings/@id:[0-9]+', function ($id) {

    try {
        $bookingService = new BookingService();

        $data = Flight::request()->data->getData();

        $bookingService->update($id, $data);

        Flight::json([
            'message' => 'Booking updated successfully'
        ], 200);

    } catch (Throwable $error) {
        handleApiError($error);
    }
});

// DELETE - Delete booking
Flight::route('DELETE /bookings/@id:[0-9]+', function ($id) {

    try {
        $bookingService = new BookingService();

        $bookingService->delete($id);

        Flight::json([
            'message' => 'Booking deleted successfully'
        ], 200);

    } catch (Throwable $error) {
        handleApiError($error);
    }
});
