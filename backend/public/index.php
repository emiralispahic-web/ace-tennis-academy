<?php

require_once __DIR__ . '/../vendor/autoload.php';

// Reusable error response function
function handleApiError(Throwable $error) {

    $status = $error->getCode();

    if (!in_array($status, [400, 401, 403, 404, 500], true)) {
        $status = 500;
    }

    $message = $error->getMessage();

    if ($status === 500) {
        error_log($message);
        $message = 'Internal server error';
    }

    Flight::json([
        'error' => $message,
        'status' => $status
    ], $status);
}

// Global error handler
Flight::map('error', function (Throwable $error) {
    handleApiError($error);
});

// Not found handler
Flight::map('notFound', function () {

    Flight::json([
        'error' => 'Endpoint not found',
        'status' => 404
    ], 404);
});

// API welcome endpoint
Flight::route('GET /', function () {

    Flight::json([
        'message' => 'Ace Tennis Academy API',
        'status' => 'running'
    ]);
});

// Load route files
require_once __DIR__ . '/../routes/UserRoutes.php';
require_once __DIR__ . '/../routes/CoachRoutes.php';
require_once __DIR__ . '/../routes/CourtRoutes.php';
require_once __DIR__ . '/../routes/TrainingSessionRoutes.php';
require_once __DIR__ . '/../routes/BookingRoutes.php';
require_once __DIR__ . '/../routes/DocumentationRoutes.php';
require_once __DIR__ . '/../routes/WeatherRoutes.php';

Flight::start();
