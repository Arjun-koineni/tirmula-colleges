<?php
/**
 * Tirumala IIT & Medical Academy
 * Core Configuration & Database Bootstrap File
 * Production-ready for standard shared hosting (Apache/cPanel/MySQL) & local preview (SQLite)
 */

if (session_status() === PHP_SESSION_NONE) {
    session_start();
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
            $value = trim(trim($value), "\"'");
            if (!isset($_SERVER[$name]) && !isset($_ENV[$name])) {
                putenv("$name=$value");
                $_ENV[$name] = $value;
                $_SERVER[$name] = $value;
            }
        }
    }
}
loadEnv();

// 2. Institutional Constants (Verified Live Data)
define('SITE_NAME', getenv('APP_NAME') ?: 'Tirumala IIT & Medical Academy');
define('SITE_TAGLINE', 'Nurturing Academic Excellence Since 2011');
define('SITE_URL', getenv('APP_URL') ?: '');

define('INSTITUTE_PHONE', '0883 297 0077');
define('INSTITUTE_PHONE_TEL', '+918832970077');
define('INSTITUTE_EMAIL', 'admin@tirumalaedu.com');
define('INSTITUTE_WHATSAPP', '918832970077');
define('INSTITUTE_ADDRESS', 'Katheru, Rajamahendravaram (Rajahmundry), Andhra Pradesh 533102');
define('FEE_PORTAL_URL', 'https://tirumala.onesaz.com/sign-in');

// Razorpay configuration (Client-side Merchant account requirement)
define('RAZORPAY_KEY_ID', getenv('RAZORPAY_KEY_ID') ?: 'rzp_test_5xDemoTirumala');
define('RAZORPAY_KEY_SECRET', getenv('RAZORPAY_KEY_SECRET') ?: '');

// 3. Database Connection
function getDB() {
    static $db = null;
    if ($db !== null) return $db;

    $host = getenv('DB_HOST') ?: '127.0.0.1';
    $port = getenv('DB_PORT') ?: '3306';
    $dbname = getenv('DB_NAME') ?: 'tirumala_db';
    $user = getenv('DB_USER') ?: 'root';
    $pass = getenv('DB_PASS') ?: '';

    // Check connection driver setting
    $driverPref = getenv('DB_CONNECTION') ?: 'auto';
    $useMysql = ($driverPref === 'mysql');

    if ($driverPref === 'auto') {
        // Fast probe: check if port 3306 is open within 30ms so we don't block for 2000ms
        $fp = @fsockopen($host, (int)$port, $errno, $errstr, 0.03);
        if ($fp) {
            fclose($fp);
            $useMysql = true;
        } else {
            $useMysql = false;
        }
    }

    if ($useMysql) {
        try {
            $dsn = "mysql:host={$host};port={$port};dbname={$dbname};charset=utf8mb4";
            $db = new PDO($dsn, $user, $pass, [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES => false,
            ]);
        } catch (Throwable $e) {
            $useMysql = false;
        }
    }

    if (!$useMysql || $db === null) {
        // Instant SQLite for local execution
        $sqlitePath = __DIR__ . '/tirumala.sqlite';
        $db = new PDO("sqlite:" . $sqlitePath, null, null, [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        ]);
    }

    $lockFile = __DIR__ . '/.db_installed';
    if (!file_exists($lockFile)) {
        initDatabaseSchema($db);
        @touch($lockFile);
    }
    return $db;
}

