<?php
/**
 * Admin: Model Papers Manager
 */
$adminTitle = "Manage Model Papers";
require_once __DIR__ . '/includes/header.php';

$db = getDB();
$message = '';
$error = '';

// Handle Delete
if (isset($_GET['delete'])) {
    $delId = (int)$_GET['delete'];
    try {
        $st = $db->prepare("DELETE FROM model_papers WHERE id = ?");
        $st->execute([$delId]);
        $message = "Model paper removed successfully.";
    } catch (Throwable $e) {
        $error = "Error: " . $e->getMessage();
    }
}

// Handle Upload / Add
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['save_paper'])) {
    $title = sanitizeInput($_POST['title'] ?? '');
    $class_grade = sanitizeInput($_POST['class_grade'] ?? 'Class 10');
    $board = sanitizeInput($_POST['board'] ?? 'STATE');
    $stream = sanitizeInput($_POST['stream'] ?? 'General');
    $file_path = sanitizeInput($_POST['file_url'] ?? '');
    $file_size = '1.5 MB';

    // File upload
    if (isset($_FILES['pdf_file']) && $_FILES['pdf_file']['error'] === UPLOAD_ERR_OK) {
        $uploadDir = __DIR__ . '/../assets/uploads/';
        if (!is_dir($uploadDir)) mkdir($uploadDir, 0777, true);
        $ext = strtolower(pathinfo($_FILES['pdf_file']['name'], PATHINFO_EXTENSION));
        if ($ext === 'pdf') {
            $newFilename = 'paper_' . time() . '_' . rand(100, 999) . '.pdf';
            if (move_uploaded_file($_FILES['pdf_file']['tmp_name'], $uploadDir . $newFilename)) {
                $file_path = '/assets/uploads/' . $newFilename;
                $file_size = round($_FILES['pdf_file']['size'] / (1024 * 1024), 1) . ' MB';
            }
        } else {
            $error = "Only PDF files are allowed for model papers.";
        }
    }

    if (!empty($title) && !empty($file_path) && empty($error)) {
        try {
            $st = $db->prepare("INSERT INTO model_papers (title, class_grade, board, stream, file_path, file_size, download_count) VALUES (?, ?, ?, ?, ?, ?, 0)");
            $st->execute([$title, $class_grade, $board, $stream, $file_path, $file_size]);
            $message = "Model paper uploaded and available for student download.";
        } catch (Throwable $e) {
            $error = "Database error: " . $e->getMessage();
        }
    } elseif (empty($error)) {
        $error = "Please provide Paper Title and either upload a PDF or enter a valid PDF link.";
    }
}

$allPapers = $db->query("SELECT * FROM model_papers ORDER BY class_grade ASC, id DESC")->fetchAll();
$showForm = isset($_GET['action']) && $_GET['action'] === 'new';
?>

