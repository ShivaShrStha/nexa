<?php
session_start();
require_once 'database.php';

if (!isset($_SESSION['admin_logged_in'])) {
    http_response_code(401);
    echo json_encode(['success' => false, 'message' => 'Unauthorized']);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['success' => false, 'message' => 'Invalid request method']);
    exit;
}

try {
    $db = new Database();
    $conn = $db->getConnection();
    
    // Create uploads directory if it doesn't exist
    $uploadDir = '../uploads/gallery/';
    if (!file_exists($uploadDir)) {
        mkdir($uploadDir, 0755, true);
    }
    
    // Validate form data
    if (empty($_POST['title'])) {
        throw new Exception('Title is required');
    }
    
    if (!isset($_FILES['image']) || $_FILES['image']['error'] !== UPLOAD_ERR_OK) {
        throw new Exception('Image upload failed');
    }
    
    $file = $_FILES['image'];
    
    // Validate file type
    $allowedTypes = ['image/jpeg', 'image/jpg', 'image/png', 'image/gif'];
    if (!in_array($file['type'], $allowedTypes)) {
        throw new Exception('Invalid file type. Only JPG, PNG, and GIF are allowed.');
    }
    
    // Validate file size (5MB max)
    if ($file['size'] > 5 * 1024 * 1024) {
        throw new Exception('File size too large. Maximum 5MB allowed.');
    }
    
    // Generate unique filename
    $extension = pathinfo($file['name'], PATHINFO_EXTENSION);
    $filename = 'gallery_' . time() . '_' . uniqid() . '.' . $extension;
    $filepath = $uploadDir . $filename;
    $relativeFilePath = 'uploads/gallery/' . $filename;
    
    // Move uploaded file
    if (!move_uploaded_file($file['tmp_name'], $filepath)) {
        throw new Exception('Failed to save uploaded file');
    }
    
    // Create table if it doesn't exist
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
    
    // Insert into database
    $stmt = $conn->prepare("INSERT INTO gallery (title, description, image_path, category, is_featured, status) VALUES (?, ?, ?, ?, ?, ?)");
    
    $title = trim($_POST['title']);
    $description = trim($_POST['description'] ?? '');
    $category = $_POST['category'] ?? 'general';
    $is_featured = isset($_POST['is_featured']) ? 1 : 0;
    $status = $_POST['status'] ?? 'published';
    
    $stmt->execute([$title, $description, $relativeFilePath, $category, $is_featured, $status]);
    
    echo json_encode(['success' => true, 'message' => 'Image uploaded successfully']);
    
} catch(Exception $e) {
    // Clean up uploaded file if database insert failed
    if (isset($filepath) && file_exists($filepath)) {
        unlink($filepath);
    }
    
    echo json_encode(['success' => false, 'message' => $e->getMessage()]);
}
?>
