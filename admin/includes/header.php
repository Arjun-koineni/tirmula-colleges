<?php
/**
 * Admin Panel Header
 * Clean, modern, accessible for non-technical staff
 */
require_once __DIR__ . '/../../config.php';

// Check authentication on all admin pages except login.php
$currentPage = basename($_SERVER['PHP_SELF']);
if ($currentPage !== 'login.php') {
    requireAdmin();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?php echo isset($adminTitle) ? htmlspecialchars($adminTitle) . ' | Tirumala Admin' : 'Staff Admin Panel | Tirumala Academy'; ?></title>
  <link rel="icon" type="image/png" href="/assets/images/round_logo.png">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="/assets/css/style.css">
  <script src="https://cdn.tailwindcss.com"></script>
  <script>
    if (window.tailwind) {
      tailwind.config = {
        theme: {
          extend: {
            colors: {
              tnavy: { DEFAULT: '#0e2554', 50: '#f0f4fc', 100: '#dce5f8', 600: '#1d4899', 800: '#0e2554', 900: '#071533' },
              tcrimson: { DEFAULT: '#d90429', hover: '#b8001f', light: '#ffebee' },
              tgold: { DEFAULT: '#f59e0b', light: '#fef3c7' }
            }
          }
        }
      };
    }
  </script>
  <style>
    body { font-family: 'Inter', sans-serif; }
    .bg-tcrimson { background-color: #d90429 !important; color: #ffffff !important; }
    .bg-tcrimson:hover, .hover\:bg-tcrimson-hover:hover { background-color: #b8001f !important; }
    .bg-tnavy { background-color: #0e2554 !important; color: #ffffff !important; }
    .bg-tnavy:hover, .hover\:bg-tnavy-hover:hover { background-color: #071533 !important; }
    .text-tcrimson { color: #d90429 !important; }
    .text-tnavy { color: #0e2554 !important; }
  </style>
</head>
<body class="bg-slate-100 text-slate-800 min-h-screen flex flex-col">

  <!-- TOP ADMIN BAR -->
  <header class="bg-slate-900 text-white sticky top-0 z-40 shadow-md">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="flex items-center justify-between h-16">
        
        <!-- Left Brand & Badge -->
        <div class="flex items-center gap-3">
          <a href="/admin/index.php" class="flex items-center gap-2">
            <img src="/assets/images/round_logo.png" alt="Logo" class="w-8 h-8 rounded-full bg-white p-0.5">
            <span class="font-bold text-base text-white tracking-tight">Tirumala Academy</span>
          </a>
          <span class="bg-amber-500 text-slate-950 font-extrabold text-[10px] uppercase px-2 py-0.5 rounded tracking-wider">
            Staff Portal
          </span>
        </div>

        <!-- Navigation Links -->
        <?php if (isAdminLoggedIn()): ?>
        <nav class="hidden md:flex items-center gap-1 text-sm font-medium">
          <a href="/admin/index.php" class="px-3 py-1.5 rounded-md hover:bg-slate-800 transition <?php echo $currentPage === 'index.php' ? 'bg-slate-800 text-amber-400 font-bold' : 'text-slate-300'; ?>">Dashboard</a>
          <a href="/admin/results.php" class="px-3 py-1.5 rounded-md hover:bg-slate-800 transition <?php echo $currentPage === 'results.php' ? 'bg-slate-800 text-amber-400 font-bold' : 'text-slate-300'; ?>">Results</a>
          <a href="/admin/notices.php" class="px-3 py-1.5 rounded-md hover:bg-slate-800 transition <?php echo $currentPage === 'notices.php' ? 'bg-slate-800 text-amber-400 font-bold' : 'text-slate-300'; ?>">Notices</a>
          <a href="/admin/model-papers.php" class="px-3 py-1.5 rounded-md hover:bg-slate-800 transition <?php echo $currentPage === 'model-papers.php' ? 'bg-slate-800 text-amber-400 font-bold' : 'text-slate-300'; ?>">Model Papers</a>
          <a href="/admin/gallery.php" class="px-3 py-1.5 rounded-md hover:bg-slate-800 transition <?php echo $currentPage === 'gallery.php' ? 'bg-slate-800 text-amber-400 font-bold' : 'text-slate-300'; ?>">Gallery</a>
          <a href="/admin/enquiries.php" class="px-3 py-1.5 rounded-md hover:bg-slate-800 transition <?php echo $currentPage === 'enquiries.php' ? 'bg-slate-800 text-amber-400 font-bold' : 'text-slate-300'; ?>">Enquiries</a>
        </nav>

        <!-- User Actions -->
        <div class="flex items-center gap-3">
          <a href="/index.php" target="_blank" class="text-xs text-slate-400 hover:text-white flex items-center gap-1">
            <span>View Website</span>
            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
          </a>
          <span class="text-slate-700">|</span>
          <a href="/admin/logout.php" class="bg-red-700 hover:bg-red-800 text-white text-xs font-semibold px-3 py-1.5 rounded transition">
            Logout
          </a>
        </div>
        <?php endif; ?>

      </div>
    </div>
  </header>

  <!-- MOBILE SUB-BAR FOR ADMIN -->
  <?php if (isAdminLoggedIn()): ?>
  <div class="md:hidden bg-slate-800 text-xs text-slate-300 py-2 px-4 flex items-center gap-2 overflow-x-auto">
    <a href="/admin/index.php" class="px-2.5 py-1 rounded <?php echo $currentPage === 'index.php' ? 'bg-slate-900 text-amber-400 font-bold' : ''; ?>">Dashboard</a>
    <a href="/admin/results.php" class="px-2.5 py-1 rounded <?php echo $currentPage === 'results.php' ? 'bg-slate-900 text-amber-400 font-bold' : ''; ?>">Results</a>
    <a href="/admin/notices.php" class="px-2.5 py-1 rounded <?php echo $currentPage === 'notices.php' ? 'bg-slate-900 text-amber-400 font-bold' : ''; ?>">Notices</a>
    <a href="/admin/model-papers.php" class="px-2.5 py-1 rounded <?php echo $currentPage === 'model-papers.php' ? 'bg-slate-900 text-amber-400 font-bold' : ''; ?>">Papers</a>
    <a href="/admin/gallery.php" class="px-2.5 py-1 rounded <?php echo $currentPage === 'gallery.php' ? 'bg-slate-900 text-amber-400 font-bold' : ''; ?>">Gallery</a>
    <a href="/admin/enquiries.php" class="px-2.5 py-1 rounded <?php echo $currentPage === 'enquiries.php' ? 'bg-slate-900 text-amber-400 font-bold' : ''; ?>">Enquiries</a>
  </div>
  <?php endif; ?>

  <main class="flex-grow max-w-7xl mx-auto w-full px-4 sm:px-6 lg:px-8 py-8">
