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
        throw new Exception('Newsletter ID is required');
    }
    $db = new Database();
    $conn = $db->getConnection();
    $stmt = $conn->prepare("DELETE FROM newsletter WHERE id = ?");
    $stmt->execute([$input['id']]);
    echo json_encode(['success' => true, 'message' => 'Newsletter subscription deleted successfully']);
} catch(Exception $e) {
    echo json_encode(['success' => false, 'message' => $e->getMessage()]);
}
?>
