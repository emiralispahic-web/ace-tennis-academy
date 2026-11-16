<?php

use OpenApi\Attributes as OA;

class CoachDocs
{
    // GET all coaches

    #[OA\Get(
        path: "/coaches",
        summary: "Get all coaches",
        description: "Returns a list of all tennis coach profiles.",
        tags: ["Coaches"],
        responses: [
            new OA\Response(
                response: 200,
                description: "Coaches retrieved successfully",
                content: new OA\JsonContent(
                    type: "array",
                    items: new OA\Items(
                        ref: "#/components/schemas/Coach"
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
    public function getAllCoaches()
    {
    }

    // GET coach by ID

    #[OA\Get(
        path: "/coaches/{id}",
        summary: "Get coach by ID",
        tags: ["Coaches"],
        parameters: [
            new OA\Parameter(
                name: "id",
                in: "path",
                required: true,
                description: "Coach profile ID",
                schema: new OA\Schema(type: "integer", example: 1)
            )
        ],
        responses: [
            new OA\Response(
                response: 200,
                description: "Coach retrieved successfully",
                content: new OA\JsonContent(
                    ref: "#/components/schemas/Coach"
                )
            ),
            new OA\Response(
                response: 404,
                description: "Coach not found",
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
    public function getCoachById()
    {
    }

    // POST - Create coach

    #[OA\Post(
        path: "/coaches",
        summary: "Create a coach profile",
        description: "Creates a coach profile for an existing user with the coach role. Each user can have only one coach profile.",
        tags: ["Coaches"],
        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(
                ref: "#/components/schemas/CoachInput"
            )
        ),
        responses: [
            new OA\Response(
                response: 201,
                description: "Coach created successfully",
                content: new OA\JsonContent(
                    ref: "#/components/schemas/SuccessMessage"
                )
            ),
            new OA\Response(
                response: 400,
                description: "Invalid coach data, incorrect user role or duplicate coach profile",
                content: new OA\JsonContent(
                    ref: "#/components/schemas/Error"
                )
            ),
            new OA\Response(
                response: 404,
                description: "Associated user not found",
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
    public function createCoach()
    {
    }

    // PUT - Update coach

    #[OA\Put(
        path: "/coaches/{id}",
        summary: "Update a coach profile",
        description: "Updates the supplied coach fields. Fields not supplied remain unchanged.",
        tags: ["Coaches"],
        parameters: [
            new OA\Parameter(
                name: "id",
                in: "path",
                required: true,
                description: "Coach profile ID",
                schema: new OA\Schema(type: "integer", example: 1)
            )
        ],
        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(
                ref: "#/components/schemas/CoachUpdate"
            )
        ),
        responses: [
            new OA\Response(
                response: 200,
                description: "Coach updated successfully",
                content: new OA\JsonContent(
                    ref: "#/components/schemas/SuccessMessage"
                )
            ),
            new OA\Response(
                response: 400,
                description: "Invalid coach data or duplicate coach profile",
                content: new OA\JsonContent(
                    ref: "#/components/schemas/Error"
                )
            ),
            new OA\Response(
                response: 404,
                description: "Coach or associated user not found",
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
    public function updateCoach()
    {
    }

    // DELETE - Delete coach

    #[OA\Delete(
        path: "/coaches/{id}",
        summary: "Delete a coach profile",
        tags: ["Coaches"],
        parameters: [
            new OA\Parameter(
                name: "id",
                in: "path",
                required: true,
                description: "Coach profile ID",
                schema: new OA\Schema(type: "integer", example: 1)
            )
        ],
        responses: [
            new OA\Response(
                response: 200,
                description: "Coach deleted successfully",
                content: new OA\JsonContent(
                    ref: "#/components/schemas/SuccessMessage"
                )
            ),
            new OA\Response(
                response: 404,
                description: "Coach not found",
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
    public function deleteCoach()
    {
    }
}