// 4. Schema and Seed Data Initialization
function initDatabaseSchema($db) {
    $driver = $db->getAttribute(PDO::ATTR_DRIVER_NAME);
    $autoInc = ($driver === 'sqlite') ? 'INTEGER PRIMARY KEY AUTOINCREMENT' : 'INT AUTO_INCREMENT PRIMARY KEY';

    // Admin Users Table
    $db->exec("CREATE TABLE IF NOT EXISTS admin_users (
        id {$autoInc},
        username VARCHAR(100) UNIQUE NOT NULL,
        password_hash VARCHAR(255) NOT NULL,
        full_name VARCHAR(150),
        created_at DATETIME DEFAULT CURRENT_TIMESTAMP
    )");

    // Results Table
    $db->exec("CREATE TABLE IF NOT EXISTS results (
        id {$autoInc},
        student_name VARCHAR(150) NOT NULL,
        roll_number VARCHAR(50) NOT NULL,
        stream VARCHAR(50) NOT NULL,       -- MPC, BiPC, Foundation
        exam_type VARCHAR(50) NOT NULL,    -- JEE Advanced, JEE Main, NEET, IPE Inter, SSC Class 10
        year INT NOT NULL,
        campus VARCHAR(100) NOT NULL,      -- Rajamahendravaram, Visakhapatnam, Bhimavaram, Tanuku, Payakaraopeta
        score_or_rank VARCHAR(100) NOT NULL,
        photo_url VARCHAR(255),
        featured INT DEFAULT 0,
        created_at DATETIME DEFAULT CURRENT_TIMESTAMP
    )");

    // Notices & Announcements Table
    $db->exec("CREATE TABLE IF NOT EXISTS notices (
        id {$autoInc},
        title VARCHAR(255) NOT NULL,
        content TEXT,
        link_url VARCHAR(255),
        badge_type VARCHAR(50) DEFAULT 'Urgent', -- Urgent, New, Admission, Exam
        is_active INT DEFAULT 1,
        created_at DATETIME DEFAULT CURRENT_TIMESTAMP
    )");

    // Model Papers Table
    $db->exec("CREATE TABLE IF NOT EXISTS model_papers (
        id {$autoInc},
        title VARCHAR(255) NOT NULL,
        class_grade VARCHAR(50) NOT NULL,  -- Class 6, Class 7, Class 8, Class 9, Class 10, Intermediate
        board VARCHAR(50) NOT NULL,        -- STATE, CBSE, ICSE, Combined
        stream VARCHAR(50) DEFAULT 'General',
        file_path VARCHAR(255) NOT NULL,
        file_size VARCHAR(50) DEFAULT '1.2 MB',
        download_count INT DEFAULT 0,
        created_at DATETIME DEFAULT CURRENT_TIMESTAMP
    )");

    // Gallery Table
    $db->exec("CREATE TABLE IF NOT EXISTS gallery (
        id {$autoInc},
        title VARCHAR(255) NOT NULL,
        category VARCHAR(50) NOT NULL,     -- Events, Results, Games, Facilities
        image_url VARCHAR(255) NOT NULL,
        caption TEXT,
        created_at DATETIME DEFAULT CURRENT_TIMESTAMP
    )");

    // Admissions Enquiries Table
    $db->exec("CREATE TABLE IF NOT EXISTS enquiries (
        id {$autoInc},
        student_name VARCHAR(150) NOT NULL,
        parent_name VARCHAR(150),
        phone VARCHAR(25) NOT NULL,
        email VARCHAR(100),
        class_applying VARCHAR(50),
        stream_interested VARCHAR(50),
        campus_preferred VARCHAR(100),
        message TEXT,
        application_fee_paid INT DEFAULT 0,
        razorpay_payment_id VARCHAR(100),
        status VARCHAR(20) DEFAULT 'Pending', -- Pending, Contacted, Admitted
        created_at DATETIME DEFAULT CURRENT_TIMESTAMP
    )");

    // Seed default admin if missing (admin / tirumala@2026)
    $stmt = $db->query("SELECT COUNT(*) as cnt FROM admin_users");
    $row = $stmt->fetch();
    if ($row && $row['cnt'] == 0) {
        $hash = password_hash('tirumala@2026', PASSWORD_DEFAULT);
        $ins = $db->prepare("INSERT INTO admin_users (username, password_hash, full_name) VALUES (?, ?, ?)");
        $ins->execute(['admin', $hash, 'Tirumala Academy Administrator']);
    }

    // Seed initial results if empty
    $stmt = $db->query("SELECT COUNT(*) as cnt FROM results");
    $row = $stmt->fetch();
    if ($row && $row['cnt'] == 0) {
        $seedResults = [
            ['K. Sai Teja', 'TIMA202401', 'MPC', 'JEE Advanced', 2024, 'Rajamahendravaram', 'AIR 142 (Top in AP)', 'assets/images/jee_adv_result.jpg', 1],
            ['V. Sravani', 'TIMA202402', 'BiPC', 'NEET', 2024, 'Visakhapatnam', 'Score: 695/720 (AIR 218)', 'assets/images/neet_result.jpg', 1],
            ['P. Rohan Kumar', 'TIMA202403', 'MPC', 'JEE Main', 2024, 'Bhimavaram', '99.94 Percentile', 'assets/images/inter_mpc_result.jpg', 1],
            ['M. Harshitha', 'TIMA202404', 'BiPC', 'IPE Inter', 2024, 'Tanuku', '992/1000 State Rank 4', 'assets/images/inter_bipc_result.jpg', 1],
            ['B. Lokesh', 'TIMA202405', 'Foundation', 'SSC Class 10', 2024, 'Payakaraopeta', '594/600 (GPA 10.0)', 'assets/images/ssc_result.jpg', 1],
            ['D. Ananya', 'TIMA202406', 'MPC', 'JEE Advanced', 2024, 'Rajamahendravaram', 'AIR 384', 'assets/images/jee_adv_result.jpg', 0],
            ['T. Vamsi Krishna', 'TIMA202407', 'BiPC', 'NEET', 2024, 'Visakhapatnam', 'Score: 678/720', 'assets/images/neet_result.jpg', 0],
            ['S. Preethi', 'TIMA202408', 'MPC', 'IPE Inter', 2024, 'Bhimavaram', '988/1000', 'assets/images/inter_mpc_result.jpg', 0],
        ];
        $ins = $db->prepare("INSERT INTO results (student_name, roll_number, stream, exam_type, year, campus, score_or_rank, photo_url, featured) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
        foreach ($seedResults as $r) {
            $ins->execute($r);
        }
    }

    // Seed initial notices if empty
    $stmt = $db->query("SELECT COUNT(*) as cnt FROM notices");
    $row = $stmt->fetch();
    if ($row && $row['cnt'] == 0) {
        $seedNotices = [
            ['Admissions Open for Academic Year 2025-26 (Schools & Junior Colleges)', 'Admissions open across Rajamahendravaram, Vizag, Bhimavaram, Tanuku & Payakaraopeta campuses. Apply online or visit campus.', 'admissions.php', 'Admission', 1],
            ['Tirumala Super 60 IIT-JEE & NEET Batch Entrance Test Announced', 'Entrance screening test for scholarship & Super 60 residential batch will be conducted this Sunday.', 'admissions.php', 'Urgent', 1],
            ['Model Papers for Classes 6th to Intermediate Available for Free Download', 'Prepare with authentic Tirumala practice question papers available in the Model Papers section.', 'model-papers.php', 'New', 1],
        ];
        $ins = $db->prepare("INSERT INTO notices (title, content, link_url, badge_type, is_active) VALUES (?, ?, ?, ?, ?)");
        foreach ($seedNotices as $n) {
            $ins->execute($n);
        }
    }

    // Seed model papers if empty
    $stmt = $db->query("SELECT COUNT(*) as cnt FROM model_papers");
    $row = $stmt->fetch();
    if ($row && $row['cnt'] == 0) {
        $seedPapers = [
            ['Into 6th Class Entrance Model Paper 2024-25', 'Class 6', 'CBSE / STATE', 'General', 'https://tirumalaedu.com/wp-content/uploads/2026/01/INTO-6TH-CLASS.pdf', '1.4 MB', 342],
            ['Into 7th Class Entrance Model Paper - ICSE Board', 'Class 7', 'ICSE', 'General', 'https://tirumalaedu.com/wp-content/uploads/2025/01/INTO-7TH-CLASS-ICSE.pdf', '1.6 MB', 289],
            ['Into 7th Class Model Paper - STATE & CBSE Combined', 'Class 7', 'Combined', 'General', 'https://tirumalaedu.com/wp-content/uploads/2025/01/INTO-7TH-CLASS-STATE-CBSE.pdf', '1.8 MB', 310],
            ['Into 8th Class Model Paper - ICSE Stream', 'Class 8', 'ICSE', 'General', 'https://tirumalaedu.com/wp-content/uploads/2026/01/INTO-8TH-CLASS_ICSE.pdf', '1.9 MB', 412],
            ['Into 8th Class Model Paper - CBSE Stream', 'Class 8', 'CBSE', 'General', 'https://tirumalaedu.com/wp-content/uploads/2026/01/INTO-8TH-CLASS_CBSE.pdf', '2.0 MB', 450],
            ['Into 8th Class Model Paper - STATE Stream', 'Class 8', 'STATE', 'General', 'https://tirumalaedu.com/wp-content/uploads/2026/01/INTO-8TH-CLASS_STATE.pdf', '1.7 MB', 380],
            ['Into 9th Class IIT/NEET Foundation - ICSE', 'Class 9', 'ICSE', 'Foundation', 'https://tirumalaedu.com/wp-content/uploads/2026/01/INTO-9TH-CLASS_ICSE.pdf', '2.2 MB', 520],
            ['Into 9th Class IIT/NEET Foundation - CBSE', 'Class 9', 'CBSE', 'Foundation', 'https://tirumalaedu.com/wp-content/uploads/2026/01/INTO-9TH-CLASS_CBSE.pdf', '2.3 MB', 560],
            ['Into 9th Class IIT/NEET Foundation - STATE', 'Class 9', 'STATE', 'Foundation', 'https://tirumalaedu.com/wp-content/uploads/2026/01/INTO-9TH-CLASS_STATE.pdf', '2.1 MB', 490],
            ['Into 10th Class Board & Olympiad - ICSE', 'Class 10', 'ICSE', 'Foundation', 'https://tirumalaedu.com/wp-content/uploads/2026/01/INTO-10TH-CLASS_-ICSE.pdf', '2.4 MB', 610],
            ['Into 10th Class Board & Olympiad - CBSE', 'Class 10', 'CBSE', 'Foundation', 'https://tirumalaedu.com/wp-content/uploads/2026/01/INTO-10TH-CLASS_CBSE.pdf', '2.5 MB', 680],
            ['Into 10th Class Board & Olympiad - STATE', 'Class 10', 'STATE', 'Foundation', 'https://tirumalaedu.com/wp-content/uploads/2026/01/INTO-10TH-CLASS_STATE.pdf', '2.3 MB', 590],
            ['Into Intermediate MPC / BiPC Entrance - ICSE', 'Intermediate', 'ICSE', 'MPC / BiPC', 'https://tirumalaedu.com/wp-content/uploads/2026/01/INTO-INTER-ICSE.pdf', '2.8 MB', 890],
            ['Into Intermediate MPC / BiPC Entrance - CBSE', 'Intermediate', 'CBSE', 'MPC / BiPC', 'https://tirumalaedu.com/wp-content/uploads/2026/01/INTO-INTER-CBSE.pdf', '2.9 MB', 940],
            ['Into Intermediate MPC / BiPC Entrance - STATE', 'Intermediate', 'STATE', 'MPC / BiPC', 'https://tirumalaedu.com/wp-content/uploads/2026/01/INTO-INTER-STATE.pdf', '2.7 MB', 820],
        ];
        $ins = $db->prepare("INSERT INTO model_papers (title, class_grade, board, stream, file_path, file_size, download_count) VALUES (?, ?, ?, ?, ?, ?, ?)");
        foreach ($seedPapers as $p) {
            $ins->execute($p);
        }
    }

    // Seed gallery if empty
    $stmt = $db->query("SELECT COUNT(*) as cnt FROM gallery");
    $row = $stmt->fetch();
    if ($row && $row['cnt'] == 0) {
        $seedGallery = [
            ['Annual Day & Merit Awards Celebration', 'Events', 'assets/images/chairman_tirumala_rao.png', 'Chairman Sri N. Tirumala Rao honoring state top rankers.'],
            ['NEET All India Rankers Felicitation', 'Results', 'assets/images/neet_result.jpg', 'Celebrating Tirumala Academy medical entrance champions.'],
            ['Inter-School Sports Meet & Athletic Championship', 'Games', 'assets/images/offcanvase.jpg', 'Students competing at the state-level athletic championship.'],
            ['JEE Advanced State Toppers Recognition', 'Results', 'assets/images/jee_adv_result.jpg', 'IIT Bombay and IIT Madras qualifiers felicitated by MD G. Satish Babu.'],
            ['Science Exhibition & Robotic Innovation Fair', 'Events', 'assets/images/director_satish_babu.jpg', 'Hands-on experiential learning by young innovators.'],
            ['Volleyball & Cricket Tournament Finals', 'Games', 'assets/images/round_logo.png', 'Annual sports carnival promoting holistic health & discipline.'],
        ];
        $ins = $db->prepare("INSERT INTO gallery (title, category, image_url, caption) VALUES (?, ?, ?, ?)");
        foreach ($seedGallery as $g) {
            $ins->execute($g);
        }
    }
}

// 5. Helper Auth Functions
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
