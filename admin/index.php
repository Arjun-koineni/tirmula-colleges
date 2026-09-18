<?php
/**
 * Admin Dashboard
 */
$adminTitle = "Dashboard";
require_once __DIR__ . '/includes/header.php';

$db = getDB();

// Fetch summary metrics
$stats = [
    'results' => 0,
    'notices' => 0,
    'papers' => 0,
    'gallery' => 0,
    'enquiries' => 0,
    'pending_enquiries' => 0
];

try {
    $stats['results'] = $db->query("SELECT COUNT(*) FROM results")->fetchColumn();
    $stats['notices'] = $db->query("SELECT COUNT(*) FROM notices WHERE is_active = 1")->fetchColumn();
    $stats['papers'] = $db->query("SELECT COUNT(*) FROM model_papers")->fetchColumn();
    $stats['gallery'] = $db->query("SELECT COUNT(*) FROM gallery")->fetchColumn();
    $stats['enquiries'] = $db->query("SELECT COUNT(*) FROM enquiries")->fetchColumn();
    $stats['pending_enquiries'] = $db->query("SELECT COUNT(*) FROM enquiries WHERE status = 'Pending'")->fetchColumn();

    // Fetch latest 5 enquiries
    $stmt = $db->query("SELECT * FROM enquiries ORDER BY id DESC LIMIT 5");
    $latestEnquiries = $stmt->fetchAll();
} catch (Throwable $e) {
    $latestEnquiries = [];
}
?>

