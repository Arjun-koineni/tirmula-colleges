<?php
/**
 * Admin: Notices & Announcements Manager
 */
$adminTitle = "Manage Notices";
require_once __DIR__ . '/includes/header.php';

$db = getDB();
$message = '';
$error = '';

// Handle Delete
if (isset($_GET['delete'])) {
    $delId = (int)$_GET['delete'];
    try {
        $st = $db->prepare("DELETE FROM notices WHERE id = ?");
        $st->execute([$delId]);
        $message = "Notice deleted successfully.";
    } catch (Throwable $e) {
        $error = "Error: " . $e->getMessage();
    }
}

// Handle Form Submission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['save_notice'])) {
    $id = !empty($_POST['id']) ? (int)$_POST['id'] : null;
    $title = sanitizeInput($_POST['title'] ?? '');
    $content = sanitizeInput($_POST['content'] ?? '');
    $link_url = sanitizeInput($_POST['link_url'] ?? '/admissions.php');
    $badge_type = sanitizeInput($_POST['badge_type'] ?? 'Urgent');
    $is_active = !empty($_POST['is_active']) ? 1 : 0;

    if (!empty($title)) {
        try {
            if ($id) {
                $st = $db->prepare("UPDATE notices SET title=?, content=?, link_url=?, badge_type=?, is_active=? WHERE id=?");
                $st->execute([$title, $content, $link_url, $badge_type, $is_active, $id]);
                $message = "Announcement updated successfully.";
            } else {
                $st = $db->prepare("INSERT INTO notices (title, content, link_url, badge_type, is_active) VALUES (?, ?, ?, ?, ?)");
                $st->execute([$title, $content, $link_url, $badge_type, $is_active]);
                $message = "Announcement created and published.";
            }
        } catch (Throwable $e) {
            $error = "Database error: " . $e->getMessage();
        }
    } else {
        $error = "Notice Title is required.";
    }
}

$editItem = null;
if (isset($_GET['edit'])) {
    $editId = (int)$_GET['edit'];
    $st = $db->prepare("SELECT * FROM notices WHERE id = ?");
    $st->execute([$editId]);
    $editItem = $st->fetch();
}

$allNotices = $db->query("SELECT * FROM notices ORDER BY id DESC")->fetchAll();
$showForm = isset($_GET['action']) && $_GET['action'] === 'new' || $editItem !== null;
?>

