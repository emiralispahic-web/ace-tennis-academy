<?php

use OpenApi\Attributes as OA;

#[OA\Schema(
    schema: "Error",
    required: ["error", "status"],
    properties: [
        new OA\Property(
            property: "error",
            type: "string",
            example: "Record not found"
        ),
        new OA\Property(
            property: "status",
            type: "integer",
            example: 404
        )
    ],
    type: "object"
)]
class ErrorSchema
{
}

#[OA\Schema(
    schema: "SuccessMessage",
    required: ["message"],
    properties: [
        new OA\Property(
            property: "message",
            type: "string",
            example: "Record created successfully"
        )
    ],
    type: "object"
)]
class SuccessMessageSchema
{
}

#[OA\Schema(
    schema: "User",
    type: "object",
    properties: [
        new OA\Property(property: "id", type: "integer", example: 1),
        new OA\Property(property: "full_name", type: "string", example: "Admin Ace"),
        new OA\Property(property: "email", type: "string", example: "admin@acetennis.test"),
        new OA\Property(property: "phone", type: "string", nullable: true, example: "061123456"),
        new OA\Property(property: "role", type: "string", enum: ["admin", "coach", "student"], example: "student"),
        new OA\Property(property: "created_at", type: "string", example: "2026-11-01 19:39:13")
    ]
)]
class UserSchema
{
}

#[OA\Schema(
    schema: "UserInput",
    type: "object",
    required: ["full_name", "email", "password", "role"],
    properties: [
        new OA\Property(property: "full_name", type: "string", maxLength: 100, example: "New Student"),
        new OA\Property(property: "email", type: "string", format: "email", maxLength: 150, example: "student@acetennis.test"),
        new OA\Property(property: "password", type: "string", format: "password", minLength: 8, example: "Tennis123"),
        new OA\Property(property: "phone", type: "string", nullable: true, maxLength: 30, example: "061123456"),
        new OA\Property(property: "role", type: "string", enum: ["admin", "coach", "student"], example: "student")
    ]
)]
class UserInputSchema
{
}

#[OA\Schema(
    schema: "UserUpdate",
    type: "object",
    properties: [
        new OA\Property(property: "full_name", type: "string", maxLength: 100, example: "Updated Student"),
        new OA\Property(property: "email", type: "string", format: "email", maxLength: 150, example: "student@acetennis.test"),
        new OA\Property(property: "password", type: "string", format: "password", minLength: 8, example: "NewTennis123"),
        new OA\Property(property: "phone", type: "string", nullable: true, maxLength: 30, example: "061999999"),
        new OA\Property(property: "role", type: "string", enum: ["admin", "coach", "student"], example: "student")
    ]
)]
class UserUpdateSchema
{
}

#[OA\Schema(
    schema: "Coach",
    type: "object",
    properties: [
        new OA\Property(property: "id", type: "integer", example: 1),
        new OA\Property(property: "user_id", type: "integer", example: 2),
        new OA\Property(property: "specialization", type: "string", example: "Beginner and Junior Tennis"),
        new OA\Property(property: "experience_years", type: "integer", nullable: true, example: 5),
        new OA\Property(property: "bio", type: "string", nullable: true, example: "Experienced junior tennis coach.")
    ]
)]
class CoachSchema
{
}

#[OA\Schema(
    schema: "CoachInput",
    type: "object",
    required: ["user_id", "specialization"],
    properties: [
        new OA\Property(property: "user_id", type: "integer", minimum: 1, example: 2),
        new OA\Property(property: "specialization", type: "string", maxLength: 100, example: "Junior Tennis"),
        new OA\Property(property: "experience_years", type: "integer", minimum: 0, nullable: true, example: 4),
        new OA\Property(property: "bio", type: "string", nullable: true, example: "Junior tennis coach.")
    ]
)]
class CoachInputSchema
{
}

