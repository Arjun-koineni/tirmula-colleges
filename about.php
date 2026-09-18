<?php
/**
 * About Us Page - Tirumala IIT & Medical Academy
 */
$pageTitle = "About Us | History, Mission & Leadership";
$currentNav = "about";
$metaDesc = "Learn about the foundation, vision, and leadership of Tirumala IIT & Medical Academy. Founded in 2011 by Sri N. Tirumala Rao.";
require_once __DIR__ . '/includes/header.php';
?>

<!-- BREADCRUMBS & HERO BANNER -->
<section class="bg-tirumala-gradient text-white py-14">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
    <span class="text-amber-400 font-bold text-xs uppercase tracking-widest">Our Legacy & Philosophy</span>
    <h1 class="text-3xl sm:text-5xl font-extrabold text-white mt-1">About Tirumala Academy</h1>
    <p class="text-slate-300 text-sm sm:text-base max-w-2xl mx-auto mt-3">
      Nurturing academic brilliance and building strong character across Andhra Pradesh since 2011.
    </p>
  </div>
</section>

<!-- 1. OUR STORY & FOUNDATION -->
<section class="py-16 bg-white">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
      
      <div class="lg:col-span-6 space-y-5">
        <span class="text-blue-700 font-bold text-xs uppercase tracking-widest">The Tirumala Journey</span>
        <h2 class="text-3xl font-extrabold text-tnavy">From a Humble Vision in 2011 to Andhra Pradesh's Benchmark</h2>
        <p class="text-slate-600 text-sm sm:text-base leading-relaxed">
          Established in <strong>2011</strong> at Rajamahendravaram by visionary philanthropist <strong>Sri N. Tirumala Rao</strong>, Tirumala Educational Institutes was born from a singular imperative: every child deserves rigorous, high-quality competitive exam coaching without compromising on individual care and emotional well-being.
        </p>
        <p class="text-slate-600 text-sm sm:text-base leading-relaxed">
          Over the past 15 years, our educational family has expanded into <strong>9 premier schools</strong> and <strong>17 junior colleges</strong> spread strategically across Rajamahendravaram, Visakhapatnam, Bhimavaram, Tanuku, and Payakaraopeta. Today, more than <strong>42,600 students</strong> study under our mentorship.
        </p>
        <div class="grid grid-cols-2 gap-4 pt-2">
          <div class="border-l-4 border-blue-700 pl-4">
            <span class="text-2xl font-bold text-tnavy">42,600+</span>
            <p class="text-xs text-slate-500 font-medium">Students Enrolled</p>
          </div>
          <div class="border-l-4 border-amber-500 pl-4">
            <span class="text-2xl font-bold text-tnavy">26 Campuses</span>
            <p class="text-xs text-slate-500 font-medium">9 Schools & 17 Colleges</p>
          </div>
        </div>
      </div>

      <div class="lg:col-span-6">
        <div class="relative rounded-2xl overflow-hidden shadow-2xl border-4 border-slate-100 bg-slate-900 p-8 text-white space-y-6">
          <div class="flex items-center gap-3">
            <img src="/assets/images/round_logo.png" alt="Logo" class="w-14 h-14 object-contain bg-white rounded-full p-1">
            <div>
              <h3 class="text-lg font-bold text-white">The Tirumala Creed</h3>
              <p class="text-xs text-amber-400">Student Welfare Above All</p>
            </div>
          </div>
          <blockquote class="italic text-sm text-slate-300 leading-relaxed border-l-2 border-tcrimson pl-4">
            "We believe that education is not merely the transmission of facts for an entrance test, but the building of intellectual resilience and moral grounding that sustains a student for a lifetime."
          </blockquote>
          <div class="text-xs text-slate-400">
            — <strong class="text-white">Sri N. Tirumala Rao</strong>, Founder Chairman
          </div>
        </div>
      </div>

    </div>
  </div>
</section>

