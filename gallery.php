<?php
/**
 * Photo Gallery - Tirumala IIT & Medical Academy
 * Categories: Events, Results, Games, Facilities
 */
$pageTitle = "Photo Gallery | Campus Events, Sports & Celebrations";
$currentNav = "gallery";
$metaDesc = "Explore life at Tirumala Academy: Annual day celebrations, state rank felicitations, sports championships, and campus life.";
require_once __DIR__ . '/includes/header.php';

$activeCat = isset($_GET['cat']) ? trim($_GET['cat']) : 'All';

$db = getDB();
$photos = [];
try {
    if ($activeCat !== 'All') {
        $stmt = $db->prepare("SELECT * FROM gallery WHERE category = ? ORDER BY id DESC");
        $stmt->execute([$activeCat]);
    } else {
        $stmt = $db->query("SELECT * FROM gallery ORDER BY id DESC");
    }
    $photos = $stmt->fetchAll();
} catch (Throwable $e) {}
?>

<!-- BANNER -->
<section class="bg-tirumala-gradient text-white py-14">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
    <span class="text-amber-400 font-bold text-xs uppercase tracking-widest">Campus Memories & Achievements</span>
    <h1 class="text-3xl sm:text-5xl font-extrabold text-white mt-1">Life at Tirumala Academy</h1>
    <p class="text-slate-300 text-sm sm:text-base max-w-2xl mx-auto mt-3">
      A visual glimpse into academic celebrations, sports tournaments, merit felicitations, and student milestones.
    </p>
  </div>
</section>

<!-- CATEGORY FILTER TABS -->
<section class="bg-white border-b border-slate-200 sticky top-20 z-30 shadow-sm py-4">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="flex items-center justify-center gap-2 flex-wrap text-xs sm:text-sm font-semibold">
      
      <a href="/gallery.php?cat=All" class="px-4 py-2 rounded-full transition <?php echo $activeCat === 'All' ? 'bg-blue-700 text-white shadow-md' : 'bg-slate-100 text-slate-700 hover:bg-slate-200'; ?>">
        All Moments
      </a>

      <a href="/gallery.php?cat=Events" class="px-4 py-2 rounded-full transition <?php echo $activeCat === 'Events' ? 'bg-blue-700 text-white shadow-md' : 'bg-slate-100 text-slate-700 hover:bg-slate-200'; ?>">
        🎉 Events & Annual Day
      </a>

      <a href="/gallery.php?cat=Results" class="px-4 py-2 rounded-full transition <?php echo $activeCat === 'Results' ? 'bg-blue-700 text-white shadow-md' : 'bg-slate-100 text-slate-700 hover:bg-slate-200'; ?>">
        🏆 Felicitations & Ranks
      </a>

      <a href="/gallery.php?cat=Games" class="px-4 py-2 rounded-full transition <?php echo $activeCat === 'Games' ? 'bg-blue-700 text-white shadow-md' : 'bg-slate-100 text-slate-700 hover:bg-slate-200'; ?>">
        ⚽ Sports & Games
      </a>

    </div>
  </div>
</section>

<!-- GALLERY GRID -->
<section class="py-14 bg-slate-50">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
      <?php if (!empty($photos)): ?>
        <?php foreach ($photos as $img): ?>
          <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden group card-hover-lift flex flex-col justify-between">
            <div class="relative overflow-hidden aspect-[4/3] bg-slate-100">
              <img 
                src="/<?php echo htmlspecialchars($img['image_url']); ?>" 
                alt="<?php echo htmlspecialchars($img['title']); ?>"
                loading="lazy"
                class="w-full h-full object-cover transition duration-500 group-hover:scale-105"
              >
              <div class="absolute inset-0 bg-gradient-to-t from-slate-950/80 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition flex items-end p-4">
                <button 
                  data-lightbox="/<?php echo htmlspecialchars($img['image_url']); ?>" 
                  data-caption="<?php echo htmlspecialchars($img['title'] . ' — ' . ($img['caption'] ?: '')); ?>"
                  class="bg-white/90 hover:bg-white text-slate-950 font-bold px-3 py-1.5 rounded text-xs flex items-center gap-1.5 shadow"
                >
                  <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v6m3-3H7"/></svg>
                  <span>Enlarge Photo</span>
                </button>
              </div>
              <span class="absolute top-3 right-3 bg-slate-900/80 backdrop-blur-sm text-amber-400 text-[10px] font-bold px-2 py-0.5 rounded shadow">
                <?php echo htmlspecialchars($img['category']); ?>
              </span>
            </div>

            <div class="p-4 space-y-1">
              <h3 class="font-bold text-slate-900 text-sm"><?php echo htmlspecialchars($img['title']); ?></h3>
              <?php if (!empty($img['caption'])): ?>
                <p class="text-xs text-slate-500 line-clamp-2"><?php echo htmlspecialchars($img['caption']); ?></p>
              <?php endif; ?>
            </div>
          </div>
        <?php endforeach; ?>
      <?php else: ?>
        <div class="col-span-full text-center py-16 bg-white rounded-xl border border-dashed border-slate-300">
          <p class="text-slate-500 text-sm">No photos found in this category.</p>
        </div>
      <?php endif; ?>
    </div>

  </div>
</section>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
