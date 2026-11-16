<?php

require_once __DIR__ . '/../services/TrainingSessionService.php';

// GET all training sessions
Flight::route('GET /training-sessions', function () {

    try {
        $sessionService = new TrainingSessionService();

        Flight::json($sessionService->getAll());

    } catch (Throwable $error) {
        handleApiError($error);
    }
});

// GET training session by ID
Flight::route('GET /training-sessions/@id:[0-9]+', function ($id) {

    try {
        $sessionService = new TrainingSessionService();

        Flight::json($sessionService->getById($id));

    } catch (Throwable $error) {
        handleApiError($error);
    }
});

// POST - Create training session
Flight::route('POST /training-sessions', function () {

    try {
        $sessionService = new TrainingSessionService();

        $data = Flight::request()->data->getData();

        $sessionService->create($data);

        Flight::json([
            'message' => 'Training session created successfully'
        ], 201);

    } catch (Throwable $error) {
        handleApiError($error);
    }
});

// PUT - Update training session
Flight::route('PUT /training-sessions/@id:[0-9]+', function ($id) {

    try {
        $sessionService = new TrainingSessionService();

        $data = Flight::request()->data->getData();

        $sessionService->update($id, $data);

        Flight::json([
            'message' => 'Training session updated successfully'
        ], 200);

    } catch (Throwable $error) {
        handleApiError($error);
    }
});

// DELETE - Delete training session
Flight::route('DELETE /training-sessions/@id:[0-9]+', function ($id) {

    try {
        $sessionService = new TrainingSessionService();

        $sessionService->delete($id);

        Flight::json([
            'message' => 'Training session deleted successfully'
        ], 200);

    } catch (Throwable $error) {
        handleApiError($error);
    }
});