<!-- 2. MISSION & CORE PILLARS -->
<section class="py-16 bg-slate-50 border-y border-slate-200">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="text-center max-w-2xl mx-auto mb-12">
      <span class="text-tcrimson font-bold text-xs uppercase tracking-widest">Our Blueprint</span>
      <h2 class="text-3xl font-extrabold text-tnavy mt-1">Our Educational Pillars</h2>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
      
      <div class="bg-white p-7 rounded-xl shadow-sm border border-slate-200 space-y-3 card-hover-lift">
        <div class="w-12 h-12 rounded-lg bg-blue-50 text-tnavy flex items-center justify-center text-2xl font-bold">🎯</div>
        <h3 class="text-xl font-bold text-slate-900">Individual Student Care</h3>
        <p class="text-xs text-slate-600 leading-relaxed">
          Unlike crowded commercial coaching factories, Tirumala assigns dedicated mentor faculty to track every learner's conceptual strengths and stress levels through continuous diagnostic assessment.
        </p>
      </div>

      <div class="bg-white p-7 rounded-xl shadow-sm border border-slate-200 space-y-3 card-hover-lift">
        <div class="w-12 h-12 rounded-lg bg-red-50 text-tcrimson flex items-center justify-center text-2xl font-bold">🔬</div>
        <h3 class="text-xl font-bold text-slate-900">Concept-First Pedagogy</h3>
        <p class="text-xs text-slate-600 leading-relaxed">
          From Class 6 IIT/NEET foundation batches to Senior Intermediate Super 60 batches, concepts in Physics, Chemistry, Mathematics, and Biology are taught with deep practical reasoning.
        </p>
      </div>

      <div class="bg-white p-7 rounded-xl shadow-sm border border-slate-200 space-y-3 card-hover-lift">
        <div class="w-12 h-12 rounded-lg bg-amber-50 text-amber-700 flex items-center justify-center text-2xl font-bold">🛡️</div>
        <h3 class="text-xl font-bold text-slate-900">Holistic Campus Life</h3>
        <p class="text-xs text-slate-600 leading-relaxed">
          Safe and secure residential hostels, hygienic nutritious food, sports activities, and yoga periods ensure that physical and mental fitness go hand in hand with academic excellence.
        </p>
      </div>

    </div>
  </div>
</section>

