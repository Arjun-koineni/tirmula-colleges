<?php
/**
 * Model Papers Page - Tirumala IIT & Medical Academy
 * Organized by Class / Board, filterable and directly downloadable
 */
$pageTitle = "Model Question Papers | Class 6 to Intermediate (CBSE, ICSE, State)";
$currentNav = "model-papers";
$metaDesc = "Download authentic Tirumala Academy entrance and curriculum model papers for Classes 6th through Intermediate across CBSE, ICSE, and State Board.";
require_once __DIR__ . '/includes/header.php';

$db = getDB();
$papers = [];
try {
    $stmt = $db->query("SELECT * FROM model_papers ORDER BY class_grade ASC, board ASC");
    $papers = $stmt->fetchAll();
} catch (Throwable $e) {}

$selectedClass = isset($_GET['class']) ? trim($_GET['class']) : 'All';
$selectedBoard = isset($_GET['board']) ? trim($_GET['board']) : 'All';
?>

<!-- BANNER -->
<section class="bg-tirumala-gradient text-white py-14">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
    <span class="text-amber-400 font-bold text-xs uppercase tracking-widest">Academic Resources</span>
    <h1 class="text-3xl sm:text-5xl font-extrabold text-white mt-1">Download Model Question Papers</h1>
    <p class="text-slate-300 text-sm sm:text-base max-w-2xl mx-auto mt-3">
      Curated practice papers developed by senior Tirumala subject faculty to help students benchmark their preparation.
    </p>
  </div>
</section>

<!-- FILTERS SECTION -->
<section class="bg-white border-b border-slate-200 py-6">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="flex flex-col md:flex-row items-center justify-between gap-4">
      
      <!-- Class Filter Chips -->
      <div class="flex items-center gap-2 overflow-x-auto pb-2 md:pb-0 w-full md:w-auto text-xs font-semibold">
        <span class="text-slate-500 font-bold mr-1">Grade:</span>
        <a href="/model-papers.php?class=All&board=<?php echo urlencode($selectedBoard); ?>" class="px-3 py-1.5 rounded-full transition whitespace-nowrap <?php echo $selectedClass === 'All' ? 'bg-tnavy text-white' : 'bg-slate-100 text-slate-700 hover:bg-slate-200'; ?>">All Classes</a>
        <a href="/model-papers.php?class=Class 6&board=<?php echo urlencode($selectedBoard); ?>" class="px-3 py-1.5 rounded-full transition whitespace-nowrap <?php echo $selectedClass === 'Class 6' ? 'bg-tnavy text-white' : 'bg-slate-100 text-slate-700 hover:bg-slate-200'; ?>">Class 6</a>
        <a href="/model-papers.php?class=Class 7&board=<?php echo urlencode($selectedBoard); ?>" class="px-3 py-1.5 rounded-full transition whitespace-nowrap <?php echo $selectedClass === 'Class 7' ? 'bg-tnavy text-white' : 'bg-slate-100 text-slate-700 hover:bg-slate-200'; ?>">Class 7</a>
        <a href="/model-papers.php?class=Class 8&board=<?php echo urlencode($selectedBoard); ?>" class="px-3 py-1.5 rounded-full transition whitespace-nowrap <?php echo $selectedClass === 'Class 8' ? 'bg-tnavy text-white' : 'bg-slate-100 text-slate-700 hover:bg-slate-200'; ?>">Class 8</a>
        <a href="/model-papers.php?class=Class 9&board=<?php echo urlencode($selectedBoard); ?>" class="px-3 py-1.5 rounded-full transition whitespace-nowrap <?php echo $selectedClass === 'Class 9' ? 'bg-tnavy text-white' : 'bg-slate-100 text-slate-700 hover:bg-slate-200'; ?>">Class 9</a>
        <a href="/model-papers.php?class=Class 10&board=<?php echo urlencode($selectedBoard); ?>" class="px-3 py-1.5 rounded-full transition whitespace-nowrap <?php echo $selectedClass === 'Class 10' ? 'bg-tnavy text-white' : 'bg-slate-100 text-slate-700 hover:bg-slate-200'; ?>">Class 10</a>
        <a href="/model-papers.php?class=Intermediate&board=<?php echo urlencode($selectedBoard); ?>" class="px-3 py-1.5 rounded-full transition whitespace-nowrap <?php echo $selectedClass === 'Intermediate' ? 'bg-tnavy text-white' : 'bg-slate-100 text-slate-700 hover:bg-slate-200'; ?>">Intermediate</a>
      </div>

      <!-- Board Filter -->
      <div class="flex items-center gap-2 text-xs">
        <label for="board-filter" class="text-slate-500 font-bold whitespace-nowrap">Board / Syllabus:</label>
        <select 
          id="board-filter" 
          onchange="location.href='/model-papers.php?class=<?php echo urlencode($selectedClass); ?>&board=' + this.value"
          class="bg-slate-50 border border-slate-300 rounded-md py-1.5 px-3 text-xs font-semibold text-slate-700 outline-none focus:ring-1 focus:ring-blue-600"
        >
          <option value="All" <?php echo $selectedBoard === 'All' ? 'selected' : ''; ?>>All Boards</option>
          <option value="CBSE" <?php echo $selectedBoard === 'CBSE' ? 'selected' : ''; ?>>CBSE</option>
          <option value="ICSE" <?php echo $selectedBoard === 'ICSE' ? 'selected' : ''; ?>>ICSE</option>
          <option value="STATE" <?php echo $selectedBoard === 'STATE' ? 'selected' : ''; ?>>AP State Board</option>
        </select>
      </div>

    </div>
  </div>
