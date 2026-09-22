<?php
/**
 * Shared Footer Component
 * Tirumala IIT & Medical Academy
 */
?>
  </main>
  <!-- MAIN PAGE CONTENT ENDS -->

  <!-- ==========================================================
       iOS GLOSSY FLOATING BOTTOM DOCK (Mobile Navigation Bar)
       ========================================================== -->
  <div id="ios-bottom-dock" class="ios-bottom-bar-container lg:hidden">
    <!-- Main Capsule Island -->
    <nav class="ios-dock-capsule" aria-label="Quick Mobile Navigation">
      <a href="/index.php" class="ios-dock-item <?php echo (!isset($currentNav) || $currentNav === 'home') ? 'active' : ''; ?>">
        <svg fill="currentColor" viewBox="0 0 20 20"><path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"/></svg>
        <span>Home</span>
      </a>

      <a href="/results.php" class="ios-dock-item <?php echo (isset($currentNav) && $currentNav === 'results') ? 'active' : ''; ?>">
        <svg fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
        <span>Results</span>
      </a>

      <a href="/contact.php#campuses" class="ios-dock-item <?php echo (isset($currentNav) && $currentNav === 'contact') ? 'active' : ''; ?>">
        <svg fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/></svg>
        <span>Campuses</span>
      </a>

      <!-- Campus Call Selector Trigger -->
      <button type="button" class="campus-call-trigger ios-dock-item text-emerald-600 hover:text-emerald-700" aria-label="Choose Campus to Call">
        <svg fill="currentColor" viewBox="0 0 20 20"><path d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 4V3z"/></svg>
        <span>Call</span>
      </button>
    </nav>

    <!-- Circular Floating Search Button (Apple Music Style) -->
    <button type="button" id="ios-search-btn" class="ios-search-circle search-trigger-btn" aria-label="Open Instant Search">
      <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
    </button>
  </div>

  <!-- ==========================================================
       SPOTLIGHT UNIVERSAL LIVE SEARCH MODAL
       ========================================================== -->
  <div id="spotlight-modal" role="dialog" aria-modal="true" aria-labelledby="spotlight-title">
    <div class="spotlight-card">
      
      <!-- Search Input Bar -->
      <div class="p-4 border-b border-slate-200/80 flex items-center gap-3 bg-slate-50/50">
        <svg class="w-5 h-5 text-blue-600 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
        <input type="text" id="spotlight-input" placeholder="Search any ranker, course, campus, paper, hostel, fee portal..." class="w-full bg-transparent text-sm text-slate-800 placeholder-slate-400 outline-none">
        <button type="button" id="spotlight-clear-btn" class="hidden p-1 text-slate-400 hover:text-slate-600 transition" aria-label="Clear Search">&times;</button>
        <button type="button" id="spotlight-close-btn" class="p-1.5 rounded-lg text-slate-400 hover:text-slate-700 hover:bg-slate-200 transition" aria-label="Close search">
          <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
        </button>
      </div>

      <!-- Category Filter Pills -->
      <div class="px-4 py-2 bg-white border-b border-slate-100 flex items-center gap-1.5 overflow-x-auto text-[11px] font-semibold text-slate-600 scrollbar-none">
        <button type="button" class="search-cat-pill px-2.5 py-1 rounded-full whitespace-nowrap transition bg-blue-700 text-white shadow-xs" data-cat="all">All Results</button>
        <button type="button" class="search-cat-pill px-2.5 py-1 rounded-full whitespace-nowrap transition bg-slate-100 hover:bg-slate-200 text-slate-700" data-cat="students">Rankers & Students</button>
        <button type="button" class="search-cat-pill px-2.5 py-1 rounded-full whitespace-nowrap transition bg-slate-100 hover:bg-slate-200 text-slate-700" data-cat="campuses">Campuses</button>
        <button type="button" class="search-cat-pill px-2.5 py-1 rounded-full whitespace-nowrap transition bg-slate-100 hover:bg-slate-200 text-slate-700" data-cat="courses">Courses & IIT/NEET</button>
        <button type="button" class="search-cat-pill px-2.5 py-1 rounded-full whitespace-nowrap transition bg-slate-100 hover:bg-slate-200 text-slate-700" data-cat="facilities">Facilities</button>
        <button type="button" class="search-cat-pill px-2.5 py-1 rounded-full whitespace-nowrap transition bg-slate-100 hover:bg-slate-200 text-slate-700" data-cat="papers">Model Papers (PDF)</button>
        <button type="button" class="search-cat-pill px-2.5 py-1 rounded-full whitespace-nowrap transition bg-slate-100 hover:bg-slate-200 text-slate-700" data-cat="portals">Portals & Links</button>
      </div>

      <!-- Live Search Results Container -->
      <div id="spotlight-results" class="p-3 max-h-80 overflow-y-auto space-y-1">
        <!-- Filled dynamically by main.js -->
      </div>

      <!-- Spotlight Bottom Status & Keyboard Hint -->
      <div class="px-4 py-2.5 bg-slate-50 border-t border-slate-100 flex items-center justify-between text-[11px] text-slate-400">
        <span id="spotlight-count-text">Type to search anything across Tirumala Academy</span>
        <span class="hidden sm:inline">Press <kbd class="bg-white px-1.5 py-0.5 rounded border border-slate-200 text-slate-500 font-mono">ESC</kbd> to exit</span>
      </div>

    </div>
  </div>

  <!-- ==========================================================
       CAMPUS CALL SELECTOR MODAL (Multi-Campus Direct Dial)
       ========================================================== -->
  <div id="campus-call-modal" role="dialog" aria-modal="true" aria-labelledby="campus-modal-title">
    <div class="campus-call-card">
      
      <!-- Modal Header -->
      <div class="p-4 sm:p-5 border-b border-slate-200/80 bg-slate-50/80 flex items-center justify-between">
        <div class="flex items-center gap-3">
          <div class="w-10 h-10 rounded-xl bg-emerald-500/10 text-emerald-600 flex items-center justify-center flex-shrink-0 border border-emerald-500/20">
            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 4V3z"/></svg>
          </div>
          <div>
            <h3 id="campus-modal-title" class="text-base sm:text-lg font-bold text-slate-900 leading-tight">Connect with Tirumala Campuses</h3>
            <p class="text-xs text-slate-500">Select which campus you want to call directly</p>
          </div>
        </div>
        <button type="button" id="campus-call-close-btn" class="w-8 h-8 rounded-full bg-slate-200/70 hover:bg-slate-300 text-slate-600 flex items-center justify-center transition" aria-label="Close dialog">
          <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
        </button>
      </div>

      <!-- Campus List -->
      <div class="p-4 space-y-2.5 max-h-[68vh] overflow-y-auto">
        
        <!-- 1. Rajamahendravaram -->
        <div class="campus-option-item p-3 sm:p-3.5 rounded-xl bg-slate-50 flex items-center justify-between gap-3">
          <div>
            <div class="flex items-center gap-2">
              <span class="font-bold text-slate-900 text-sm">1. Rajamahendravaram</span>
              <span class="text-[10px] font-bold px-2 py-0.5 rounded bg-amber-100 text-amber-800 uppercase">Central HQ</span>
            </div>
            <p class="text-xs text-slate-500 mt-0.5">Katheru Main Campus • Jr. Colleges & Schools</p>
            <p class="text-xs font-mono font-bold text-emerald-600 mt-0.5">0883 297 0077</p>
          </div>
          <a href="tel:08832970077" class="bg-emerald-600 hover:bg-emerald-700 text-white font-bold px-3 py-2 rounded-lg text-xs flex items-center gap-1.5 shadow-sm transition flex-shrink-0">
            <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 20 20"><path d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 4V3z"/></svg>
            <span>Call Now</span>
          </a>
        </div>

        <!-- 2. Visakhapatnam -->
        <div class="campus-option-item p-3 sm:p-3.5 rounded-xl bg-slate-50 flex items-center justify-between gap-3">
          <div>
            <div class="flex items-center gap-2">
              <span class="font-bold text-slate-900 text-sm">2. Visakhapatnam (Vizag)</span>
              <span class="text-[10px] font-bold px-2 py-0.5 rounded bg-blue-100 text-blue-800 uppercase">Port Hub</span>
            </div>
            <p class="text-xs text-slate-500 mt-0.5">Maddilapalem & MVP Colony Main Road</p>
            <p class="text-xs font-mono font-bold text-emerald-600 mt-0.5">0891 278 4077</p>
          </div>
          <a href="tel:08912784077" class="bg-emerald-600 hover:bg-emerald-700 text-white font-bold px-3 py-2 rounded-lg text-xs flex items-center gap-1.5 shadow-sm transition flex-shrink-0">
            <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 20 20"><path d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 4V3z"/></svg>
            <span>Call Now</span>
          </a>
        </div>

        <!-- 3. Bhimavaram -->
        <div class="campus-option-item p-3 sm:p-3.5 rounded-xl bg-slate-50 flex items-center justify-between gap-3">
          <div>
            <div class="flex items-center gap-2">
              <span class="font-bold text-slate-900 text-sm">3. Bhimavaram</span>
              <span class="text-[10px] font-bold px-2 py-0.5 rounded bg-emerald-100 text-emerald-800 uppercase">Delta Wing</span>
            </div>
            <p class="text-xs text-slate-500 mt-0.5">PP Road Campus Near Sompeta Junction</p>
            <p class="text-xs font-mono font-bold text-emerald-600 mt-0.5">08816 225 077</p>
          </div>
          <a href="tel:08816225077" class="bg-emerald-600 hover:bg-emerald-700 text-white font-bold px-3 py-2 rounded-lg text-xs flex items-center gap-1.5 shadow-sm transition flex-shrink-0">
            <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 20 20"><path d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 4V3z"/></svg>
            <span>Call Now</span>
          </a>
        </div>

        <!-- 4. Tanuku -->
        <div class="campus-option-item p-3 sm:p-3.5 rounded-xl bg-slate-50 flex items-center justify-between gap-3">
          <div>
            <div class="flex items-center gap-2">
              <span class="font-bold text-slate-900 text-sm">4. Tanuku</span>
              <span class="text-[10px] font-bold px-2 py-0.5 rounded bg-purple-100 text-purple-800 uppercase">Academic Wing</span>
            </div>
            <p class="text-xs text-slate-500 mt-0.5">Bypass Road Near Overbridge Center</p>
            <p class="text-xs font-mono font-bold text-emerald-600 mt-0.5">08819 245 077</p>
          </div>
          <a href="tel:08819245077" class="bg-emerald-600 hover:bg-emerald-700 text-white font-bold px-3 py-2 rounded-lg text-xs flex items-center gap-1.5 shadow-sm transition flex-shrink-0">
            <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 20 20"><path d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 4V3z"/></svg>
            <span>Call Now</span>
          </a>
        </div>

        <!-- 5. Payakaraopeta -->
        <div class="campus-option-item p-3 sm:p-3.5 rounded-xl bg-slate-50 flex items-center justify-between gap-3">
          <div>
            <div class="flex items-center gap-2">
              <span class="font-bold text-slate-900 text-sm">5. Payakaraopeta</span>
              <span class="text-[10px] font-bold px-2 py-0.5 rounded bg-rose-100 text-rose-800 uppercase">Residential</span>
            </div>
            <p class="text-xs text-slate-500 mt-0.5">National Highway 16 Campus</p>
            <p class="text-xs font-mono font-bold text-emerald-600 mt-0.5">08932 233 077</p>
          </div>
          <a href="tel:08932233077" class="bg-emerald-600 hover:bg-emerald-700 text-white font-bold px-3 py-2 rounded-lg text-xs flex items-center gap-1.5 shadow-sm transition flex-shrink-0">
            <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 20 20"><path d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 4V3z"/></svg>
            <span>Call Now</span>
          </a>
        </div>

      </div>

      <!-- Modal Footer WhatsApp Link -->
      <div class="p-4 bg-slate-100/70 border-t border-slate-200/80 flex items-center justify-between text-xs">
        <span class="text-slate-500">Need instant chat counseling?</span>
        <a href="https://wa.me/<?php echo INSTITUTE_WHATSAPP; ?>" target="_blank" rel="noopener noreferrer" class="inline-flex items-center gap-1.5 font-bold text-emerald-700 hover:text-emerald-800 hover:underline">
          <svg class="w-4 h-4 text-emerald-600" fill="currentColor" viewBox="0 0 24 24"><path d="M12.031 6.172c-3.181 0-5.767 2.586-5.768 5.766-.001 1.298.38 2.27 1.019 3.287l-.711 2.598 2.664-.698c.969.587 1.771.865 2.796.865 3.181 0 5.767-2.587 5.768-5.766.001-3.18-2.585-5.652-5.768-5.652zm0 10.362c-.894 0-1.636-.25-2.348-.68l-.168-.101-1.748.458.467-1.704-.112-.178c-.469-.747-.716-1.503-.715-2.39.001-2.531 2.059-4.59 4.616-4.59 2.556 0 4.615 2.059 4.616 4.59-.001 2.531-2.06 4.595-4.616 4.595z"/></svg>
          <span>Chat on WhatsApp</span>
        </a>
      </div>

    </div>
  </div>

  <!-- ==========================================================
       FLOATING HELPLINE TOGGLE WIDGET (Multi-Campus Direct Dial Support)
       ========================================================== -->
  <div class="helpline-side-toggle flex flex-col items-end">
    <!-- Toggle Button opens the Campus Call Selector -->
    <button type="button" id="helpline-toggle-btn" class="campus-call-trigger flex items-center gap-2 bg-blue-700 hover:bg-blue-800 text-white p-3 sm:px-3.5 sm:py-2.5 rounded-full shadow-xl transition-all duration-300 transform hover:scale-105 border border-blue-500/50" aria-label="Call Tirumala Campuses">
      <div class="relative">
        <svg class="w-5 h-5 text-amber-300 fill-current" viewBox="0 0 20 20"><path d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 4V3z"/></svg>
        <span class="absolute -top-1 -right-1 w-2.5 h-2.5 bg-amber-400 rounded-full animate-ping"></span>
      </div>
      <span class="hidden sm:inline text-xs font-bold tracking-wide">Call Campuses</span>
    </button>
  </div>

  <!-- ==========================================================
       INTERACTIVE WHATSAPP COUNSELING AGENT
       ========================================================== -->
  <div id="whatsapp-agent-container" class="whatsapp-float flex flex-col items-end">
    
    <!-- WhatsApp Agent Card -->
    <div id="whatsapp-agent-card" class="hidden mb-3 w-[320px] sm:w-[360px] bg-white rounded-2xl shadow-2xl border border-slate-200 overflow-hidden transition-all duration-300 origin-bottom-right">
      <div class="bg-gradient-to-r from-emerald-600 via-teal-600 to-emerald-700 p-4 text-white flex items-center justify-between shadow-sm">
        <div class="flex items-center gap-3">
          <div class="relative">
            <img src="/assets/images/round_logo.png" alt="Counselor Avatar" class="w-10 h-10 rounded-full bg-white p-0.5 border-2 border-white shadow">
            <span class="absolute bottom-0 right-0 w-3 h-3 bg-emerald-400 border-2 border-white rounded-full"></span>
          </div>
          <div>
            <div class="flex items-center gap-1.5">
              <h4 class="text-sm font-bold leading-tight text-white">Admissions Assistant</h4>
              <span class="bg-emerald-500/80 text-[9px] px-1.5 py-0.2 rounded font-bold uppercase tracking-wider">Online</span>
            </div>
            <p class="text-[11px] text-emerald-100 flex items-center gap-1 mt-0.5">
              <span class="w-1.5 h-1.5 bg-emerald-300 rounded-full animate-pulse"></span>
              Tirumala Academy • Official WhatsApp Desk
            </p>
          </div>
        </div>
        <button id="whatsapp-agent-close" class="text-white/80 hover:text-white p-1 rounded-lg hover:bg-white/10 transition" aria-label="Close WhatsApp Agent">
          <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
        </button>
      </div>

      <div class="p-4 bg-slate-50 space-y-3 max-h-80 overflow-y-auto">
        <div class="flex items-start gap-2.5">
          <div class="w-7 h-7 rounded-full bg-emerald-600 text-white flex items-center justify-center text-xs font-bold flex-shrink-0 shadow-sm">T</div>
          <div class="bg-white p-3 rounded-2xl rounded-tl-none shadow-sm border border-slate-200 text-xs text-slate-700 leading-relaxed">
            <p class="font-bold text-slate-900 mb-1">Namaste! 🙏</p>
            Welcome to <strong>Tirumala IIT & Medical Academy</strong>. How can our admissions counselor help you today?
          </div>
        </div>

        <div class="space-y-1.5 pl-9">
          <button type="button" class="wa-preset-btn w-full text-left bg-white hover:bg-emerald-50 hover:text-emerald-700 border border-slate-200 hover:border-emerald-300 rounded-lg px-3 py-2 text-xs font-semibold text-slate-700 transition flex items-center justify-between shadow-xs" data-query="Hello, I want details regarding IIT-JEE & NEET Admissions for 2025-26.">
            <span>📚 Course & Fee Details 2025-26</span>
            <span class="text-emerald-500">→</span>
          </button>
          <button type="button" class="wa-preset-btn w-full text-left bg-white hover:bg-emerald-50 hover:text-emerald-700 border border-slate-200 hover:border-emerald-300 rounded-lg px-3 py-2 text-xs font-semibold text-slate-700 transition flex items-center justify-between shadow-xs" data-query="Hello, please provide details regarding Hostel and Transport facilities.">
            <span>🏢 A/C Hostel & Bus Transport</span>
            <span class="text-emerald-500">→</span>
          </button>
          <button type="button" class="wa-preset-btn w-full text-left bg-white hover:bg-emerald-50 hover:text-emerald-700 border border-slate-200 hover:border-emerald-300 rounded-lg px-3 py-2 text-xs font-semibold text-slate-700 transition flex items-center justify-between shadow-xs" data-query="Hello, I would like to visit the Rajamahendravaram Katheru Main Campus.">
            <span>📍 Campus Visit & Counseling</span>
            <span class="text-emerald-500">→</span>
          </button>
        </div>
      </div>

      <div class="p-3 bg-white border-t border-slate-200">
        <form id="wa-custom-form" class="flex items-center gap-2">
          <input type="text" id="wa-custom-msg" placeholder="Type your inquiry or student class..." class="flex-1 text-xs border border-slate-300 rounded-lg px-3 py-2.5 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 outline-none">
          <button type="submit" class="bg-emerald-600 hover:bg-emerald-700 text-white p-2.5 rounded-lg transition shadow flex-shrink-0" aria-label="Send WhatsApp Message">
            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path d="M10.894 2.553a1 1 0 00-1.788 0l-7 14a1 1 0 001.169 1.409l5-1.429A1 1 0 009 15.571V11a1 1 0 112 0v4.571a1 1 0 00.725.962l5 1.428a1 1 0 001.17-1.408l-7-14z"/></svg>
          </button>
        </form>
      </div>
    </div>

    <!-- WhatsApp Launcher Button -->
    <button id="whatsapp-agent-launcher" class="group flex items-center gap-2.5 bg-[#25D366] hover:bg-[#20ba5a] text-white p-3 sm:px-4 sm:py-3 rounded-full shadow-2xl transition-all duration-300 transform hover:scale-105" aria-label="Open Tirumala WhatsApp Admissions Agent">
      <div class="relative">
        <svg class="w-6 h-6 fill-current" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372s-1.04 1.016-1.04 2.479 1.065 2.876 1.213 3.074c.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z"/></svg>
        <span class="absolute -top-1 -right-1 w-2.5 h-2.5 bg-emerald-300 rounded-full animate-ping"></span>
      </div>
      <div class="hidden sm:flex flex-col text-left">
        <span class="text-xs font-bold leading-none">WhatsApp Agent</span>
        <span class="text-[10px] text-white/90 leading-tight">Admissions Help 🟢</span>
      </div>
    </button>
  </div>

  <!-- ==========================================================
       PROFESSIONAL COLLEGIATE INSTITUTIONAL FOOTER
       ========================================================== -->
  <footer class="bg-gradient-to-b from-[#071533] via-[#091b42] to-[#040c1e] text-slate-300 pt-16 pb-14 border-t-2 border-amber-500/40 relative overflow-hidden">
    
    <!-- Subtle Architectural Background Pattern -->
    <div class="absolute inset-0 opacity-5 bg-[radial-gradient(#ffffff_1px,transparent_1px)] [background-size:24px_24px] pointer-events-none"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
      
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-10 pb-12 border-b border-slate-800/90">
        
        <!-- Col 1: Institutional Heritage & Accreditation -->
        <div class="space-y-4">
          <div class="flex items-center gap-3">
            <img src="/assets/images/round_logo.png" alt="Tirumala Academy Crest" width="52" height="52" class="w-13 h-13 object-contain bg-white rounded-2xl p-1.5 shadow-md">
            <div>
              <span class="block text-xl font-black text-white tracking-tight leading-tight">TIRUMALA</span>
              <span class="text-xs text-amber-400 font-bold uppercase tracking-wider">IIT & Medical Academy</span>
            </div>
          </div>
          <p class="text-xs leading-relaxed text-slate-300" data-i18n="footer_tagline">
            Founded in 2011, Tirumala IIT & Medical Academy is Andhra Pradesh's premier educational group with 9 schools and 17 junior colleges dedicated to individual mentorship and nation-leading ranks.
          </p>
          <div class="pt-2 flex flex-wrap items-center gap-2 text-xs">
            <span class="bg-white/10 text-amber-300 font-bold px-3 py-1 rounded-lg border border-white/10 backdrop-blur-sm">42,600+ Students</span>
            <span class="bg-white/10 text-emerald-300 font-bold px-3 py-1 rounded-lg border border-white/10 backdrop-blur-sm">9 Schools • 17 Colleges</span>
          </div>
          <p class="text-[11px] text-slate-400">Recognized by Board of Intermediate Education, AP & School Education Dept.</p>
        </div>

        <!-- Col 2: Academic Portals & Quick Links -->
        <div>
          <h3 class="text-sm font-bold text-white uppercase tracking-wider mb-4 pb-1.5 border-b border-slate-800 flex items-center gap-2">
            <span class="w-2 h-2 rounded-full bg-blue-500"></span>
            <span>Academic Portals</span>
          </h3>
          <ul class="space-y-2 text-xs">
            <li><a href="/index.php" class="hover:text-amber-400 transition flex items-center gap-2 py-0.5"><span class="text-slate-500">›</span> Home & Welcome</a></li>
            <li><a href="/about.php" class="hover:text-amber-400 transition flex items-center gap-2 py-0.5"><span class="text-slate-500">›</span> Leadership & Vision</a></li>
            <li><a href="/results.php" class="hover:text-amber-400 transition flex items-center gap-2 py-0.5"><span class="text-slate-500">›</span> Outstanding Results & Ranks</a></li>
            <li><a href="/facilities/hostel.php" class="hover:text-amber-400 transition flex items-center gap-2 py-0.5"><span class="text-slate-500">›</span> A/C Hostel & Facilities</a></li>
            <li><a href="/model-papers.php" class="hover:text-amber-400 transition flex items-center gap-2 py-0.5"><span class="text-slate-500">›</span> Model Question Papers (PDF)</a></li>
            <li><a href="/gallery.php" class="hover:text-amber-400 transition flex items-center gap-2 py-0.5"><span class="text-slate-500">›</span> Campus Gallery & Awards</a></li>
            <li><a href="/admissions.php" class="text-amber-400 font-bold hover:underline flex items-center gap-2 py-0.5"><span class="text-amber-400">›</span> Admissions 2025-26 Open</a></li>
            <li><a href="<?php echo FEE_PORTAL_URL; ?>" target="_blank" rel="noopener noreferrer" class="text-emerald-400 font-bold hover:underline flex items-center gap-2 py-0.5"><span class="text-emerald-400">›</span> Student Fee Portal (Onesaz) ↗</a></li>
          </ul>
        </div>

        <!-- Col 3: Verified AP Campuses (With Google Maps Integration) -->
        <div>
          <h3 class="text-sm font-bold text-white uppercase tracking-wider mb-4 pb-1.5 border-b border-slate-800 flex items-center gap-2">
            <span class="w-2 h-2 rounded-full bg-amber-400"></span>
            <span>Our AP Campuses</span>
          </h3>
          <ul class="space-y-3 text-xs">
            <li>
              <a href="https://www.google.com/maps/search/?api=1&query=Tirumala+IIT+Academy+Katheru+Rajahmundry" target="_blank" rel="noopener noreferrer" class="group block p-2 rounded-xl bg-white/5 hover:bg-white/10 border border-white/5 hover:border-white/20 transition">
                <div class="flex items-center justify-between">
                  <div class="flex items-center gap-2">
                    <svg class="w-3.5 h-3.5 text-amber-400 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/></svg>
                    <span class="font-bold text-white group-hover:text-amber-400 transition">Rajamahendravaram (HQ)</span>
                  </div>
                  <span class="text-[10px] text-slate-400 group-hover:text-white">Maps ↗</span>
                </div>
                <p class="text-[11px] text-slate-400 mt-0.5 pl-5">Katheru Main Campus, Rajahmundry 533102</p>
              </a>
            </li>

            <li>
              <a href="https://www.google.com/maps/search/?api=1&query=Tirumala+Junior+College+Maddilapalem+Visakhapatnam" target="_blank" rel="noopener noreferrer" class="group block p-2 rounded-xl bg-white/5 hover:bg-white/10 border border-white/5 hover:border-white/20 transition">
                <div class="flex items-center justify-between">
                  <div class="flex items-center gap-2">
                    <svg class="w-3.5 h-3.5 text-blue-400 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/></svg>
                    <span class="font-bold text-white group-hover:text-blue-400 transition">Visakhapatnam Campus</span>
                  </div>
                  <span class="text-[10px] text-slate-400 group-hover:text-white">Maps ↗</span>
                </div>
                <p class="text-[11px] text-slate-400 mt-0.5 pl-5">Maddilapalem & MVP Colony, Vizag</p>
              </a>
            </li>

            <li>
              <a href="https://www.google.com/maps/search/?api=1&query=Tirumala+School+PP+Road+Bhimavaram" target="_blank" rel="noopener noreferrer" class="group block p-2 rounded-xl bg-white/5 hover:bg-white/10 border border-white/5 hover:border-white/20 transition">
                <div class="flex items-center justify-between">
                  <div class="flex items-center gap-2">
                    <svg class="w-3.5 h-3.5 text-emerald-400 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/></svg>
                    <span class="font-bold text-white group-hover:text-emerald-400 transition">Bhimavaram Campus</span>
                  </div>
                  <span class="text-[10px] text-slate-400 group-hover:text-white">Maps ↗</span>
                </div>
                <p class="text-[11px] text-slate-400 mt-0.5 pl-5">PP Road School & Junior College</p>
              </a>
            </li>

            <li>
              <a href="https://www.google.com/maps/search/?api=1&query=Tirumala+Junior+College+Tanuku" target="_blank" rel="noopener noreferrer" class="group block p-2 rounded-xl bg-white/5 hover:bg-white/10 border border-white/5 hover:border-white/20 transition">
                <div class="flex items-center justify-between">
                  <div class="flex items-center gap-2">
                    <svg class="w-3.5 h-3.5 text-amber-400 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/></svg>
                    <span class="font-bold text-white group-hover:text-amber-400 transition">Tanuku & Payakaraopeta</span>
                  </div>
                  <span class="text-[10px] text-slate-400 group-hover:text-white">Maps ↗</span>
                </div>
                <p class="text-[11px] text-slate-400 mt-0.5 pl-5">Overbridge Tanuku & National Highway</p>
              </a>
            </li>
          </ul>
        </div>

        <!-- Col 4: Central Institutional Support Desk -->
        <div>
          <h3 class="text-sm font-bold text-white uppercase tracking-wider mb-4 pb-1.5 border-b border-slate-800 flex items-center gap-2">
            <span class="w-2 h-2 rounded-full bg-emerald-400"></span>
            <span>Central Support Desk</span>
          </h3>

          <div class="space-y-3.5 text-xs">
            <!-- Helpline Card -->
            <div class="bg-white/5 p-3 rounded-xl border border-white/10">
              <span class="text-slate-400 block text-[11px]">Admissions & Academic Helpline:</span>
              <a href="tel:<?php echo INSTITUTE_PHONE_TEL; ?>" class="text-base font-black text-amber-400 hover:text-amber-300 transition block mt-0.5"><?php echo INSTITUTE_PHONE; ?></a>
              <span class="text-[10px] text-slate-400 block mt-0.5">Mon – Sat: 8:00 AM – 8:00 PM</span>
            </div>

            <!-- Email Card -->
            <div class="bg-white/5 p-3 rounded-xl border border-white/10">
              <span class="text-slate-400 block text-[11px]">Official Email:</span>
              <a href="mailto:<?php echo INSTITUTE_EMAIL; ?>" class="text-white font-semibold hover:text-blue-300 transition block mt-0.5 truncate"><?php echo INSTITUTE_EMAIL; ?></a>
            </div>

            <!-- Postal Address Card -->
            <div class="bg-white/5 p-3 rounded-xl border border-white/10">
              <span class="text-slate-400 block text-[11px]">Headquarters Address:</span>
              <p class="text-slate-300 mt-0.5 text-[11px] leading-relaxed"><?php echo INSTITUTE_ADDRESS; ?></p>
            </div>

            <!-- Portals CTA -->
            <div class="pt-1 flex items-center gap-2">
              <a href="<?php echo FEE_PORTAL_URL; ?>" target="_blank" rel="noopener noreferrer" class="flex-1 bg-amber-500 hover:bg-amber-600 text-slate-950 font-bold py-2 px-3 rounded-xl text-center text-xs transition shadow-sm">
                Student Sign In
              </a>
              <a href="/admin" class="bg-white/10 hover:bg-white/20 text-white font-medium py-2 px-3 rounded-xl text-center text-xs border border-white/15 transition">
                Admin
              </a>
            </div>
          </div>
        </div>

      </div>

      <!-- Bottom Accreditation & Copyright Bar -->
      <div class="pt-8 flex flex-col sm:flex-row items-center justify-between gap-4 text-xs text-slate-400">
        <p>© <?php echo date('Y'); ?> Tirumala IIT & Medical Academy. All rights reserved.</p>
        <div class="flex items-center gap-4 text-xs">
          <a href="/contact.php" class="hover:text-white transition">Campuses</a>
          <span>•</span>
          <a href="/admissions.php" class="hover:text-white transition">Admissions 2025-26</a>
          <span>•</span>
          <a href="<?php echo FEE_PORTAL_URL; ?>" target="_blank" class="hover:text-white transition">Fee Portal</a>
          <span>•</span>
          <a href="/admin" class="hover:text-white transition">Staff Admin</a>
        </div>
      </div>

    </div>
  </footer>

  <!-- Core Scripts -->
  <script src="<?php echo SITE_URL; ?>/assets/js/main.js"></script>
  <script src="<?php echo SITE_URL; ?>/assets/js/lightbox.js"></script>

</body>
</html>
