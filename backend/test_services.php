
<?php

require_once __DIR__ . '/services/UserService.php';

try {
    $userService = new UserService();

    echo "=== USER SERVICE TEST ===\n\n";

    $users = $userService->getAll();

    echo "Total users: " . count($users) . "\n\n";

    foreach ($users as $user) {
        echo $user['id'] . " - "
            . $user['full_name'] . " - "
            . $user['role'] . "\n";
    }

    echo "\n=== GET USER BY ID ===\n";

    print_r($userService->getById(1));

    echo "\n=== VALIDATION TEST ===\n";

    try {
        $userService->create([
            'full_name' => 'Test User',
            'email' => 'invalid-email',
            'password' => 'Tennis123',
            'role' => 'student'
        ]);
    } catch (Exception $e) {
        echo "Expected error: " . $e->getMessage() . "\n";
    }

    echo "\n=== NOT FOUND TEST ===\n";

    try {
        $userService->getById(999999);
    } catch (Exception $e) {
        echo "Expected error: " . $e->getMessage() . "\n";
    }

    echo "\nUserService tests completed!\n";

} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