<div class="space-y-6">
  
  <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
    <div>
      <h1 class="text-2xl font-bold text-slate-900">Homepage Notices & Top Banner</h1>
      <p class="text-xs text-slate-500 mt-0.5">Control the top announcement bar shown across every public page.</p>
    </div>
    <?php if (!$showForm): ?>
      <a href="/admin/notices.php?action=new" class="bg-tnavy hover:bg-slate-900 text-white font-bold px-4 py-2 rounded-lg text-xs shadow transition flex items-center gap-1.5">
        <span>+ Post New Notice</span>
      </a>
    <?php else: ?>
      <a href="/admin/notices.php" class="bg-slate-200 hover:bg-slate-300 text-slate-700 font-semibold px-4 py-2 rounded-lg text-xs transition">
        ← Back to Notices List
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

  <?php if ($showForm): ?>
    <div class="bg-white rounded-2xl p-6 sm:p-8 border border-slate-200 shadow-sm space-y-5">
      <h2 class="text-lg font-bold text-slate-900 border-b border-slate-100 pb-3">
        <?php echo $editItem ? 'Edit Announcement' : 'Post New Announcement'; ?>
      </h2>

      <form method="POST" action="/admin/notices.php" class="space-y-4">
        <?php if ($editItem): ?>
          <input type="hidden" name="id" value="<?php echo $editItem['id']; ?>">
        <?php endif; ?>

        <div>
          <label class="block text-xs font-bold text-slate-700 mb-1">Notice Headline / Banner Text *</label>
          <input type="text" name="title" required value="<?php echo htmlspecialchars($editItem['title'] ?? ''); ?>" placeholder="e.g. Admissions Open for Academic Year 2025-26" class="w-full text-sm px-3.5 py-2.5 rounded-lg border border-slate-300 focus:ring-2 focus:ring-amber-500 outline-none">
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
          <div>
            <label class="block text-xs font-bold text-slate-700 mb-1">Badge Tag</label>
            <select name="badge_type" class="w-full text-sm px-3.5 py-2.5 rounded-lg border border-slate-300 bg-white outline-none">
              <option value="Urgent" <?php echo ($editItem['badge_type'] ?? '') === 'Urgent' ? 'selected' : ''; ?>>Urgent (Red)</option>
              <option value="Admission" <?php echo ($editItem['badge_type'] ?? '') === 'Admission' ? 'selected' : ''; ?>>Admission (Amber)</option>
              <option value="New" <?php echo ($editItem['badge_type'] ?? '') === 'New' ? 'selected' : ''; ?>>New Announcement</option>
              <option value="Exam" <?php echo ($editItem['badge_type'] ?? '') === 'Exam' ? 'selected' : ''; ?>>Exam Notice</option>
            </select>
          </div>

          <div>
            <label class="block text-xs font-bold text-slate-700 mb-1">Clickable Link (Optional)</label>
            <input type="text" name="link_url" value="<?php echo htmlspecialchars($editItem['link_url'] ?? '/admissions.php'); ?>" placeholder="/admissions.php" class="w-full text-sm px-3.5 py-2.5 rounded-lg border border-slate-300 outline-none">
          </div>

          <div class="flex items-center gap-2 pt-6">
            <input type="checkbox" name="is_active" id="is_active" value="1" <?php echo (!isset($editItem) || !empty($editItem['is_active'])) ? 'checked' : ''; ?> class="w-4 h-4 text-tnavy rounded">
            <label for="is_active" class="text-xs font-bold text-slate-700">Display Active on Website</label>
          </div>
        </div>

        <div>
          <label class="block text-xs font-bold text-slate-700 mb-1">Full Notice Details (Optional)</label>
          <textarea name="content" rows="3" placeholder="Provide extra details or instructions for visitors..." class="w-full text-sm px-3.5 py-2.5 rounded-lg border border-slate-300 outline-none"><?php echo htmlspecialchars($editItem['content'] ?? ''); ?></textarea>
        </div>

        <div class="pt-3 flex items-center gap-3 border-t border-slate-100">
          <button type="submit" name="save_notice" class="bg-slate-900 hover:bg-slate-800 text-white font-bold px-6 py-2.5 rounded-lg text-xs shadow transition">
            Save Notice
          </button>
          <a href="/admin/notices.php" class="text-xs text-slate-500 hover:underline">Cancel</a>
        </div>
      </form>
    </div>
  <?php endif; ?>

  <!-- NOTICES TABLE -->
  <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
    <div class="p-5 border-b border-slate-100">
      <h2 class="text-base font-bold text-slate-900">Current Announcements</h2>
    </div>

    <div class="overflow-x-auto">
      <table class="w-full text-left text-xs">
        <thead class="bg-slate-50 text-slate-500 font-semibold uppercase tracking-wider text-[10px] border-b border-slate-100">
          <tr>
            <th class="px-5 py-3">Tag</th>
            <th class="px-5 py-3">Notice Title</th>
            <th class="px-5 py-3">Link Destination</th>
            <th class="px-5 py-3">Status</th>
            <th class="px-5 py-3 text-right">Actions</th>
          </tr>
        </thead>
        <tbody class="divide-y divide-slate-100 text-slate-700">
          <?php if (!empty($allNotices)): ?>
            <?php foreach ($allNotices as $n): ?>
              <tr class="hover:bg-slate-50/70">
                <td class="px-5 py-3.5">
                  <span class="bg-red-100 text-red-800 font-bold px-2 py-0.5 rounded text-[10px]">
                    <?php echo htmlspecialchars($n['badge_type']); ?>
                  </span>
                </td>
                <td class="px-5 py-3.5 font-bold text-slate-900"><?php echo htmlspecialchars($n['title']); ?></td>
                <td class="px-5 py-3.5 font-mono text-slate-500"><?php echo htmlspecialchars($n['link_url'] ?: 'None'); ?></td>
                <td class="px-5 py-3.5">
                  <?php if (!empty($n['is_active'])): ?>
                    <span class="text-emerald-600 font-bold flex items-center gap-1">● Active on Top</span>
                  <?php else: ?>
                    <span class="text-slate-400">Hidden / Inactive</span>
                  <?php endif; ?>
                </td>
                <td class="px-5 py-3.5 text-right space-x-2">
                  <a href="/admin/notices.php?edit=<?php echo $n['id']; ?>" class="text-blue-600 hover:underline font-semibold">Edit</a>
                  <a href="/admin/notices.php?delete=<?php echo $n['id']; ?>" onclick="return confirm('Delete this announcement?')" class="text-red-600 hover:underline font-semibold">Delete</a>
                </td>
              </tr>
            <?php endforeach; ?>
          <?php else: ?>
            <tr>
              <td colspan="5" class="px-5 py-8 text-center text-slate-400">No notices posted yet.</td>
            </tr>
          <?php endif; ?>
        </tbody>
      </table>
    </div>
  </div>

</div>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
