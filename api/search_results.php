<?php
/**
 * API: Search and Filter Results (JSON)
 */
require_once __DIR__ . '/../config.php';

header('Content-Type: application/json');

$query = trim($_GET['q'] ?? '');
$stream = trim($_GET['stream'] ?? '');
$exam = trim($_GET['exam'] ?? '');
$campus = trim($_GET['campus'] ?? '');
$year = trim($_GET['year'] ?? '');

try {
    $db = getDB();
    $sql = "SELECT * FROM results WHERE 1=1";
    $params = [];

    if (!empty($query)) {
        $sql .= " AND (student_name LIKE ? OR roll_number LIKE ?)";
        $params[] = "%$query%";
        $params[] = "%$query%";
    }
    if (!empty($stream) && $stream !== 'all') {
        $sql .= " AND stream = ?";
        $params[] = $stream;
    }
    if (!empty($exam) && $exam !== 'all') {
        $sql .= " AND exam_type = ?";
        $params[] = $exam;
    }
    if (!empty($campus) && $campus !== 'all') {
        $sql .= " AND campus = ?";
        $params[] = $campus;
    }
    if (!empty($year) && $year !== 'all') {
        $sql .= " AND year = ?";
        $params[] = $year;
    }

    $sql .= " ORDER BY year DESC, featured DESC, id ASC";
    $stmt = $db->prepare($sql);
    $stmt->execute($params);
    $data = $stmt->fetchAll();

    echo json_encode(['status' => 'success', 'count' => count($data), 'results' => $data]);
} catch (Throwable $e) {
    echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
}
