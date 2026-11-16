<?php

use OpenApi\Attributes as OA;

#[OA\Info(
    title: "Ace Tennis Academy API",
    version: "1.0.0",
    description: "REST API for managing users, coaches, tennis courts, training sessions and bookings."
)]

#[OA\Server(
    url: "http://localhost:8000",
    description: "Local development server"
)]

#[OA\Tag(
    name: "Users",
    description: "User management operations"
)]

#[OA\Tag(
    name: "Coaches",
    description: "Coach management operations"
)]

#[OA\Tag(
    name: "Courts",
    description: "Tennis court management operations"
)]

#[OA\Tag(
    name: "Training Sessions",
    description: "Training session management operations"
)]

#[OA\Tag(
    name: "Bookings",
    description: "Student booking management operations"
)]
#[OA\Tag(
    name: "Weather",
    description: "Current weather information from OpenWeatherMap for outdoor tennis activities"
)]

class OpenApiDocumentation
{
}
