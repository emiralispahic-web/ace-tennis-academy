
<?php

require_once __DIR__ . '/services/TrainingSessionService.php';

try {

    $sessionService = new TrainingSessionService();

    echo "=== TRAINING SESSION SERVICE TEST ===\n\n";

    $sessions = $sessionService->getAll();

    echo "Total sessions: " . count($sessions) . "\n\n";

    foreach ($sessions as $session) {
        echo $session['id'] . " - "
            . $session['title'] . " - "
            . $session['session_date'] . " - "
            . $session['price'] . " KM\n";
    }

    echo "\n=== GET SESSION BY ID ===\n";

    print_r($sessionService->getById(1));

    $testData = [
        'coach_id' => 1,
        'court_id' => 1,
        'title' => 'Test Training',
        'session_date' => '2026-12-01',
        'start_time' => '10:00:00',
        'end_time' => '11:00:00',
        'price' => 25,
        'capacity' => 8
    ];

    echo "\n=== INVALID COACH TEST ===\n";

    try {
        $data = $testData;
        $data['coach_id'] = 999999;

        $sessionService->create($data);

        echo "FAILED: Invalid coach accepted\n";

    } catch (Exception $e) {
        echo "Expected error: " . $e->getMessage() . "\n";
    }

    echo "\n=== INVALID COURT TEST ===\n";

    try {
        $data = $testData;
        $data['court_id'] = 999999;

        $sessionService->create($data);

        echo "FAILED: Invalid court accepted\n";

    } catch (Exception $e) {
        echo "Expected error: " . $e->getMessage() . "\n";
    }

    echo "\n=== INVALID DATE TEST ===\n";

    try {
        $data = $testData;
        $data['session_date'] = '2026-02-30';

        $sessionService->create($data);

        echo "FAILED: Invalid date accepted\n";

    } catch (Exception $e) {
        echo "Expected error: " . $e->getMessage() . "\n";
    }

    echo "\n=== INVALID TIME TEST ===\n";

    try {
        $data = $testData;
        $data['start_time'] = '12:00:00';
        $data['end_time'] = '11:00:00';

        $sessionService->create($data);

        echo "FAILED: Invalid time accepted\n";

    } catch (Exception $e) {
        echo "Expected error: " . $e->getMessage() . "\n";
    }

    echo "\n=== INVALID PRICE TEST ===\n";

    try {
        $data = $testData;
        $data['price'] = -25;

        $sessionService->create($data);

        echo "FAILED: Invalid price accepted\n";

    } catch (Exception $e) {
        echo "Expected error: " . $e->getMessage() . "\n";
    }

    echo "\n=== INVALID CAPACITY TEST ===\n";

    try {
        $data = $testData;
        $data['capacity'] = 0;

        $sessionService->create($data);

        echo "FAILED: Invalid capacity accepted\n";

    } catch (Exception $e) {
        echo "Expected error: " . $e->getMessage() . "\n";
    }

    echo "\n=== COURT CONFLICT TEST ===\n";

    try {
        $data = $testData;
        $data['coach_id'] = 2;
        $data['session_date'] = '2026-11-05';
        $data['start_time'] = '10:30:00';
        $data['end_time'] = '11:30:00';

        $sessionService->create($data);

        echo "FAILED: Court conflict accepted\n";

    } catch (Exception $e) {
        echo "Expected error: " . $e->getMessage() . "\n";
    }

    echo "\n=== COACH CONFLICT TEST ===\n";

    try {
        $data = $testData;
        $data['court_id'] = 2;
        $data['session_date'] = '2026-11-05';
        $data['start_time'] = '10:30:00';
        $data['end_time'] = '11:30:00';

        $sessionService->create($data);

        echo "FAILED: Coach conflict accepted\n";

    } catch (Exception $e) {
        echo "Expected error: " . $e->getMessage() . "\n";
    }

    echo "\n=== NOT FOUND TEST ===\n";

    try {
        $sessionService->getById(999999);

        echo "FAILED: Nonexistent session found\n";

    } catch (Exception $e) {
        echo "Expected error: " . $e->getMessage() . "\n";
    }

    echo "\nTrainingSessionService tests completed!\n";

} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
