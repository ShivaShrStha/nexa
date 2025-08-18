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
    
    // Handle image upload
    $featured_image = '';
    if (isset($_FILES['featured_image']) && $_FILES['featured_image']['error'] === UPLOAD_ERR_OK) {
        $uploadDir = '../uploads/blog/';
        
        // Create directory if it doesn't exist
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0755, true);
        }
        
        $fileInfo = pathinfo($_FILES['featured_image']['name']);
        $extension = strtolower($fileInfo['extension']);
        
        // Validate file type
        $allowedTypes = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
        if (!in_array($extension, $allowedTypes)) {
            echo json_encode(['success' => false, 'message' => 'Invalid file type. Please upload JPG, PNG, GIF, or WebP images.']);
            exit;
        }
        
        // Validate file size (5MB max)
        if ($_FILES['featured_image']['size'] > 5 * 1024 * 1024) {
            echo json_encode(['success' => false, 'message' => 'File too large. Maximum size is 5MB.']);
            exit;
        }
        
        // Generate unique filename
        $filename = 'blog_' . time() . '_' . uniqid() . '.' . $extension;
        $filePath = $uploadDir . $filename;
        
        if (move_uploaded_file($_FILES['featured_image']['tmp_name'], $filePath)) {
            $featured_image = 'uploads/blog/' . $filename;
        } else {
            echo json_encode(['success' => false, 'message' => 'Failed to upload image.']);
            exit;
        }
    }
    
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
