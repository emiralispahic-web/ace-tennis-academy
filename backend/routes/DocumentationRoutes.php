<?php

use OpenApi\Generator;

// Generate OpenAPI JSON documentation

Flight::route('GET /openapi.json', function () {
    try {
        $docsDirectory = __DIR__ . '/../docs';

        // Load all documentation classes
        foreach (glob($docsDirectory . '/*.php') as $file) {
            require_once $file;
        }

        // Generate OpenAPI documentation
        $openapi = (new Generator())->generate([
            $docsDirectory
        ]);

        Flight::response()->header(
            'Content-Type',
            'application/json'
        );

        Flight::response()->write($openapi->toJson());

    } catch (Throwable $error) {
        handleApiError($error);
    }
});

// Display Swagger UI

Flight::route('GET /docs', function () {

    Flight::response()->header(
        'Content-Type',
        'text/html; charset=UTF-8'
    );

    Flight::response()->write(<<<HTML
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Ace Tennis Academy - API Documentation</title>

    <link rel="stylesheet"
          href="https://cdn.jsdelivr.net/npm/swagger-ui-dist@5.17.14/swagger-ui.css">

    <style>
        body {
            margin: 0;
            background: #fafafa;
        }
    </style>
</head>

<body>

    <div id="swagger-ui"></div>

    <script src="https://cdn.jsdelivr.net/npm/swagger-ui-dist@5.17.14/swagger-ui-bundle.js"></script>

    <script>
        window.onload = function () {
            SwaggerUIBundle({
                url: "/openapi.json",
                dom_id: "#swagger-ui",
                deepLinking: true,
                presets: [
                    SwaggerUIBundle.presets.apis
                ],
                layout: "BaseLayout"
            });
        };
    </script>

</body>
</html>
HTML
    );
});