<div class="space-y-6">
  
  <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
    <div>
      <h1 class="text-2xl font-bold text-slate-900">Model Question Papers Repository</h1>
      <p class="text-xs text-slate-500 mt-0.5">Upload new practice tests or remove old PDF papers.</p>
    </div>
    <?php if (!$showForm): ?>
      <a href="/admin/model-papers.php?action=new" class="bg-tcrimson hover:bg-tcrimson-hover text-white font-bold px-4 py-2 rounded-lg text-xs shadow transition flex items-center gap-1.5">
        <span>+ Upload New Paper</span>
      </a>
    <?php else: ?>
      <a href="/admin/model-papers.php" class="bg-slate-200 hover:bg-slate-300 text-slate-700 font-semibold px-4 py-2 rounded-lg text-xs transition">
        ← Back to Papers List
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
      <h2 class="text-lg font-bold text-slate-900 border-b border-slate-100 pb-3">Upload New Model Question Paper</h2>

      <form method="POST" action="/admin/model-papers.php" enctype="multipart/form-data" class="space-y-4">
        <div>
          <label class="block text-xs font-bold text-slate-700 mb-1">Paper Title *</label>
          <input type="text" name="title" required placeholder="e.g. Into 10th Class Entrance Screening Model Paper 2025" class="w-full text-sm px-3.5 py-2.5 rounded-lg border border-slate-300 focus:ring-2 focus:ring-amber-500 outline-none">
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
          <div>
            <label class="block text-xs font-bold text-slate-700 mb-1">Grade / Class *</label>
            <select name="class_grade" class="w-full text-sm px-3.5 py-2.5 rounded-lg border border-slate-300 bg-white outline-none">
              <option value="Class 6">Class 6</option>
              <option value="Class 7">Class 7</option>
              <option value="Class 8">Class 8</option>
              <option value="Class 9">Class 9</option>
              <option value="Class 10">Class 10</option>
              <option value="Intermediate">Intermediate (11th/12th)</option>
            </select>
          </div>

          <div>
            <label class="block text-xs font-bold text-slate-700 mb-1">Board *</label>
            <select name="board" class="w-full text-sm px-3.5 py-2.5 rounded-lg border border-slate-300 bg-white outline-none">
              <option value="CBSE">CBSE</option>
              <option value="ICSE">ICSE</option>
              <option value="STATE">AP State Board</option>
              <option value="Combined">STATE & CBSE Combined</option>
            </select>
          </div>

          <div>
            <label class="block text-xs font-bold text-slate-700 mb-1">Stream Focus</label>
            <input type="text" name="stream" value="General" placeholder="e.g. MPC, BiPC, Olympiad" class="w-full text-sm px-3.5 py-2.5 rounded-lg border border-slate-300 outline-none">
          </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
          <div>
            <label class="block text-xs font-bold text-slate-700 mb-1">Upload PDF File</label>
            <input type="file" name="pdf_file" accept=".pdf" class="w-full text-xs file:py-2 file:px-3 file:rounded-md file:border-0 file:bg-slate-100 file:font-semibold">
          </div>
          <div>
            <label class="block text-xs font-bold text-slate-700 mb-1">OR External PDF URL (Optional)</label>
            <input type="url" name="file_url" placeholder="https://..." class="w-full text-sm px-3.5 py-2.5 rounded-lg border border-slate-300 outline-none">
          </div>
        </div>

        <div class="pt-3 flex items-center gap-3 border-t border-slate-100">
          <button type="submit" name="save_paper" class="bg-slate-900 hover:bg-slate-800 text-white font-bold px-6 py-2.5 rounded-lg text-xs shadow transition">
            Save & Publish Model Paper
          </button>
          <a href="/admin/model-papers.php" class="text-xs text-slate-500 hover:underline">Cancel</a>
        </div>
      </form>
    </div>
  <?php endif; ?>

  <!-- PAPERS TABLE -->
  <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
    <div class="p-5 border-b border-slate-100">
      <h2 class="text-base font-bold text-slate-900">All Model Question Papers (<?php echo count($allPapers); ?>)</h2>
    </div>

    <div class="overflow-x-auto">
      <table class="w-full text-left text-xs">
        <thead class="bg-slate-50 text-slate-500 font-semibold uppercase tracking-wider text-[10px] border-b border-slate-100">
          <tr>
            <th class="px-5 py-3">Grade</th>
            <th class="px-5 py-3">Board</th>
            <th class="px-5 py-3">Paper Title</th>
            <th class="px-5 py-3">File Size</th>
            <th class="px-5 py-3">Downloads</th>
            <th class="px-5 py-3 text-right">Actions</th>
          </tr>
        </thead>
        <tbody class="divide-y divide-slate-100 text-slate-700">
          <?php if (!empty($allPapers)): ?>
            <?php foreach ($allPapers as $p): ?>
              <tr class="hover:bg-slate-50/70">
                <td class="px-5 py-3.5 font-bold text-slate-900"><?php echo htmlspecialchars($p['class_grade']); ?></td>
                <td class="px-5 py-3.5">
                  <span class="bg-slate-100 font-bold px-2 py-0.5 rounded text-[10px]"><?php echo htmlspecialchars($p['board']); ?></span>
                </td>
                <td class="px-5 py-3.5 font-medium text-slate-800"><?php echo htmlspecialchars($p['title']); ?></td>
                <td class="px-5 py-3.5 text-slate-400"><?php echo htmlspecialchars($p['file_size']); ?></td>
                <td class="px-5 py-3.5 font-mono text-slate-500"><?php echo (int)$p['download_count']; ?></td>
                <td class="px-5 py-3.5 text-right space-x-2">
                  <a href="<?php echo htmlspecialchars($p['file_path']); ?>" target="_blank" class="text-emerald-600 hover:underline font-semibold">View PDF ↗</a>
                  <a href="/admin/model-papers.php?delete=<?php echo $p['id']; ?>" onclick="return confirm('Remove this model paper?')" class="text-red-600 hover:underline font-semibold">Delete</a>
                </td>
              </tr>
            <?php endforeach; ?>
          <?php else: ?>
            <tr>
              <td colspan="6" class="px-5 py-8 text-center text-slate-400">No model papers found.</td>
            </tr>
          <?php endif; ?>
        </tbody>
      </table>
    </div>
  </div>

</div>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
