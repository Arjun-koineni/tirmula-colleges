<?php
// Vercel Serverless PHP Router for Tirumala College
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

// Normalize trailing slashes
if ($uri !== '/' && substr($uri, -1) === '/') {
    $uri = rtrim($uri, '/');
}

$fileMap = [
    '/' => '/index.php',
    '/index.php' => '/index.php',
    '/about' => '/about.php',
    '/about.php' => '/about.php',
    '/admissions' => '/admissions.php',
    '/admissions.php' => '/admissions.php',
    '/contact' => '/contact.php',
    '/contact.php' => '/contact.php',
    '/results' => '/results.php',
    '/results.php' => '/results.php',
    '/gallery' => '/gallery.php',
    '/gallery.php' => '/gallery.php',
    '/model-papers' => '/model-papers.php',
    '/model-papers.php' => '/model-papers.php',
    '/admin' => '/admin/index.php',
    '/admin/index.php' => '/admin/index.php',
    '/admin/login.php' => '/admin/login.php',
    '/admin/logout.php' => '/admin/logout.php',
    '/admin/enquiries.php' => '/admin/enquiries.php',
    '/admin/results.php' => '/admin/results.php',
    '/admin/notices.php' => '/admin/notices.php',
    '/admin/gallery.php' => '/admin/gallery.php',
    '/admin/model-papers.php' => '/admin/model-papers.php',
    '/facilities/transport.php' => '/facilities/transport.php',
    '/facilities/hostel.php' => '/facilities/hostel.php',
    '/facilities/computer-lab.php' => '/facilities/computer-lab.php',
    '/api/get_notices.php' => '/api/get_notices.php',
    '/api/search_results.php' => '/api/search_results.php',
    '/api/submit_enquiry.php' => '/api/submit_enquiry.php'
];

if (isset($fileMap[$uri])) {
    require __DIR__ . '/..' . $fileMap[$uri];
    exit;
}

// Check direct file or .php extension
$candidate = __DIR__ . '/..' . $uri;
if (is_file($candidate)) {
    require $candidate;
    exit;
}

if (is_file($candidate . '.php')) {
    require $candidate . '.php';
    exit;
}

// Fallback to home page
require __DIR__ . '/../index.php';