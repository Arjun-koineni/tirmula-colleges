/**
 * Tirumala IIT & Medical Academy
 * Core JavaScript: Navigation, iOS Glassmorphic Dock, Universal Search, Theme Toggle, Campus Call Selector
 */

document.addEventListener('DOMContentLoaded', () => {
  initThemeToggle();
  initStickyHeader();
  initMobileMenu();
  initLanguageToggle();
  initNoticeBanner();
  initWhatsAppAgent();
  initScrollDock();
  initSpotlightSearch();
  initCampusCallModal();
});

// 0. Global Theme Toggle (Dark & Bright Mode)
function initThemeToggle() {
  const themeToggles = document.querySelectorAll('.theme-toggle-btn');
  
  function getPreferredTheme() {
    const saved = localStorage.getItem('tima_theme');
    if (saved) return saved;
    return window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light';
  }

  function applyTheme(theme) {
    if (theme === 'dark') {
      document.documentElement.classList.add('dark');
    } else {
      document.documentElement.classList.remove('dark');
    }
    localStorage.setItem('tima_theme', theme);

    themeToggles.forEach(btn => {
      const sun = btn.querySelector('.theme-sun-icon');
      const moon = btn.querySelector('.theme-moon-icon');
      const statusText = btn.querySelector('.theme-status-text');

      if (theme === 'dark') {
        if (sun) sun.classList.remove('hidden');
        if (moon) moon.classList.add('hidden');
        if (statusText) statusText.textContent = 'Bright Mode';
        btn.setAttribute('title', 'Switch to Bright Mode');
      } else {
        if (sun) sun.classList.add('hidden');
        if (moon) moon.classList.remove('hidden');
        if (statusText) statusText.textContent = 'Dark Mode';
        btn.setAttribute('title', 'Switch to Dark Mode');
      }
    });
  }

  themeToggles.forEach(btn => {
    btn.addEventListener('click', (e) => {
      e.preventDefault();
      const current = document.documentElement.classList.contains('dark') ? 'dark' : 'light';
      const nextTheme = current === 'dark' ? 'light' : 'dark';
      applyTheme(nextTheme);
    });
  });

  applyTheme(getPreferredTheme());

  if (window.matchMedia) {
    window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', (e) => {
      if (!localStorage.getItem('tima_theme')) {
        applyTheme(e.matches ? 'dark' : 'light');
      }
    });
  }
}

// 1. Sticky Header Elevation on Scroll
function initStickyHeader() {
  const header = document.querySelector('header');
  if (!header) return;

  window.addEventListener('scroll', () => {
    if (window.scrollY > 20) {
      header.classList.add('header-scrolled');
    } else {
      header.classList.remove('header-scrolled');
    }
  }, { passive: true });
}

// 2. Mobile Drawer Navigation (Bulletproof open/close)
function initMobileMenu() {
  const toggleBtn = document.getElementById('mobile-menu-btn');
  const closeBtn = document.getElementById('mobile-menu-close');
  const drawer = document.getElementById('mobile-drawer');
  const backdrop = document.getElementById('mobile-backdrop');

  if (!toggleBtn || !drawer) return;

  function openDrawer() {
    drawer.classList.add('open');
    if (backdrop) backdrop.classList.add('open');
    document.body.style.overflow = 'hidden';
  }

  function closeDrawer() {
    drawer.classList.remove('open');
    if (backdrop) backdrop.classList.remove('open');
    document.body.style.overflow = '';
  }

  toggleBtn.addEventListener('click', openDrawer);
  if (closeBtn) closeBtn.addEventListener('click', closeDrawer);
  if (backdrop) backdrop.addEventListener('click', closeDrawer);

  drawer.querySelectorAll('a').forEach(link => {
    link.addEventListener('click', () => {
      closeDrawer();
    });
  });

  document.addEventListener('keydown', (e) => {
    if (e.key === 'Escape') closeDrawer();
  });
}

// 3. iOS Floating Bottom Dock (Mobile Mode Only: Entrance, Scroll Hide/Show & Spring Tap Animations)
function initScrollDock() {
  const dock = document.getElementById('ios-bottom-dock');
  if (!dock) return;

  // Add interactive iOS tactile spring bounce on touch/click
  const dockInteractive = dock.querySelectorAll('.ios-dock-item, #ios-search-btn');
  dockInteractive.forEach(item => {
    ['mousedown', 'touchstart'].forEach(evt => {
      item.addEventListener(evt, () => {
        item.classList.add('ios-item-pressed');
      }, { passive: true });
    });

    ['mouseup', 'mouseleave', 'touchend', 'touchcancel'].forEach(evt => {
      item.addEventListener(evt, () => {
        if (item.classList.contains('ios-item-pressed')) {
          item.classList.remove('ios-item-pressed');
          item.classList.add('ios-item-bouncing');
          setTimeout(() => item.classList.remove('ios-item-bouncing'), 450);
        }
      }, { passive: true });
    });
  });

  // Fluid scroll hide & spring reveal on mobile
  let scrollTimeout = null;
  let lastScrollY = window.scrollY;

  window.addEventListener('scroll', () => {
    // Dock is mobile-only (<1024px)
    if (window.innerWidth >= 1024) return;

    const currentScrollY = window.scrollY;
    
    // Hide smoothly when scrolling down past 60px
    if (currentScrollY > lastScrollY + 8 && currentScrollY > 60) {
      dock.classList.add('dock-hidden');
    } else if (currentScrollY < lastScrollY - 6) {
      // Reappear immediately when scrolling up
      dock.classList.remove('dock-hidden');
    }

    lastScrollY = currentScrollY;
    clearTimeout(scrollTimeout);

    // Reappear automatically when user pauses scrolling
    scrollTimeout = setTimeout(() => {
      dock.classList.remove('dock-hidden');
    }, 240);
  }, { passive: true });
}

