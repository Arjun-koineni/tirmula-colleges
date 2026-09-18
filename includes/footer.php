<?php
/**
 * Shared Footer Component
 * Tirumala IIT & Medical Academy
 */
?>
  </main>
  <!-- MAIN PAGE CONTENT ENDS -->

  <!-- INTERACTIVE WHATSAPP AGENT WIDGET -->
  <div id="whatsapp-agent-container" class="fixed bottom-6 right-6 z-50 flex flex-col items-end">
    
    <!-- WhatsApp Agent Card (Toggled on click) -->
    <div id="whatsapp-agent-card" class="hidden mb-3 w-[320px] sm:w-[360px] bg-white rounded-2xl shadow-2xl border border-slate-200 overflow-hidden transition-all duration-300 origin-bottom-right">
      
      <!-- Agent Card Header -->
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
              Tirumala Academy • Replies in ~5m
            </p>
          </div>
        </div>
        <button id="whatsapp-agent-close" class="text-white/80 hover:text-white p-1 rounded-lg hover:bg-white/10 transition" aria-label="Close WhatsApp Agent">
          <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
        </button>
      </div>

      <!-- Agent Chat History & Options -->
      <div class="p-4 bg-slate-50 space-y-3 max-h-80 overflow-y-auto">
        <!-- Counselor Welcome Bubble -->
        <div class="flex items-start gap-2.5">
          <div class="w-7 h-7 rounded-full bg-emerald-600 text-white flex items-center justify-center text-xs font-bold flex-shrink-0 shadow-sm">
            T
          </div>
          <div class="bg-white p-3 rounded-2xl rounded-tl-none shadow-sm border border-slate-200 text-xs text-slate-700 leading-relaxed">
            <p class="font-bold text-slate-900 mb-1">Namaste! 🙏</p>
            Welcome to <strong>Tirumala IIT & Medical Academy</strong>. How can our admissions counselor help you today?
          </div>
        </div>

        <!-- Quick Action Suggestion Chips -->
        <div class="space-y-1.5 pl-9">
          <button type="button" class="wa-preset-btn w-full text-left bg-white hover:bg-emerald-50 hover:text-emerald-700 border border-slate-200 hover:border-emerald-300 rounded-lg px-3 py-2 text-xs font-semibold text-slate-700 transition flex items-center justify-between shadow-xs" data-query="Hello, I want details regarding IIT-JEE & NEET Admissions for 2025-26.">
            <span>🎓 Admissions 2025-26</span>
            <span class="text-slate-400 text-xs">→</span>
          </button>
          <button type="button" class="wa-preset-btn w-full text-left bg-white hover:bg-emerald-50 hover:text-emerald-700 border border-slate-200 hover:border-emerald-300 rounded-lg px-3 py-2 text-xs font-semibold text-slate-700 transition flex items-center justify-between shadow-xs" data-query="Hello, please provide details about A/C Hostel, Dining, and Bus Transport facilities.">
            <span>🏢 Hostel & Transport Facilities</span>
            <span class="text-slate-400 text-xs">→</span>
          </button>
          <button type="button" class="wa-preset-btn w-full text-left bg-white hover:bg-emerald-50 hover:text-emerald-700 border border-slate-200 hover:border-emerald-300 rounded-lg px-3 py-2 text-xs font-semibold text-slate-700 transition flex items-center justify-between shadow-xs" data-query="Hello, I would like information regarding the Tirumala Talent Search Exam (TTSE) and scholarships.">
            <span>🏆 TTSE & Scholarship Tests</span>
            <span class="text-slate-400 text-xs">→</span>
          </button>
          <button type="button" class="wa-preset-btn w-full text-left bg-white hover:bg-emerald-50 hover:text-emerald-700 border border-slate-200 hover:border-emerald-300 rounded-lg px-3 py-2 text-xs font-semibold text-slate-700 transition flex items-center justify-between shadow-xs" data-query="Hello, I want to talk directly to a campus coordinator for Rajamahendravaram/Visakhapatnam.">
            <span>📞 Request Coordinator Callback</span>
            <span class="text-slate-400 text-xs">→</span>
          </button>
        </div>
      </div>

      <!-- Agent Direct Input Footer -->
      <div class="p-3 bg-white border-t border-slate-200">
        <form id="wa-custom-form" class="flex items-center gap-2">
          <input type="text" id="wa-custom-msg" placeholder="Type your inquiry or student class..." class="flex-1 text-xs border border-slate-300 rounded-lg px-3 py-2.5 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 outline-none">
          <button type="submit" class="bg-emerald-600 hover:bg-emerald-700 text-white p-2.5 rounded-lg transition shadow flex-shrink-0" aria-label="Send WhatsApp Message">
            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path d="M10.894 2.553a1 1 0 00-1.788 0l-7 14a1 1 0 001.169 1.409l5-1.429A1 1 0 009 15.571V11a1 1 0 112 0v4.571a1 1 0 00.725.962l5 1.428a1 1 0 001.17-1.408l-7-14z"/></svg>
          </button>
        </form>
      </div>

    </div>

    <!-- Floating Launcher Button with Tooltip -->
    <button id="whatsapp-agent-launcher" class="group flex items-center gap-2.5 bg-[#25D366] hover:bg-[#20ba5a] text-white p-3 sm:px-4 sm:py-3 rounded-full shadow-2xl transition-all duration-300 transform hover:scale-105" aria-label="Open Tirumala WhatsApp Admissions Agent">
      <div class="relative">
        <svg class="w-7 h-7 fill-current" viewBox="0 0 24 24">
          <path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372s-1.04 1.016-1.04 2.479 1.065 2.876 1.213 3.074c.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z"/>
        </svg>
        <span class="absolute -top-1 -right-1 w-2.5 h-2.5 bg-emerald-300 rounded-full animate-ping"></span>
      </div>
      <div class="hidden sm:flex flex-col text-left">
        <span class="text-xs font-bold leading-none">WhatsApp Agent</span>
        <span class="text-[10px] text-white/90 leading-tight">Admissions Help 🟢</span>
      </div>
    </button>

  </div>

  <!-- MAIN RICH FOOTER -->
  <footer class="bg-slate-950 text-slate-300 pt-16 pb-12 border-t border-slate-800">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-10 pb-12 border-b border-slate-800/80">
        
        <!-- Col 1: Institute Overview & Trust Metrics -->
        <div class="space-y-4">
          <div class="flex items-center gap-3">
            <img src="/assets/images/round_logo.png" alt="Tirumala Academy Logo" width="48" height="48" class="w-12 h-12 object-contain bg-white rounded-full p-1">
            <div>
              <span class="block text-lg font-bold text-white leading-tight">Tirumala Academy</span>
              <span class="text-xs text-amber-400 font-medium">IIT & Medical Coaching</span>
            </div>
          </div>
          <p class="text-xs leading-relaxed text-slate-400" data-i18n="footer_tagline">
            Founded in 2011, Tirumala IIT & Medical Academy is Andhra Pradesh's premier educational group with 9 schools and 17 junior colleges dedicated to student welfare, academic rigor, and nation-building values.
          </p>
          <div class="pt-2 flex items-center gap-3 text-xs text-slate-300">
            <span class="bg-slate-800 px-2.5 py-1 rounded border border-slate-700 font-semibold text-amber-400">42,600+ Students</span>
            <span class="bg-slate-800 px-2.5 py-1 rounded border border-slate-700 font-semibold text-emerald-400">9 Schools • 17 Colleges</span>
          </div>
        </div>

        <!-- Col 2: Navigation & Quick Links -->
        <div>
          <h3 class="text-sm font-bold text-white uppercase tracking-wider mb-4 border-l-2 border-tcrimson pl-2.5">Quick Links</h3>
          <ul class="space-y-2 text-xs">
            <li><a href="/index.php" class="hover:text-amber-400 transition flex items-center gap-1.5"><span>›</span> Home</a></li>
            <li><a href="/about.php" class="hover:text-amber-400 transition flex items-center gap-1.5"><span>›</span> About Us & Leadership</a></li>
            <li><a href="/results.php" class="hover:text-amber-400 transition flex items-center gap-1.5"><span>›</span> Results & State Ranks</a></li>
            <li><a href="/facilities/transport.php" class="hover:text-amber-400 transition flex items-center gap-1.5"><span>›</span> Facilities & Hostel</a></li>
            <li><a href="/model-papers.php" class="hover:text-amber-400 transition flex items-center gap-1.5"><span>›</span> Model Papers (Free Download)</a></li>
            <li><a href="/gallery.php" class="hover:text-amber-400 transition flex items-center gap-1.5"><span>›</span> Photo Gallery</a></li>
            <li><a href="/admissions.php" class="text-amber-400 font-semibold hover:underline flex items-center gap-1.5"><span>›</span> Admissions 2025-26</a></li>
            <li><a href="<?php echo FEE_PORTAL_URL; ?>" target="_blank" class="text-emerald-400 hover:underline flex items-center gap-1.5"><span>›</span> Student Fee Portal (Onesaz) ↗</a></li>
          </ul>
        </div>

        <!-- Col 3: Campus Locations across AP -->
        <div>
          <h3 class="text-sm font-bold text-white uppercase tracking-wider mb-4 border-l-2 border-amber-400 pl-2.5">Our AP Campuses</h3>
          <ul class="space-y-2.5 text-xs text-slate-300">
            <li class="flex items-start gap-2">
              <span class="text-tcrimson font-bold">📍</span>
              <div>
                <strong class="text-white">Rajamahendravaram (Central HQ)</strong>
                <p class="text-slate-400 text-[11px]">Katheru Campus, Rajahmundry 533102</p>
              </div>
            </li>
            <li class="flex items-start gap-2">
              <span class="text-tcrimson font-bold">📍</span>
              <div>
                <strong class="text-white">Visakhapatnam Campus</strong>
                <p class="text-slate-400 text-[11px]">Maddilapalem / MVP Colony, Vizag</p>
              </div>
            </li>
            <li class="flex items-start gap-2">
              <span class="text-tcrimson font-bold">📍</span>
              <div>
                <strong class="text-white">Bhimavaram Campus</strong>
                <p class="text-slate-400 text-[11px]">PP Road, West Godavari</p>
              </div>
            </li>
            <li class="flex items-start gap-2">
              <span class="text-tcrimson font-bold">📍</span>
              <div>
                <strong class="text-white">Tanuku Campus</strong>
                <p class="text-slate-400 text-[11px]">Near Overbridge, Tanuku</p>
              </div>
            </li>
            <li class="flex items-start gap-2">
              <span class="text-tcrimson font-bold">📍</span>
              <div>
                <strong class="text-white">Payakaraopeta Campus</strong>
                <p class="text-slate-400 text-[11px]">National Highway, Anakapalli Dist.</p>
              </div>
            </li>
          </ul>
        </div>

        <!-- Col 4: Verified Contact & Staff Portal -->
        <div>
          <h3 class="text-sm font-bold text-white uppercase tracking-wider mb-4 border-l-2 border-emerald-400 pl-2.5">Central Support</h3>
          <div class="space-y-3 text-xs">
            <div>
              <span class="text-slate-400 block">General & Admissions Helpline:</span>
              <a href="tel:<?php echo INSTITUTE_PHONE_TEL; ?>" class="text-base font-bold text-white hover:text-amber-400 transition block mt-0.5"><?php echo INSTITUTE_PHONE; ?></a>
            </div>
            <div>
              <span class="text-slate-400 block">Official Communication Email:</span>
              <a href="mailto:<?php echo INSTITUTE_EMAIL; ?>" class="text-slate-200 hover:text-white transition block mt-0.5"><?php echo INSTITUTE_EMAIL; ?></a>
            </div>
            <div>
              <span class="text-slate-400 block">Postal Address:</span>
              <p class="text-slate-300 mt-0.5"><?php echo INSTITUTE_ADDRESS; ?></p>
            </div>
            <div class="pt-3">
              <a href="<?php echo FEE_PORTAL_URL; ?>" target="_blank" rel="noopener noreferrer" class="inline-flex items-center gap-1.5 text-xs bg-slate-800 hover:bg-slate-700 text-slate-200 px-3.5 py-1.5 rounded border border-slate-700 transition">
                <svg class="w-3.5 h-3.5 text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
                <span>Student & Parent Sign In</span>
              </a>
            </div>
          </div>
        </div>

      </div>

      <!-- Bottom Copyright & Compliance Bar -->
      <div class="pt-8 flex flex-col sm:flex-row items-center justify-between gap-4 text-xs text-slate-500">
        <p>© <?php echo date('Y'); ?> Tirumala IIT & Medical Academy. All rights reserved.</p>
        <div class="flex items-center gap-4">
          <a href="/contact.php" class="hover:text-slate-300 transition">Contact</a>
          <span>•</span>
          <a href="/admissions.php" class="hover:text-slate-300 transition">Admissions</a>
          <span>•</span>
          <a href="<?php echo FEE_PORTAL_URL; ?>" target="_blank" class="hover:text-slate-300 transition">Sign In</a>
        </div>
      </div>

    </div>
  </footer>

  <!-- Core Scripts -->
  <script src="<?php echo SITE_URL; ?>/assets/js/main.js"></script>
  <script src="<?php echo SITE_URL; ?>/assets/js/lightbox.js"></script>

</body>
</html>
