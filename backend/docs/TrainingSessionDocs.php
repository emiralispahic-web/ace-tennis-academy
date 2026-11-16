<?php

use OpenApi\Attributes as OA;

class TrainingSessionDocs
{
    // GET all training sessions

    #[OA\Get(
        path: "/training-sessions",
        summary: "Get all training sessions",
        description: "Returns all tennis training sessions with their coach, court, date, time, price and capacity.",
        tags: ["Training Sessions"],
        responses: [
            new OA\Response(
                response: 200,
                description: "Training sessions retrieved successfully",
                content: new OA\JsonContent(
                    type: "array",
                    items: new OA\Items(
                        ref: "#/components/schemas/TrainingSession"
                    )
                )
            ),
            new OA\Response(
                response: 500,
                description: "Internal server error",
                content: new OA\JsonContent(
                    ref: "#/components/schemas/Error"
                )
            )
        ]
    )]
    public function getAllTrainingSessions()
    {
    }

    // GET training session by ID

    #[OA\Get(
        path: "/training-sessions/{id}",
        summary: "Get training session by ID",
        tags: ["Training Sessions"],
        parameters: [
            new OA\Parameter(
                name: "id",
                in: "path",
                required: true,
                description: "Training session ID",
                schema: new OA\Schema(type: "integer", example: 1)
            )
        ],
        responses: [
            new OA\Response(
                response: 200,
                description: "Training session retrieved successfully",
                content: new OA\JsonContent(
                    ref: "#/components/schemas/TrainingSession"
                )
            ),
            new OA\Response(
                response: 404,
                description: "Training session not found",
                content: new OA\JsonContent(
                    ref: "#/components/schemas/Error"
                )
            ),
            new OA\Response(
                response: 500,
                description: "Internal server error",
                content: new OA\JsonContent(
                    ref: "#/components/schemas/Error"
                )
            )
        ]
    )]
    public function getTrainingSessionById()
    {
    }

    // POST - Create training session

    #[OA\Post(
        path: "/training-sessions",
        summary: "Create a training session",
        description: "Creates a training session with an existing coach and available court. The end time must be after the start time. Overlapping court or coach schedules are not allowed.",
        tags: ["Training Sessions"],
        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(
                ref: "#/components/schemas/TrainingSessionInput"
            )
        ),
        responses: [
            new OA\Response(
                response: 201,
                description: "Training session created successfully",
                content: new OA\JsonContent(
                    ref: "#/components/schemas/SuccessMessage"
                )
            ),
            new OA\Response(
                response: 400,
                description: "Invalid session data, unavailable court or scheduling conflict",
                content: new OA\JsonContent(
                    ref: "#/components/schemas/Error"
                )
            ),
            new OA\Response(
                response: 404,
                description: "Coach or court not found",
                content: new OA\JsonContent(
                    ref: "#/components/schemas/Error"
                )
            ),
            new OA\Response(
                response: 500,
                description: "Internal server error",
                content: new OA\JsonContent(
                    ref: "#/components/schemas/Error"
                )
            )
        ]
    )]
    public function createTrainingSession()
    {
    }

    // PUT - Update training session

    #[OA\Put(
        path: "/training-sessions/{id}",
        summary: "Update a training session",
        description: "Updates the supplied session fields. Fields not supplied remain unchanged. Scheduling conflicts are checked before updating.",
        tags: ["Training Sessions"],
        parameters: [
            new OA\Parameter(
                name: "id",
                in: "path",
                required: true,
                description: "Training session ID",
                schema: new OA\Schema(type: "integer", example: 1)
            )
        ],
        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(
                ref: "#/components/schemas/TrainingSessionUpdate"
            )
        ),
        responses: [
            new OA\Response(
                response: 200,
                description: "Training session updated successfully",
                content: new OA\JsonContent(
                    ref: "#/components/schemas/SuccessMessage"
                )
            ),
            new OA\Response(
                response: 400,
                description: "Invalid session data or scheduling conflict",
                content: new OA\JsonContent(
                    ref: "#/components/schemas/Error"
                )
            ),
            new OA\Response(
                response: 404,
                description: "Training session, coach or court not found",
                content: new OA\JsonContent(
                    ref: "#/components/schemas/Error"
                )
            ),
            new OA\Response(
                response: 500,
                description: "Internal server error",
                content: new OA\JsonContent(
                    ref: "#/components/schemas/Error"
                )
            )
        ]
    )]
    public function updateTrainingSession()
    {
    }

    // DELETE - Delete training session

    #[OA\Delete(
        path: "/training-sessions/{id}",
        summary: "Delete a training session",
        tags: ["Training Sessions"],
        parameters: [
            new OA\Parameter(
                name: "id",
                in: "path",
                required: true,
                description: "Training session ID",
                schema: new OA\Schema(type: "integer", example: 1)
            )
        ],
        responses: [
            new OA\Response(
                response: 200,
                description: "Training session deleted successfully",
                content: new OA\JsonContent(
                    ref: "#/components/schemas/SuccessMessage"
                )
            ),
            new OA\Response(
                response: 404,
                description: "Training session not found",
                content: new OA\JsonContent(
                    ref: "#/components/schemas/Error"
                )
            ),
            new OA\Response(
                response: 500,
                description: "Internal server error",
                content: new OA\JsonContent(
                    ref: "#/components/schemas/Error"
                )
            )
        ]
    )]
    public function deleteTrainingSession()
    {
    }
}
