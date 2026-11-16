<?php

use OpenApi\Attributes as OA;

class BookingDocs
{
    // GET all bookings

    #[OA\Get(
        path: "/bookings",
        summary: "Get all bookings",
        description: "Returns all student bookings, including their training session, status and booking date.",
        tags: ["Bookings"],
        responses: [
            new OA\Response(
                response: 200,
                description: "Bookings retrieved successfully",
                content: new OA\JsonContent(
                    type: "array",
                    items: new OA\Items(
                        ref: "#/components/schemas/Booking"
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
    public function getAllBookings()
    {
    }

    // GET booking by ID

    #[OA\Get(
        path: "/bookings/{id}",
        summary: "Get booking by ID",
        tags: ["Bookings"],
        parameters: [
            new OA\Parameter(
                name: "id",
                in: "path",
                required: true,
                description: "Booking ID",
                schema: new OA\Schema(type: "integer", example: 1)
            )
        ],
        responses: [
            new OA\Response(
                response: 200,
                description: "Booking retrieved successfully",
                content: new OA\JsonContent(
                    ref: "#/components/schemas/Booking"
                )
            ),
            new OA\Response(
                response: 404,
                description: "Booking not found",
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
    public function getBookingById()
    {
    }

    // POST - Create booking

    #[OA\Post(
        path: "/bookings",
        summary: "Create a student booking",
        description: "Creates a booking for an existing student and training session. Duplicate bookings are not allowed. Pending and confirmed bookings count towards the session capacity.",
        tags: ["Bookings"],
        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(
                ref: "#/components/schemas/BookingInput"
            )
        ),
        responses: [
            new OA\Response(
                response: 201,
                description: "Booking created successfully",
                content: new OA\JsonContent(
                    ref: "#/components/schemas/SuccessMessage"
                )
            ),
            new OA\Response(
                response: 400,
                description: "Invalid booking data, incorrect user role, duplicate booking or session capacity reached",
                content: new OA\JsonContent(
                    ref: "#/components/schemas/Error"
                )
            ),
            new OA\Response(
                response: 404,
                description: "User or training session not found",
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
    public function createBooking()
    {
    }

    // PUT - Update booking

    #[OA\Put(
        path: "/bookings/{id}",
        summary: "Update a booking",
        description: "Updates the supplied booking fields. Fields not supplied remain unchanged. A booking can be pending, confirmed or cancelled. Duplicate and capacity rules are checked before updating.",
        tags: ["Bookings"],
        parameters: [
            new OA\Parameter(
                name: "id",
                in: "path",
                required: true,
                description: "Booking ID",
                schema: new OA\Schema(type: "integer", example: 1)
            )
        ],
        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(
                ref: "#/components/schemas/BookingUpdate"
            )
        ),
        responses: [
            new OA\Response(
                response: 200,
                description: "Booking updated successfully",
                content: new OA\JsonContent(
                    ref: "#/components/schemas/SuccessMessage"
                )
            ),
            new OA\Response(
                response: 400,
                description: "Invalid booking data, duplicate booking or session capacity reached",
                content: new OA\JsonContent(
                    ref: "#/components/schemas/Error"
                )
            ),
            new OA\Response(
                response: 404,
                description: "Booking, user or training session not found",
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
    public function updateBooking()
    {
    }

    // DELETE - Delete booking

    #[OA\Delete(
        path: "/bookings/{id}",
        summary: "Delete a booking",
        tags: ["Bookings"],
        parameters: [
            new OA\Parameter(
                name: "id",
                in: "path",
                required: true,
                description: "Booking ID",
                schema: new OA\Schema(type: "integer", example: 1)
            )
        ],
        responses: [
            new OA\Response(
                response: 200,
                description: "Booking deleted successfully",
                content: new OA\JsonContent(
                    ref: "#/components/schemas/SuccessMessage"
                )
            ),
            new OA\Response(
                response: 404,
                description: "Booking not found",
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
    public function deleteBooking()
    {
    }
}
