<?php
/**
 * Homepage - Tirumala IIT & Medical Academy
 */
$pageTitle = "Home | Premier IIT-JEE, NEET & School Education in Andhra Pradesh";
$currentNav = "home";
$metaDesc = "Tirumala IIT & Medical Academy: Leading Andhra Pradesh in IIT-JEE, NEET & EAPCET coaching with 42,600+ students, 9 schools, and 17 junior colleges.";
require_once __DIR__ . '/includes/header.php';

// Fetch latest featured results from DB
$db = getDB();
$featuredResults = [];
try {
    $stmt = $db->query("SELECT * FROM results WHERE featured = 1 ORDER BY id ASC LIMIT 6");
    $featuredResults = $stmt->fetchAll();
} catch (Throwable $e) {}

// Fetch active notices for ticker / feed
$notices = [];
try {
    $stmt = $db->query("SELECT * FROM notices WHERE is_active = 1 ORDER BY id DESC LIMIT 4");
    $notices = $stmt->fetchAll();
} catch (Throwable $e) {}
?>

<!-- 1. HERO SECTION -->
<section class="relative bg-tirumala-gradient text-white overflow-hidden py-16 lg:py-24">
  <!-- Subtle Background Geometric Accents -->
  <div class="absolute inset-0 opacity-10 bg-[radial-gradient(#ffffff_1px,transparent_1px)] [background-size:24px_24px] pointer-events-none"></div>
  <div class="absolute -right-24 -top-24 w-96 h-96 bg-blue-500/20 rounded-full blur-3xl pointer-events-none"></div>
  <div class="absolute -left-24 -bottom-24 w-96 h-96 bg-red-600/20 rounded-full blur-3xl pointer-events-none"></div>

  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
      
      <!-- Hero Left: Content & CTAs -->
      <div class="lg:col-span-7 space-y-6 text-center lg:text-left">
        <div class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-white/10 border border-white/20 text-xs font-semibold tracking-wide text-amber-300">
          <span class="w-2 h-2 rounded-full bg-emerald-400 animate-ping"></span>
          <span data-i18n="hero_badge">Admissions Open 2025-26</span>
          <span class="text-white/60">•</span>
          <span>Scholarship Tests Active</span>
        </div>

        <h1 class="text-4xl sm:text-5xl lg:text-6xl font-extrabold text-white leading-tight tracking-tight" data-i18n="hero_title">
          Empowering Students for <span class="text-amber-400">IIT-JEE</span>, <span class="text-emerald-400">NEET</span> & Academic Mastery
        </h1>

        <p class="text-base sm:text-lg text-slate-200 font-normal leading-relaxed max-w-2xl mx-auto lg:mx-0" data-i18n="hero_desc">
          South India's premier educational group with 9 schools and 17 junior colleges across Andhra Pradesh, guiding 42,600+ young minds towards nation-leading ranks with individual mentorship.
        </p>

        <!-- CTAs -->
        <div class="pt-2 flex flex-col sm:flex-row items-center justify-center lg:justify-start gap-4">
          <a href="/admissions.php" data-i18n="cta_enquire" class="w-full sm:w-auto text-center bg-blue-700 hover:bg-blue-800 text-white font-bold px-8 py-3.5 rounded-xl shadow-xl hover:shadow-2xl transition transform hover:-translate-y-0.5 text-base flex items-center justify-center gap-2">
            <span>Apply for Admission</span>
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/></svg>
          </a>
          <a href="/results.php" data-i18n="cta_explore" class="w-full sm:w-auto text-center bg-white/10 hover:bg-white/20 text-white font-semibold px-7 py-3.5 rounded-xl border border-white/20 transition backdrop-blur-sm text-base flex items-center justify-center gap-2">
            <span>Explore Rankers</span>
            <svg class="w-5 h-5 text-amber-400" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
          </a>
        </div>

        <!-- Trust Badges -->
        <div class="pt-4 flex flex-wrap items-center justify-center lg:justify-start gap-6 text-xs text-slate-300">
          <div class="flex items-center gap-2">
            <span class="text-amber-400 text-lg">✓</span> <span>State Top Ranks</span>
          </div>
          <div class="flex items-center gap-2">
            <span class="text-amber-400 text-lg">✓</span> <span>AC Residential Hostels</span>
          </div>
          <div class="flex items-center gap-2">
            <span class="text-amber-400 text-lg">✓</span> <span>Dedicated IIT/AIIMS Faculty</span>
          </div>
        </div>
      </div>

      <!-- Hero Right: Quick Admissions Card -->
      <div class="lg:col-span-5">
        <div class="bg-white text-slate-900 rounded-2xl shadow-2xl p-6 sm:p-8 border border-slate-100 relative">
          <div class="absolute -top-3 right-6 bg-amber-500 text-slate-950 font-extrabold text-xs uppercase tracking-wider px-3 py-1 rounded-full shadow">
            Session 2025-26
          </div>
          <h2 class="text-2xl font-bold text-tnavy" data-i18n="enquiry_heading">Quick Admissions Enquiry</h2>
          <p class="text-xs text-slate-500 mt-1 mb-6" data-i18n="enquiry_subheading">Receive prospectus and call from senior academic mentor.</p>

          <form action="/api/submit_enquiry.php" method="POST" class="space-y-4">
            <div>
              <label for="quick_student_name" class="block text-xs font-semibold text-slate-700 mb-1">Student Full Name *</label>
              <input type="text" id="quick_student_name" name="student_name" required placeholder="e.g. K. Sai Teja" class="w-full text-sm px-3.5 py-2.5 rounded-lg border border-slate-300 focus:ring-2 focus:ring-blue-600 focus:border-blue-600 outline-none transition">
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
              <div>
                <label for="quick_phone" class="block text-xs font-semibold text-slate-700 mb-1">Mobile Number *</label>
                <input type="tel" id="quick_phone" name="phone" required placeholder="10-digit number" class="w-full text-sm px-3.5 py-2.5 rounded-lg border border-slate-300 focus:ring-2 focus:ring-blue-600 focus:border-blue-600 outline-none transition">
              </div>
              <div>
                <label for="quick_campus" class="block text-xs font-semibold text-slate-700 mb-1">Preferred Campus *</label>
                <select id="quick_campus" name="campus_preferred" required class="w-full text-sm px-3.5 py-2.5 rounded-lg border border-slate-300 focus:ring-2 focus:ring-blue-600 focus:border-blue-600 outline-none transition bg-white">
                  <option value="Rajamahendravaram">Rajamahendravaram</option>
                  <option value="Visakhapatnam">Visakhapatnam</option>
                  <option value="Bhimavaram">Bhimavaram</option>
                  <option value="Tanuku">Tanuku</option>
                  <option value="Payakaraopeta">Payakaraopeta</option>
                </select>
              </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
              <div>
                <label for="quick_stream" class="block text-xs font-semibold text-slate-700 mb-1">Stream / Grade *</label>
                <select id="quick_stream" name="stream_interested" required class="w-full text-sm px-3.5 py-2.5 rounded-lg border border-slate-300 focus:ring-2 focus:ring-blue-600 focus:border-blue-600 outline-none transition bg-white">
                  <option value="IIT-JEE (MPC)">IIT-JEE (MPC)</option>
                  <option value="NEET (BiPC)">NEET (BiPC)</option>
                  <option value="IPE Inter">IPE Intermediate</option>
                  <option value="Class 6-10 School">Class 6th to 10th School</option>
                </select>
              </div>
              <div>
                <label for="quick_email" class="block text-xs font-semibold text-slate-700 mb-1">Parent Email (Optional)</label>
                <input type="email" id="quick_email" name="email" placeholder="parent@gmail.com" class="w-full text-sm px-3.5 py-2.5 rounded-lg border border-slate-300 focus:ring-2 focus:ring-blue-600 focus:border-blue-600 outline-none transition">
              </div>
            </div>

            <button type="submit" class="w-full bg-blue-700 hover:bg-blue-800 text-white font-bold py-3 px-4 rounded-lg shadow transition transform active:scale-95 text-sm flex items-center justify-center gap-2">
              <span>Submit Admissions Enquiry</span>
              <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
            </button>
            <p class="text-[11px] text-center text-slate-400">Your details remain strictly confidential.</p>
          </form>
        </div>
      </div>

    </div>
  </div>
