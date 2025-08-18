<?php
// Admin Security Check
// Add this at the top of admin files for basic protection

session_start();

// Load configuration
$config = require_once 'config.php';
$admin_password = $config['admin_password'];

if (!isset($_SESSION['admin_logged_in'])) {
    if (isset($_POST['admin_password']) && $_POST['admin_password'] === $admin_password) {
        $_SESSION['admin_logged_in'] = true;
    } else {
        // Show login form
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $error = "Invalid password!";
        }
        ?>
        <!DOCTYPE html>
        <html>
        <head>
            <title>Admin Login - NexaEducation</title>
            <style>
                body { font-family: Arial, sans-serif; display: flex; justify-content: center; align-items: center; height: 100vh; margin: 0; background: #f5f7fa; }
                .login-form { background: white; padding: 2rem; border-radius: 10px; box-shadow: 0 4px 20px rgba(0,0,0,0.1); max-width: 400px; width: 100%; }
                .login-form h2 { text-align: center; color: #333; margin-bottom: 1.5rem; }
                .login-form input { width: 100%; padding: 12px; margin: 10px 0; border: 1px solid #ddd; border-radius: 5px; font-size: 16px; }
                .login-form button { width: 100%; padding: 12px; background: #667eea; color: white; border: none; border-radius: 5px; font-size: 16px; cursor: pointer; }
                .login-form button:hover { background: #5a6fd8; }
                .error { color: red; text-align: center; margin: 10px 0; }
            </style>
        </head>
        <body>
            <div class="login-form">
                <h2>🔐 Admin Login</h2>
                <?php if (isset($error)) echo "<div class='error'>$error</div>"; ?>
                <form method="POST">
                    <input type="password" name="admin_password" placeholder="Enter admin password" required>
                    <button type="submit">Login</button>
                </form>
                <p style="text-align: center; color: #666; font-size: 14px; margin-top: 1rem;">
                    Protected Admin Area<br>
                    <small>Contact administrator for access</small>
                </p>
            </div>
        </body>
        </html>
        <?php
        exit;
    }
}
?>
