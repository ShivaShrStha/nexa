<?php
// Configuration file - Secure for production
// Use environment variables for sensitive data

// Load .env file if present (simple loader)
$envPath = __DIR__ . '/../.env';
if (file_exists($envPath)) {
    foreach (file($envPath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES) as $line) {
        if (strpos(trim($line), '#') === 0) continue;
        putenv(trim($line));
    }
}

$config = [
    'admin_password' => getenv('NEXA_ADMIN_PASSWORD'),
    'database_path' => getenv('NEXA_DATABASE_PATH') ?: __DIR__ . '/nexa_data.db',
    'site_name' => 'NexaEducation Admin',
    'max_login_attempts' => 5,
    'session_timeout' => 3600, // 1 hour
];

return $config;
?>
