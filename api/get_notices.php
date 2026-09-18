<?php
/**
 * API: Get Active Notices & Announcements
 */
require_once __DIR__ . '/../config.php';

header('Content-Type: application/json');

try {
    $db = getDB();
    $stmt = $db->query("SELECT * FROM notices WHERE is_active = 1 ORDER BY id DESC LIMIT 10");
    $notices = $stmt->fetchAll();
    echo json_encode(['status' => 'success', 'notices' => $notices]);
} catch (Throwable $e) {
    echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
}
