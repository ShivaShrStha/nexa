<?php
// Simple router for PHP built-in server to handle clean URLs

$uri = $_SERVER['REQUEST_URI'];
$path = trim(parse_url($uri, PHP_URL_PATH), '/');

// Route mapping
switch($path) {
    case '':
        include 'index.php';
        break;
    case 'blog':
        include 'blog.php';
        break;
    case 'gallery':
        include 'gallery.php';
        break;
    case 'about':
        include 'about.php';
        break;
    case 'contact':
        include 'contact.php';
        break;
    default:
        // Check if it's a real file (CSS, JS, images, etc.)
        if (file_exists($path)) {
            return false; // Let PHP serve the file normally
        }
        // 404 for unknown routes
        http_response_code(404);
        echo "Page not found: " . htmlspecialchars($path);
        break;
}
?>