<div class="space-y-8">
  
  <!-- Welcome Header -->
  <div class="bg-white rounded-2xl p-6 sm:p-8 shadow-sm border border-slate-200 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
    <div>
      <h1 class="text-2xl font-bold text-slate-900">Welcome, Staff Administrator 👋</h1>
      <p class="text-xs text-slate-500 mt-1">
        Logged in as <strong class="text-slate-800"><?php echo htmlspecialchars($_SESSION['tirumala_admin_user'] ?? 'admin'); ?></strong>. Manage all website content without needing a developer.
      </p>
    </div>
    <div class="flex items-center gap-3">
      <a href="/admin/results.php?action=new" class="bg-tcrimson hover:bg-tcrimson-hover text-white font-bold px-4 py-2.5 rounded-lg text-xs shadow transition flex items-center gap-1.5">
        <span>+ Add New Result</span>
      </a>
      <a href="/admin/notices.php?action=new" class="bg-tnavy hover:bg-slate-900 text-white font-bold px-4 py-2.5 rounded-lg text-xs shadow transition flex items-center gap-1.5">
        <span>+ Post Notice</span>
      </a>
    </div>
  </div>

  <!-- Metric Stat Cards -->
  <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-5 gap-4">
    
    <a href="/admin/results.php" class="bg-white p-5 rounded-xl border border-slate-200 shadow-sm hover:border-slate-400 transition group">
      <span class="text-xs font-bold uppercase tracking-wider text-slate-400 group-hover:text-tcrimson">Student Results</span>
      <p class="text-3xl font-black text-slate-900 mt-1"><?php echo $stats['results']; ?></p>
      <span class="text-[11px] text-slate-500 mt-2 block">Manage Ranks →</span>
    </a>

    <a href="/admin/notices.php" class="bg-white p-5 rounded-xl border border-slate-200 shadow-sm hover:border-slate-400 transition group">
      <span class="text-xs font-bold uppercase tracking-wider text-slate-400 group-hover:text-tcrimson">Active Notices</span>
      <p class="text-3xl font-black text-slate-900 mt-1"><?php echo $stats['notices']; ?></p>
      <span class="text-[11px] text-slate-500 mt-2 block">Homepage Banner →</span>
    </a>

    <a href="/admin/model-papers.php" class="bg-white p-5 rounded-xl border border-slate-200 shadow-sm hover:border-slate-400 transition group">
      <span class="text-xs font-bold uppercase tracking-wider text-slate-400 group-hover:text-tcrimson">Model Papers</span>
      <p class="text-3xl font-black text-slate-900 mt-1"><?php echo $stats['papers']; ?></p>
      <span class="text-[11px] text-slate-500 mt-2 block">PDF Downloads →</span>
    </a>

    <a href="/admin/gallery.php" class="bg-white p-5 rounded-xl border border-slate-200 shadow-sm hover:border-slate-400 transition group">
      <span class="text-xs font-bold uppercase tracking-wider text-slate-400 group-hover:text-tcrimson">Gallery Photos</span>
      <p class="text-3xl font-black text-slate-900 mt-1"><?php echo $stats['gallery']; ?></p>
      <span class="text-[11px] text-slate-500 mt-2 block">Manage Media →</span>
    </a>

    <a href="/admin/enquiries.php" class="bg-white p-5 rounded-xl border border-amber-300 shadow-sm hover:border-amber-400 transition group bg-amber-50/40">
      <span class="text-xs font-bold uppercase tracking-wider text-amber-800">New Enquiries</span>
      <p class="text-3xl font-black text-amber-900 mt-1"><?php echo $stats['pending_enquiries']; ?> <span class="text-xs font-normal text-slate-500">/ <?php echo $stats['enquiries']; ?></span></p>
      <span class="text-[11px] text-amber-700 font-bold mt-2 block">Review Submissions →</span>
    </a>

  </div>

  <!-- Quick Manager Shortcuts Grid -->
  <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
    
    <!-- Left: Quick Links to Update Website -->
    <div class="bg-white rounded-2xl p-6 border border-slate-200 shadow-sm space-y-4">
      <h2 class="text-base font-bold text-slate-900 flex items-center gap-2">
        <span>⚡</span> Quick Management Shortcuts
      </h2>

      <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 text-xs">
        <a href="/admin/results.php?action=new" class="p-3 rounded-lg border border-slate-200 bg-slate-50 hover:bg-slate-100 transition flex items-center gap-2.5">
          <span class="text-base">🏆</span>
          <div>
            <strong class="text-slate-800 block">Post New Result</strong>
            <span class="text-slate-500 text-[11px]">Add JEE/NEET ranker</span>
          </div>
        </a>

        <a href="/admin/notices.php?action=new" class="p-3 rounded-lg border border-slate-200 bg-slate-50 hover:bg-slate-100 transition flex items-center gap-2.5">
          <span class="text-base">📢</span>
          <div>
            <strong class="text-slate-800 block">Post Urgent Notice</strong>
            <span class="text-slate-500 text-[11px]">Updates homepage ticker</span>
          </div>
        </a>

        <a href="/admin/model-papers.php?action=new" class="p-3 rounded-lg border border-slate-200 bg-slate-50 hover:bg-slate-100 transition flex items-center gap-2.5">
          <span class="text-base">📄</span>
          <div>
            <strong class="text-slate-800 block">Upload Model Paper</strong>
            <span class="text-slate-500 text-[11px]">PDF for Class 6 to Inter</span>
          </div>
        </a>

        <a href="/admin/gallery.php?action=new" class="p-3 rounded-lg border border-slate-200 bg-slate-50 hover:bg-slate-100 transition flex items-center gap-2.5">
          <span class="text-base">🖼️</span>
          <div>
            <strong class="text-slate-800 block">Upload Gallery Image</strong>
            <span class="text-slate-500 text-[11px]">Events, Sports & Awards</span>
          </div>
        </a>
      </div>
    </div>

    <!-- Right: How to Update Guide Hint -->
    <div class="bg-gradient-to-br from-slate-900 to-blue-950 text-white rounded-2xl p-6 shadow-sm space-y-3">
      <span class="text-amber-400 font-bold text-xs uppercase tracking-wider">Non-Technical Staff Guide</span>
      <h3 class="text-lg font-bold text-white">How to Maintain Your New Website</h3>
      <p class="text-xs text-slate-300 leading-relaxed">
        Everything on the public website is wired directly to these simple forms. When you add a result or notice, it goes live immediately. No coding or HTML knowledge required!
      </p>
      <div class="pt-2">
        <a href="/docs/staff_user_guide.md" target="_blank" class="inline-flex items-center gap-1.5 text-xs bg-white text-slate-900 font-bold px-3.5 py-2 rounded-lg hover:bg-slate-100 transition shadow">
          <span>Read Staff User Guide</span>
          <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
        </a>
      </div>
    </div>

  </div>

  <!-- Latest Admissions Enquiries Table -->
  <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
    <div class="p-6 border-b border-slate-100 flex items-center justify-between">
      <div>
        <h2 class="text-base font-bold text-slate-900">Recent Admissions Enquiries</h2>
        <p class="text-xs text-slate-500">Latest online submissions from prospective parents and students.</p>
      </div>
      <a href="/admin/enquiries.php" class="text-xs text-tcrimson font-bold hover:underline">View All Enquiries →</a>
    </div>

    <div class="overflow-x-auto">
      <table class="w-full text-left text-xs">
        <thead class="bg-slate-50 text-slate-500 font-semibold uppercase tracking-wider text-[10px] border-b border-slate-100">
          <tr>
            <th class="px-6 py-3">Student Name</th>
            <th class="px-6 py-3">Phone</th>
            <th class="px-6 py-3">Stream / Course</th>
            <th class="px-6 py-3">Campus</th>
            <th class="px-6 py-3">App Fee Status</th>
            <th class="px-6 py-3">Status</th>
            <th class="px-6 py-3 text-right">Action</th>
          </tr>
        </thead>
        <tbody class="divide-y divide-slate-100 text-slate-700">
          <?php if (!empty($latestEnquiries)): ?>
            <?php foreach ($latestEnquiries as $enq): ?>
              <tr class="hover:bg-slate-50/80">
                <td class="px-6 py-4 font-bold text-slate-900"><?php echo htmlspecialchars($enq['student_name']); ?></td>
                <td class="px-6 py-4 font-mono"><?php echo htmlspecialchars($enq['phone']); ?></td>
                <td class="px-6 py-4"><?php echo htmlspecialchars($enq['stream_interested'] ?: 'General'); ?></td>
                <td class="px-6 py-4"><?php echo htmlspecialchars($enq['campus_preferred']); ?></td>
                <td class="px-6 py-4">
                  <?php if (!empty($enq['application_fee_paid'])): ?>
                    <span class="bg-emerald-100 text-emerald-800 font-bold px-2 py-0.5 rounded text-[10px]">₹500 Paid</span>
                  <?php else: ?>
                    <span class="text-slate-400">Unpaid Enquiry</span>
                  <?php endif; ?>
                </td>
                <td class="px-6 py-4">
                  <span class="px-2 py-0.5 rounded text-[10px] font-bold <?php echo $enq['status'] === 'Contacted' ? 'bg-blue-100 text-blue-800' : 'bg-amber-100 text-amber-800'; ?>">
                    <?php echo htmlspecialchars($enq['status']); ?>
                  </span>
                </td>
                <td class="px-6 py-4 text-right">
                  <a href="/admin/enquiries.php?id=<?php echo $enq['id']; ?>" class="text-tnavy hover:underline font-semibold">View Details</a>
                </td>
              </tr>
            <?php endforeach; ?>
          <?php else: ?>
            <tr>
              <td colspan="7" class="px-6 py-8 text-center text-slate-400">No enquiries received yet.</td>
            </tr>
          <?php endif; ?>
        </tbody>
      </table>
    </div>
  </div>

</div>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
