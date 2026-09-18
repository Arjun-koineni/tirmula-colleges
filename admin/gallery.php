<?php
/**
 * Admin: Photo Gallery Manager
 */
$adminTitle = "Manage Photo Gallery";
require_once __DIR__ . '/includes/header.php';

$db = getDB();
$message = '';
$error = '';

// Handle Delete
if (isset($_GET['delete'])) {
    $delId = (int)$_GET['delete'];
    try {
        $st = $db->prepare("DELETE FROM gallery WHERE id = ?");
        $st->execute([$delId]);
        $message = "Photo removed from gallery.";
    } catch (Throwable $e) {
        $error = "Error deleting: " . $e->getMessage();
    }
}

// Handle Form Submission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['save_photo'])) {
    $title = sanitizeInput($_POST['title'] ?? '');
    $category = sanitizeInput($_POST['category'] ?? 'Events');
    $caption = sanitizeInput($_POST['caption'] ?? '');
    $image_url = sanitizeInput($_POST['image_url'] ?? '');

    // Image Upload
    if (isset($_FILES['image_file']) && $_FILES['image_file']['error'] === UPLOAD_ERR_OK) {
        $uploadDir = __DIR__ . '/../assets/uploads/';
        if (!is_dir($uploadDir)) mkdir($uploadDir, 0777, true);
        $ext = strtolower(pathinfo($_FILES['image_file']['name'], PATHINFO_EXTENSION));
        if (in_array($ext, ['jpg', 'jpeg', 'png', 'webp'])) {
            $newFilename = 'gal_' . time() . '_' . rand(100, 999) . '.' . $ext;
            if (move_uploaded_file($_FILES['image_file']['tmp_name'], $uploadDir . $newFilename)) {
                $image_url = 'assets/uploads/' . $newFilename;
            }
        } else {
            $error = "Only image formats (JPG, PNG, WebP) are allowed.";
        }
    }

    if (!empty($title) && !empty($image_url) && empty($error)) {
        try {
            $st = $db->prepare("INSERT INTO gallery (title, category, image_url, caption) VALUES (?, ?, ?, ?)");
            $st->execute([$title, $category, $image_url, $caption]);
            $message = "Image added to gallery.";
        } catch (Throwable $e) {
            $error = "Database error: " . $e->getMessage();
        }
    } elseif (empty($error)) {
        $error = "Please provide an Image Title and select an image file.";
    }
}

$allPhotos = $db->query("SELECT * FROM gallery ORDER BY id DESC")->fetchAll();
$showForm = isset($_GET['action']) && $_GET['action'] === 'new';
?>

