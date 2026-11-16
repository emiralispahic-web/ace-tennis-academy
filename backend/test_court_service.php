
<?php

require_once __DIR__ . '/services/CourtService.php';

try {
    $courtService = new CourtService();

    echo "=== COURT SERVICE TEST ===\n\n";

    $courts = $courtService->getAll();

    echo "Total courts: " . count($courts) . "\n\n";

    foreach ($courts as $court) {
        echo $court['id'] . " - "
            . $court['name'] . " - "
            . $court['surface'] . " - "
            . $court['court_type'] . " - "
            . $court['hourly_price'] . " KM/hour\n";
    }

    echo "\n=== GET COURT BY ID ===\n";

    print_r($courtService->getById(1));

    echo "\n=== INVALID PRICE TEST ===\n";

    try {
        $courtService->create([
            'name' => 'Test Court',
            'surface' => 'Clay',
            'court_type' => 'Outdoor',
            'hourly_price' => -25,
            'is_available' => 1
        ]);
    } catch (Exception $e) {
        echo "Expected error: "
            . $e->getMessage() . "\n";
    }

    echo "\n=== INVALID SURFACE TEST ===\n";

    try {
        $courtService->create([
            'name' => 'Test Court',
            'surface' => 'Invalid Surface',
            'court_type' => 'Outdoor',
            'hourly_price' => 30,
            'is_available' => 1
        ]);
    } catch (Exception $e) {
        echo "Expected error: "
            . $e->getMessage() . "\n";
    }

    echo "\n=== INVALID COURT TYPE TEST ===\n";

    try {
        $courtService->create([
            'name' => 'Test Court',
            'surface' => 'Clay',
            'court_type' => 'Invalid Type',
            'hourly_price' => 30,
            'is_available' => 1
        ]);
    } catch (Exception $e) {
        echo "Expected error: "
            . $e->getMessage() . "\n";
    }

    echo "\n=== INVALID AVAILABILITY TEST ===\n";

    try {
        $courtService->create([
            'name' => 'Test Court',
            'surface' => 'Clay',
            'court_type' => 'Outdoor',
            'hourly_price' => 30,
            'is_available' => 5
        ]);
    } catch (Exception $e) {
        echo "Expected error: "
            . $e->getMessage() . "\n";
    }

    echo "\n=== NOT FOUND TEST ===\n";

    try {
        $courtService->getById(999999);
    } catch (Exception $e) {
        echo "Expected error: "
            . $e->getMessage() . "\n";
    }

    echo "\nCourtService tests completed!\n";

} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
