<?php
require_once 'database.php';

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');

try {
    $db = new Database();
    $conn = $db->getConnection();
    
    $stmt = $conn->query("SELECT * FROM newsletter_subscriptions ORDER BY created_at DESC");
    $subscriptions = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    echo json_encode($subscriptions);
    
} catch(Exception $e) {
    http_response_code(500);
    echo json_encode(['error' => 'Server error: ' . $e->getMessage()]);
}
?>
