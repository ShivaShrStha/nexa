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
        throw new Exception('Contact Message ID is required');
    }
    $db = new Database();
    $conn = $db->getConnection();
    $stmt = $conn->prepare("UPDATE contact_messages SET name = ?, email = ?, subject = ?, message = ? WHERE id = ?");
    $stmt->execute([
        $input['name'],
        $input['email'],
        $input['subject'],
        $input['message'],
        $input['id']
    ]);
    echo json_encode(['success' => true, 'message' => 'Contact message updated successfully']);
} catch(Exception $e) {
    echo json_encode(['success' => false, 'message' => $e->getMessage()]);
}
?>
