<?php
/**
 * Shared Header Component
 * Tirumala IIT & Medical Academy
 */
require_once __DIR__ . '/../config.php';

// Fetch active announcement banner if database is available
$activeNotice = null;
try {
    $db = getDB();
    $stmt = $db->query("SELECT * FROM notices WHERE is_active = 1 ORDER BY id DESC LIMIT 1");
    $activeNotice = $stmt->fetch();
} catch (Throwable $e) {
    // Graceful fallback
}

$pageTitle = isset($pageTitle) ? $pageTitle . " | " . SITE_NAME : SITE_NAME . " - Premier IIT-JEE & NEET Academy";
$currentNav = isset($currentNav) ? $currentNav : 'home';
$metaDesc = isset($metaDesc) ? $metaDesc : "Tirumala IIT & Medical Academy - Premier educational group with 9 schools and 17 junior colleges across Andhra Pradesh, guiding 42,600+ students towards nation-leading ranks.";
?>
<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?php echo htmlspecialchars($pageTitle); ?></title>
  
  <!-- SEO & Open Graph Meta -->
  <meta name="description" content="<?php echo htmlspecialchars($metaDesc); ?>">
  <meta property="og:title" content="<?php echo htmlspecialchars($pageTitle); ?>">
  <meta property="og:description" content="<?php echo htmlspecialchars($metaDesc); ?>">
  <meta property="og:type" content="website">
  <meta property="og:image" content="<?php echo SITE_URL; ?>/assets/images/round_logo.png">
  <link rel="icon" type="image/png" href="<?php echo SITE_URL; ?>/assets/images/round_logo.png">

  <!-- Preconnect and Google Fonts (Asynchronous & Non-blocking) -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Hind:wght@500;600;700&family=Inter:wght@400;500;600;700&family=Noto+Sans+Telugu:wght@400;600;700&display=swap">

  <!-- Production Compiled Tailwind CSS + CDN Fallback -->
  <link rel="stylesheet" href="<?php echo SITE_URL; ?>/assets/css/tailwind.min.css">
  <script src="https://cdn.tailwindcss.com" defer></script>
  <script>
    window.addEventListener('DOMContentLoaded', () => {
      if (window.tailwind) {
        tailwind.config = {
          theme: {
            extend: {
              colors: {
                tnavy: { DEFAULT: '#0e2554', 50: '#f0f4fc', 100: '#dce5f8', 600: '#1d4899', 800: '#0e2554', 900: '#071533' },
                tblue: { DEFAULT: '#1d4ed8', hover: '#1e40af', light: '#eff6ff' },
                tcrimson: { DEFAULT: '#1d4ed8', hover: '#1e40af', light: '#eff6ff' },
                tgold: { DEFAULT: '#f59e0b', light: '#fef3c7' },
                turgent: { DEFAULT: '#dc2626', hover: '#b91c1c', light: '#fee2e2' }
              }
            }
          }
        };
      }
    });
  </script>

  <!-- Custom Styles -->
  <link rel="stylesheet" href="<?php echo SITE_URL; ?>/assets/css/style.css">
