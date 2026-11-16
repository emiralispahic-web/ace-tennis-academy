
<?php

use OpenApi\Attributes as OA;

class UserDocs
{
    // GET all users

    #[OA\Get(
        path: "/users",
        summary: "Get all users",
        description: "Returns all registered users without their password hashes.",
        tags: ["Users"],
        responses: [
            new OA\Response(
                response: 200,
                description: "Users retrieved successfully",
                content: new OA\JsonContent(
                    type: "array",
                    items: new OA\Items(
                        ref: "#/components/schemas/User"
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
    public function getAllUsers()
    {
    }

    // GET user by ID

    #[OA\Get(
        path: "/users/{id}",
        summary: "Get user by ID",
        tags: ["Users"],
        parameters: [
            new OA\Parameter(
                name: "id",
                in: "path",
                required: true,
                description: "User ID",
                schema: new OA\Schema(type: "integer", example: 1)
            )
        ],
        responses: [
            new OA\Response(
                response: 200,
                description: "User retrieved successfully",
                content: new OA\JsonContent(
                    ref: "#/components/schemas/User"
                )
            ),
            new OA\Response(
                response: 404,
                description: "User not found",
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
    public function getUserById()
    {
    }

    // POST - Create user

    #[OA\Post(
        path: "/users",
        summary: "Create a new user",
        tags: ["Users"],
        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(
                ref: "#/components/schemas/UserInput"
            )
        ),
        responses: [
            new OA\Response(
                response: 201,
                description: "User created successfully",
                content: new OA\JsonContent(
                    ref: "#/components/schemas/SuccessMessage"
                )
            ),
            new OA\Response(
                response: 400,
                description: "Invalid user data or duplicate email",
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
    public function createUser()
    {
    }

    // PUT - Update user

    #[OA\Put(
        path: "/users/{id}",
        summary: "Update an existing user",
        description: "Updates the supplied user fields. Fields not supplied remain unchanged.",
        tags: ["Users"],
        parameters: [
            new OA\Parameter(
                name: "id",
                in: "path",
                required: true,
                description: "User ID",
                schema: new OA\Schema(type: "integer", example: 1)
            )
        ],
        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(
                ref: "#/components/schemas/UserUpdate"
            )
        ),
        responses: [
            new OA\Response(
                response: 200,
                description: "User updated successfully",
                content: new OA\JsonContent(
                    ref: "#/components/schemas/SuccessMessage"
                )
            ),
            new OA\Response(
                response: 400,
                description: "Invalid user data or duplicate email",
                content: new OA\JsonContent(
                    ref: "#/components/schemas/Error"
                )
            ),
            new OA\Response(
                response: 404,
                description: "User not found",
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
    public function updateUser()
    {
    }

    // DELETE - Delete user

    #[OA\Delete(
        path: "/users/{id}",
        summary: "Delete a user",
        tags: ["Users"],
        parameters: [
            new OA\Parameter(
                name: "id",
                in: "path",
                required: true,
                description: "User ID",
                schema: new OA\Schema(type: "integer", example: 1)
            )
        ],
        responses: [
            new OA\Response(
                response: 200,
                description: "User deleted successfully",
                content: new OA\JsonContent(
                    ref: "#/components/schemas/SuccessMessage"
                )
            ),
            new OA\Response(
                response: 404,
                description: "User not found",
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
    public function deleteUser()
    {
    }
}
