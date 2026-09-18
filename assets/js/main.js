/**
 * Tirumala IIT & Medical Academy
 * Core JavaScript: Navigation, iOS Glassmorphic Dock, Spotlight Search, Language Toggle
 */

document.addEventListener('DOMContentLoaded', () => {
  initStickyHeader();
  initMobileMenu();
  initLanguageToggle();
  initNoticeBanner();
  initWhatsAppAgent();
  initScrollDock();
  initSpotlightSearch();
  initHelplineToggle();
});

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

  // Close drawer on link click
  drawer.querySelectorAll('a').forEach(link => {
    link.addEventListener('click', () => {
      closeDrawer();
    });
  });

  // Close on Escape key
  document.addEventListener('keydown', (e) => {
    if (e.key === 'Escape') closeDrawer();
  });
}

// 3. iOS Floating Bottom Dock (Auto-Hide on Scroll, Reappear on Stop)
function initScrollDock() {
  const dock = document.getElementById('ios-bottom-dock');
  if (!dock) return;

  let isScrolling = false;
  let scrollTimeout = null;
  let lastScrollY = window.scrollY;

  window.addEventListener('scroll', () => {
    const currentScrollY = window.scrollY;
    
    // If scrolling down by more than 8px, hide the dock
    if (currentScrollY > lastScrollY + 8 && currentScrollY > 60) {
      dock.classList.add('dock-hidden');
    } else if (currentScrollY < lastScrollY - 12) {
      // If scrolling up, show dock immediately
      dock.classList.remove('dock-hidden');
    }

    lastScrollY = currentScrollY;

    // Clear timeout while active scrolling
    clearTimeout(scrollTimeout);

    // When scrolling stops (after 220ms of no scroll events), show the dock
    scrollTimeout = setTimeout(() => {
      dock.classList.remove('dock-hidden');
    }, 240);
  }, { passive: true });
}