</section>

<!-- 2. TRUST STATS STRIP -->
<section class="bg-slate-900 text-white py-10 border-y border-slate-800">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-8 text-center">
      <div class="space-y-1">
        <p class="text-3xl sm:text-5xl font-black text-amber-400 tracking-tight">42,600+</p>
        <p class="text-xs sm:text-sm text-slate-300 font-medium uppercase tracking-wider" data-i18n="trust_students">Students Enrolled</p>
      </div>
      <div class="space-y-1">
        <p class="text-3xl sm:text-5xl font-black text-white tracking-tight">9</p>
        <p class="text-xs sm:text-sm text-slate-300 font-medium uppercase tracking-wider" data-i18n="trust_schools">Schools across AP</p>
      </div>
      <div class="space-y-1">
        <p class="text-3xl sm:text-5xl font-black text-emerald-400 tracking-tight">17</p>
        <p class="text-xs sm:text-sm text-slate-300 font-medium uppercase tracking-wider" data-i18n="trust_colleges">Junior Colleges</p>
      </div>
      <div class="space-y-1">
        <p class="text-3xl sm:text-5xl font-black text-red-400 tracking-tight">2011</p>
        <p class="text-xs sm:text-sm text-slate-300 font-medium uppercase tracking-wider" data-i18n="trust_years">Founded (15+ Years Trust)</p>
      </div>
    </div>
  </div>
