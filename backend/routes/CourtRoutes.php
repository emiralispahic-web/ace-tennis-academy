<?php

require_once __DIR__ . '/../services/CourtService.php';

// GET all courts
Flight::route('GET /courts', function () {

    try {
        $courtService = new CourtService();

        Flight::json($courtService->getAll());

    } catch (Throwable $error) {
        handleApiError($error);
    }
});

// GET court by ID
Flight::route('GET /courts/@id:[0-9]+', function ($id) {

    try {
        $courtService = new CourtService();

        Flight::json($courtService->getById($id));

    } catch (Throwable $error) {
        handleApiError($error);
    }
});

// POST - Create court
Flight::route('POST /courts', function () {

    try {
        $courtService = new CourtService();

        $data = Flight::request()->data->getData();

        $courtService->create($data);

        Flight::json([
            'message' => 'Court created successfully'
        ], 201);

    } catch (Throwable $error) {
        handleApiError($error);
    }
});

// PUT - Update court
Flight::route('PUT /courts/@id:[0-9]+', function ($id) {

    try {
        $courtService = new CourtService();

        $data = Flight::request()->data->getData();

        $courtService->update($id, $data);

        Flight::json([
            'message' => 'Court updated successfully'
        ], 200);

    } catch (Throwable $error) {
        handleApiError($error);
    }
});

// DELETE - Delete court
Flight::route('DELETE /courts/@id:[0-9]+', function ($id) {

    try {
        $courtService = new CourtService();

        $courtService->delete($id);

        Flight::json([
            'message' => 'Court deleted successfully'
        ], 200);

    } catch (Throwable $error) {
        handleApiError($error);
    }
});