#[OA\Schema(
    schema: "CoachUpdate",
    type: "object",
    properties: [
        new OA\Property(property: "user_id", type: "integer", minimum: 1, example: 2),
        new OA\Property(property: "specialization", type: "string", maxLength: 100, example: "Advanced Junior Tennis"),
        new OA\Property(property: "experience_years", type: "integer", minimum: 0, nullable: true, example: 6),
        new OA\Property(property: "bio", type: "string", nullable: true, example: "Experienced tennis coach.")
    ]
)]
class CoachUpdateSchema
{
}

#[OA\Schema(
    schema: "Court",
    type: "object",
    properties: [
        new OA\Property(property: "id", type: "integer", example: 1),
        new OA\Property(property: "name", type: "string", example: "Court 1"),
        new OA\Property(property: "surface", type: "string", enum: ["Clay", "Hard", "Grass"], example: "Clay"),
        new OA\Property(property: "court_type", type: "string", enum: ["Indoor", "Outdoor"], example: "Outdoor"),
        new OA\Property(property: "hourly_price", type: "string", example: "25.00"),
        new OA\Property(property: "is_available", type: "integer", enum: [0, 1], example: 1)
    ]
)]
class CourtSchema
{
}

#[OA\Schema(
    schema: "CourtInput",
    type: "object",
    required: ["name", "surface", "court_type", "hourly_price"],
    properties: [
        new OA\Property(property: "name", type: "string", maxLength: 100, example: "New Tennis Court"),
        new OA\Property(property: "surface", type: "string", enum: ["Clay", "Hard", "Grass"], example: "Hard"),
        new OA\Property(property: "court_type", type: "string", enum: ["Indoor", "Outdoor"], example: "Indoor"),
        new OA\Property(property: "hourly_price", type: "number", format: "float", minimum: 0, exclusiveMinimum: true, example: 35),
        new OA\Property(property: "is_available", type: "integer", enum: [0, 1], default: 1, example: 1)
    ]
)]
class CourtInputSchema
{
}

#[OA\Schema(
    schema: "CourtUpdate",
    type: "object",
    properties: [
        new OA\Property(property: "name", type: "string", maxLength: 100, example: "Updated Tennis Court"),
        new OA\Property(property: "surface", type: "string", enum: ["Clay", "Hard", "Grass"], example: "Hard"),
        new OA\Property(property: "court_type", type: "string", enum: ["Indoor", "Outdoor"], example: "Indoor"),
        new OA\Property(property: "hourly_price", type: "number", format: "float", minimum: 0, exclusiveMinimum: true, example: 45),
        new OA\Property(property: "is_available", type: "integer", enum: [0, 1], example: 0)
    ]
)]
class CourtUpdateSchema
{
}

#[OA\Schema(
    schema: "TrainingSession",
    type: "object",
    properties: [
        new OA\Property(property: "id", type: "integer", example: 1),
        new OA\Property(property: "coach_id", type: "integer", example: 1),
        new OA\Property(property: "court_id", type: "integer", example: 1),
        new OA\Property(property: "title", type: "string", example: "Beginner Tennis Training"),
        new OA\Property(property: "session_date", type: "string", format: "date", example: "2026-12-20"),
        new OA\Property(property: "start_time", type: "string", example: "10:00:00"),
        new OA\Property(property: "end_time", type: "string", example: "11:00:00"),
        new OA\Property(property: "price", type: "string", example: "25.00"),
        new OA\Property(property: "capacity", type: "integer", example: 8)
    ]
)]
class TrainingSessionSchema
{
}

#[OA\Schema(
    schema: "TrainingSessionInput",
    type: "object",
    required: [
        "coach_id",
        "court_id",
        "title",
        "session_date",
        "start_time",
        "end_time",
        "price",
        "capacity"
    ],
    properties: [
        new OA\Property(property: "coach_id", type: "integer", minimum: 1, example: 1),
        new OA\Property(property: "court_id", type: "integer", minimum: 1, example: 1),
        new OA\Property(property: "title", type: "string", maxLength: 150, example: "New Tennis Training"),
        new OA\Property(property: "session_date", type: "string", format: "date", example: "2026-12-20"),
        new OA\Property(property: "start_time", type: "string", example: "10:00:00"),
        new OA\Property(property: "end_time", type: "string", example: "11:00:00"),
        new OA\Property(property: "price", type: "number", format: "float", minimum: 0, exclusiveMinimum: true, example: 25),
        new OA\Property(property: "capacity", type: "integer", minimum: 1, example: 6)
    ]
)]
class TrainingSessionInputSchema
{
}

