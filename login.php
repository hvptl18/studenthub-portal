
<?php
require_once __DIR__ . '/includes/functions.php';
require_once __DIR__ . '/config/db.php';

// Redirect users who are already logged in.
if (is_logged_in()) {
    redirect('dashboard.php');
}

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $email = strtolower(trim($_POST['email'] ?? ''));
    $password = $_POST['password'] ?? '';

    if (!filter_var($email, FILTER_VALIDATE_EMAIL) || $password === '') {
        $error = 'Enter a valid email and password.';
    } else {

        $stmt = $conn->prepare(
            'SELECT id, name, email, password_hash, role
             FROM users
             WHERE email = ?
             LIMIT 1'
        );

        if (!$stmt) {
            error_log('Login query preparation failed: ' . $conn->error);
            $error = 'Unable to process your login right now.';
        } else {

            $stmt->bind_param('s', $email);

            if (!$stmt->execute()) {
                error_log('Login query execution failed: ' . $stmt->error);
                $error = 'Unable to process your login right now.';
            } else {

                $result = $stmt->get_result();
                $user = $result->fetch_assoc();

                if (
                    $user &&
                    password_verify($password, $user['password_hash'])
                ) {

                    // Prevent session fixation.
                    session_regenerate_id(true);

                    // Store the authenticated user's information.
                    $_SESSION['user_id'] = (int) $user['id'];
                    $_SESSION['name'] = $user['name'];
                    $_SESSION['email'] = $user['email'];
                    $_SESSION['role'] = $user['role'];

                    $stmt->close();

                    set_flash('Welcome back, ' . $user['name'] . '!');
                    redirect('dashboard.php');

                } else {
                    $error = 'Email or password is incorrect.';
                }
            }

            if (isset($stmt) && $stmt instanceof mysqli_stmt) {
                $stmt->close();
            }
        }
    }
}

$pageTitle = 'Log in';

require __DIR__ . '/includes/header.php';
?>

<section class="form-page">
    <div class="container login-layout">

        <div class="login-aside">
            <p class="eyebrow">GOOD TO SEE YOU</p>

            <h1>
                Pick up where <em>you left off.</em>
            </h1>

            <p>
                Sign in to your student space and keep your campus
                journey moving.
            </p>

            <div class="login-decoration">S<span>H</span></div>
        </div>

        <div class="form-card login-card">

            <div class="form-card-heading">
                <span class="feature-icon">◈</span>
                <h2>Welcome back</h2>
                <p>Enter your account details below.</p>
            </div>

            <?php if ($error !== ''): ?>
                <div class="form-errors" role="alert">
                    <?= e($error) ?>
                </div>
            <?php endif; ?>

            <form method="post" action="login.php">

                <label class="field">
                    Email address

                    <input
                        type="email"
                        name="email"
                        required
                        autocomplete="email"
                        value="<?= e($_POST['email'] ?? '') ?>"
                        placeholder="you@example.com"
                    >
                </label>

                <label class="field">
                    Password

                    <input
                        type="password"
                        name="password"
                        required
                        autocomplete="current-password"
                        placeholder="Your password"
                    >
                </label>

                <button
                    class="btn btn-primary btn-wide"
                    type="submit"
                >
                    Sign in ↗
                </button>

                <p class="form-switch">
                    New to StudentHub?
                    <a href="register.php">Create an account</a>
                </p>

            </form>

        </div>

    </div>
</section>

<?php require __DIR__ . '/includes/footer.php'; ?>