// 4. Campus Call Selector Modal (Direct Dial for All 5 Campuses)
function initCampusCallModal() {
  const modal = document.getElementById('campus-call-modal');
  const triggers = document.querySelectorAll('.campus-call-trigger');
  const closeBtn = document.getElementById('campus-call-close-btn');

  if (!modal) return;

  function openModal() {
    modal.classList.add('active');
    document.body.style.overflow = 'hidden';
  }

  function closeModal() {
    modal.classList.remove('active');
    document.body.style.overflow = '';
  }

  triggers.forEach(trig => {
    trig.addEventListener('click', (e) => {
      e.preventDefault();
      openModal();
    });
  });

  if (closeBtn) closeBtn.addEventListener('click', closeModal);

  modal.addEventListener('click', (e) => {
    if (e.target === modal) closeModal();
  });

  document.addEventListener('keydown', (e) => {
    if (e.key === 'Escape' && modal.classList.contains('active')) {
      closeModal();
    }
  });
}

// 5. Universal Spotlight Live Search System (Search Anything across the website)
function initSpotlightSearch() {
  const modal = document.getElementById('spotlight-modal');
  const openBtns = document.querySelectorAll('.search-trigger-btn, #ios-search-btn');
  const closeBtn = document.getElementById('spotlight-close-btn');
  const clearBtn = document.getElementById('spotlight-clear-btn');
  const searchInput = document.getElementById('spotlight-input');
  const resultsContainer = document.getElementById('spotlight-results');
  const countText = document.getElementById('spotlight-count-text');
  const categoryPills = document.querySelectorAll('.search-cat-pill');

  if (!modal || !searchInput || !resultsContainer) return;

  let activeCategory = 'all';
  let debounceTimer = null;
  let activeIndex = -1;

  // Comprehensive Static Knowledge Base for Instant Client Search
  const staticDirectory = [
    // Rankers & Top Performers
    { title: "K. Sai Teja - AIR 142 (Top in AP)", category: "Rankers & Students", cat_key: "students", sub: "Roll: TIMA202401 • JEE Advanced 2024 • Rajamahendravaram", url: "/results.php?search=TIMA202401", icon: "trophy", keywords: "sai teja air 142 jee advanced iit topper tima202401 mpc" },
    { title: "V. Sravani - NEET 695/720 (AIR 218)", category: "Rankers & Students", cat_key: "students", sub: "Roll: TIMA202402 • Medical Stream • Visakhapatnam", url: "/results.php?search=TIMA202402", icon: "trophy", keywords: "sravani neet 695 medical bipc vizag doctor aiims tima202402" },
    { title: "P. Rohan Kumar - 99.94 Percentile", category: "Rankers & Students", cat_key: "students", sub: "Roll: TIMA202403 • JEE Main 2024 • Bhimavaram", url: "/results.php?search=TIMA202403", icon: "trophy", keywords: "rohan kumar 99.94 jee main nit bhimavaram tima202403" },
    { title: "M. Harshitha - 992/1000 State Rank 4", category: "Rankers & Students", cat_key: "students", sub: "Roll: TIMA202404 • IPE Inter BiPC • Tanuku", url: "/results.php?search=TIMA202404", icon: "trophy", keywords: "harshitha 992 intermediate board state rank tanuku tima202404" },
    { title: "B. Lokesh - 594/600 (GPA 10.0)", category: "Rankers & Students", cat_key: "students", sub: "Roll: TIMA202405 • Class 10 SSC • Payakaraopeta", url: "/results.php?search=TIMA202405", icon: "trophy", keywords: "lokesh 594 gpa 10 10.0 ssc class 10 school payakaraopeta tima202405" },
    { title: "D. Ananya - AIR 384 JEE Advanced", category: "Rankers & Students", cat_key: "students", sub: "Roll: TIMA202406 • MPC Stream • Rajamahendravaram", url: "/results.php?search=TIMA202406", icon: "trophy", keywords: "ananya air 384 iit jee advanced tima202406" },

    // Campuses
    { title: "Rajamahendravaram Campus (HQ)", category: "Campuses", cat_key: "campuses", sub: "Katheru Main Campus • Tel: 0883 297 0077", url: "/contact.php#campuses", icon: "map", keywords: "rajamahendravaram rajahmundry katheru central head office hq 08832970077" },
    { title: "Visakhapatnam Campus (Vizag)", category: "Campuses", cat_key: "campuses", sub: "Maddilapalem & MVP Colony • Tel: 0891 278 4077", url: "/contact.php#campuses", icon: "map", keywords: "visakhapatnam vizag maddilapalem mvp colony port city 08912784077" },
    { title: "Bhimavaram Campus", category: "Campuses", cat_key: "campuses", sub: "PP Road School & Junior College • Tel: 08816 225 077", url: "/contact.php#campuses", icon: "map", keywords: "bhimavaram pp road sompeta west godavari 08816225077" },
    { title: "Tanuku Campus", category: "Campuses", cat_key: "campuses", sub: "Near Overbridge, Bypass Road • Tel: 08819 245 077", url: "/contact.php#campuses", icon: "map", keywords: "tanuku overbridge bypass road academic 08819245077" },
    { title: "Payakaraopeta Campus", category: "Campuses", cat_key: "campuses", sub: "National Highway 16 Residential • Tel: 08932 233 077", url: "/contact.php#campuses", icon: "map", keywords: "payakaraopeta nh 16 national highway residential anakapalli 08932233077" },

    // Academic Courses & Streams
    { title: "IIT-JEE Super 60 Residential Batch", category: "Courses & Academics", cat_key: "courses", sub: "Intensive 2-Year MPC Program with top national faculty", url: "/admissions.php", icon: "academic", keywords: "iit-jee super 60 mpc engineering advanced main residential entrance" },
    { title: "NEET Intensive Medical Coaching", category: "Courses & Academics", cat_key: "courses", sub: "Specialized BiPC Program with daily NCERT test series", url: "/admissions.php", icon: "academic", keywords: "neet medical bipc aiims doctor biology mbbs coaching" },
    { title: "Intermediate MPC / BiPC (Board + Entrance)", category: "Courses & Academics", cat_key: "courses", sub: "2-Year Integrated IPE syllabus with competitive exams", url: "/admissions.php", icon: "academic", keywords: "intermediate inter ipe 1st year 2nd year mpc bipc board" },
    { title: "High School Foundation (Classes 6 to 10)", category: "Courses & Academics", cat_key: "courses", sub: "CBSE & State Board with Olympiad, NTSE & IIT foundation", url: "/admissions.php", icon: "academic", keywords: "school high school foundation class 6 7 8 9 10 cbse state olympiad" },

    // Campus Facilities
    { title: "Transport & Real-Time GPS Tracking", category: "Facilities", cat_key: "facilities", sub: "Dedicated air-conditioned/safe buses covering 45+ regional routes", url: "/facilities/transport.php", icon: "bus", keywords: "transport bus tracking gps vehicle routes safety pickup drop" },
    { title: "A/C Hostels & Hygienic Nutritious Dining", category: "Facilities", cat_key: "facilities", sub: "Separate boys & girls residential hostel wings with south Indian food", url: "/facilities/hostel.php", icon: "home", keywords: "hostel ac air conditioned dining food mess lunch dinner breakfast residential rooms" },
    { title: "Online CBT Computer Testing Lab", category: "Facilities", cat_key: "facilities", sub: "High-speed computer systems replicating real NTA JEE/NEET exams", url: "/facilities/computer-lab.php", icon: "laptop", keywords: "computer lab cbt online mock test nta exam simulation practice systems" },
    { title: "Sports, Games & Physical Fitness", category: "Facilities", cat_key: "facilities", sub: "Cricket nets, badminton, volleyball, basketball & yoga sessions", url: "/gallery.php?cat=Games", icon: "sports", keywords: "sports games cricket fitness playground yoga physical education" },

    // Model Papers
    { title: "Into Class 6 Entrance Model Paper", category: "Model Papers", cat_key: "papers", sub: "Free PDF Download • CBSE & State syllabus", url: "/model-papers.php", icon: "doc", keywords: "class 6 into 6th entrance model paper pdf download test question" },
    { title: "Into Class 7 Model Paper (ICSE / CBSE)", category: "Model Papers", cat_key: "papers", sub: "Free PDF Download • Entrance and screening", url: "/model-papers.php", icon: "doc", keywords: "class 7 into 7th icse cbse model paper pdf download" },
    { title: "Into Class 8 Model Paper (CBSE / State / ICSE)", category: "Model Papers", cat_key: "papers", sub: "Free PDF Download • 3 board formats available", url: "/model-papers.php", icon: "doc", keywords: "class 8 into 8th cbse state icse model paper pdf download" },
    { title: "Into Class 9 IIT-JEE / NEET Foundation Paper", category: "Model Papers", cat_key: "papers", sub: "Free PDF Download • High level math & science", url: "/model-papers.php", icon: "doc", keywords: "class 9 into 9th foundation iit neet math physics chemistry pdf" },
    { title: "Into Class 10 SSC & CBSE Board Papers", category: "Model Papers", cat_key: "papers", sub: "Free PDF Download • Complete subject-wise papers", url: "/model-papers.php", icon: "doc", keywords: "class 10 10th ssc cbse board model paper pdf download" },
    { title: "Intermediate 1st & 2nd Year MPC / BiPC Papers", category: "Model Papers", cat_key: "papers", sub: "Free PDF Download • Board + Entrance practice sets", url: "/model-papers.php", icon: "doc", keywords: "intermediate inter 1st year 2nd year mpc bipc question paper pdf" },

    // Portals & Direct Links
    { title: "Student Fee Payment Portal (Onesaz)", category: "Portals & Services", cat_key: "portals", sub: "Pay term fees, view ledger & download receipts online", url: "https://tirumala.onesaz.com/sign-in", external: true, icon: "portal", keywords: "fee payment pay fee online receipt onesaz student portal sign in" },
    { title: "Apply for 2025-26 Admission Form", category: "Portals & Services", cat_key: "portals", sub: "Online admissions registration for schools & junior colleges", url: "/admissions.php", icon: "portal", keywords: "apply admission application form 2025 2026 register joining enquiry" },
    { title: "Staff & Administration Desk Portal", category: "Portals & Services", cat_key: "portals", sub: "Secure institutional portal for faculty and administrators", url: "/admin", icon: "lock", keywords: "admin portal staff login faculty management system dashboard" },
    { title: "Admissions Central Helpline (All Campuses)", category: "Portals & Services", cat_key: "portals", sub: "Call: 0883 297 0077 • Immediate student counseling", url: "tel:08832970077", icon: "phone", keywords: "phone call contact helpline number telephone admissions 08832970077" },
    { title: "Official WhatsApp Admission Counseling Desk", category: "Portals & Services", cat_key: "portals", sub: "Chat directly with counselors on WhatsApp (+91 883 297 0077)", url: "https://wa.me/918832970077", external: true, icon: "whatsapp", keywords: "whatsapp chat message counseling assistance mobile" },

    // Leadership & Legacy
    { title: "Chairman: Sri Nunna Tirumala Rao", category: "Leadership & Legacy", cat_key: "courses", sub: "Founder & visionary leader of Tirumala Educational Institutions", url: "/about.php", icon: "leadership", keywords: "chairman tirumala rao nunna founder leadership vision message" },
    { title: "Director: Sri Satish Babu", category: "Leadership & Legacy", cat_key: "courses", sub: "Academic director shaping premier curriculum & training", url: "/about.php", icon: "leadership", keywords: "director satish babu academic curriculum mentorship leadership" },
    { title: "Vice-Chairperson: Smt. Nunna Rasmi", category: "Leadership & Legacy", cat_key: "courses", sub: "Administration, student welfare & residential care", url: "/about.php", icon: "leadership", keywords: "vice chairperson nunna rasmi welfare administration hostel care" },
    { title: "Institutional Legacy (Established 2011)", category: "Leadership & Legacy", cat_key: "courses", sub: "42,600+ students mentored across 9 schools and 17 junior colleges", url: "/about.php", icon: "leadership", keywords: "legacy about 2011 trust students colleges schools statistics history" },

    // Photo Gallery & Media
    { title: "Annual Day & Cultural Celebrations Gallery", category: "Gallery", cat_key: "facilities", sub: "Photos of cultural festivals, science exhibitions & stage events", url: "/gallery.php?cat=Events", icon: "camera", keywords: "gallery photos annual day events cultural images celebration" },
    { title: "State Rankers Felicitation Ceremony Gallery", category: "Gallery", cat_key: "facilities", sub: "Award ceremonies for JEE Advanced, NEET & State Toppers", url: "/gallery.php?cat=Results", icon: "camera", keywords: "gallery rankers awards felicitation ceremony photos images" }
  ];

  function getIconSvg(type) {
    if (type === 'trophy') {
      return `<svg class="w-4 h-4 text-amber-500" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>`;
    } else if (type === 'map') {
      return `<svg class="w-4 h-4 text-blue-600" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/></svg>`;
    } else if (type === 'phone') {
      return `<svg class="w-4 h-4 text-emerald-600" fill="currentColor" viewBox="0 0 20 20"><path d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 4V3z"/></svg>`;
    } else if (type === 'doc') {
      return `<svg class="w-4 h-4 text-rose-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4zm2 6a1 1 0 011-1h6a1 1 0 110 2H7a1 1 0 01-1-1zm1 3a1 1 0 100 2h6a1 1 0 100-2H7z" clip-rule="evenodd"/></svg>`;
    } else if (type === 'bus') {
      return `<svg class="w-4 h-4 text-emerald-600" fill="currentColor" viewBox="0 0 20 20"><path d="M8 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zm8 0a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0z"/><path d="M4 4h10a2 2 0 012 2v6h1a1 1 0 011 1v2a1 1 0 01-1 1h-1a3 3 0 01-6 0H9a3 3 0 01-6 0H2a1 1 0 01-1-1v-2a1 1 0 011-1h1V6a2 2 0 012-2zm0 2v5h10V6H4z"/></svg>`;
    } else if (type === 'home') {
      return `<svg class="w-4 h-4 text-amber-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M4 4a2 2 0 012-2h8a2 2 0 012 2v12a1 1 0 110 2h-3a1 1 0 01-1-1v-2a1 1 0 00-1-1H9a1 1 0 00-1 1v2a1 1 0 01-1 1H4a1 1 0 110-2V4zm3 1h2v2H7V5zm2 4H7v2h2V9zm2-4h2v2h-2V5zm2 4h-2v2h2V9z" clip-rule="evenodd"/></svg>`;
    } else if (type === 'laptop') {
      return `<svg class="w-4 h-4 text-blue-600" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M3 5a2 2 0 012-2h10a2 2 0 012 2v8a2 2 0 01-2 2h-2.22l.123.489.804.804A1 1 0 0113 18H7a1 1 0 01-.707-1.707l.804-.804L7.22 15H5a2 2 0 01-2-2V5zm2 1v6h10V6H5z" clip-rule="evenodd"/></svg>`;
    } else if (type === 'academic') {
      return `<svg class="w-4 h-4 text-indigo-600" fill="currentColor" viewBox="0 0 20 20"><path d="M10.394 2.08a1 1 0 00-.788 0l-7 3a1 1 0 000 1.84L5.25 8.051a10.973 10.973 0 00-.25 2.449c0 .768.106 1.512.306 2.223a1 1 0 001.378.653A10.976 10.976 0 0010 15c1.782 0 3.447-.428 4.916-1.184a1 1 0 001.378-.653c.2-.711.306-1.455.306-2.223 0-.84-.09-1.658-.25-2.449l2.644-1.131a1 1 0 000-1.84l-7-3z"/></svg>`;
    } else if (type === 'camera') {
      return `<svg class="w-4 h-4 text-purple-600" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z" clip-rule="evenodd"/></svg>`;
    } else if (type === 'portal' || type === 'lock') {
      return `<svg class="w-4 h-4 text-amber-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd"/></svg>`;
    } else if (type === 'whatsapp') {
      return `<svg class="w-4 h-4 text-emerald-500" fill="currentColor" viewBox="0 0 24 24"><path d="M12.031 6.172c-3.181 0-5.767 2.586-5.768 5.766-.001 1.298.38 2.27 1.019 3.287l-.711 2.598 2.664-.698c.969.587 1.771.865 2.796.865 3.181 0 5.767-2.587 5.768-5.766.001-3.18-2.585-5.652-5.768-5.652zm0 10.362c-.894 0-1.636-.25-2.348-.68l-.168-.101-1.748.458.467-1.704-.112-.178c-.469-.747-.716-1.503-.715-2.39.001-2.531 2.059-4.59 4.616-4.59 2.556 0 4.615 2.059 4.616 4.59-.001 2.531-2.06 4.595-4.616 4.595z"/></svg>`;
    }
    return `<svg class="w-4 h-4 text-blue-600" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-11a1 1 0 10-2 0v2H7a1 1 0 100 2h2v2a1 1 0 102 0v-2h2a1 1 0 100-2h-2V7z" clip-rule="evenodd"/></svg>`;
  }

  function highlightText(text, q) {
    if (!q || !text) return escapeHtml(text);
    const escapedQ = q.replace(/[.*+?^${}()|[\]\\]/g, '\\$&');
    const regex = new RegExp(`(${escapedQ})`, 'gi');
    return escapeHtml(text).replace(regex, '<mark class="search-hl">$1</mark>');
  }

  function openSearch() {
    modal.classList.add('active');
    document.body.style.overflow = 'hidden';
    setTimeout(() => searchInput.focus(), 80);
    renderResults(searchInput.value);
  }

  function closeSearch() {
    modal.classList.remove('active');
    document.body.style.overflow = '';
  }

  openBtns.forEach(btn => {
    btn.addEventListener('click', (e) => {
      e.preventDefault();
      openSearch();
    });
  });

  if (closeBtn) closeBtn.addEventListener('click', closeSearch);

  if (clearBtn) {
    clearBtn.addEventListener('click', () => {
      searchInput.value = '';
      clearBtn.classList.add('hidden');
      renderResults('');
      searchInput.focus();
    });
  }

  modal.addEventListener('click', (e) => {
    if (e.target === modal) closeSearch();
  });

  document.addEventListener('keydown', (e) => {
    if ((e.metaKey || e.ctrlKey) && e.key.toLowerCase() === 'k') {
      e.preventDefault();
      if (modal.classList.contains('active')) closeSearch();
      else openSearch();
    }
    if (e.key === 'Escape' && modal.classList.contains('active')) {
      closeSearch();
    }
  });

  // Category Filter Pill Clicks
  categoryPills.forEach(pill => {
    pill.addEventListener('click', () => {
      categoryPills.forEach(p => {
        p.classList.remove('bg-blue-700', 'text-white', 'shadow-xs');
        p.classList.add('bg-slate-100', 'hover:bg-slate-200', 'text-slate-700');
      });
      pill.classList.add('bg-blue-700', 'text-white', 'shadow-xs');
      pill.classList.remove('bg-slate-100', 'hover:bg-slate-200', 'text-slate-700');
      activeCategory = pill.dataset.cat || 'all';
      renderResults(searchInput.value);
    });
  });

  // Render combined static and backend results
  function renderResults(q) {
    const rawQuery = (q || '').trim();
    const query = rawQuery.toLowerCase();
    activeIndex = -1;

    if (clearBtn) {
      if (rawQuery.length > 0) clearBtn.classList.remove('hidden');
      else clearBtn.classList.add('hidden');
    }

    // 1. Filter local directory
    let localMatches = staticDirectory;
    if (activeCategory !== 'all') {
      localMatches = localMatches.filter(item => item.cat_key === activeCategory);
    }
    if (query) {
      localMatches = localMatches.filter(item => 
        item.title.toLowerCase().includes(query) || 
        item.category.toLowerCase().includes(query) || 
        item.sub.toLowerCase().includes(query) ||
        (item.keywords && item.keywords.toLowerCase().includes(query))
      );
    }

    // Display local matches immediately
    displaySearchResults(localMatches, rawQuery, false);

    // 2. Query backend dynamically if query is entered
    if (rawQuery.length >= 2) {
      clearTimeout(debounceTimer);
      debounceTimer = setTimeout(() => {
        fetch(`/api/search_all.php?q=${encodeURIComponent(rawQuery)}&cat=${encodeURIComponent(activeCategory)}`)
          .then(res => res.json())
          .then(data => {
            if (data && data.status === 'success' && Array.isArray(data.results)) {
              // Merge local and remote, avoiding exact duplicate titles
              const existingTitles = new Set(localMatches.map(m => m.title.toLowerCase()));
              const remoteMatches = data.results.filter(r => !existingTitles.has(r.title.toLowerCase()));
              const combined = [...localMatches, ...remoteMatches];
              displaySearchResults(combined, rawQuery, true);
            }
          })
          .catch(() => {
            // Silently retain local results on network error
          });
      }, 160);
    }
  }

  function displaySearchResults(items, rawQuery, isLiveUpdate) {
    if (countText) {
      if (!rawQuery) {
        countText.textContent = `Directory: Showing ${items.length} top resources across all campuses`;
      } else {
        countText.textContent = `Found ${items.length} match${items.length === 1 ? '' : 'es'} for "${rawQuery}"`;
      }
    }

    if (items.length === 0) {
      resultsContainer.innerHTML = `
        <div class="py-8 text-center text-slate-500 text-sm">
          <svg class="w-10 h-10 mx-auto text-slate-300 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
          <p class="font-semibold text-slate-700">No direct matches found for "${escapeHtml(rawQuery)}"</p>
          <p class="text-xs text-slate-400 mt-1">Try searching by student name, "NEET", "IIT-JEE", "Hostel", "Fee", or "Vizag"</p>
          <div class="mt-4 flex flex-wrap justify-center gap-2">
            <button type="button" class="campus-call-trigger px-3 py-1.5 rounded-lg bg-emerald-600 text-white text-xs font-bold shadow-xs hover:bg-emerald-700 transition flex items-center gap-1">
              <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 20 20"><path d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 4V3z"/></svg>
              <span>Call Campus Helpline</span>
            </button>
            <a href="https://wa.me/918832970077" target="_blank" rel="noopener noreferrer" class="px-3 py-1.5 rounded-lg bg-emerald-50 text-emerald-700 border border-emerald-300 text-xs font-bold hover:bg-emerald-100 transition">
              Chat on WhatsApp
            </a>
          </div>
        </div>
      `;
      return;
    }

    resultsContainer.innerHTML = items.slice(0, 15).map((item, idx) => `
      <a href="${item.url}" ${item.external ? 'target="_blank" rel="noopener noreferrer"' : ''} data-index="${idx}" class="spotlight-result-item flex items-center justify-between p-3 rounded-xl hover:bg-slate-100/90 transition group border border-transparent hover:border-slate-200/60">
        <div class="flex items-center gap-3 min-w-0">
          <div class="w-9 h-9 rounded-xl bg-slate-100/80 flex items-center justify-center flex-shrink-0 group-hover:bg-white group-hover:shadow-sm transition">
            ${getIconSvg(item.icon)}
          </div>
          <div class="truncate">
            <div class="text-sm font-bold text-slate-800 group-hover:text-blue-700 transition truncate">${highlightText(item.title, rawQuery)}</div>
            <div class="text-xs text-slate-500 truncate mt-0.5">${highlightText(item.sub, rawQuery)}</div>
          </div>
        </div>
        <span class="text-[10px] font-bold uppercase tracking-wider px-2 py-0.5 rounded bg-slate-100 group-hover:bg-blue-50 group-hover:text-blue-700 text-slate-600 flex-shrink-0 ml-3 transition">${escapeHtml(item.badge || item.category)}</span>
      </a>
    `).join('');

    // Re-bind campus-call-trigger clicks if any result links trigger call
    resultsContainer.querySelectorAll('.campus-call-trigger').forEach(btn => {
      btn.addEventListener('click', (e) => {
        e.preventDefault();
        closeSearch();
        const callModal = document.getElementById('campus-call-modal');
        if (callModal) callModal.classList.add('active');
      });
    });
  }

  // Keyboard navigation within spotlight search
  searchInput.addEventListener('keydown', (e) => {
    const items = resultsContainer.querySelectorAll('.spotlight-result-item');
    if (items.length === 0) return;

    if (e.key === 'ArrowDown') {
      e.preventDefault();
      activeIndex = (activeIndex + 1) % items.length;
      updateActiveItem(items);
    } else if (e.key === 'ArrowUp') {
      e.preventDefault();
      activeIndex = (activeIndex - 1 + items.length) % items.length;
      updateActiveItem(items);
    } else if (e.key === 'Enter') {
      if (activeIndex >= 0 && items[activeIndex]) {
        e.preventDefault();
        items[activeIndex].click();
      }
    }
  });

  function updateActiveItem(items) {
    items.forEach((it, idx) => {
      if (idx === activeIndex) {
        it.classList.add('bg-blue-50', 'border-blue-300');
        it.scrollIntoView({ block: 'nearest', behavior: 'smooth' });
      } else {
        it.classList.remove('bg-blue-50', 'border-blue-300');
      }
    });
  }

  searchInput.addEventListener('input', (e) => {
    renderResults(e.target.value);
  });
}

