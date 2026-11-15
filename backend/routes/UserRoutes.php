<?php

require_once __DIR__ . '/../services/UserService.php';

// GET all users
Flight::route('GET /users', function () {

    try {
        $userService = new UserService();

        Flight::json($userService->getAll());

    } catch (Throwable $error) {
        handleApiError($error);
    }
});

// GET user by ID
Flight::route('GET /users/@id:[0-9]+', function ($id) {

    try {
        $userService = new UserService();

        Flight::json($userService->getById($id));

    } catch (Throwable $error) {
        handleApiError($error);
    }
});

// POST - Create user
Flight::route('POST /users', function () {

    try {
        $userService = new UserService();

        $data = Flight::request()->data->getData();

        $userService->create($data);

        Flight::json([
            'message' => 'User created successfully'
        ], 201);

    } catch (Throwable $error) {
        handleApiError($error);
    }
});

// PUT - Update user
Flight::route('PUT /users/@id:[0-9]+', function ($id) {

    try {
        $userService = new UserService();

        $data = Flight::request()->data->getData();

        $userService->update($id, $data);

        Flight::json([
            'message' => 'User updated successfully'
        ], 200);

    } catch (Throwable $error) {
        handleApiError($error);
    }
});

// DELETE - Delete user
Flight::route('DELETE /users/@id:[0-9]+', function ($id) {

    try {
        $userService = new UserService();

        $userService->delete($id);

        Flight::json([
            'message' => 'User deleted successfully'
        ], 200);

    } catch (Throwable $error) {
        handleApiError($error);
    }
});
