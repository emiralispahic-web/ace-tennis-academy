<?php

require_once __DIR__ . '/../services/WeatherService.php';

Flight::route('GET /weather', function () {
    try {
        $weatherService = new WeatherService();

        $weather = $weatherService->getWeather();

        Flight::json($weather, 200);

    } catch (Throwable $error) {
        error_log('Weather service request failed.');

        Flight::json([
            'error' => 'Weather information is temporarily unavailable. Please try again later.',
            'status' => 503
        ], 503);
    }
});