function escapeHtml(str) {
  return String(str || '').replace(/[&<>"']/g, m => ({ '&': '&amp;', '<': '&lt;', '>': '&gt;', '"': '&quot;', "'": '&#39;' })[m]);
}

// 6. Bilingual Language Toggle (English / Telugu)
const translations = {
  en: {
    nav_home: "Home",
    nav_about: "About Us",
    nav_results: "Results",
    nav_facilities: "Facilities",
    nav_transport: "Transport",
    nav_hostel: "A/C Hostel",
    nav_lab: "Computer Lab",
    nav_gallery: "Gallery",
    nav_events: "Events",
    nav_games: "Sports",
    nav_papers: "Model Papers",
    nav_contact: "Contact",
    nav_admissions: "Admissions",
    nav_pay_fee: "Pay Fee",
    hero_badge: "Admissions Open 2025-26 • Scholarship Tests Active",
    hero_title: "Empowering Students for IIT-JEE, NEET & Academic Mastery",
    hero_desc: "South India's premier educational group with 9 schools and 17 junior colleges across Andhra Pradesh, guiding 42,600+ young minds towards nation-leading ranks with individual mentorship.",
    cta_enquire: "Apply for Admission",
    cta_explore: "Explore Rankers",
    trust_students: "Students Mentored",
    trust_schools: "Schools",
    trust_colleges: "Junior Colleges",
    trust_years: "Years of Trust (Est. 2011)",
    footer_tagline: "Founded in 2011, Tirumala IIT & Medical Academy is Andhra Pradesh's premier educational group with 9 schools and 17 junior colleges dedicated to student welfare, academic rigor, and nation-building values.",
    enquiry_heading: "Quick Admissions Enquiry",
    enquiry_subheading: "Submit your details and our academic counseling team will contact you within 24 hours.",
    contact_hq: "Central Campus & Administration",
  },
  te: {
    nav_home: "హోమ్",
    nav_about: "మా గురించి",
    nav_results: "ఫలితాలు",
    nav_facilities: "సౌకర్యాలు",
    nav_transport: "రవాణా",
    nav_hostel: "ఎ/సి హాస్టల్",
    nav_lab: "కంప్యూటర్ ల్యాబ్",
    nav_gallery: "గ్యాలరీ",
    nav_events: "కార్యక్రమాలు",
    nav_games: "క్రీడలు",
    nav_papers: "మోడల్ పేపర్స్",
    nav_contact: "సంప్రదించండి",
    nav_admissions: "ప్రవేశాలు",
    nav_pay_fee: "ఫీజు చెల్లింపు",
    hero_badge: "2025-26 ప్రవేశాలు ప్రారంభమైనవి",
    hero_title: "IIT-JEE, NEET మరియు అత్యున్నత విద్యా శిక్షణలో తిరుమల అకాడమీ",
    hero_desc: "ఆంధ్రప్రదేశ్ వ్యాప్తంగా 9 పాఠశాలలు మరియు 17 జూనియర్ కళాశాలలతో 42,600+ విద్యార్థులకు అత్యుత్తమ ర్యాంకులు సాధిస్తున్న ప్రతిష్టాత్మక విద్యాసంస్థ.",
    cta_enquire: "ప్రవేశానికి దరఖాస్తు చేయండి",
    cta_explore: "ఫలితాలను చూడండి",
    trust_students: "విద్యార్థులు",
    trust_schools: "పాఠశాలలు",
    trust_colleges: "జూనియర్ కళాశాలలు",
    trust_years: "సంవత్సరాల విశ్వసనీయత (2011 నుండి)",
    footer_tagline: "2011 నుండి విద్యార్థుల సంక్షేమం, క్రమశిక్షణ మరియు నాణ్యమైన విద్యకు అంకితం.",
    enquiry_heading: "2025-26 ప్రవేశ విచారణ",
    enquiry_subheading: "మీ వివరాలను సమర్పించండి, మా కౌన్సెలర్లు 24 గంటల్లో మిమ్మల్ని సంప్రదిస్తారు.",
    contact_hq: "ప్రధాన క్యాంపస్ & పరిపాలన",
  }
};

function initLanguageToggle() {
  const toggleButtons = document.querySelectorAll('.lang-toggle-btn');
  let currentLang = localStorage.getItem('tima_lang') || 'en';

  function applyLanguage(lang) {
    currentLang = lang;
    localStorage.setItem('tima_lang', lang);

    document.querySelectorAll('[data-i18n]').forEach((el) => {
      const key = el.getAttribute('data-i18n');
      if (translations[lang] && translations[lang][key]) {
        el.textContent = translations[lang][key];
      }
    });

    toggleButtons.forEach((btn) => {
      if (btn.dataset.lang === lang) {
        btn.classList.add('bg-white', 'text-slate-900', 'shadow-sm');
        btn.classList.remove('text-slate-400', 'hover:text-white');
      } else {
        btn.classList.remove('bg-white', 'text-slate-900', 'shadow-sm');
        btn.classList.add('text-slate-400', 'hover:text-white');
      }
    });

    if (lang === 'te') {
      document.body.classList.add('telugu-active');
    } else {
      document.body.classList.remove('telugu-active');
    }
  }

  toggleButtons.forEach((btn) => {
    btn.addEventListener('click', () => {
      applyLanguage(btn.dataset.lang);
    });
  });

  applyLanguage(currentLang);
}

// 7. Dismissible Announcement Bar
function initNoticeBanner() {
  const banner = document.getElementById('top-notice-banner');
  const dismissBtn = document.getElementById('dismiss-notice-btn');
  if (!banner || !dismissBtn) return;

  dismissBtn.addEventListener('click', () => {
    banner.style.display = 'none';
  });
}

// 8. Interactive WhatsApp Admissions Agent
function initWhatsAppAgent() {
  const launcher = document.getElementById('whatsapp-agent-launcher');
  const card = document.getElementById('whatsapp-agent-card');
  const closeBtn = document.getElementById('whatsapp-agent-close');
  const customForm = document.getElementById('wa-custom-form');
  const customInput = document.getElementById('wa-custom-msg');
  const presetButtons = document.querySelectorAll('.wa-preset-btn');

  if (!launcher || !card) return;

  const waNumber = "918832970077";

  function toggleAgent() {
    const isHidden = card.classList.contains('hidden');
    if (isHidden) {
      card.classList.remove('hidden');
      card.style.display = 'block';
      if (customInput) customInput.focus();
    } else {
      card.classList.add('hidden');
      card.style.display = 'none';
    }
  }

  function sendToWhatsApp(message) {
    const cleanMsg = encodeURIComponent(message || 'Hello Tirumala Academy Admissions Desk, I would like to enquire about courses for 2025-26.');
    const waUrl = `https://wa.me/${waNumber}?text=${cleanMsg}`;
    window.open(waUrl, '_blank', 'noopener,noreferrer');
  }

  launcher.addEventListener('click', (e) => {
    e.stopPropagation();
    toggleAgent();
  });

  if (closeBtn) {
    closeBtn.addEventListener('click', (e) => {
      e.stopPropagation();
      toggleAgent();
    });
  }

  presetButtons.forEach((btn) => {
    btn.addEventListener('click', (e) => {
      e.preventDefault();
      const q = btn.getAttribute('data-query');
      sendToWhatsApp(q);
    });
  });

  if (customForm && customInput) {
    customForm.addEventListener('submit', (e) => {
      e.preventDefault();
      const val = customInput.value.trim();
      if (val) {
        sendToWhatsApp(val);
        customInput.value = '';
      }
    });
  }

  document.addEventListener('click', (e) => {
    if (!card.contains(e.target) && !launcher.contains(e.target) && !card.classList.contains('hidden')) {
      toggleAgent();
    }
  });
}
