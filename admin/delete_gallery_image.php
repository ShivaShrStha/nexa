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
    $input = json_decode(file_get_contents('php://input'), true);
    
    if (!isset($input['id'])) {
        throw new Exception('Image ID is required');
    }
    
    $db = new Database();
    $conn = $db->getConnection();
    
    // Get image path before deleting
    $stmt = $conn->prepare("SELECT image_path FROM gallery WHERE id = ?");
    $stmt->execute([$input['id']]);
    $image = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if (!$image) {
        throw new Exception('Image not found');
    }
    
    // Delete from database
    $stmt = $conn->prepare("DELETE FROM gallery WHERE id = ?");
    $stmt->execute([$input['id']]);
    
    // Delete physical file
    $filePath = '../' . $image['image_path'];
    if (file_exists($filePath)) {
        unlink($filePath);
    }
    
    echo json_encode(['success' => true, 'message' => 'Image deleted successfully']);
    
} catch(Exception $e) {
    echo json_encode(['success' => false, 'message' => $e->getMessage()]);
}
?>