</section>

<!-- 3. LATEST RESULTS BANNER (Database Driven) -->
<section class="py-16 bg-slate-50">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    
    <div class="flex flex-col md:flex-row md:items-end justify-between mb-10 gap-4">
      <div>
        <span class="text-blue-700 font-bold text-xs uppercase tracking-widest">Proven Track Record</span>
        <h2 class="text-3xl sm:text-4xl font-extrabold text-tnavy mt-1">Outstanding Results & State Ranks</h2>
      </div>
      <a href="/results.php" class="inline-flex items-center gap-1.5 text-sm font-bold text-blue-700 hover:text-blue-800 group">
        <span>View Full Results Archive</span>
        <svg class="w-4 h-4 transform group-hover:translate-x-1 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
      </a>
    </div>

    <!-- Results Cards Grid -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
      <?php if (!empty($featuredResults)): ?>
        <?php foreach ($featuredResults as $res): ?>
          <div class="bg-white rounded-xl shadow-md border border-slate-200 overflow-hidden card-hover-lift flex flex-col justify-between">
            <div class="p-6">
              <div class="flex items-center justify-between gap-2 mb-3">
                <span class="bg-blue-50 text-tnavy border border-blue-200 text-xs font-bold px-2.5 py-0.5 rounded-full">
                  <?php echo htmlspecialchars($res['exam_type']); ?>
                </span>
                <span class="text-xs text-slate-400 font-medium"><?php echo htmlspecialchars($res['campus']); ?></span>
              </div>
              <h3 class="text-xl font-bold text-slate-900"><?php echo htmlspecialchars($res['student_name']); ?></h3>
              <p class="text-xs text-slate-500 mt-0.5">Roll No: <?php echo htmlspecialchars($res['roll_number']); ?> • Stream: <?php echo htmlspecialchars($res['stream']); ?></p>
              
              <div class="mt-4 bg-gradient-to-r from-amber-50 to-orange-50 border border-amber-200/60 rounded-lg p-3">
                <span class="text-xs font-semibold text-amber-800 uppercase tracking-wider block">Rank / Score Achieved</span>
                <span class="text-lg font-black text-amber-900"><?php echo htmlspecialchars($res['score_or_rank']); ?></span>
              </div>
            </div>
            <div class="bg-slate-50 px-6 py-3 border-t border-slate-100 flex items-center justify-between text-xs text-slate-500">
              <span>Year <?php echo htmlspecialchars($res['year']); ?></span>
              <a href="/results.php?search=<?php echo urlencode($res['roll_number']); ?>" class="text-blue-700 font-bold hover:underline">Verify Result →</a>
            </div>
          </div>
        <?php endforeach; ?>
      <?php else: ?>
        <div class="col-span-full text-center py-10 bg-white rounded-xl border border-dashed border-slate-300">
          <p class="text-slate-500 text-sm">Results are being loaded from the database.</p>
        </div>
      <?php endif; ?>
    </div>

  </div>
