<?php
// Get blog posts for public display
require_once 'admin/database.php';

try {
    $db = new Database();
    $conn = $db->getConnection();
    
    // Create table if it doesn't exist
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
    
    // Get published posts
    $stmt = $conn->query("SELECT * FROM blog_posts WHERE status = 'published' ORDER BY created_at DESC LIMIT 6");
    $posts = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
} catch(Exception $e) {
    $posts = [];
}
?>