// 4. Spotlight Live Search Modal for Students & Parents
function initSpotlightSearch() {
  const modal = document.getElementById('spotlight-modal');
  const openBtns = document.querySelectorAll('.search-trigger-btn, #ios-search-btn');
  const closeBtn = document.getElementById('spotlight-close-btn');
  const searchInput = document.getElementById('spotlight-input');
  const resultsContainer = document.getElementById('spotlight-results');

  if (!modal || !searchInput) return;

  // Search Knowledge Database
  const searchIndex = [
    { title: "K. Sai Teja - AIR 142 (Top in AP)", category: "Student Result", sub: "Roll No: TIMA202401 • JEE Advanced 2024", url: "/results.php?search=TIMA202401", icon: "trophy" },
    { title: "V. Sravani - NEET 695/720 (AIR 218)", category: "Student Result", sub: "Roll No: TIMA202402 • Medical Stream", url: "/results.php?search=TIMA202402", icon: "trophy" },
    { title: "P. Rohan Kumar - 99.94 Percentile", category: "Student Result", sub: "Roll No: TIMA202403 • JEE Main 2024", url: "/results.php?search=TIMA202403", icon: "trophy" },
    { title: "M. Harshitha - 992/1000 State Rank 4", category: "Student Result", sub: "Roll No: TIMA202404 • IPE Inter BiPC", url: "/results.php?search=TIMA202404", icon: "trophy" },
    { title: "B. Lokesh - 594/600 (GPA 10.0)", category: "Student Result", sub: "Roll No: TIMA202405 • Class 10 SSC", url: "/results.php?search=TIMA202405", icon: "trophy" },
    { title: "Class 6 Entrance Model Paper", category: "Model Papers", sub: "PDF Download • CBSE & State Board", url: "/model-papers.php", icon: "doc" },
    { title: "Class 7 & 8 Olympiad / Entrance Papers", category: "Model Papers", sub: "PDF Download • ICSE & CBSE", url: "/model-papers.php", icon: "doc" },
    { title: "Class 9 & 10 IIT-JEE/NEET Foundation", category: "Model Papers", sub: "PDF Download • Full syllabus", url: "/model-papers.php", icon: "doc" },
    { title: "Intermediate MPC / BiPC Entrance Papers", category: "Model Papers", sub: "PDF Download • Board & Entrance", url: "/model-papers.php", icon: "doc" },
    { title: "Student Fee Portal (Onesaz)", category: "Online Services", sub: "Pay term fees & view receipt online", url: "https://tirumala.onesaz.com/sign-in", external: true, icon: "portal" },
    { title: "Apply for 2025-26 Admission", category: "Admissions", sub: "Schools & Junior Colleges Admission Form", url: "/admissions.php", icon: "portal" },
    { title: "Rajamahendravaram Campus (HQ)", category: "Campuses", sub: "Katheru Main Campus, Rajahmundry", url: "https://www.google.com/maps/search/?api=1&query=Tirumala+IIT+Academy+Katheru+Rajahmundry", external: true, icon: "map" },
    { title: "Visakhapatnam Campus (Vizag)", category: "Campuses", sub: "Maddilapalem / MVP Colony", url: "https://www.google.com/maps/search/?api=1&query=Tirumala+Junior+College+Maddilapalem+Visakhapatnam", external: true, icon: "map" },
    { title: "Bhimavaram Campus", category: "Campuses", sub: "PP Road School & Junior College", url: "https://www.google.com/maps/search/?api=1&query=Tirumala+School+PP+Road+Bhimavaram", external: true, icon: "map" },
    { title: "Tanuku Campus", category: "Campuses", sub: "Near Overbridge, Academic Center", url: "https://www.google.com/maps/search/?api=1&query=Tirumala+Junior+College+Tanuku", external: true, icon: "map" },
    { title: "Payakaraopeta Campus", category: "Campuses", sub: "National Highway Residential Campus", url: "https://www.google.com/maps/search/?api=1&query=Tirumala+Academy+Payakaraopeta", external: true, icon: "map" },
    { title: "Central Admissions Helpline: 0883 297 0077", category: "Helpline", sub: "Call directly for admission counseling", url: "tel:08832970077", icon: "phone" }
  ];

  function openSearch() {
    modal.classList.add('active');
    document.body.style.overflow = 'hidden';
    setTimeout(() => searchInput.focus(), 80);
    renderResults('');
  }

  function closeSearch() {
    modal.classList.remove('active');
    document.body.style.overflow = '';
    searchInput.value = '';
  }

  openBtns.forEach(btn => {
    btn.addEventListener('click', (e) => {
      e.preventDefault();
      openSearch();
    });
  });

  if (closeBtn) closeBtn.addEventListener('click', closeSearch);

  modal.addEventListener('click', (e) => {
    if (e.target === modal) closeSearch();
  });

  document.addEventListener('keydown', (e) => {
    if ((e.metaKey || e.ctrlKey) && e.key === 'k') {
      e.preventDefault();
      if (modal.classList.contains('active')) closeSearch();
      else openSearch();
    }
    if (e.key === 'Escape' && modal.classList.contains('active')) {
      closeSearch();
    }
  });

  function getIconSvg(type) {
    if (type === 'trophy') {
      return `<svg class="w-4 h-4 text-amber-500" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>`;
    } else if (type === 'map') {
      return `<svg class="w-4 h-4 text-blue-600" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/></svg>`;
    } else if (type === 'phone') {
      return `<svg class="w-4 h-4 text-emerald-600" fill="currentColor" viewBox="0 0 20 20"><path d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 4V3z"/></svg>`;
    } else if (type === 'doc') {
      return `<svg class="w-4 h-4 text-rose-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4zm2 6a1 1 0 011-1h6a1 1 0 110 2H7a1 1 0 01-1-1zm1 3a1 1 0 100 2h6a1 1 0 100-2H7z" clip-rule="evenodd"/></svg>`;
    }
    return `<svg class="w-4 h-4 text-slate-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-11a1 1 0 10-2 0v2H7a1 1 0 100 2h2v2a1 1 0 102 0v-2h2a1 1 0 100-2h-2V7z" clip-rule="evenodd"/></svg>`;
  }

  function renderResults(q) {
    const query = q.trim().toLowerCase();
    let matches = searchIndex;
    if (query) {
      matches = searchIndex.filter(item => 
        item.title.toLowerCase().includes(query) || 
        item.category.toLowerCase().includes(query) || 
        item.sub.toLowerCase().includes(query)
      );
    }

    if (matches.length === 0) {
      resultsContainer.innerHTML = `
        <div class="py-8 text-center text-slate-500 text-sm">
          <p class="font-medium">No direct results found for "${escapeHtml(q)}"</p>
          <p class="text-xs text-slate-400 mt-1">Try searching "Sai Teja", "NEET", "Model Papers", "Fee", or "Vizag"</p>
        </div>
      `;
      return;
    }

    resultsContainer.innerHTML = matches.slice(0, 7).map(item => `
      <a href="${item.url}" ${item.external ? 'target="_blank" rel="noopener noreferrer"' : ''} class="flex items-center justify-between p-3 rounded-xl hover:bg-slate-100 transition group">
        <div class="flex items-center gap-3">
          <div class="w-8 h-8 rounded-lg bg-slate-100 flex items-center justify-center group-hover:bg-white group-hover:shadow-sm transition">
            ${getIconSvg(item.icon)}
          </div>
          <div>
            <div class="text-sm font-semibold text-slate-800 group-hover:text-blue-700 transition">${escapeHtml(item.title)}</div>
            <div class="text-xs text-slate-400">${escapeHtml(item.sub)}</div>
          </div>
        </div>
        <span class="text-[10px] font-bold uppercase tracking-wider px-2 py-0.5 rounded bg-slate-200/60 text-slate-600">${escapeHtml(item.category)}</span>
      </a>
    `).join('');
  }

  searchInput.addEventListener('input', (e) => {
    renderResults(e.target.value);
  });
}

function escapeHtml(str) {
  return String(str).replace(/[&<>"']/g, m => ({ '&': '&amp;', '<': '&lt;', '>': '&gt;', '"': '&quot;', "'": '&#39;' })[m]);
}

// 5. Floating Helpline Side Toggle
function initHelplineToggle() {
  const toggleBtn = document.getElementById('helpline-toggle-btn');
  const popup = document.getElementById('helpline-popup');
  if (!toggleBtn || !popup) return;

  toggleBtn.addEventListener('click', (e) => {
    e.stopPropagation();
    popup.classList.toggle('hidden');
  });

  document.addEventListener('click', (e) => {
    if (!popup.contains(e.target) && !toggleBtn.contains(e.target)) {
      popup.classList.add('hidden');
    }
  });
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
