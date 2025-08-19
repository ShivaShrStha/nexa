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
        throw new Exception('Course Request ID is required');
    }
    $db = new Database();
    $conn = $db->getConnection();
    $stmt = $conn->prepare("UPDATE course_requests SET first_name = ?, last_name = ?, email = ?, phone = ?, subject = ? WHERE id = ?");
    $stmt->execute([
        $input['first_name'],
        $input['last_name'],
        $input['email'],
        $input['phone'],
        $input['subject'],
        $input['id']
    ]);
    echo json_encode(['success' => true, 'message' => 'Course request updated successfully']);
} catch(Exception $e) {
    echo json_encode(['success' => false, 'message' => $e->getMessage()]);
}
?>
