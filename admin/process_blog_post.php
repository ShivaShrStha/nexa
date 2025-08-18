<?php
require_once 'database.php';

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Content-Type');

// Only allow POST requests
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['success' => false, 'message' => 'Method not allowed']);
    exit;
}

try {
    $db = new Database();
    $conn = $db->getConnection();
    
    // Create blog_posts table if it doesn't exist
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
    
    // Get form data
    $title = $_POST['title'] ?? '';
    $content = $_POST['content'] ?? '';
    $excerpt = $_POST['excerpt'] ?? '';
    $author = $_POST['author'] ?? 'NexaEducation Admin';
    $featured_image = $_POST['featured_image'] ?? '';
    
    // Validate required fields
    if (empty($title) || empty($content)) {
        echo json_encode(['success' => false, 'message' => 'Title and content are required']);
        exit;
    }
    
    // Auto-generate excerpt if not provided
    if (empty($excerpt)) {
        $excerpt = substr(strip_tags($content), 0, 150) . '...';
    }
    
    // Insert into database
    $stmt = $conn->prepare("INSERT INTO blog_posts (title, content, excerpt, author, featured_image) VALUES (?, ?, ?, ?, ?)");
    $stmt->execute([$title, $content, $excerpt, $author, $featured_image]);
    
    echo json_encode(['success' => true, 'message' => 'Blog post created successfully!', 'id' => $conn->lastInsertId()]);
    
} catch(Exception $e) {
    http_response_code(500);
    echo json_encode(['success' => false, 'message' => 'Server error: ' . $e->getMessage()]);
}
?>