<div class="space-y-6">
  
  <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
    <div>
      <h1 class="text-2xl font-bold text-slate-900">Photo Gallery Manager</h1>
      <p class="text-xs text-slate-500 mt-0.5">Upload, categorize, or delete photos in Events, Results, and Games.</p>
    </div>
    <?php if (!$showForm): ?>
      <a href="/admin/gallery.php?action=new" class="bg-tnavy hover:bg-slate-900 text-white font-bold px-4 py-2 rounded-lg text-xs shadow transition flex items-center gap-1.5">
        <span>+ Add Gallery Photo</span>
      </a>
    <?php else: ?>
      <a href="/admin/gallery.php" class="bg-slate-200 hover:bg-slate-300 text-slate-700 font-semibold px-4 py-2 rounded-lg text-xs transition">
        ← Back to Gallery
      </a>
    <?php endif; ?>
  </div>

  <?php if ($message): ?>
    <div class="bg-emerald-50 border-l-4 border-emerald-500 text-emerald-800 p-3 text-xs rounded shadow-sm">
      <?php echo htmlspecialchars($message); ?>
    </div>
  <?php endif; ?>

  <?php if ($error): ?>
    <div class="bg-red-50 border-l-4 border-red-500 text-red-800 p-3 text-xs rounded shadow-sm">
      <?php echo htmlspecialchars($error); ?>
    </div>
  <?php endif; ?>

  <!-- UPLOAD FORM -->
  <?php if ($showForm): ?>
    <div class="bg-white rounded-2xl p-6 sm:p-8 border border-slate-200 shadow-sm space-y-5">
      <h2 class="text-lg font-bold text-slate-900 border-b border-slate-100 pb-3">Upload New Gallery Photo</h2>

      <form method="POST" action="/admin/gallery.php" enctype="multipart/form-data" class="space-y-4">
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
          <div>
            <label class="block text-xs font-bold text-slate-700 mb-1">Photo Title *</label>
            <input type="text" name="title" required placeholder="e.g. State Science Fair Winners 2025" class="w-full text-sm px-3.5 py-2.5 rounded-lg border border-slate-300 focus:ring-2 focus:ring-amber-500 outline-none">
          </div>
          <div>
            <label class="block text-xs font-bold text-slate-700 mb-1">Category *</label>
            <select name="category" class="w-full text-sm px-3.5 py-2.5 rounded-lg border border-slate-300 bg-white outline-none">
              <option value="Events">Events & Annual Day</option>
              <option value="Results">Results & Felicitations</option>
              <option value="Games">Sports & Games</option>
              <option value="Facilities">Campus & Facilities</option>
            </select>
          </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
          <div>
            <label class="block text-xs font-bold text-slate-700 mb-1">Upload Image File (JPG/PNG/WebP) *</label>
            <input type="file" name="image_file" accept="image/*" class="w-full text-xs file:py-2 file:px-3 file:rounded-md file:border-0 file:bg-slate-100 file:font-semibold">
          </div>
          <div>
            <label class="block text-xs font-bold text-slate-700 mb-1">OR Existing Image URL Path</label>
            <input type="text" name="image_url" placeholder="assets/images/round_logo.png" class="w-full text-sm px-3.5 py-2.5 rounded-lg border border-slate-300 outline-none">
          </div>
        </div>

        <div>
          <label class="block text-xs font-bold text-slate-700 mb-1">Caption / Short Description</label>
          <input type="text" name="caption" placeholder="Short description explaining the photo..." class="w-full text-sm px-3.5 py-2.5 rounded-lg border border-slate-300 outline-none">
        </div>

        <div class="pt-3 flex items-center gap-3 border-t border-slate-100">
          <button type="submit" name="save_photo" class="bg-slate-900 hover:bg-slate-800 text-white font-bold px-6 py-2.5 rounded-lg text-xs shadow transition">
            Add to Gallery
          </button>
          <a href="/admin/gallery.php" class="text-xs text-slate-500 hover:underline">Cancel</a>
        </div>
      </form>
    </div>
  <?php endif; ?>

  <!-- GALLERY THUMBNAIL GRID -->
  <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
    <?php if (!empty($allPhotos)): ?>
      <?php foreach ($allPhotos as $pic): ?>
        <div class="bg-white rounded-xl border border-slate-200 overflow-hidden shadow-sm flex flex-col justify-between">
          <div class="aspect-[4/3] bg-slate-100 relative overflow-hidden">
            <img src="/<?php echo htmlspecialchars($pic['image_url']); ?>" alt="" class="w-full h-full object-cover">
            <span class="absolute top-2 right-2 bg-slate-900/80 text-amber-400 text-[10px] font-bold px-2 py-0.5 rounded shadow">
              <?php echo htmlspecialchars($pic['category']); ?>
            </span>
          </div>
          <div class="p-4 space-y-1">
            <h3 class="font-bold text-slate-900 text-xs truncate"><?php echo htmlspecialchars($pic['title']); ?></h3>
            <p class="text-[11px] text-slate-500 line-clamp-2"><?php echo htmlspecialchars($pic['caption'] ?: 'No caption provided.'); ?></p>
          </div>
          <div class="bg-slate-50 px-4 py-2.5 border-t border-slate-100 flex items-center justify-between text-xs">
            <a href="/<?php echo htmlspecialchars($pic['image_url']); ?>" target="_blank" class="text-blue-600 hover:underline">View Full</a>
            <a href="/admin/gallery.php?delete=<?php echo $pic['id']; ?>" onclick="return confirm('Remove this image from gallery?')" class="text-red-600 hover:underline font-semibold">Delete</a>
          </div>
        </div>
      <?php endforeach; ?>
    <?php else: ?>
      <div class="col-span-full text-center py-12 bg-white rounded-xl border border-dashed border-slate-300">
        <p class="text-slate-400 text-xs">No photos in the gallery yet.</p>
      </div>
    <?php endif; ?>
  </div>

</div>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
