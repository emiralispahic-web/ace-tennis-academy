
<?php

require_once __DIR__ . '/services/CoachService.php';

try {
    $coachService = new CoachService();

    echo "=== COACH SERVICE TEST ===\n\n";

    $coaches = $coachService->getAll();

    echo "Total coaches: " . count($coaches) . "\n\n";

    foreach ($coaches as $coach) {
        echo $coach['id'] . " - "
            . $coach['specialization'] . " - "
            . $coach['experience_years'] . " years\n";
    }

    echo "\n=== GET COACH BY ID ===\n";

    print_r($coachService->getById(1));

    echo "\n=== DUPLICATE COACH TEST ===\n";

    try {
        $coachService->create([
            'user_id' => 2,
            'specialization' => 'Tennis Training',
            'experience_years' => 3,
            'bio' => 'Test coach'
        ]);
    } catch (Exception $e) {
        echo "Expected error: " . $e->getMessage() . "\n";
    }

    echo "\n=== INVALID ROLE TEST ===\n";

    try {
        $coachService->create([
            'user_id' => 4,
            'specialization' => 'Tennis Training',
            'experience_years' => 2,
            'bio' => 'Test coach'
        ]);
    } catch (Exception $e) {
        echo "Expected error: " . $e->getMessage() . "\n";
    }

    echo "\n=== INVALID EXPERIENCE TEST ===\n";

    try {
        $coachService->create([
            'user_id' => 2,
            'specialization' => 'Tennis Training',
            'experience_years' => -5,
            'bio' => 'Test coach'
        ]);
    } catch (Exception $e) {
        echo "Expected error: " . $e->getMessage() . "\n";
    }

    echo "\n=== NOT FOUND TEST ===\n";

    try {
        $coachService->getById(999999);
    } catch (Exception $e) {
        echo "Expected error: " . $e->getMessage() . "\n";
    }

    echo "\nCoachService tests completed!\n";

} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
