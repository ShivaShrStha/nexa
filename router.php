<?php
// Copyright © 2025 Shiva Sharan Shrestha. All rights reserved. This code is part of NexaEducationCountaltancy.

error_reporting(E_ALL);
ini_set('display_errors', 1);

$uri = $_SERVER['REQUEST_URI'];
$path = trim(parse_url($uri, PHP_URL_PATH), '/');

// Map known routes
$routes = [
    ''        => 'index.php',
    'blog'    => 'blog.php',
    'gallery' => 'gallery.php',
    'about'   => 'about.php',
    'contact' => 'contact.php',
];

// If route exists in mapping, include it
if (array_key_exists($path, $routes)) {
    include $routes[$path];
    exit;
}

// If actual file exists (like CSS, JS, images), let Apache serve it
if (file_exists(__DIR__ . '/' . $path)) {
    return false;
}

// Otherwise 404
http_response_code(404);
echo "Page not found: " . htmlspecialchars($path);
?>
