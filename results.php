<?php
/**
 * Results Page - Tirumala IIT & Medical Academy
 * Includes interactive multi-filtering & "Check Your Result" search
 */
$pageTitle = "Results & Rankers | State Top Scores & JEE/NEET Achievements";
$currentNav = "results";
$metaDesc = "Search and verify student results from Tirumala IIT & Medical Academy across JEE Advanced, NEET, JEE Main, IPE Intermediate, and Class 10 SSC.";
require_once __DIR__ . '/includes/header.php';

$db = getDB();
$allResults = [];
try {
    $stmt = $db->query("SELECT * FROM results ORDER BY year DESC, featured DESC, id ASC");
    $allResults = $stmt->fetchAll();
} catch (Throwable $e) {}

// Pre-fill search if provided in GET
$initialSearch = isset($_GET['search']) ? trim($_GET['search']) : '';
?>

<!-- BANNER -->
<section class="bg-tirumala-gradient text-white py-14">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
    <span class="text-amber-400 font-bold text-xs uppercase tracking-widest">Hall of Fame</span>
    <h1 class="text-3xl sm:text-5xl font-extrabold text-white mt-1">Our Stellar Results & Top Rankers</h1>
    <p class="text-slate-300 text-sm sm:text-base max-w-2xl mx-auto mt-3">
      Celebrating the dedication of our students and the guidance of our faculty in national and state examinations.
    </p>
  </div>
</section>

<!-- SEARCH & FILTER TOOLBAR -->
<section class="bg-white border-b border-slate-200 sticky top-20 z-30 shadow-sm py-4">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="flex flex-col lg:flex-row items-stretch lg:items-center justify-between gap-4">
      
      <!-- Live Search Box -->
      <div class="relative flex-1 max-w-md">
        <span class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none text-slate-400">
          <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
        </span>
        <input 
          type="text" 
          id="result-search-input" 
          value="<?php echo htmlspecialchars($initialSearch); ?>" 
          placeholder="Check result by Student Name or Roll Number..." 
          class="w-full pl-9 pr-4 py-2.5 bg-slate-50 border border-slate-300 rounded-lg text-sm text-slate-800 focus:bg-white focus:ring-2 focus:ring-blue-600 focus:border-blue-600 outline-none transition"
        >
      </div>

      <!-- Filter Dropdowns -->
      <div class="flex flex-wrap items-center gap-2 text-xs">
        
        <!-- Stream Filter -->
        <select id="filter-stream" class="py-2.5 px-3 bg-slate-50 border border-slate-300 rounded-lg font-medium text-slate-700 outline-none focus:ring-1 focus:ring-blue-600">
          <option value="all">All Streams</option>
          <option value="MPC">MPC (IIT-JEE)</option>
          <option value="BiPC">BiPC (NEET)</option>
          <option value="Foundation">Foundation</option>
        </select>

        <!-- Exam Filter -->
        <select id="filter-exam" class="py-2.5 px-3 bg-slate-50 border border-slate-300 rounded-lg font-medium text-slate-700 outline-none focus:ring-1 focus:ring-blue-600">
          <option value="all">All Exams</option>
          <option value="JEE Advanced">JEE Advanced</option>
          <option value="NEET">NEET</option>
          <option value="JEE Main">JEE Main</option>
          <option value="IPE Inter">IPE Intermediate</option>
          <option value="SSC Class 10">SSC Class 10</option>
        </select>

        <!-- Campus Filter -->
        <select id="filter-campus" class="py-2.5 px-3 bg-slate-50 border border-slate-300 rounded-lg font-medium text-slate-700 outline-none focus:ring-1 focus:ring-blue-600">
          <option value="all">All Campuses</option>
          <option value="Rajamahendravaram">Rajamahendravaram</option>
          <option value="Visakhapatnam">Visakhapatnam</option>
          <option value="Bhimavaram">Bhimavaram</option>
          <option value="Tanuku">Tanuku</option>
          <option value="Payakaraopeta">Payakaraopeta</option>
        </select>

        <!-- Year Filter -->
        <select id="filter-year" class="py-2.5 px-3 bg-slate-50 border border-slate-300 rounded-lg font-medium text-slate-700 outline-none focus:ring-1 focus:ring-blue-600">
          <option value="all">All Years</option>
          <option value="2024">2024</option>
          <option value="2023">2023</option>
          <option value="2022">2022</option>
        </select>

        <!-- Reset Button -->
        <button id="clear-filters-btn" class="py-2.5 px-3 bg-slate-200 hover:bg-slate-300 text-slate-700 rounded-lg font-semibold transition">
          Reset
        </button>

      </div>

    </div>

    <!-- Active Match Count -->
    <div class="mt-2 text-[11px] text-slate-500 flex justify-between items-center">
      <span id="results-count-text">Showing <?php echo count($allResults); ?> results</span>
      <span class="text-slate-400">Database updated live</span>
    </div>
  </div>
</section>

