
<?php

require_once __DIR__ . '/vendor/autoload.php';

use OpenApi\Generator;

// Load all OpenAPI documentation classes
foreach (glob(__DIR__ . '/docs/*.php') as $file) {
    require_once $file;
}

// Generate OpenAPI documentation
$openapi = (new Generator())->generate([
    __DIR__ . '/docs'
]);

echo $openapi->toJson();
