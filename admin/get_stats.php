<?php
require_once 'database.php';

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');

try {
    $db = new Database();
    $conn = $db->getConnection();
    
    // Get counts for each table
    $courseCount = $conn->query("SELECT COUNT(*) FROM course_requests")->fetchColumn();
    $newsletterCount = $conn->query("SELECT COUNT(*) FROM newsletter_subscriptions")->fetchColumn();
    $contactCount = $conn->query("SELECT COUNT(*) FROM contact_messages")->fetchColumn();
    
    // Get blog posts count (create table if it doesn't exist)
    $conn->exec("CREATE TABLE IF NOT EXISTS blog_posts (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        title TEXT NOT NULL,
        content TEXT NOT NULL,
        excerpt TEXT,
        author TEXT DEFAULT 'NexaEducation Admin',
        featured_image TEXT,
        status TEXT DEFAULT 'published',
        created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
        updated_at DATETIME DEFAULT CURRENT_TIMESTAMP
    )");
    $blogCount = $conn->query("SELECT COUNT(*) FROM blog_posts")->fetchColumn();
    
    // Get gallery images count (create table if it doesn't exist)
    $conn->exec("CREATE TABLE IF NOT EXISTS gallery (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        title TEXT NOT NULL,
        description TEXT,
        image_path TEXT NOT NULL,
        category TEXT DEFAULT 'general',
        is_featured INTEGER DEFAULT 0,
        status TEXT DEFAULT 'published',
        created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
        updated_at DATETIME DEFAULT CURRENT_TIMESTAMP
    )");
    $galleryCount = $conn->query("SELECT COUNT(*) FROM gallery")->fetchColumn();
    
    echo json_encode([
        'course_requests' => $courseCount,
        'newsletter_subscriptions' => $newsletterCount,
        'contact_messages' => $contactCount,
        'blog_posts' => $blogCount,
        'gallery_images' => $galleryCount
    ]);
    
} catch(Exception $e) {
    http_response_code(500);
    echo json_encode(['error' => 'Server error: ' . $e->getMessage()]);
}
?>