</section>

<!-- 4. LEADERSHIP VISION (Sri N. Tirumala Rao, Sri G. Satish Babu, Dr. Sri Rasmi Nunna) -->
<section class="py-20 bg-white">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="text-center max-w-3xl mx-auto mb-16">
      <span class="text-blue-700 font-bold text-xs uppercase tracking-widest">Guiding Vision</span>
      <h2 class="text-3xl sm:text-4xl font-extrabold text-tnavy mt-1">Visionary Leadership</h2>
      <p class="text-slate-600 text-sm sm:text-base mt-3">
        Guided by philanthropists and passionate educators committed to empowering every student across Andhra Pradesh with individual care, academic discipline, and values.
      </p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
      
      <!-- Chairman -->
      <div class="bg-slate-50 rounded-2xl p-6 border border-slate-200 card-hover-lift flex flex-col items-center text-center">
        <div class="w-36 h-36 rounded-full overflow-hidden border-4 border-amber-400 shadow-lg mb-4 bg-white">
          <img src="/assets/images/chairman_tirumala_rao.png" alt="Sri N. Tirumala Rao" width="144" height="144" loading="lazy" class="w-full h-full object-cover object-top">
        </div>
        <h3 class="text-xl font-bold text-tnavy">Sri N. Tirumala Rao</h3>
        <p class="text-xs font-bold uppercase tracking-wider text-blue-700 mb-3">Founder & Chairman</p>
        <p class="text-xs text-slate-600 leading-relaxed">
          A respected philanthropist whose driving force has always been student welfare. For lakhs of young learners, he has become a source of stability, direction, and inspiration, establishing individual care as the blueprint of the institution.
        </p>
      </div>

      <!-- Managing Director -->
      <div class="bg-slate-50 rounded-2xl p-6 border border-slate-200 card-hover-lift flex flex-col items-center text-center">
        <div class="w-36 h-36 rounded-full overflow-hidden border-4 border-amber-400 shadow-lg mb-4 bg-white">
          <img src="/assets/images/director_satish_babu.jpg" alt="Sri G. Satish Babu" width="144" height="144" loading="lazy" class="w-full h-full object-cover object-top">
        </div>
        <h3 class="text-xl font-bold text-tnavy">Sri G. Satish Babu</h3>
        <p class="text-xs font-bold uppercase tracking-wider text-blue-700 mb-3">Managing Director</p>
        <p class="text-xs text-slate-600 leading-relaxed">
          A postgraduate in Chemistry and educator since 1999. Through his teaching and strong motivational mentorship, he has steered thousands of learners into premier IITs, NITs, and medical colleges across India.
        </p>
      </div>

      <!-- Vice Chairperson -->
      <div class="bg-slate-50 rounded-2xl p-6 border border-slate-200 card-hover-lift flex flex-col items-center text-center">
        <div class="w-36 h-36 rounded-full overflow-hidden border-4 border-amber-400 shadow-lg mb-4 bg-white">
          <img src="/assets/images/vice_chairperson_rasmi_nunna.jpg" alt="Dr. Sri Rasmi Nunna" width="144" height="144" loading="lazy" class="w-full h-full object-cover object-top">
        </div>
        <h3 class="text-xl font-bold text-tnavy">Dr. Sri Rasmi Nunna</h3>
        <p class="text-xs font-bold uppercase tracking-wider text-blue-700 mb-3">Vice Chairperson</p>
        <p class="text-xs text-slate-600 leading-relaxed">
          MBBS (Andhra Medical College, Vizag) & MS General Surgery (Sri Ramachandra, Chennai). A visionary healthcare professional blending clinical discipline, student psychology, and modern educational methodologies.
        </p>
      </div>

    </div>
  </div>
