<?php

require_once __DIR__ . '/../services/CoachService.php';

// GET all coaches
Flight::route('GET /coaches', function () {

    try {
        $coachService = new CoachService();

        Flight::json($coachService->getAll());

    } catch (Throwable $error) {
        handleApiError($error);
    }
});

// GET coach by ID
Flight::route('GET /coaches/@id:[0-9]+', function ($id) {

    try {
        $coachService = new CoachService();

        Flight::json($coachService->getById($id));

    } catch (Throwable $error) {
        handleApiError($error);
    }
});

// POST - Create coach
Flight::route('POST /coaches', function () {

    try {
        $coachService = new CoachService();

        $data = Flight::request()->data->getData();

        $coachService->create($data);

        Flight::json([
            'message' => 'Coach created successfully'
        ], 201);

    } catch (Throwable $error) {
        handleApiError($error);
    }
});

// PUT - Update coach
Flight::route('PUT /coaches/@id:[0-9]+', function ($id) {

    try {
        $coachService = new CoachService();

        $data = Flight::request()->data->getData();

        $coachService->update($id, $data);

        Flight::json([
            'message' => 'Coach updated successfully'
        ], 200);

    } catch (Throwable $error) {
        handleApiError($error);
    }
});

// DELETE - Delete coach
Flight::route('DELETE /coaches/@id:[0-9]+', function ($id) {

    try {
        $coachService = new CoachService();

        $coachService->delete($id);

        Flight::json([
            'message' => 'Coach deleted successfully'
        ], 200);

    } catch (Throwable $error) {
        handleApiError($error);
    }
});