#[OA\Schema(
    schema: "TrainingSessionUpdate",
    type: "object",
    properties: [
        new OA\Property(property: "coach_id", type: "integer", minimum: 1, example: 1),
        new OA\Property(property: "court_id", type: "integer", minimum: 1, example: 1),
        new OA\Property(property: "title", type: "string", maxLength: 150, example: "Updated Tennis Training"),
        new OA\Property(property: "session_date", type: "string", format: "date", example: "2026-12-20"),
        new OA\Property(property: "start_time", type: "string", example: "10:00:00"),
        new OA\Property(property: "end_time", type: "string", example: "11:00:00"),
        new OA\Property(property: "price", type: "number", format: "float", minimum: 0, exclusiveMinimum: true, example: 30),
        new OA\Property(property: "capacity", type: "integer", minimum: 1, example: 8)
    ]
)]
class TrainingSessionUpdateSchema
{
}

#[OA\Schema(
    schema: "Booking",
    type: "object",
    properties: [
        new OA\Property(property: "id", type: "integer", example: 1),
        new OA\Property(property: "user_id", type: "integer", example: 4),
        new OA\Property(property: "training_session_id", type: "integer", example: 1),
        new OA\Property(property: "status", type: "string", enum: ["pending", "confirmed", "cancelled"], example: "confirmed"),
        new OA\Property(property: "booked_at", type: "string", example: "2026-11-01 19:39:13")
    ]
)]
class BookingSchema
{
}

#[OA\Schema(
    schema: "BookingInput",
    type: "object",
    required: ["user_id", "training_session_id"],
    properties: [
        new OA\Property(property: "user_id", type: "integer", minimum: 1, example: 4),
        new OA\Property(property: "training_session_id", type: "integer", minimum: 1, example: 3),
        new OA\Property(
            property: "status",
            type: "string",
            enum: ["pending", "confirmed", "cancelled"],
            default: "pending",
            example: "pending"
        )
    ]
)]
class BookingInputSchema
{
}

#[OA\Schema(
    schema: "BookingUpdate",
    type: "object",
    properties: [
        new OA\Property(property: "user_id", type: "integer", minimum: 1, example: 4),
        new OA\Property(property: "training_session_id", type: "integer", minimum: 1, example: 3),
        new OA\Property(
            property: "status",
            type: "string",
            enum: ["pending", "confirmed", "cancelled"],
            example: "confirmed"
        )
    ]
)]
class BookingUpdateSchema
{
}

#[OA\Schema(
    schema: "Weather",
    type: "object",
    required: [
        "city",
        "temperature",
        "feels_like",
        "humidity",
        "description",
        "wind_speed",
        "temperature_unit",
        "wind_speed_unit"
    ],
    properties: [
        new OA\Property(
            property: "city",
            type: "string",
            example: "Sarajevo"
        ),
        new OA\Property(
            property: "temperature",
            type: "number",
            format: "float",
            example: 12.5
        ),
        new OA\Property(
            property: "feels_like",
            type: "number",
            format: "float",
            example: 11.2
        ),
        new OA\Property(
            property: "humidity",
            type: "integer",
            minimum: 0,
            maximum: 100,
            example: 75
        ),
        new OA\Property(
            property: "description",
            type: "string",
            example: "overcast clouds"
        ),
        new OA\Property(
            property: "wind_speed",
            type: "number",
            format: "float",
            example: 8.64
        ),
        new OA\Property(
            property: "temperature_unit",
            type: "string",
            example: "Celsius"
        ),
        new OA\Property(
            property: "wind_speed_unit",
            type: "string",
            example: "km/h"
        )
    ]
)]
class WeatherSchema {}