</section>

<!-- PAPERS LIST -->
<section class="py-12 bg-slate-50">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
      <?php
      $filteredPapers = array_filter($papers, function($p) use ($selectedClass, $selectedBoard) {
          $matchClass = ($selectedClass === 'All' || $p['class_grade'] === $selectedClass);
          $matchBoard = ($selectedBoard === 'All' || stripos($p['board'], $selectedBoard) !== false);
          return $matchClass && $matchBoard;
      });
      ?>

      <?php if (!empty($filteredPapers)): ?>
        <?php foreach ($filteredPapers as $item): ?>
          <div class="bg-white rounded-xl p-6 shadow-sm border border-slate-200 card-hover-lift flex flex-col justify-between space-y-4">
            <div>
              <div class="flex items-center justify-between gap-2 mb-2">
                <span class="bg-blue-50 text-blue-700 font-bold text-[11px] px-2.5 py-0.5 rounded border border-blue-200">
                  <?php echo htmlspecialchars($item['class_grade']); ?>
                </span>
                <span class="text-xs font-semibold text-slate-500">
                  <?php echo htmlspecialchars($item['board']); ?>
                </span>
              </div>
              <h3 class="font-bold text-slate-900 text-base leading-snug"><?php echo htmlspecialchars($item['title']); ?></h3>
              <p class="text-xs text-slate-400 mt-1">Format: PDF Document • <?php echo htmlspecialchars($item['file_size'] ?: '1.5 MB'); ?></p>
            </div>

            <div class="pt-2 border-t border-slate-100 flex items-center justify-between">
              <span class="text-[11px] text-slate-400 flex items-center gap-1">
                <svg class="w-3.5 h-3.5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M9 19l3 3m0 0l3-3m-3 3V10"/></svg>
                <span><?php echo (int)($item['download_count'] ?: 300); ?> downloads</span>
              </span>

              <a 
                href="<?php echo htmlspecialchars($item['file_path']); ?>" 
                target="_blank" 
                rel="noopener noreferrer" 
                class="bg-tnavy hover:bg-slate-900 text-white text-xs font-bold px-4 py-2 rounded-lg transition flex items-center gap-1.5 shadow-sm"
              >
                <span>Download PDF</span>
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/></svg>
              </a>
            </div>
          </div>
        <?php endforeach; ?>
      <?php else: ?>
        <div class="col-span-full text-center py-16 bg-white rounded-xl border border-dashed border-slate-300">
          <p class="text-slate-500 text-sm">No model papers match the selected grade and board.</p>
          <a href="/model-papers.php" class="text-xs text-tcrimson font-bold hover:underline mt-2 inline-block">Reset Filters</a>
        </div>
      <?php endif; ?>
    </div>

  </div>
</section>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