</section>

<!-- 5. FIVE AP CAMPUS LOCATIONS -->
<section class="py-16 bg-slate-900 text-white">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="text-center max-w-2xl mx-auto mb-12">
      <span class="text-amber-400 font-bold text-xs uppercase tracking-widest">Statewide Network</span>
      <h2 class="text-3xl font-extrabold text-white mt-1">Our Premier Campus Hubs</h2>
      <p class="text-slate-400 text-sm mt-2">World-class infrastructure, air-conditioned classrooms, labs, and residential facilities across Andhra Pradesh.</p>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-4">
      
      <div class="bg-slate-800/80 rounded-xl p-5 border border-slate-700/80 text-center space-y-2 card-hover-lift">
        <div class="text-3xl">🏛️</div>
        <h3 class="font-bold text-white text-base">Rajamahendravaram</h3>
        <p class="text-xs text-amber-400 font-medium">Central Headquarters</p>
        <p class="text-[11px] text-slate-400">Katheru Main Campus, School & Colleges</p>
      </div>

      <div class="bg-slate-800/80 rounded-xl p-5 border border-slate-700/80 text-center space-y-2 card-hover-lift">
        <div class="text-3xl">🌊</div>
        <h3 class="font-bold text-white text-base">Visakhapatnam</h3>
        <p class="text-xs text-amber-400 font-medium">Port City Hub</p>
        <p class="text-[11px] text-slate-400">Maddilapalem & MVP Colony Campuses</p>
      </div>

      <div class="bg-slate-800/80 rounded-xl p-5 border border-slate-700/80 text-center space-y-2 card-hover-lift">
        <div class="text-3xl">🌾</div>
        <h3 class="font-bold text-white text-base">Bhimavaram</h3>
        <p class="text-xs text-amber-400 font-medium">Delta Hub</p>
        <p class="text-[11px] text-slate-400">PP Road School & Junior College</p>
      </div>

      <div class="bg-slate-800/80 rounded-xl p-5 border border-slate-700/80 text-center space-y-2 card-hover-lift">
        <div class="text-3xl">🌴</div>
        <h3 class="font-bold text-white text-base">Tanuku</h3>
        <p class="text-xs text-amber-400 font-medium">Academic Center</p>
        <p class="text-[11px] text-slate-400">Near Overbridge, High School & Inter</p>
      </div>

      <div class="bg-slate-800/80 rounded-xl p-5 border border-slate-700/80 text-center space-y-2 card-hover-lift">
        <div class="text-3xl">🛣️</div>
        <h3 class="font-bold text-white text-base">Payakaraopeta</h3>
        <p class="text-xs text-amber-400 font-medium">Highway Campus</p>
        <p class="text-[11px] text-slate-400">Residential & Day Scholar Facilities</p>
      </div>

    </div>
  </div>
</section>

<!-- 6. CALL TO ACTION STRIP -->
<section class="py-14 bg-gradient-to-r from-red-600 via-rose-600 to-red-700 text-white text-center">
  <div class="max-w-4xl mx-auto px-4 space-y-4">
    <h2 class="text-3xl sm:text-4xl font-black">Begin Your Journey to IIT & Medical Excellence</h2>
    <p class="text-sm sm:text-base text-rose-100 max-w-2xl mx-auto">
      Speak with our senior counseling team or visit our central campus at Katheru, Rajamahendravaram.
    </p>
    <div class="pt-2 flex flex-wrap items-center justify-center gap-4">
      <a href="/admissions.php" class="bg-white hover:bg-slate-100 text-red-700 font-bold px-8 py-3 rounded-lg shadow-lg text-sm transition">
        Apply for 2025-26 Admission
      </a>
      <a href="tel:<?php echo INSTITUTE_PHONE_TEL; ?>" class="bg-red-800/70 hover:bg-red-900 text-white font-semibold px-6 py-3 rounded-lg border border-red-400 text-sm transition flex items-center gap-2">
        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 4V3z"/></svg>
        <span>Call: <?php echo INSTITUTE_PHONE; ?></span>
      </a>
    </div>
  </div>
</section>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
