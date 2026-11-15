
<?php

require_once __DIR__ . '/services/BookingService.php';

try {

    $bookingService = new BookingService();

    echo "=== BOOKING SERVICE TEST ===\n\n";

    $bookings = $bookingService->getAll();

    echo "Total bookings: " . count($bookings) . "\n\n";

    foreach ($bookings as $booking) {
        echo $booking['id'] . " - User: "
            . $booking['user_id'] . " - Session: "
            . $booking['training_session_id'] . " - "
            . $booking['status'] . "\n";
    }

    echo "\n=== GET BOOKING BY ID ===\n";

    print_r($bookingService->getById(1));

    $testData = [
        'user_id' => 4,
        'training_session_id' => 3,
        'status' => 'pending'
    ];

    echo "\n=== INVALID USER TEST ===\n";

    try {
        $data = $testData;
        $data['user_id'] = 999999;

        $bookingService->create($data);

        echo "FAILED: Invalid user accepted\n";

    } catch (Exception $e) {
        echo "Expected error: " . $e->getMessage() . "\n";
    }

    echo "\n=== INVALID ROLE TEST ===\n";

    try {
        $data = $testData;
        $data['user_id'] = 2;

        $bookingService->create($data);

        echo "FAILED: Invalid role accepted\n";

    } catch (Exception $e) {
        echo "Expected error: " . $e->getMessage() . "\n";
    }

    echo "\n=== INVALID SESSION TEST ===\n";

    try {
        $data = $testData;
        $data['training_session_id'] = 999999;

        $bookingService->create($data);

        echo "FAILED: Invalid session accepted\n";

    } catch (Exception $e) {
        echo "Expected error: " . $e->getMessage() . "\n";
    }

    echo "\n=== INVALID STATUS TEST ===\n";

    try {
        $data = $testData;
        $data['status'] = 'invalid';

        $bookingService->create($data);

        echo "FAILED: Invalid status accepted\n";

    } catch (Exception $e) {
        echo "Expected error: " . $e->getMessage() . "\n";
    }

    echo "\n=== DUPLICATE BOOKING TEST ===\n";

    try {
        $data = $testData;
        $data['training_session_id'] = 1;

        $bookingService->create($data);

        echo "FAILED: Duplicate booking accepted\n";

    } catch (Exception $e) {
        echo "Expected error: " . $e->getMessage() . "\n";
    }

    echo "\n=== NOT FOUND TEST ===\n";

    try {
        $bookingService->getById(999999);

        echo "FAILED: Nonexistent booking found\n";

    } catch (Exception $e) {
        echo "Expected error: " . $e->getMessage() . "\n";
    }

    echo "\nBookingService tests completed!\n";

} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
