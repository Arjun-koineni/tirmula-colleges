<?php
/**
 * Admin: Results Manager
 */
$adminTitle = "Manage Results";
require_once __DIR__ . '/includes/header.php';

$db = getDB();
$message = '';
$error = '';

// Handle Delete
if (isset($_GET['delete'])) {
    $delId = (int)$_GET['delete'];
    try {
        $delStmt = $db->prepare("DELETE FROM results WHERE id = ?");
        $delStmt->execute([$delId]);
        $message = "Result entry deleted successfully.";
    } catch (Throwable $e) {
        $error = "Error deleting result: " . $e->getMessage();
    }
}

// Handle Form Submission (Add or Edit)
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['save_result'])) {
    $id = !empty($_POST['id']) ? (int)$_POST['id'] : null;
    $student_name = sanitizeInput($_POST['student_name'] ?? '');
    $roll_number = sanitizeInput($_POST['roll_number'] ?? '');
    $stream = sanitizeInput($_POST['stream'] ?? 'MPC');
    $exam_type = sanitizeInput($_POST['exam_type'] ?? 'JEE Advanced');
    $year = (int)($_POST['year'] ?? date('Y'));
    $campus = sanitizeInput($_POST['campus'] ?? 'Rajamahendravaram');
    $score_or_rank = sanitizeInput($_POST['score_or_rank'] ?? '');
    $featured = !empty($_POST['featured']) ? 1 : 0;
    $photo_url = sanitizeInput($_POST['photo_url'] ?? 'assets/images/jee_adv_result.jpg');

    // Handle optional file upload if provided
    if (isset($_FILES['photo_file']) && $_FILES['photo_file']['error'] === UPLOAD_ERR_OK) {
        $uploadDir = __DIR__ . '/../assets/uploads/';
        if (!is_dir($uploadDir)) mkdir($uploadDir, 0777, true);
        $ext = strtolower(pathinfo($_FILES['photo_file']['name'], PATHINFO_EXTENSION));
        if (in_array($ext, ['jpg', 'jpeg', 'png', 'webp'])) {
            $newFilename = 'result_' . time() . '_' . rand(100, 999) . '.' . $ext;
            if (move_uploaded_file($_FILES['photo_file']['tmp_name'], $uploadDir . $newFilename)) {
                $photo_url = 'assets/uploads/' . $newFilename;
            }
        }
    }

    if (!empty($student_name) && !empty($roll_number) && !empty($score_or_rank)) {
        try {
            if ($id) {
                $stmt = $db->prepare("UPDATE results SET student_name=?, roll_number=?, stream=?, exam_type=?, year=?, campus=?, score_or_rank=?, photo_url=?, featured=? WHERE id=?");
                $stmt->execute([$student_name, $roll_number, $stream, $exam_type, $year, $campus, $score_or_rank, $photo_url, $featured, $id]);
                $message = "Result updated successfully.";
            } else {
                $stmt = $db->prepare("INSERT INTO results (student_name, roll_number, stream, exam_type, year, campus, score_or_rank, photo_url, featured) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
                $stmt->execute([$student_name, $roll_number, $stream, $exam_type, $year, $campus, $score_or_rank, $photo_url, $featured]);
                $message = "New student result published successfully.";
            }
        } catch (Throwable $e) {
            $error = "Error saving result: " . $e->getMessage();
        }
    } else {
        $error = "Please fill all required fields.";
    }
}

// Check if editing
$editItem = null;
if (isset($_GET['edit'])) {
    $editId = (int)$_GET['edit'];
    $st = $db->prepare("SELECT * FROM results WHERE id = ?");
    $st->execute([$editId]);
    $editItem = $st->fetch();
}

// Fetch all results
$allResults = $db->query("SELECT * FROM results ORDER BY year DESC, featured DESC, id ASC")->fetchAll();
$showForm = isset($_GET['action']) && $_GET['action'] === 'new' || $editItem !== null;
?>

<div class="space-y-6">
  
  <!-- Top Bar -->
  <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
    <div>
      <h1 class="text-2xl font-bold text-slate-900">Student Results & Ranks Manager</h1>
      <p class="text-xs text-slate-500 mt-0.5">Add, edit, or delete published exam ranks shown on the public Results and Home pages.</p>
    </div>
    <?php if (!$showForm): ?>
      <a href="/admin/results.php?action=new" class="bg-tcrimson hover:bg-tcrimson-hover text-white font-bold px-4 py-2 rounded-lg text-xs shadow transition flex items-center gap-1.5">
        <span>+ Add New Result</span>
      </a>
    <?php else: ?>
      <a href="/admin/results.php" class="bg-slate-200 hover:bg-slate-300 text-slate-700 font-semibold px-4 py-2 rounded-lg text-xs transition">
        ← Back to Results List
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

  <!-- ADD / EDIT FORM MODAL / SECTION -->
  <?php if ($showForm): ?>
    <div class="bg-white rounded-2xl p-6 sm:p-8 border border-slate-200 shadow-sm space-y-6">
      <h2 class="text-lg font-bold text-slate-900 border-b border-slate-100 pb-3">
        <?php echo $editItem ? 'Edit Result Record' : 'Add New Student Result'; ?>
      </h2>

      <form method="POST" action="/admin/results.php" enctype="multipart/form-data" class="space-y-5">
        <?php if ($editItem): ?>
          <input type="hidden" name="id" value="<?php echo $editItem['id']; ?>">
        <?php endif; ?>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
          <div>
            <label class="block text-xs font-bold text-slate-700 mb-1">Student Full Name *</label>
            <input type="text" name="student_name" required value="<?php echo htmlspecialchars($editItem['student_name'] ?? ''); ?>" placeholder="e.g. K. Sai Teja" class="w-full text-sm px-3.5 py-2.5 rounded-lg border border-slate-300 focus:ring-2 focus:ring-amber-500 outline-none">
          </div>
          <div>
            <label class="block text-xs font-bold text-slate-700 mb-1">Roll Number *</label>
            <input type="text" name="roll_number" required value="<?php echo htmlspecialchars($editItem['roll_number'] ?? ''); ?>" placeholder="e.g. TIMA202401" class="w-full text-sm px-3.5 py-2.5 rounded-lg border border-slate-300 focus:ring-2 focus:ring-amber-500 outline-none">
          </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
          <div>
            <label class="block text-xs font-bold text-slate-700 mb-1">Stream *</label>
            <select name="stream" class="w-full text-sm px-3.5 py-2.5 rounded-lg border border-slate-300 bg-white outline-none">
              <option value="MPC" <?php echo ($editItem['stream'] ?? '') === 'MPC' ? 'selected' : ''; ?>>MPC (IIT-JEE)</option>
              <option value="BiPC" <?php echo ($editItem['stream'] ?? '') === 'BiPC' ? 'selected' : ''; ?>>BiPC (NEET)</option>
              <option value="Foundation" <?php echo ($editItem['stream'] ?? '') === 'Foundation' ? 'selected' : ''; ?>>Foundation (Classes 6-10)</option>
            </select>
          </div>

          <div>
            <label class="block text-xs font-bold text-slate-700 mb-1">Exam Type *</label>
            <select name="exam_type" class="w-full text-sm px-3.5 py-2.5 rounded-lg border border-slate-300 bg-white outline-none">
              <option value="JEE Advanced" <?php echo ($editItem['exam_type'] ?? '') === 'JEE Advanced' ? 'selected' : ''; ?>>JEE Advanced</option>
              <option value="NEET" <?php echo ($editItem['exam_type'] ?? '') === 'NEET' ? 'selected' : ''; ?>>NEET</option>
              <option value="JEE Main" <?php echo ($editItem['exam_type'] ?? '') === 'JEE Main' ? 'selected' : ''; ?>>JEE Main</option>
              <option value="IPE Inter" <?php echo ($editItem['exam_type'] ?? '') === 'IPE Inter' ? 'selected' : ''; ?>>IPE Intermediate</option>
              <option value="SSC Class 10" <?php echo ($editItem['exam_type'] ?? '') === 'SSC Class 10' ? 'selected' : ''; ?>>SSC Class 10</option>
            </select>
          </div>

          <div>
            <label class="block text-xs font-bold text-slate-700 mb-1">Year *</label>
            <input type="number" name="year" required value="<?php echo htmlspecialchars($editItem['year'] ?? date('Y')); ?>" class="w-full text-sm px-3.5 py-2.5 rounded-lg border border-slate-300 outline-none">
          </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
          <div>
            <label class="block text-xs font-bold text-slate-700 mb-1">Campus *</label>
            <select name="campus" class="w-full text-sm px-3.5 py-2.5 rounded-lg border border-slate-300 bg-white outline-none">
              <option value="Rajamahendravaram" <?php echo ($editItem['campus'] ?? '') === 'Rajamahendravaram' ? 'selected' : ''; ?>>Rajamahendravaram</option>
              <option value="Visakhapatnam" <?php echo ($editItem['campus'] ?? '') === 'Visakhapatnam' ? 'selected' : ''; ?>>Visakhapatnam</option>
              <option value="Bhimavaram" <?php echo ($editItem['campus'] ?? '') === 'Bhimavaram' ? 'selected' : ''; ?>>Bhimavaram</option>
              <option value="Tanuku" <?php echo ($editItem['campus'] ?? '') === 'Tanuku' ? 'selected' : ''; ?>>Tanuku</option>
              <option value="Payakaraopeta" <?php echo ($editItem['campus'] ?? '') === 'Payakaraopeta' ? 'selected' : ''; ?>>Payakaraopeta</option>
            </select>
          </div>

          <div>
            <label class="block text-xs font-bold text-slate-700 mb-1">Score / Rank Achieved *</label>
            <input type="text" name="score_or_rank" required value="<?php echo htmlspecialchars($editItem['score_or_rank'] ?? ''); ?>" placeholder="e.g. AIR 142 (Top in AP) or 695/720" class="w-full text-sm px-3.5 py-2.5 rounded-lg border border-slate-300 outline-none">
          </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
          <div>
            <label class="block text-xs font-bold text-slate-700 mb-1">Certificate / Photo Upload (Optional)</label>
            <input type="file" name="photo_file" accept="image/*" class="w-full text-xs file:py-2 file:px-3 file:rounded-md file:border-0 file:bg-slate-100 file:font-semibold">
          </div>
          <div class="flex items-center gap-2 pt-6">
            <input type="checkbox" name="featured" id="featured" value="1" <?php echo !empty($editItem['featured']) ? 'checked' : ''; ?> class="w-4 h-4 text-tcrimson rounded">
            <label for="featured" class="text-xs font-bold text-slate-700">Feature this result on Homepage Banner</label>
          </div>
        </div>

        <div class="pt-4 flex items-center gap-3 border-t border-slate-100">
          <button type="submit" name="save_result" class="bg-slate-900 hover:bg-slate-800 text-white font-bold px-6 py-2.5 rounded-lg text-xs shadow transition">
            Save & Publish Result
          </button>
          <a href="/admin/results.php" class="text-xs text-slate-500 hover:underline">Cancel</a>
        </div>
      </form>
    </div>
  <?php endif; ?>

  <!-- RESULTS LIST TABLE -->
  <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
    <div class="p-5 border-b border-slate-100 flex items-center justify-between">
      <h2 class="text-base font-bold text-slate-900">All Published Results (<?php echo count($allResults); ?>)</h2>
      <span class="text-xs text-slate-400">Click Edit to modify student records</span>
    </div>

    <div class="overflow-x-auto">
      <table class="w-full text-left text-xs">
        <thead class="bg-slate-50 text-slate-500 font-semibold uppercase tracking-wider text-[10px] border-b border-slate-100">
          <tr>
            <th class="px-5 py-3">Student Name</th>
            <th class="px-5 py-3">Roll No</th>
            <th class="px-5 py-3">Stream / Exam</th>
            <th class="px-5 py-3">Year</th>
            <th class="px-5 py-3">Campus</th>
            <th class="px-5 py-3">Score / Rank</th>
            <th class="px-5 py-3">Home Featured</th>
            <th class="px-5 py-3 text-right">Actions</th>
          </tr>
        </thead>
        <tbody class="divide-y divide-slate-100 text-slate-700">
          <?php if (!empty($allResults)): ?>
            <?php foreach ($allResults as $row): ?>
              <tr class="hover:bg-slate-50/70">
                <td class="px-5 py-3.5 font-bold text-slate-900"><?php echo htmlspecialchars($row['student_name']); ?></td>
                <td class="px-5 py-3.5 font-mono text-slate-600"><?php echo htmlspecialchars($row['roll_number']); ?></td>
                <td class="px-5 py-3.5"><?php echo htmlspecialchars($row['exam_type']); ?> (<?php echo htmlspecialchars($row['stream']); ?>)</td>
                <td class="px-5 py-3.5 font-semibold"><?php echo htmlspecialchars($row['year']); ?></td>
                <td class="px-5 py-3.5"><?php echo htmlspecialchars($row['campus']); ?></td>
                <td class="px-5 py-3.5 font-bold text-amber-800"><?php echo htmlspecialchars($row['score_or_rank']); ?></td>
                <td class="px-5 py-3.5">
                  <?php if (!empty($row['featured'])): ?>
                    <span class="bg-emerald-100 text-emerald-800 font-bold px-2 py-0.5 rounded text-[10px]">Featured</span>
                  <?php else: ?>
                    <span class="text-slate-400">—</span>
                  <?php endif; ?>
                </td>
                <td class="px-5 py-3.5 text-right space-x-2">
                  <a href="/admin/results.php?edit=<?php echo $row['id']; ?>" class="text-blue-600 hover:underline font-semibold">Edit</a>
                  <a href="/admin/results.php?delete=<?php echo $row['id']; ?>" onclick="return confirm('Are you sure you want to delete this result?')" class="text-red-600 hover:underline font-semibold">Delete</a>
                </td>
              </tr>
            <?php endforeach; ?>
          <?php else: ?>
            <tr>
              <td colspan="8" class="px-5 py-8 text-center text-slate-400">No results found in the database.</td>
            </tr>
          <?php endif; ?>
        </tbody>
      </table>
    </div>
  </div>

</div>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