<!-- 3. DETAILED LEADERSHIP PROFILES -->
<section class="py-20 bg-white">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="text-center max-w-2xl mx-auto mb-16">
      <span class="text-blue-700 font-bold text-xs uppercase tracking-widest">Leadership Behind Success</span>
      <h2 class="text-3xl sm:text-4xl font-extrabold text-tnavy mt-1">Meet Our Guiding Leaders</h2>
    </div>

    <!-- Leader 1: Chairman -->
    <div class="mb-14 bg-slate-50 rounded-2xl p-8 border border-slate-200 grid grid-cols-1 lg:grid-cols-12 gap-8 items-center">
      <div class="lg:col-span-4 flex justify-center">
        <div class="w-48 h-48 rounded-full overflow-hidden border-4 border-amber-400 shadow-xl bg-white">
          <img src="/assets/images/chairman_tirumala_rao.png" alt="Sri N. Tirumala Rao" class="w-full h-full object-cover object-top">
        </div>
      </div>
      <div class="lg:col-span-8 space-y-3">
        <div class="inline-block bg-amber-100 text-amber-800 text-xs font-bold px-3 py-1 rounded-full uppercase tracking-wider">Founder & Chairman</div>
        <h3 class="text-2xl font-black text-tnavy">Sri N. Tirumala Rao</h3>
        <p class="text-sm text-slate-600 leading-relaxed">
          Sri N. Tirumala Rao is a renowned philanthropist whose guiding light has always been the welfare of students, faculty, and support staff alike. For hundreds of thousands of learners across Coastal Andhra, he represents direction, reliability, and inspirational mentorship.
        </p>
        <p class="text-sm text-slate-600 leading-relaxed">
          He firmly maintains that institutional growth is meaningless without individual care. Under his visionary stewardship, Tirumala has established state-of-the-art campuses while maintaining accessible fee structures and extensive scholarships for meritorious students.
        </p>
      </div>
    </div>

    <!-- Leader 2: MD -->
    <div class="mb-14 bg-slate-50 rounded-2xl p-8 border border-slate-200 grid grid-cols-1 lg:grid-cols-12 gap-8 items-center">
      <div class="lg:col-span-4 flex justify-center order-1 lg:order-2">
        <div class="w-48 h-48 rounded-full overflow-hidden border-4 border-amber-400 shadow-xl bg-white">
          <img src="/assets/images/director_satish_babu.jpg" alt="Sri G. Satish Babu" class="w-full h-full object-cover object-top">
        </div>
      </div>
      <div class="lg:col-span-8 space-y-3 order-2 lg:order-1">
        <div class="inline-block bg-blue-100 text-blue-800 text-xs font-bold px-3 py-1 rounded-full uppercase tracking-wider">Managing Director</div>
        <h3 class="text-2xl font-black text-tnavy">Sri G. Satish Babu</h3>
        <p class="text-sm text-slate-600 leading-relaxed">
          Mr. Satishbabu Garapati, a postgraduate in Chemistry, commenced his career as an academic lecturer in 1999. His innate passion for teaching quickly made him a beloved educator for thousands of aspirants seeking admissions into premier Indian institutes.
        </p>
        <p class="text-sm text-slate-600 leading-relaxed">
          Through his sharp motivational guidance and analytical approach to entrance syllabi, he joined Tirumala Educational Institutes as Academic Director in 2012. Today, as Managing Director, he spearheads curriculum engineering, faculty recruitment, and student performance metrics.
        </p>
      </div>
    </div>

    <!-- Leader 3: Vice Chairperson -->
    <div class="bg-slate-50 rounded-2xl p-8 border border-slate-200 grid grid-cols-1 lg:grid-cols-12 gap-8 items-center">
      <div class="lg:col-span-4 flex justify-center">
        <div class="w-48 h-48 rounded-full overflow-hidden border-4 border-amber-400 shadow-xl bg-white">
          <img src="/assets/images/vice_chairperson_rasmi_nunna.jpg" alt="Dr. Sri Rasmi Nunna" class="w-full h-full object-cover object-top">
        </div>
      </div>
      <div class="lg:col-span-8 space-y-3">
        <div class="inline-block bg-emerald-100 text-emerald-800 text-xs font-bold px-3 py-1 rounded-full uppercase tracking-wider">Vice Chairperson</div>
        <h3 class="text-2xl font-black text-tnavy">Dr. Sri Rasmi Nunna</h3>
        <p class="text-sm text-slate-600 leading-relaxed">
          Dr. Sri Rasmi Nunna has been a meritorious scholar throughout her academic journey. She earned her MBBS from the prestigious Andhra Medical College, Visakhapatnam, and completed her MS in General Surgery at Sri Ramachandra Institute of Higher Education & Research, Chennai.
        </p>
        <p class="text-sm text-slate-600 leading-relaxed">
          Growing up alongside the institution under the mentorship of her father, Chairman Sri Tirumala Rao, she brings modern medical rigor, mental wellness awareness, and compassionate oversight to the Tirumala educational ecosystem.
        </p>
      </div>
    </div>

  </div>
</section>

<!-- 4. ADMISSIONS BANNER -->
<section class="py-12 bg-slate-900 text-white text-center">
  <div class="max-w-4xl mx-auto px-4 space-y-4">
    <h3 class="text-2xl sm:text-3xl font-bold">Experience the Tirumala Difference</h3>
    <p class="text-slate-300 text-sm max-w-xl mx-auto">Visit our central campus at Katheru, Rajamahendravaram, or call our admissions helpline.</p>
    <div class="pt-2 flex justify-center gap-4">
      <a href="/admissions.php" class="bg-tcrimson hover:bg-tcrimson-hover text-white font-bold px-6 py-2.5 rounded-lg text-sm shadow">Apply Online</a>
      <a href="/contact.php" class="bg-slate-800 hover:bg-slate-700 text-white font-semibold px-6 py-2.5 rounded-lg border border-slate-700 text-sm">View Campuses</a>
    </div>
  </div>
</section>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
