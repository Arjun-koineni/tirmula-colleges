<?php
/**
 * API: Universal Search Across the Institution
 * Searches results, model papers, notices, and gallery items dynamically.
 */
require_once __DIR__ . '/../config.php';

header('Content-Type: application/json; charset=utf-8');

$query = trim($_GET['q'] ?? '');
$category = trim($_GET['cat'] ?? 'all');

if (strlen($query) < 1) {
    echo json_encode(['status' => 'success', 'count' => 0, 'results' => []]);
    exit;
}

$results = [];
$searchWildcard = "%" . $query . "%";

try {
    $db = getDB();
    if ($db) {
        // 1. Search Results / Students
        if ($category === 'all' || $category === 'students') {
            $stmt = $db->prepare("SELECT id, student_name, roll_number, stream, exam_type, year, campus, score_or_rank, photo_url 
                                  FROM results 
                                  WHERE student_name LIKE ? OR roll_number LIKE ? OR score_or_rank LIKE ? OR stream LIKE ? OR exam_type LIKE ? OR campus LIKE ?
                                  ORDER BY year DESC, featured DESC LIMIT 10");
            $stmt->execute([$searchWildcard, $searchWildcard, $searchWildcard, $searchWildcard, $searchWildcard, $searchWildcard]);
            while ($row = $stmt->fetch()) {
                $results[] = [
                    'id' => 'student-' . $row['id'],
                    'title' => $row['student_name'] . ' - ' . $row['score_or_rank'],
                    'sub' => $row['exam_type'] . ' (' . $row['year'] . ') • ' . $row['campus'] . ' • Roll: ' . $row['roll_number'],
                    'category' => 'Rankers & Students',
                    'cat_key' => 'students',
                    'url' => '/results.php?search=' . urlencode($row['roll_number']),
                    'icon' => 'trophy',
                    'badge' => $row['stream']
                ];
            }
        }

        // 2. Search Model Papers
        if ($category === 'all' || $category === 'papers') {
            $stmt = $db->prepare("SELECT id, title, class_grade, board, stream, file_path, file_size 
                                  FROM model_papers 
                                  WHERE title LIKE ? OR class_grade LIKE ? OR board LIKE ? OR stream LIKE ?
                                  ORDER BY id DESC LIMIT 10");
            $stmt->execute([$searchWildcard, $searchWildcard, $searchWildcard, $searchWildcard]);
            while ($row = $stmt->fetch()) {
                $results[] = [
                    'id' => 'paper-' . $row['id'],
                    'title' => $row['title'],
                    'sub' => $row['class_grade'] . ' • ' . $row['board'] . ' (' . ($row['file_size'] ?: 'PDF') . ')',
                    'category' => 'Model Papers (PDF)',
                    'cat_key' => 'papers',
                    'url' => $row['file_path'] ?: '/model-papers.php',
                    'external' => !empty($row['file_path']) && strpos($row['file_path'], 'http') === 0,
                    'icon' => 'doc',
                    'badge' => 'Free PDF'
                ];
            }
        }

        // 3. Search Notices
        if ($category === 'all' || $category === 'notices') {
            $stmt = $db->prepare("SELECT id, title, content, link_url, badge_type 
                                  FROM notices 
                                  WHERE is_active = 1 AND (title LIKE ? OR content LIKE ?)
                                  ORDER BY id DESC LIMIT 5");
            $stmt->execute([$searchWildcard, $searchWildcard]);
            while ($row = $stmt->fetch()) {
                $results[] = [
                    'id' => 'notice-' . $row['id'],
                    'title' => $row['title'],
                    'sub' => $row['content'] ? mb_substr(strip_tags($row['content']), 0, 80) . '...' : 'Latest Notice',
                    'category' => 'Announcements',
                    'cat_key' => 'notices',
                    'url' => $row['link_url'] ?: '/admissions.php',
                    'icon' => 'bell',
                    'badge' => $row['badge_type'] ?: 'Notice'
                ];
            }
        }

        // 4. Search Gallery
        if ($category === 'all' || $category === 'gallery') {
            $stmt = $db->prepare("SELECT id, title, category, caption, image_url 
                                  FROM gallery 
                                  WHERE title LIKE ? OR category LIKE ? OR caption LIKE ?
                                  ORDER BY id DESC LIMIT 6");
            $stmt->execute([$searchWildcard, $searchWildcard, $searchWildcard]);
            while ($row = $stmt->fetch()) {
                $results[] = [
                    'id' => 'gallery-' . $row['id'],
                    'title' => $row['title'],
                    'sub' => $row['caption'] ?: ('Category: ' . $row['category']),
                    'category' => 'Photo Gallery',
                    'cat_key' => 'gallery',
                    'url' => '/gallery.php?cat=' . urlencode($row['category']),
                    'icon' => 'camera',
                    'badge' => $row['category']
                ];
            }
        }
    }
} catch (Throwable $e) {
    error_log("Search error: " . $e->getMessage());
}

echo json_encode([
    'status' => 'success',
    'query' => $query,
    'count' => count($results),
    'results' => $results
], JSON_UNESCAPED_UNICODE);
