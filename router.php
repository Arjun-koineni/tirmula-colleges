<?php
// Router for PHP built-in web server (php -S 127.0.0.1:8000 router.php)
$uri = parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);

// If requesting a physical file that exists (CSS, JS, images, fonts, downloads, direct php), serve it
if ($uri !== '/' && file_exists(__DIR__ . $uri) && !is_dir(__DIR__ . $uri)) {
    return false;
}

// If directory requested (e.g., /admin, /), check for index.php inside it
if (is_dir(__DIR__ . $uri) && file_exists(__DIR__ . $uri . '/index.php')) {
    require __DIR__ . $uri . '/index.php';
    return;
}

// Check if appending .php matches a file (e.g., /about -> /about.php, /results -> /results.php)
$cleanUri = rtrim($uri, '/');
if ($cleanUri !== '' && file_exists(__DIR__ . $cleanUri . '.php')) {
    require __DIR__ . $cleanUri . '.php';
    return;
}

// Default fallback to index.php
require __DIR__ . '/index.php';
