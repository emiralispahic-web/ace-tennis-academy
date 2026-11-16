<?php

use OpenApi\Attributes as OA;

class WeatherDocs
{
    #[OA\Get(
        path: "/weather",
        summary: "Get current weather information",
        description: "Retrieves current weather conditions for Sarajevo using the OpenWeatherMap external API. Helps tennis academy users plan outdoor training sessions.",
        tags: ["Weather"],
        responses: [
            new OA\Response(
                response: 200,
                description: "Weather information retrieved successfully",
                content: new OA\JsonContent(
                    ref: "#/components/schemas/Weather"
                )
            ),
            new OA\Response(
                response: 503,
                description: "Weather service is temporarily unavailable",
                content: new OA\JsonContent(
                    ref: "#/components/schemas/Error",
                    example: [
                        "error" => "Weather information is temporarily unavailable. Please try again later.",
                        "status" => 503
                    ]
                )
            )
        ]
    )]
    public function getWeather() {}
}
