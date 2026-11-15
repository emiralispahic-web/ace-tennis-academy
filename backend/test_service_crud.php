
<?php

require_once __DIR__ . '/services/UserService.php';
require_once __DIR__ . '/services/CoachService.php';
require_once __DIR__ . '/services/CourtService.php';
require_once __DIR__ . '/services/TrainingSessionService.php';
require_once __DIR__ . '/services/BookingService.php';

function check($condition, $message) {
    if (!$condition) {
        throw new Exception("FAILED: " . $message);
    }

    echo "PASS: " . $message . "\n";
}

function findId($records, $field, $value) {
    foreach ($records as $record) {
        if ($record[$field] == $value) {
            return $record['id'];
        }
    }

    throw new Exception("Created record not found");
}

$coachUserId = null;
$studentId = null;
$coachId = null;
$courtId = null;
$sessionId = null;
$bookingId = null;

try {

    $userService = new UserService();
    $coachService = new CoachService();
    $courtService = new CourtService();
    $sessionService = new TrainingSessionService();
    $bookingService = new BookingService();

    $suffix = uniqid();

    echo "=== USER SERVICE CRUD ===\n";

    $coachEmail = "coach_" . $suffix . "@test.com";

    check($userService->create([
        'full_name' => 'Temporary Coach',
        'email' => $coachEmail,
        'password' => 'Tennis123',
        'phone' => '061000000',
        'role' => 'coach'
    ]), "Create coach user");

    $coachUserId = findId(
        $userService->getAll(),
        'email',
        $coachEmail
    );

    $studentEmail = "student_" . $suffix . "@test.com";

    check($userService->create([
        'full_name' => 'Temporary Student',
        'email' => $studentEmail,
        'password' => 'Tennis123',
        'phone' => '061000001',
        'role' => 'student'
    ]), "Create student user");

    $studentId = findId(
        $userService->getAll(),
        'email',
        $studentEmail
    );

    check(
        $userService->getById($studentId)['email']
            === $studentEmail,
        "Read user"
    );

    check($userService->update($studentId, [
        'full_name' => 'Updated Temporary Student'
    ]), "Update user");

    check(
        $userService->getById($studentId)['full_name']
            === 'Updated Temporary Student',
        "Verify updated user"
    );

    echo "\n=== COACH SERVICE CRUD ===\n";

    check($coachService->create([
        'user_id' => $coachUserId,
        'specialization' => 'Junior Tennis',
        'experience_years' => 5,
        'bio' => 'Temporary test coach'
    ]), "Create coach");

    $coachId = findId(
        $coachService->getAll(),
        'user_id',
        $coachUserId
    );

    check(
        $coachService->getById($coachId)['user_id']
            == $coachUserId,
        "Read coach"
    );

    check($coachService->update($coachId, [
        'experience_years' => 6
    ]), "Update coach");

    check(
        $coachService->getById($coachId)['experience_years']
            == 6,
        "Verify updated coach"
    );

    echo "\n=== COURT SERVICE CRUD ===\n";

    $courtName = "Test Court " . $suffix;

    check($courtService->create([
        'name' => $courtName,
        'surface' => 'Clay',
        'court_type' => 'Outdoor',
        'hourly_price' => 30,
        'is_available' => 1
    ]), "Create court");

    $courtId = findId(
        $courtService->getAll(),
        'name',
        $courtName
    );

    check(
        $courtService->getById($courtId)['name']
            === $courtName,
        "Read court"
    );

    check($courtService->update($courtId, [
        'hourly_price' => 40
    ]), "Update court");

    check(
        $courtService->getById($courtId)['hourly_price']
            == 40,
        "Verify updated court"
    );

    echo "\n=== TRAINING SESSION SERVICE CRUD ===\n";

    $sessionTitle = "Test Training " . $suffix;

    check($sessionService->create([
        'coach_id' => $coachId,
        'court_id' => $courtId,
        'title' => $sessionTitle,
        'session_date' => '2026-12-15',
        'start_time' => '10:00:00',
        'end_time' => '11:00:00',
        'price' => 25,
        'capacity' => 1
    ]), "Create training session");

    $sessionId = findId(
        $sessionService->getAll(),
        'title',
        $sessionTitle
    );

    check(
        $sessionService->getById($sessionId)['title']
            === $sessionTitle,
        "Read training session"
    );

    check($sessionService->update($sessionId, [
        'price' => 30
    ]), "Update training session");

    check(
        $sessionService->getById($sessionId)['price']
            == 30,
        "Verify updated session"
    );

    echo "\n=== BOOKING SERVICE CRUD ===\n";

    check($bookingService->create([
        'user_id' => $studentId,
        'training_session_id' => $sessionId,
        'status' => 'pending'
    ]), "Create booking");

    $bookingId = findId(
        $bookingService->getAll(),
        'training_session_id',
        $sessionId
    );

    check(
        $bookingService->getById($bookingId)['status']
            === 'pending',
        "Read booking"
    );

    check($bookingService->update($bookingId, [
        'status' => 'confirmed'
    ]), "Update booking");

    check(
        $bookingService->getById($bookingId)['status']
            === 'confirmed',
        "Verify updated booking"
    );

    echo "\n=== CAPACITY VALIDATION TEST ===\n";

    $capacityRejected = false;

    try {
        $bookingService->create([
            'user_id' => 4,
            'training_session_id' => $sessionId,
            'status' => 'pending'
        ]);
    } catch (Exception $e) {
        if ($e->getMessage() ===
            "Training session is fully booked") {
            $capacityRejected = true;
        } else {
            throw $e;
        }
    }

    check(
        $capacityRejected,
        "Reject booking when session is full"
    );

    echo "\n=== DELETE TESTS ===\n";

    check(
        $bookingService->delete($bookingId),
        "Delete booking"
    );
    $bookingId = null;

    check(
        $sessionService->delete($sessionId),
        "Delete training session"
    );
    $sessionId = null;

    check(
        $coachService->delete($coachId),
        "Delete coach"
    );
    $coachId = null;

    check(
        $courtService->delete($courtId),
        "Delete court"
    );
    $courtId = null;

    check(
        $userService->delete($studentId),
        "Delete student user"
    );
    $studentId = null;

    check(
        $userService->delete($coachUserId),
        "Delete coach user"
    );
    $coachUserId = null;

    echo "\nALL SERVICE CRUD TESTS PASSED!\n";

} catch (Throwable $e) {

    echo "\nERROR: " . $e->getMessage() . "\n";

} finally {

    echo "\n=== CLEANUP ===\n";

    $cleanup = [
        [$bookingService ?? null, $bookingId],
        [$sessionService ?? null, $sessionId],
        [$coachService ?? null, $coachId],
        [$courtService ?? null, $courtId],
        [$userService ?? null, $studentId],
        [$userService ?? null, $coachUserId]
    ];

    foreach ($cleanup as $item) {
        if ($item[0] !== null && $item[1] !== null) {
            try {
                $item[0]->delete($item[1]);
                echo "Temporary record removed\n";
            } catch (Throwable $e) {
                echo "Cleanup error: "
                    . $e->getMessage() . "\n";
            }
        }
    }

    echo "Cleanup finished.\n";
}
