<?php
/**
 * Tirumala IIT & Medical Academy
 * Core Configuration & Database Bootstrap File
 */

// Start output buffering immediately so no headers are prematurely sent
if (!ob_get_level()) {
    ob_start();
}

if (session_status() === PHP_SESSION_NONE) {
    @session_start();
}

// 1. Environment loader
function loadEnv($path = __DIR__ . '/.env') {
    if (!file_exists($path)) return;
    $lines = file($path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($lines as $line) {
        $line = trim($line);
        if (empty($line) || strpos($line, '#') === 0) continue;
        if (strpos($line, '=') !== false) {
            list($name, $value) = explode('=', $line, 2);
            $name = trim($name);
            $value = trim($value, " \t\n\r\0\x0B\"'");
            if (!isset($_SERVER[$name]) && !isset($_ENV[$name])) {
                putenv("$name=$value");
                $_ENV[$name] = $value;
                $_SERVER[$name] = $value;
            }
        }
    }
}
loadEnv();

// 2. Institutional Constants
define('SITE_NAME', getenv('APP_NAME') ?: 'Tirumala IIT & Medical Academy');
define('SITE_TAGLINE', 'Nurturing Academic Excellence Since 2011');

// Root-relative empty prefix ensures assets always load reliably on Vercel and any host
define('SITE_URL', '');

define('INSTITUTE_PHONE', '0883 297 0077');
define('INSTITUTE_PHONE_TEL', '+918832970077');
define('INSTITUTE_EMAIL', 'admin@tirumalaedu.com');
define('INSTITUTE_WHATSAPP', '918832970077');
define('INSTITUTE_ADDRESS', 'Katheru, Rajamahendravaram (Rajahmundry), Andhra Pradesh 533102');
define('FEE_PORTAL_URL', 'https://tirumala.onesaz.com/sign-in');

define('RAZORPAY_KEY_ID', getenv('RAZORPAY_KEY_ID') ?: 'rzp_test_YourKeyHere');
define('RAZORPAY_KEY_SECRET', getenv('RAZORPAY_KEY_SECRET') ?: '');

// 3. Database Connection
function getDB() {
    static $pdo = null;
    if ($pdo !== null) return $pdo;

    $sqlitePath = __DIR__ . '/tirumala.sqlite';
    try {
        $pdo = new PDO('sqlite:' . $sqlitePath);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        initDatabaseTables($pdo);
        return $pdo;
    } catch (PDOException $e) {
        error_log('Database Connection Error: ' . $e->getMessage());
        return null;
    }
}

function initDatabaseTables($db) {
    if (!$db) return;

    $db->exec("CREATE TABLE IF NOT EXISTS admin_users (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        username TEXT UNIQUE NOT NULL,
        password_hash TEXT NOT NULL,
        full_name TEXT NOT NULL,
        created_at DATETIME DEFAULT CURRENT_TIMESTAMP
    )");

    $db->exec("CREATE TABLE IF NOT EXISTS results (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        student_name TEXT NOT NULL,
        roll_number TEXT UNIQUE NOT NULL,
        stream TEXT NOT NULL,
        exam_type TEXT NOT NULL,
        year INTEGER NOT NULL,
        campus TEXT NOT NULL,
        score_or_rank TEXT NOT NULL,
        photo_url TEXT DEFAULT NULL,
        featured INTEGER DEFAULT 0,
        created_at DATETIME DEFAULT CURRENT_TIMESTAMP
    )");

    $db->exec("CREATE TABLE IF NOT EXISTS notices (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        title TEXT NOT NULL,
        content TEXT,
        link_url TEXT DEFAULT NULL,
        badge_type TEXT DEFAULT 'Urgent',
        is_active INTEGER DEFAULT 1,
        created_at DATETIME DEFAULT CURRENT_TIMESTAMP
    )");

    $db->exec("CREATE TABLE IF NOT EXISTS model_papers (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        title TEXT NOT NULL,
        class_grade TEXT NOT NULL,
        board TEXT NOT NULL,
        stream TEXT NOT NULL,
        file_path TEXT NOT NULL,
        file_size TEXT DEFAULT '1.5 MB',
        download_count INTEGER DEFAULT 0,
        created_at DATETIME DEFAULT CURRENT_TIMESTAMP
    )");

    $db->exec("CREATE TABLE IF NOT EXISTS gallery (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        title TEXT NOT NULL,
        category TEXT NOT NULL,
        image_url TEXT NOT NULL,
        caption TEXT DEFAULT NULL,
        created_at DATETIME DEFAULT CURRENT_TIMESTAMP
    )");

    $db->exec("CREATE TABLE IF NOT EXISTS enquiries (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        student_name TEXT NOT NULL,
        parent_name TEXT DEFAULT NULL,
        phone TEXT NOT NULL,
        email TEXT DEFAULT NULL,
        class_applying TEXT DEFAULT NULL,
        stream_interested TEXT DEFAULT NULL,
        campus_preferred TEXT DEFAULT NULL,
        message TEXT DEFAULT NULL,
        application_fee_paid INTEGER DEFAULT 0,
        razorpay_payment_id TEXT DEFAULT NULL,
        status TEXT DEFAULT 'Pending',
        created_at DATETIME DEFAULT CURRENT_TIMESTAMP
    )");
}

function isAdminLoggedIn() {
    return !empty($_SESSION['tirumala_admin_id']);
}

function requireAdmin() {
    if (!isAdminLoggedIn()) {
        header('Location: /admin/login.php');
        exit;
    }
}

function sanitizeInput($data) {
    return htmlspecialchars(trim($data), ENT_QUOTES, 'UTF-8');
}