<!-- RESULTS GRID SECTION -->
<section class="py-12 bg-slate-50">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    
    <div id="results-grid" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
      <?php foreach ($allResults as $item): ?>
        <div 
          class="result-card bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden card-hover-lift flex flex-col justify-between"
          data-name="<?php echo htmlspecialchars($item['student_name']); ?>"
          data-roll="<?php echo htmlspecialchars($item['roll_number']); ?>"
          data-stream="<?php echo htmlspecialchars($item['stream']); ?>"
          data-exam="<?php echo htmlspecialchars($item['exam_type']); ?>"
          data-campus="<?php echo htmlspecialchars($item['campus']); ?>"
          data-year="<?php echo htmlspecialchars($item['year']); ?>"
        >
          <div>
            <!-- Card Header Badge -->
            <div class="p-5 pb-3 border-b border-slate-100 flex items-center justify-between">
              <span class="bg-blue-50 text-tnavy border border-blue-200 text-[11px] font-bold px-2.5 py-0.5 rounded-full">
                <?php echo htmlspecialchars($item['exam_type']); ?>
              </span>
              <span class="text-xs text-slate-400 font-semibold"><?php echo htmlspecialchars($item['year']); ?></span>
            </div>

            <!-- Student Profile & Score -->
            <div class="p-5 space-y-3">
              <?php
                $itemPhoto = '/assets/images/round_logo.png';
                $sName = $item['student_name'];
                if (stripos($sName, 'Sai Teja') !== false) {
                    $itemPhoto = '/assets/images/student_sai_teja.jpg';
                } elseif (stripos($sName, 'Sravani') !== false) {
                    $itemPhoto = '/assets/images/student_sravani.jpg';
                } elseif (stripos($sName, 'Rohan') !== false) {
                    $itemPhoto = '/assets/images/student_rohan.jpg';
                } elseif (stripos($sName, 'Harshitha') !== false) {
                    $itemPhoto = '/assets/images/student_harshitha.jpg';
                } elseif (stripos($sName, 'Lokesh') !== false) {
                    $itemPhoto = '/assets/images/student_lokesh.jpg';
                }
              ?>
              <div class="flex items-center gap-3.5">
                <img src="<?php echo htmlspecialchars($itemPhoto); ?>" alt="<?php echo htmlspecialchars($item['student_name']); ?>" class="w-14 h-14 rounded-full object-cover border-2 border-amber-400 ring-2 ring-amber-100 flex-shrink-0 shadow-sm">
                <div class="min-w-0">
                  <h3 class="text-base font-bold text-slate-900 leading-tight truncate"><?php echo htmlspecialchars($item['student_name']); ?></h3>
                  <p class="text-xs text-slate-500 mt-0.5">Roll No: <span class="font-mono font-semibold text-slate-700"><?php echo htmlspecialchars($item['roll_number']); ?></span></p>
                </div>
              </div>

              <div class="bg-gradient-to-br from-amber-50 to-orange-50 border border-amber-200/80 rounded-lg p-3">
                <span class="text-[10px] font-bold uppercase tracking-wider text-amber-800 block">Achievement / Rank</span>
                <span class="text-base font-black text-amber-950"><?php echo htmlspecialchars($item['score_or_rank']); ?></span>
              </div>

              <div class="text-xs text-slate-600 space-y-1 pt-1">
                <p><strong class="text-slate-700">Stream:</strong> <?php echo htmlspecialchars($item['stream']); ?></p>
                <p><strong class="text-slate-700">Campus:</strong> <?php echo htmlspecialchars($item['campus']); ?></p>
              </div>
            </div>
          </div>

          <!-- Card Footer Action -->
          <div class="bg-slate-50 px-5 py-3 border-t border-slate-100 flex items-center justify-between text-xs">
            <?php if (!empty($item['photo_url'])): ?>
              <button 
                data-lightbox="/<?php echo htmlspecialchars($item['photo_url']); ?>" 
                data-caption="<?php echo htmlspecialchars($item['student_name'] . ' - ' . $item['score_or_rank'] . ' (' . $item['exam_type'] . ')'); ?>"
                class="text-blue-700 hover:underline font-semibold flex items-center gap-1"
              >
                <span>View Certificate</span>
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
              </button>
            <?php else: ?>
              <span class="text-slate-400">Verified Result</span>
            <?php endif; ?>
            <span class="text-emerald-600 font-medium">âœ“ Verified</span>
          </div>
        </div>
      <?php endforeach; ?>
    </div>

    <!-- Empty State -->
    <div id="results-empty-state" class="hidden text-center py-16 bg-white rounded-2xl border border-dashed border-slate-300 mt-6 space-y-3">
      <div class="text-4xl">ðŸ”</div>
      <h3 class="text-lg font-bold text-slate-800">No matching student result found</h3>
      <p class="text-xs text-slate-500 max-w-sm mx-auto">
        Please check the spelling of the name, enter the complete roll number (e.g. TIMA202401), or clear filters.
      </p>
      <button onclick="document.getElementById('clear-filters-btn').click()" class="text-xs bg-slate-900 text-white px-4 py-2 rounded-md font-semibold hover:bg-slate-800">
        Reset Search & Filters
      </button>
    </div>

  </div>
</section>

<!-- SEARCH LOGIC SCRIPT -->
<script src="/assets/js/results-search.js"></script>

<?php require_once __DIR__ . '/includes/footer.php'; ?>

