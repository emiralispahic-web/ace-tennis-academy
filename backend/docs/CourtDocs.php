<?php

use OpenApi\Attributes as OA;

class CourtDocs
{
    // GET all courts

    #[OA\Get(
        path: "/courts",
        summary: "Get all tennis courts",
        description: "Returns all tennis courts, including their surface, type, hourly price and availability.",
        tags: ["Courts"],
        responses: [
            new OA\Response(
                response: 200,
                description: "Courts retrieved successfully",
                content: new OA\JsonContent(
                    type: "array",
                    items: new OA\Items(
                        ref: "#/components/schemas/Court"
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
    public function getAllCourts()
    {
    }

    // GET court by ID

    #[OA\Get(
        path: "/courts/{id}",
        summary: "Get court by ID",
        tags: ["Courts"],
        parameters: [
            new OA\Parameter(
                name: "id",
                in: "path",
                required: true,
                description: "Court ID",
                schema: new OA\Schema(type: "integer", example: 1)
            )
        ],
        responses: [
            new OA\Response(
                response: 200,
                description: "Court retrieved successfully",
                content: new OA\JsonContent(
                    ref: "#/components/schemas/Court"
                )
            ),
            new OA\Response(
                response: 404,
                description: "Court not found",
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
    public function getCourtById()
    {
    }

    // POST - Create court

    #[OA\Post(
        path: "/courts",
        summary: "Create a tennis court",
        description: "Creates a court with a valid surface, court type and positive hourly price.",
        tags: ["Courts"],
        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(
                ref: "#/components/schemas/CourtInput"
            )
        ),
        responses: [
            new OA\Response(
                response: 201,
                description: "Court created successfully",
                content: new OA\JsonContent(
                    ref: "#/components/schemas/SuccessMessage"
                )
            ),
            new OA\Response(
                response: 400,
                description: "Invalid court data, surface, type, price or availability",
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
    public function createCourt()
    {
    }

    // PUT - Update court

    #[OA\Put(
        path: "/courts/{id}",
        summary: "Update a tennis court",
        description: "Updates the supplied court fields. Fields not supplied remain unchanged.",
        tags: ["Courts"],
        parameters: [
            new OA\Parameter(
                name: "id",
                in: "path",
                required: true,
                description: "Court ID",
                schema: new OA\Schema(type: "integer", example: 1)
            )
        ],
        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(
                ref: "#/components/schemas/CourtUpdate"
            )
        ),
        responses: [
            new OA\Response(
                response: 200,
                description: "Court updated successfully",
                content: new OA\JsonContent(
                    ref: "#/components/schemas/SuccessMessage"
                )
            ),
            new OA\Response(
                response: 400,
                description: "Invalid court data",
                content: new OA\JsonContent(
                    ref: "#/components/schemas/Error"
                )
            ),
            new OA\Response(
                response: 404,
                description: "Court not found",
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
    public function updateCourt()
    {
    }

    // DELETE - Delete court

    #[OA\Delete(
        path: "/courts/{id}",
        summary: "Delete a tennis court",
        tags: ["Courts"],
        parameters: [
            new OA\Parameter(
                name: "id",
                in: "path",
                required: true,
                description: "Court ID",
                schema: new OA\Schema(type: "integer", example: 1)
            )
        ],
        responses: [
            new OA\Response(
                response: 200,
                description: "Court deleted successfully",
                content: new OA\JsonContent(
                    ref: "#/components/schemas/SuccessMessage"
                )
            ),
            new OA\Response(
                response: 404,
                description: "Court not found",
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
    public function deleteCourt()
    {
    }
}