</head>
<body class="bg-white text-slate-800 antialiased flex flex-col min-h-screen">

  <!-- TOP ANNOUNCEMENT BANNER (PRESERVED RED EXCLUSIVELY FOR URGENT ALERTS) -->
  <?php if ($activeNotice): ?>
  <div id="top-notice-banner" class="bg-gradient-to-r from-red-600 via-rose-600 to-red-700 text-white text-xs md:text-sm py-2 px-4 relative shadow-sm">
    <div class="max-w-7xl mx-auto flex items-center justify-between gap-3">
      <div class="flex items-center gap-2 overflow-hidden">
        <span class="bg-white text-red-700 font-bold uppercase tracking-wider px-2 py-0.5 rounded text-[10px] shadow-sm flex-shrink-0 animate-pulse">
          <?php echo htmlspecialchars($activeNotice['badge_type'] ?: 'Notice'); ?>
        </span>
        <a href="<?php echo htmlspecialchars($activeNotice['link_url'] ?: '/admissions.php'); ?>" class="hover:underline truncate font-medium">
          <?php echo htmlspecialchars($activeNotice['title']); ?>
        </a>
      </div>
      <button id="dismiss-notice-btn" class="text-white/80 hover:text-white flex-shrink-0 p-1" aria-label="Dismiss Announcement">&times;</button>
    </div>
  </div>
  <?php endif; ?>

  <!-- UTILITY TOP BAR -->
  <div class="bg-slate-900 text-slate-300 text-xs py-2 px-4 border-b border-slate-800">
    <div class="max-w-7xl mx-auto flex flex-wrap justify-between items-center gap-3">
      <!-- Left Contact Info -->
      <div class="flex items-center gap-4 flex-wrap">
        <a href="tel:<?php echo INSTITUTE_PHONE_TEL; ?>" class="flex items-center gap-1.5 hover:text-white transition">
          <svg class="w-3.5 h-3.5 text-amber-400" fill="currentColor" viewBox="0 0 20 20"><path d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 4V3z"/></svg>
          <span><?php echo INSTITUTE_PHONE; ?></span>
        </a>
        <span class="text-slate-700">|</span>
        <a href="mailto:<?php echo INSTITUTE_EMAIL; ?>" class="flex items-center gap-1.5 hover:text-white transition hidden sm:flex">
          <svg class="w-3.5 h-3.5 text-amber-400" fill="currentColor" viewBox="0 0 20 20"><path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"/><path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"/></svg>
          <span><?php echo INSTITUTE_EMAIL; ?></span>
        </a>
        <span class="text-slate-700 hidden sm:inline">|</span>
        <span class="text-slate-400 hidden md:inline">Central Campus: Katheru, Rajamahendravaram (AP)</span>
      </div>

      <!-- Right Actions: Language Switch & Student Fee Portal -->

      <div class="flex items-center gap-3">
        <!-- Language Switcher -->
        <div class="flex items-center bg-slate-800 rounded-md p-0.5 border border-slate-700">
          <button type="button" data-lang="en" class="lang-toggle-btn px-2 py-0.5 text-xs font-semibold rounded transition bg-white text-slate-900 shadow-sm">EN</button>
          <button type="button" data-lang="te" class="lang-toggle-btn px-2 py-0.5 text-xs font-semibold rounded transition text-slate-400 hover:text-white">తెలుగు</button>
        </div>

        <a href="<?php echo FEE_PORTAL_URL; ?>" target="_blank" rel="noopener noreferrer" class="bg-amber-500 hover:bg-amber-600 text-slate-950 font-bold px-3.5 py-1 rounded text-xs transition flex items-center gap-1.5 shadow-sm">
          <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"/></svg>
          <span>Sign In</span>
        </a>
        <a href="/admin" class="bg-slate-800 hover:bg-slate-700 text-slate-200 hover:text-white font-medium px-2.5 py-1 rounded text-xs transition flex items-center gap-1 border border-slate-700"><svg class="w-3 h-3 text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg><span>Admin</span></a>
      </div>
    </div>
  </div>

  <!-- MAIN NAVIGATION HEADER -->
  <header class="header-glass sticky top-0 z-50 border-b border-slate-200">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="flex justify-between items-center h-20">
        
        <!-- Brand Logo with Verified Official Emblem -->
        <a href="/index.php" class="flex items-center gap-3 group">
          <img src="/assets/images/round_logo.png" alt="Tirumala IIT & Medical Academy Emblem" width="56" height="56" class="h-12 sm:h-14 w-auto object-contain transition transform group-hover:scale-105 rounded-full bg-white p-0.5 border border-slate-200 shadow-sm">
          <div>
            <span class="block text-xl sm:text-2xl font-black tracking-tight text-tnavy uppercase leading-none">Tirumala</span>
            <span class="block text-[10px] sm:text-[11px] font-bold text-blue-700 tracking-wider uppercase mt-1">IIT & Medical Academy</span>
          </div>
        </a>

        <!-- Desktop Navigation Links -->
        <nav class="hidden xl:flex items-center gap-6 text-[15px] font-medium text-slate-700">
          <a href="/index.php" data-i18n="nav_home" class="transition hover:text-blue-700 <?php echo $currentNav === 'home' ? 'text-blue-700 font-bold' : ''; ?>">Home</a>
          <a href="/about.php" data-i18n="nav_about" class="transition hover:text-blue-700 <?php echo $currentNav === 'about' ? 'text-blue-700 font-bold' : ''; ?>">About Us</a>
          <a href="/results.php" data-i18n="nav_results" class="transition hover:text-blue-700 <?php echo $currentNav === 'results' ? 'text-blue-700 font-bold' : ''; ?>">Results</a>
          
          <!-- Facilities Dropdown -->
          <div class="relative group py-4">
            <button class="flex items-center gap-1 transition hover:text-blue-700 <?php echo strpos($currentNav, 'facilities') === 0 ? 'text-blue-700 font-bold' : ''; ?>">
              <span data-i18n="nav_facilities">Facilities</span>
              <svg class="w-4 h-4 text-slate-400 group-hover:text-blue-700 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
            </button>
            <div class="absolute left-0 top-full hidden group-hover:block w-52 bg-white rounded-lg shadow-xl border border-slate-100 py-2 z-50 animate-fadeIn">
              <a href="/facilities/transport.php" class="block px-4 py-2.5 text-sm text-slate-700 hover:bg-slate-50 hover:text-blue-700 font-medium">🚌 Transport & GPS</a>
              <a href="/facilities/hostel.php" class="block px-4 py-2.5 text-sm text-slate-700 hover:bg-slate-50 hover:text-blue-700 font-medium">🏢 A/C Hostel & Dining</a>
              <a href="/facilities/computer-lab.php" class="block px-4 py-2.5 text-sm text-slate-700 hover:bg-slate-50 hover:text-blue-700 font-medium">💻 Computer Lab (CBT)</a>
            </div>
          </div>

          <!-- Gallery Dropdown -->
          <div class="relative group py-4">
            <button class="flex items-center gap-1 transition hover:text-blue-700 <?php echo $currentNav === 'gallery' ? 'text-blue-700 font-bold' : ''; ?>">
              <span data-i18n="nav_gallery">Gallery</span>
              <svg class="w-4 h-4 text-slate-400 group-hover:text-blue-700 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
            </button>
            <div class="absolute left-0 top-full hidden group-hover:block w-48 bg-white rounded-lg shadow-xl border border-slate-100 py-2 z-50 animate-fadeIn">
              <a href="/gallery.php?cat=Events" class="block px-4 py-2.5 text-sm text-slate-700 hover:bg-slate-50 hover:text-blue-700 font-medium">🎉 Events & Annual Day</a>
              <a href="/gallery.php?cat=Results" class="block px-4 py-2.5 text-sm text-slate-700 hover:bg-slate-50 hover:text-blue-700 font-medium">🏆 Felicitations & Ranks</a>
              <a href="/gallery.php?cat=Games" class="block px-4 py-2.5 text-sm text-slate-700 hover:bg-slate-50 hover:text-blue-700 font-medium">⚽ Sports & Games</a>
            </div>
          </div>

          <a href="/model-papers.php" data-i18n="nav_papers" class="transition hover:text-blue-700 <?php echo $currentNav === 'model-papers' ? 'text-blue-700 font-bold' : ''; ?>">Model Papers</a>
          <a href="/contact.php" data-i18n="nav_contact" class="transition hover:text-blue-700 <?php echo $currentNav === 'contact' ? 'text-blue-700 font-bold' : ''; ?>">Contact</a>
        </nav>

        <!-- Right Call to Action (Vibrant Blue Theme) -->
        <div class="hidden sm:flex items-center gap-3">
          <a href="/admissions.php" data-i18n="nav_admissions" class="bg-blue-700 hover:bg-blue-800 text-white font-semibold px-5 py-2.5 rounded-lg text-sm shadow-md hover:shadow-lg transition transform hover:-translate-y-0.5 flex items-center gap-2">
            <span>Apply for Admission</span>
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
          </a>
        </div>

        <!-- Mobile Menu Hamburger Button -->
        <div class="flex xl:hidden items-center gap-2">
          <a href="/admissions.php" class="bg-blue-700 text-white px-3 py-1.5 rounded text-xs font-semibold sm:hidden">Apply</a>
          <button id="mobile-menu-btn" class="p-2 rounded-lg text-slate-700 hover:bg-slate-100 focus:outline-none" aria-label="Open Navigation Menu">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
          </button>
        </div>

      </div>
    </div>
  </header>

  <!-- MOBILE DRAWER BACKDROP & MENU -->
  <div id="mobile-backdrop" class="fixed inset-0 bg-slate-900/60 z-50 hidden transition-opacity"></div>
  <div id="mobile-drawer" class="fixed top-0 right-0 bottom-0 w-80 max-w-[85vw] bg-white z-50 shadow-2xl transform translate-x-full transition-transform duration-300 ease-in-out flex flex-col">
    
    <div class="p-4 border-b border-slate-100 flex items-center justify-between">
      <div class="flex items-center gap-2">
        <img src="/assets/images/round_logo.png" alt="Logo" class="w-9 h-9 object-contain">
        <span class="font-bold text-tnavy text-sm">Tirumala Academy</span>
      </div>
      <button id="mobile-menu-close" class="p-2 text-slate-500 hover:text-slate-900" aria-label="Close Menu">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
      </button>
    </div>

    <div class="p-4 flex-1 overflow-y-auto space-y-1">
      <a href="/index.php" class="block py-2.5 px-3 rounded-lg text-slate-800 font-medium hover:bg-slate-50">Home</a>
      <a href="/about.php" class="block py-2.5 px-3 rounded-lg text-slate-800 font-medium hover:bg-slate-50">About Us</a>
      <a href="/results.php" class="block py-2.5 px-3 rounded-lg text-slate-800 font-medium hover:bg-slate-50">Results & Ranks</a>

      <div class="pt-2 pb-1 text-xs font-bold uppercase tracking-wider text-slate-400 px-3">Facilities</div>
      <a href="/facilities/transport.php" class="block py-2 px-3 pl-6 rounded-lg text-sm text-slate-700 hover:bg-slate-50">🚌 Transport & GPS</a>
      <a href="/facilities/hostel.php" class="block py-2 px-3 pl-6 rounded-lg text-sm text-slate-700 hover:bg-slate-50">🏢 A/C Hostel</a>
      <a href="/facilities/computer-lab.php" class="block py-2 px-3 pl-6 rounded-lg text-sm text-slate-700 hover:bg-slate-50">💻 Computer Lab</a>

      <div class="pt-2 pb-1 text-xs font-bold uppercase tracking-wider text-slate-400 px-3">Academics & Media</div>
      <a href="/gallery.php" class="block py-2 px-3 pl-6 rounded-lg text-sm text-slate-700 hover:bg-slate-50">🖼️ Photo Gallery</a>
      <a href="/model-papers.php" class="block py-2 px-3 pl-6 rounded-lg text-sm text-slate-700 hover:bg-slate-50">📄 Model Papers (PDF)</a>

      <div class="pt-2 pb-1 text-xs font-bold uppercase tracking-wider text-slate-400 px-3">Contact & Fees</div>
      <a href="/contact.php" class="block py-2.5 px-3 rounded-lg text-slate-800 font-medium hover:bg-slate-50">Contact & Campuses</a>
      <a href="<?php echo FEE_PORTAL_URL; ?>" target="_blank" class="block py-2.5 px-3 rounded-lg text-amber-700 font-medium hover:bg-amber-50">🔐 Student & Parent Sign In</a>
      <a href="/admin" class="block py-2.5 px-3 rounded-lg text-slate-700 font-medium hover:bg-slate-50">⚙️ Staff / Admin Portal</a>
      <a href="/admissions.php" class="block mt-4 py-3 px-4 text-center rounded-lg bg-blue-700 hover:bg-blue-800 text-white font-bold shadow">Apply for Admission 2025-26</a>
    </div>

    <div class="p-4 border-t border-slate-100 bg-slate-50 text-xs text-slate-500">
      <p class="font-semibold text-slate-700">Central Helpline:</p>
      <p class="text-sm font-bold text-tnavy mt-0.5"><?php echo INSTITUTE_PHONE; ?></p>
      <p class="mt-1">Katheru, Rajamahendravaram, AP</p>
    </div>

  </div>

  <!-- MAIN PAGE CONTENT CONTAINER STARTS -->
  <main class="flex-grow">
