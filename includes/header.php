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
    if ($db) {
        $stmt = $db->query("SELECT * FROM notices WHERE is_active = 1 ORDER BY id DESC LIMIT 1");
        $activeNotice = $stmt->fetch();
    }
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
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0">
  <title><?php echo htmlspecialchars($pageTitle); ?></title>
  
  <!-- SEO & Open Graph Meta -->
  <meta name="description" content="<?php echo htmlspecialchars($metaDesc); ?>">
  <meta property="og:title" content="<?php echo htmlspecialchars($pageTitle); ?>">
  <meta property="og:description" content="<?php echo htmlspecialchars($metaDesc); ?>">
  <meta property="og:type" content="website">
  <meta property="og:image" content="/assets/images/round_logo.png">
  <link rel="icon" type="image/png" href="/assets/images/round_logo.png">

  <!-- Preconnect and Google Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Hind:wght@500;600;700&family=Inter:wght@400;500;600;700&family=Noto+Sans+Telugu:wght@400;600;700&display=swap">

  <!-- Production Compiled Tailwind CSS + CDN Fallback -->
  <link rel="stylesheet" href="/assets/css/tailwind.min.css">
  <script src="https://cdn.tailwindcss.com" defer></script>
  <script>
    window.addEventListener('DOMContentLoaded', () => {
      if (window.tailwind) {
        tailwind.config = {
          theme: {
            extend: {
              colors: {
                tnavy: { DEFAULT: '#071533', 50: '#f0f4fc', 100: '#dce5f8', 600: '#1d4899', 800: '#071533', 900: '#030a1c' },
                tblue: { DEFAULT: '#1d4ed8', hover: '#1e40af', light: '#eff6ff' },
                tgold: { DEFAULT: '#f59e0b', light: '#fef3c7' }
              }
            }
          }
        };
      }
    });
  </script>

  <!-- Custom Styles with iOS Glassmorphic Design System -->
  <link rel="stylesheet" href="/assets/css/style.css">
