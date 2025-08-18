<?php
// Configuration file - Keep this secure and out of public access
// In production, use environment variables or a secure config file

// Admin credentials
$config = [
    'admin_password' => 'nexa2025admin', // Change this in production!
    'database_path' => __DIR__ . '/nexa_data.db',
    'site_name' => 'NexaEducation Admin',
    'max_login_attempts' => 5,
    'session_timeout' => 3600, // 1 hour
];

return $config;
?>
