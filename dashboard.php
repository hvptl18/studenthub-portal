
<?php
require_once __DIR__ . '/includes/functions.php';
require_login();

require_once __DIR__ . '/config/db.php';

// Get the logged-in user's ID safely.
$userId = filter_var(
    $_SESSION['user_id'] ?? null,
    FILTER_VALIDATE_INT
);

// Stop if the session does not contain a valid user ID.
if (!$userId || $userId < 1) {
    header('Location: login.php');
    exit;
}

// Retrieve the student record.
$stmt = $conn->prepare(
    'SELECT id, name, email, mobile, course, year_level,
            gender, created_at
     FROM users
     WHERE id = ?
     LIMIT 1'
);

$stmt->bind_param('i', $userId);
$stmt->execute();

$result = $stmt->get_result();
$student = $result->fetch_assoc();

$stmt->close();

// If the account no longer exists, clear the invalid session.
if (!$student) {
    $_SESSION = [];
    session_destroy();

    header('Location: login.php');
    exit;
}

// Safe values for display.
$studentName = $student['name'] ?? 'Student';
$firstName = explode(' ', trim($studentName))[0] ?: 'Student';

$studentEmail = $student['email'] ?? 'Not provided';
$studentMobile = $student['mobile'] ?? 'Not provided';
$studentCourse = $student['course'] ?? 'Not provided';
$studentYear = $student['year_level'] ?? null;

$memberSince = 'Not available';

if (!empty($student['created_at'])) {
    $timestamp = strtotime($student['created_at']);

    if ($timestamp !== false) {
        $memberSince = date('d M Y', $timestamp);
    }
}

// Count available events.
$eventCount = 0;

$eventResult = $conn->query(
    'SELECT COUNT(*) AS total FROM events'
);

if ($eventResult) {
    $eventCount = (int) $eventResult->fetch_assoc()['total'];
}

$pageTitle = 'Dashboard';

require __DIR__ . '/includes/header.php';
?>

<section class="dashboard-hero">
    <div class="container dashboard-heading">
        <div>
            <p class="eyebrow">YOUR STUDENT SPACE</p>

            <h1>
                Hello, <?= e($firstName) ?>
                <span class="wave">✳</span>
            </h1>

            <p>
                Here’s your snapshot. Keep your profile up to date
                and see what’s happening around campus.
            </p>
        </div>

        <a class="btn btn-light" href="profile.php">
            View profile ↗
        </a>
    </div>
</section>

<section class="section-pad dashboard-content">
    <div class="container">

        <div class="dashboard-stat-grid">

            <article class="stat-card">
                <span class="stat-icon">♙</span>
                <small>ACCOUNT STATUS</small>
                <strong>Active</strong>
                <span class="stat-note">
                    Your student account is ready
                </span>
            </article>

            <article class="stat-card">
                <span class="stat-icon">✳</span>
                <small>EVENTS TO EXPLORE</small>
                <strong><?= $eventCount ?></strong>

                <a class="stat-note text-link" href="events.php">
                    See campus events →
                </a>
            </article>

            <article class="stat-card">
                <span class="stat-icon">⌂</span>
                <small>COURSE</small>

                <strong class="stat-course">
                    <?= e($studentCourse) ?>
                </strong>

                <span class="stat-note">
                    <?php if ($studentYear !== null && $studentYear !== ''): ?>
                        Year <?= e((string) $studentYear) ?>
                    <?php else: ?>
                        Year not provided
                    <?php endif; ?>
                </span>
            </article>

        </div>

        <div class="dashboard-columns">

            <section class="panel">

                <div class="panel-heading">
                    <div>
                        <p class="eyebrow">YOUR DETAILS</p>
                        <h2>Profile overview</h2>
                    </div>

                    <a class="text-link" href="profile.php">
                        Edit profile ↗
                    </a>
                </div>

                <dl class="details-list">

                    <div>
                        <dt>Full name</dt>
                        <dd><?= e($studentName) ?></dd>
                    </div>

                    <div>
                        <dt>Email</dt>
                        <dd><?= e($studentEmail) ?></dd>
                    </div>

                    <div>
                        <dt>Mobile</dt>
                        <dd><?= e($studentMobile) ?></dd>
                    </div>

                    <div>
                        <dt>Course</dt>
                        <dd><?= e($studentCourse) ?></dd>
                    </div>

                    <div>
                        <dt>Year</dt>
                        <dd>
                            <?= $studentYear !== null && $studentYear !== ''
                                ? 'Year ' . e((string) $studentYear)
                                : 'Not provided' ?>
                        </dd>
                    </div>

                    <div>
                        <dt>Member since</dt>
                        <dd><?= e($memberSince) ?></dd>
                    </div>

                </dl>

            </section>

            <section class="panel notice-panel">

                <p class="eyebrow">CAMPUS BOARD</p>

                <h2>Good things are happening.</h2>

                <p>
                    Check the events page for workshops, seminars
                    and opportunities to connect with other students.
                </p>

                <a class="btn btn-primary" href="events.php">
                    Explore events ↗
                </a>

                <div class="panel-ornament">✳</div>

            </section>

        </div>

    </div>
</section>

<?php require __DIR__ . '/includes/footer.php'; ?>