</head>
<body class="bg-white text-slate-900 antialiased flex flex-col min-h-screen">

  <!-- TOP ANNOUNCEMENT BANNER -->
  <?php if ($activeNotice): ?>
  <div id="top-notice-banner" class="bg-gradient-to-r from-red-600 via-rose-600 to-red-700 text-white text-xs md:text-sm py-2 px-4 relative shadow-sm z-30">
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
  <div class="bg-slate-900 text-slate-300 text-xs py-2 px-3 sm:px-4 border-b border-slate-800 relative z-20">
    <div class="max-w-7xl mx-auto flex justify-between items-center gap-2 sm:gap-3">
      
      <!-- Left Contact Info (Desktop Only) -->
      <div class="hidden md:flex items-center gap-4">
        <a href="tel:<?php echo INSTITUTE_PHONE_TEL; ?>" class="flex items-center gap-1.5 hover:text-white transition">
          <svg class="w-3.5 h-3.5 text-amber-400" fill="currentColor" viewBox="0 0 20 20"><path d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 4V3z"/></svg>
          <span class="font-medium"><?php echo INSTITUTE_PHONE; ?></span>
        </a>
        <span class="text-slate-700">|</span>
        <a href="mailto:<?php echo INSTITUTE_EMAIL; ?>" class="flex items-center gap-1.5 hover:text-white transition">
          <svg class="w-3.5 h-3.5 text-amber-400" fill="currentColor" viewBox="0 0 20 20"><path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"/><path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"/></svg>
          <span><?php echo INSTITUTE_EMAIL; ?></span>
        </a>
        <span class="text-slate-700">|</span>
        <span class="text-slate-400">Central Campus: Katheru, Rajamahendravaram</span>
      </div>

      <!-- Mobile Left Indicator -->
      <div class="md:hidden flex items-center gap-1.5 text-slate-400 text-[11px]">
        <span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span>
        <span class="font-medium text-slate-200">Admissions 2025-26 Open</span>
      </div>

      <!-- Right Actions -->
      <div class="flex items-center gap-2 sm:gap-2.5 ml-auto">
        <!-- Language Switcher -->
        <div class="flex items-center bg-slate-800 rounded-md p-0.5 border border-slate-700">
          <button type="button" data-lang="en" class="lang-toggle-btn px-2 py-0.5 text-xs font-semibold rounded transition bg-white text-slate-900 shadow-sm">EN</button>
          <button type="button" data-lang="te" class="lang-toggle-btn px-2 py-0.5 text-xs font-semibold rounded transition text-slate-400 hover:text-white">??????</button>
        </div>

        <!-- Student Sign In -->
        <a href="<?php echo FEE_PORTAL_URL; ?>" target="_blank" rel="noopener noreferrer" class="bg-amber-500 hover:bg-amber-600 text-slate-950 font-bold px-2.5 sm:px-3 py-1 rounded text-xs transition flex items-center gap-1 shadow-sm">
          <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"/></svg>
          <span>Sign In</span>
        </a>

        <!-- Admin Portal -->
        <a href="/admin" class="bg-slate-800 hover:bg-slate-700 text-slate-200 hover:text-white font-medium px-2 sm:px-2.5 py-1 rounded text-xs transition flex items-center gap-1 border border-slate-700" title="Staff & Admin Portal">
          <svg class="w-3 h-3 text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
          <span>Admin</span>
        </a>
      </div>

    </div>
  </div>

  <!-- MAIN STICKY NAVIGATION BAR -->
  <header class="sticky top-0 z-40 header-glass border-b border-slate-200/80">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="flex items-center justify-between h-16 sm:h-20 gap-4">

        <!-- Academy Brand Logo & Typography -->
        <a href="/index.php" class="flex items-center gap-3 group flex-shrink-0">
          <img src="/assets/images/round_logo.png" alt="Tirumala Academy Emblem" width="48" height="48" class="w-10 h-10 sm:w-12 sm:h-12 object-contain transition-transform group-hover:scale-105">
          <div class="flex flex-col">
            <span class="text-base sm:text-xl font-black text-slate-950 tracking-tight leading-none group-hover:text-blue-700 transition">TIRUMALA</span>
            <span class="text-[9px] sm:text-[11px] font-bold text-blue-700 tracking-wider uppercase mt-0.5 sm:mt-1 leading-none">IIT & Medical Academy</span>
          </div>
        </a>

        <!-- Desktop Navigation Menu -->
        <nav class="hidden xl:flex items-center gap-6 text-sm font-semibold text-slate-700">
          <a href="/index.php" data-i18n="nav_home" class="transition hover:text-blue-700 <?php echo $currentNav === 'home' ? 'text-blue-700 font-bold' : ''; ?>">Home</a>
          <a href="/about.php" data-i18n="nav_about" class="transition hover:text-blue-700 <?php echo $currentNav === 'about' ? 'text-blue-700 font-bold' : ''; ?>">About Us</a>
          <a href="/results.php" data-i18n="nav_results" class="transition hover:text-blue-700 <?php echo $currentNav === 'results' ? 'text-blue-700 font-bold' : ''; ?>">Results</a>
          
          <!-- Facilities Dropdown -->
          <div class="relative group py-4">
            <button class="flex items-center gap-1 transition hover:text-blue-700 <?php echo strpos($currentNav, 'facilities') === 0 ? 'text-blue-700 font-bold' : ''; ?>">
              <span data-i18n="nav_facilities">Facilities</span>
              <svg class="w-4 h-4 text-slate-400 group-hover:text-blue-700 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
            </button>
            <div class="absolute left-0 top-full hidden group-hover:block w-52 bg-white rounded-xl shadow-xl border border-slate-100 py-2 z-50">
              <a href="/facilities/transport.php" class="block px-4 py-2.5 text-sm text-slate-700 hover:bg-slate-50 hover:text-blue-700 font-medium">?? Transport & GPS</a>
              <a href="/facilities/hostel.php" class="block px-4 py-2.5 text-sm text-slate-700 hover:bg-slate-50 hover:text-blue-700 font-medium">?? A/C Hostel & Dining</a>
              <a href="/facilities/computer-lab.php" class="block px-4 py-2.5 text-sm text-slate-700 hover:bg-slate-50 hover:text-blue-700 font-medium">?? Computer Lab (CBT)</a>
            </div>
          </div>

          <!-- Gallery Dropdown -->
          <div class="relative group py-4">
            <button class="flex items-center gap-1 transition hover:text-blue-700 <?php echo $currentNav === 'gallery' ? 'text-blue-700 font-bold' : ''; ?>">
              <span data-i18n="nav_gallery">Gallery</span>
              <svg class="w-4 h-4 text-slate-400 group-hover:text-blue-700 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
            </button>
            <div class="absolute left-0 top-full hidden group-hover:block w-48 bg-white rounded-xl shadow-xl border border-slate-100 py-2 z-50">
              <a href="/gallery.php?cat=Events" class="block px-4 py-2.5 text-sm text-slate-700 hover:bg-slate-50 hover:text-blue-700 font-medium">?? Events & Annual Day</a>
              <a href="/gallery.php?cat=Results" class="block px-4 py-2.5 text-sm text-slate-700 hover:bg-slate-50 hover:text-blue-700 font-medium">?? Felicitations & Ranks</a>
              <a href="/gallery.php?cat=Games" class="block px-4 py-2.5 text-sm text-slate-700 hover:bg-slate-50 hover:text-blue-700 font-medium">? Sports & Games</a>
            </div>
          </div>

          <a href="/model-papers.php" data-i18n="nav_papers" class="transition hover:text-blue-700 <?php echo $currentNav === 'model-papers' ? 'text-blue-700 font-bold' : ''; ?>">Model Papers</a>
          <a href="/contact.php" data-i18n="nav_contact" class="transition hover:text-blue-700 <?php echo $currentNav === 'contact' ? 'text-blue-700 font-bold' : ''; ?>">Campuses</a>
        </nav>

        <!-- Right Call to Action -->
        <div class="flex items-center gap-2 sm:gap-3">
          <!-- Spotlight Search Trigger Button -->
          <button type="button" class="search-trigger-btn flex items-center gap-2 text-slate-600 hover:text-blue-700 bg-slate-100/90 hover:bg-slate-200/80 px-3 py-2 rounded-lg text-xs font-semibold transition" title="Search results, papers, campuses (Ctrl+K)">
            <svg class="w-4 h-4 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
            <span class="hidden sm:inline">Search</span>
            <kbd class="hidden sm:inline-block bg-white text-slate-400 text-[10px] px-1.5 py-0.5 rounded shadow-xs border border-slate-200">?K</kbd>
          </button>

          <!-- Apply Button -->
          <a href="/admissions.php" data-i18n="nav_admissions" class="bg-blue-700 hover:bg-blue-800 text-white font-bold px-3.5 sm:px-5 py-2 sm:py-2.5 rounded-lg text-xs sm:text-sm shadow-md hover:shadow-lg transition transform hover:-translate-y-0.5 flex items-center gap-1.5">
            <span>Apply</span>
            <span class="hidden sm:inline">for Admission</span>
            <svg class="w-3.5 h-3.5 sm:w-4 sm:h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
          </a>

          <!-- Mobile Hamburger Button -->
          <button id="mobile-menu-btn" class="xl:hidden p-2 rounded-lg text-slate-700 hover:bg-slate-100 focus:outline-none transition active:scale-95" aria-label="Open Navigation Menu">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
          </button>
        </div>

      </div>
    </div>
  </header>

  <!-- MOBILE DRAWER BACKDROP & ENHANCED SLIDE-OUT MENU -->
  <div id="mobile-backdrop"></div>
  <div id="mobile-drawer">
    
    <!-- Drawer Header -->
    <div class="p-4 border-b border-slate-200/80 flex items-center justify-between bg-slate-50">
      <div class="flex items-center gap-2.5">
        <img src="/assets/images/round_logo.png" alt="Tirumala Emblem" class="w-9 h-9 object-contain bg-white rounded-full p-0.5 border border-slate-200 shadow-xs">
        <div>
          <span class="font-black text-slate-900 text-sm tracking-tight block">Tirumala Academy</span>
          <span class="text-[10px] text-blue-700 font-bold tracking-wider uppercase">Menu & Services</span>
        </div>
      </div>
      <button id="mobile-menu-close" class="w-8 h-8 rounded-full bg-slate-200/70 hover:bg-slate-300 text-slate-700 flex items-center justify-center transition" aria-label="Close Menu">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"/></svg>
      </button>
    </div>

    <!-- Quick Search trigger inside Drawer -->
    <div class="p-3 bg-white border-b border-slate-100">
      <button type="button" class="search-trigger-btn w-full bg-slate-100 hover:bg-slate-200/80 text-slate-600 rounded-xl px-3.5 py-2.5 text-xs flex items-center justify-between transition">
        <span class="flex items-center gap-2">
          <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
          <span class="text-slate-500">Search rankers, papers, campuses...</span>
        </span>
        <span class="text-[10px] font-bold text-blue-700 uppercase">Find</span>
      </button>
    </div>

    <!-- Drawer Nav Options (Scrollable) -->
    <div class="p-4 flex-1 overflow-y-auto space-y-1 text-slate-800">
      <a href="/index.php" class="flex items-center gap-3 py-2.5 px-3 rounded-xl font-semibold hover:bg-blue-50 hover:text-blue-700 transition">
        <span class="w-7 h-7 rounded-lg bg-blue-100 text-blue-700 flex items-center justify-center flex-shrink-0">
          <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"/></svg>
        </span>
        <span>Home</span>
      </a>

      <a href="/about.php" class="flex items-center gap-3 py-2.5 px-3 rounded-xl font-semibold hover:bg-blue-50 hover:text-blue-700 transition">
        <span class="w-7 h-7 rounded-lg bg-indigo-100 text-indigo-700 flex items-center justify-center flex-shrink-0">
          <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z"/></svg>
        </span>
        <span>About Us & Leadership</span>
      </a>

      <a href="/results.php" class="flex items-center gap-3 py-2.5 px-3 rounded-xl font-semibold hover:bg-blue-50 hover:text-blue-700 transition">
        <span class="w-7 h-7 rounded-lg bg-amber-100 text-amber-700 flex items-center justify-center flex-shrink-0">
          <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
        </span>
        <span>Results & State Ranks</span>
      </a>

      <div class="pt-3 pb-1 text-[11px] font-bold uppercase tracking-wider text-slate-400 px-3">Campus Facilities</div>
      <a href="/facilities/transport.php" class="block py-2 px-3 pl-8 rounded-lg text-sm text-slate-700 hover:bg-slate-100 hover:text-blue-700">?? Transport & GPS Tracking</a>
      <a href="/facilities/hostel.php" class="block py-2 px-3 pl-8 rounded-lg text-sm text-slate-700 hover:bg-slate-100 hover:text-blue-700">?? A/C Hostel & Nutritious Dining</a>
      <a href="/facilities/computer-lab.php" class="block py-2 px-3 pl-8 rounded-lg text-sm text-slate-700 hover:bg-slate-100 hover:text-blue-700">?? Online CBT Computer Lab</a>

      <div class="pt-3 pb-1 text-[11px] font-bold uppercase tracking-wider text-slate-400 px-3">Resources & Media</div>
      <a href="/model-papers.php" class="block py-2 px-3 pl-8 rounded-lg text-sm text-slate-700 hover:bg-slate-100 hover:text-blue-700">?? Model Papers (Free PDF)</a>
      <a href="/gallery.php" class="block py-2 px-3 pl-8 rounded-lg text-sm text-slate-700 hover:bg-slate-100 hover:text-blue-700">??? Campus Photo Gallery</a>

      <div class="pt-3 pb-1 text-[11px] font-bold uppercase tracking-wider text-slate-400 px-3">Locations & Portals</div>
      <a href="/contact.php" class="block py-2 px-3 pl-8 rounded-lg text-sm text-slate-700 hover:bg-slate-100 hover:text-blue-700">?? Campuses & Google Maps</a>
      <a href="<?php echo FEE_PORTAL_URL; ?>" target="_blank" rel="noopener noreferrer" class="block py-2 px-3 pl-8 rounded-lg text-sm font-semibold text-amber-600 hover:bg-amber-50">?? Student Fee Portal (Onesaz) ?</a>
      <a href="/admin" class="block py-2 px-3 pl-8 rounded-lg text-sm text-slate-700 hover:bg-slate-100">?? Staff / Admin Login</a>

      <div class="pt-4">
        <a href="/admissions.php" class="block py-3 px-4 text-center rounded-xl bg-blue-700 hover:bg-blue-800 text-white font-bold shadow-md transition">Apply for Admission 2025-26</a>
      </div>
    </div>

    <!-- Drawer Footer Helpline -->
    <div class="p-4 border-t border-slate-200 bg-slate-50 text-xs">
      <div class="flex items-center justify-between">
        <div>
          <span class="text-slate-400 block text-[11px]">Admissions Helpline:</span>
          <a href="tel:<?php echo INSTITUTE_PHONE_TEL; ?>" class="font-bold text-slate-900 hover:text-blue-700 text-sm"><?php echo INSTITUTE_PHONE; ?></a>
        </div>
        <a href="tel:<?php echo INSTITUTE_PHONE_TEL; ?>" class="bg-emerald-600 hover:bg-emerald-700 text-white p-2 rounded-full shadow-sm" aria-label="Call Helpline Now">
          <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 4V3z"/></svg>
        </a>
      </div>
    </div>

  </div>

  <!-- MAIN PAGE CONTENT CONTAINER STARTS -->
  <main class="flex-grow">
