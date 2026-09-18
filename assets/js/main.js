/**
 * Tirumala IIT & Medical Academy
 * Core JavaScript: Navigation, Mobile Menu, Bilingual Language Toggle (EN/TE)
 */

document.addEventListener('DOMContentLoaded', () => {
  initStickyHeader();
  initMobileMenu();
  initLanguageToggle();
  initNoticeBanner();
  initWhatsAppAgent();
});

// 1. Sticky Header Shadow on Scroll
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

// 2. Mobile Drawer Navigation
function initMobileMenu() {
  const toggleBtn = document.getElementById('mobile-menu-btn');
  const closeBtn = document.getElementById('mobile-menu-close');
  const drawer = document.getElementById('mobile-drawer');
  const backdrop = document.getElementById('mobile-backdrop');

  if (!toggleBtn || !drawer) return;

  function openDrawer() {
    drawer.classList.remove('translate-x-full');
    drawer.classList.add('translate-x-0');
    if (backdrop) backdrop.classList.remove('hidden');
    document.body.style.overflow = 'hidden';
  }

  function closeDrawer() {
    drawer.classList.add('translate-x-full');
    drawer.classList.remove('translate-x-0');
    if (backdrop) backdrop.classList.add('hidden');
    document.body.style.overflow = '';
  }

  toggleBtn.addEventListener('click', openDrawer);
  if (closeBtn) closeBtn.addEventListener('click', closeDrawer);
  if (backdrop) backdrop.addEventListener('click', closeDrawer);

  // Close on Escape
  document.addEventListener('keydown', (e) => {
    if (e.key === 'Escape') closeDrawer();
  });
}

// 3. Bilingual Language Toggle (English / Telugu)
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
    nav_games: "Games",
    nav_papers: "Model Papers",
    nav_contact: "Contact",
    nav_admissions: "Admissions",
    nav_pay_fee: "Pay Fee (Portal)",
    hero_badge: "Admissions Open 2025-26",
    hero_title: "Empowering Students for IIT-JEE, NEET & Academic Mastery",
    hero_desc: "South India's premier educational group with 9 schools and 17 junior colleges across Andhra Pradesh, guiding 42,600+ students towards nation-leading ranks.",
    cta_enquire: "Apply for Admission",
    cta_explore: "Explore Results",
    trust_students: "Students Enrolled",
    trust_schools: "Schools across AP",
    trust_colleges: "Junior Colleges",
    trust_years: "Years of Trust (Est. 2011)",
    footer_tagline: "Dedicated to student welfare, academic rigor, and nation-building values since 2011.",
    enquiry_heading: "Admissions Enquiry 2025-26",
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

    // Update button states
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

  // Apply saved preference on page load
  applyLanguage(currentLang);
}

// 4. Dismissible Announcement Bar
function initNoticeBanner() {
  const banner = document.getElementById('top-notice-banner');
  const dismissBtn = document.getElementById('dismiss-notice-btn');
  if (!banner || !dismissBtn) return;

  dismissBtn.addEventListener('click', () => {
    banner.style.display = 'none';
  });
}

// 5. Interactive WhatsApp Admissions Agent
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

  // Close when clicking outside
  document.addEventListener('click', (e) => {
    if (!card.contains(e.target) && !launcher.contains(e.target) && !card.classList.contains('hidden')) {
      toggleAgent();
    }
  });
}
