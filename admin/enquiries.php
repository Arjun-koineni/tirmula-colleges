<?php
/**
 * Admin: Admissions Enquiries Manager
 */
$adminTitle = "Admissions Enquiries";
require_once __DIR__ . '/includes/header.php';

$db = getDB();
$message = '';

// Handle Status Change
if (isset($_GET['set_status']) && isset($_GET['id'])) {
    $statusId = (int)$_GET['id'];
    $newStatus = sanitizeInput($_GET['set_status']);
    if (in_array($newStatus, ['Pending', 'Contacted', 'Admitted'])) {
        $st = $db->prepare("UPDATE enquiries SET status = ? WHERE id = ?");
        $st->execute([$newStatus, $statusId]);
        $message = "Status updated to $newStatus.";
    }
}

// Handle Export to CSV
if (isset($_GET['export']) && $_GET['export'] === 'csv') {
    header('Content-Type: text/csv');
    header('Content-Disposition: attachment; filename="tirumala_admissions_enquiries_' . date('Y-m-d') . '.csv"');
    $out = fopen('php://output', 'w');
    fputcsv($out, ['ID', 'Student Name', 'Parent Name', 'Phone', 'Email', 'Class', 'Stream', 'Campus', 'Fee Paid', 'Payment ID', 'Status', 'Date']);
    $rows = $db->query("SELECT id, student_name, parent_name, phone, email, class_applying, stream_interested, campus_preferred, application_fee_paid, razorpay_payment_id, status, created_at FROM enquiries ORDER BY id DESC")->fetchAll(PDO::FETCH_NUM);
    foreach ($rows as $r) {
        fputcsv($out, $r);
    }
    fclose($out);
    exit;
}

$allEnquiries = $db->query("SELECT * FROM enquiries ORDER BY id DESC")->fetchAll();
?>

<div class="space-y-6">
  
  <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
    <div>
      <h1 class="text-2xl font-bold text-slate-900">Admissions Form Submissions</h1>
      <p class="text-xs text-slate-500 mt-0.5">Track prospective student leads, follow-ups, and application fee payments.</p>
    </div>
    <div class="flex items-center gap-2">
      <a href="/admin/enquiries.php?export=csv" class="bg-emerald-600 hover:bg-emerald-700 text-white font-bold px-3.5 py-2 rounded-lg text-xs shadow transition flex items-center gap-1.5">
        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
        <span>Export to CSV</span>
      </a>
    </div>
  </div>

  <?php if ($message): ?>
    <div class="bg-emerald-50 border-l-4 border-emerald-500 text-emerald-800 p-3 text-xs rounded shadow-sm">
      <?php echo htmlspecialchars($message); ?>
    </div>
  <?php endif; ?>

  <!-- ENQUIRIES TABLE -->
  <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
    <div class="p-5 border-b border-slate-100 flex items-center justify-between">
      <h2 class="text-base font-bold text-slate-900">All Submissions (<?php echo count($allEnquiries); ?>)</h2>
      <span class="text-xs text-slate-400">Click status to update lead progress</span>
    </div>

    <div class="overflow-x-auto">
      <table class="w-full text-left text-xs">
        <thead class="bg-slate-50 text-slate-500 font-semibold uppercase tracking-wider text-[10px] border-b border-slate-100">
          <tr>
            <th class="px-5 py-3">Date</th>
            <th class="px-5 py-3">Student Name</th>
            <th class="px-5 py-3">Parent Name</th>
            <th class="px-5 py-3">Contact Details</th>
            <th class="px-5 py-3">Class & Stream</th>
            <th class="px-5 py-3">Campus</th>
            <th class="px-5 py-3">Application Fee</th>
            <th class="px-5 py-3">Status</th>
            <th class="px-5 py-3 text-right">Actions</th>
          </tr>
        </thead>
        <tbody class="divide-y divide-slate-100 text-slate-700">
          <?php if (!empty($allEnquiries)): ?>
            <?php foreach ($allEnquiries as $e): ?>
              <tr class="hover:bg-slate-50/70">
                <td class="px-5 py-3.5 text-slate-400 font-mono text-[11px] whitespace-nowrap">
                  <?php echo date('d M, Y', strtotime($e['created_at'])); ?>
                </td>
                <td class="px-5 py-3.5 font-bold text-slate-900"><?php echo htmlspecialchars($e['student_name']); ?></td>
                <td class="px-5 py-3.5 text-slate-600"><?php echo htmlspecialchars($e['parent_name'] ?: '—'); ?></td>
                <td class="px-5 py-3.5">
                  <a href="tel:<?php echo htmlspecialchars($e['phone']); ?>" class="font-mono font-bold text-blue-600 hover:underline block"><?php echo htmlspecialchars($e['phone']); ?></a>
                  <?php if ($e['email']): ?>
                    <span class="text-slate-400 text-[11px] block"><?php echo htmlspecialchars($e['email']); ?></span>
                  <?php endif; ?>
                </td>
                <td class="px-5 py-3.5">
                  <span class="font-semibold block"><?php echo htmlspecialchars($e['class_applying'] ?: 'General'); ?></span>
                  <span class="text-slate-500 text-[11px]"><?php echo htmlspecialchars($e['stream_interested']); ?></span>
                </td>
                <td class="px-5 py-3.5 font-medium"><?php echo htmlspecialchars($e['campus_preferred']); ?></td>
                <td class="px-5 py-3.5">
                  <?php if (!empty($e['application_fee_paid'])): ?>
                    <span class="bg-emerald-100 text-emerald-800 font-bold px-2 py-0.5 rounded text-[10px] block w-max">₹500 Paid</span>
                    <span class="text-[10px] font-mono text-slate-400"><?php echo htmlspecialchars($e['razorpay_payment_id'] ?: ''); ?></span>
                  <?php else: ?>
                    <span class="text-slate-400">Not Paid</span>
                  <?php endif; ?>
                </td>
                <td class="px-5 py-3.5">
                  <span class="px-2 py-0.5 rounded text-[10px] font-bold <?php 
                    if ($e['status'] === 'Admitted') echo 'bg-emerald-100 text-emerald-800';
                    elseif ($e['status'] === 'Contacted') echo 'bg-blue-100 text-blue-800';
                    else echo 'bg-amber-100 text-amber-800';
                  ?>">
                    <?php echo htmlspecialchars($e['status']); ?>
                  </span>
                </td>
                <td class="px-5 py-3.5 text-right space-x-1 whitespace-nowrap">
                  <?php if ($e['status'] === 'Pending'): ?>
                    <a href="/admin/enquiries.php?id=<?php echo $e['id']; ?>&set_status=Contacted" class="bg-blue-50 text-blue-700 hover:bg-blue-100 px-2 py-1 rounded font-semibold text-[11px]">Mark Contacted</a>
                  <?php elseif ($e['status'] === 'Contacted'): ?>
                    <a href="/admin/enquiries.php?id=<?php echo $e['id']; ?>&set_status=Admitted" class="bg-emerald-50 text-emerald-700 hover:bg-emerald-100 px-2 py-1 rounded font-semibold text-[11px]">Mark Admitted</a>
                  <?php else: ?>
                    <span class="text-emerald-600 font-bold text-[11px]">Enrolled</span>
                  <?php endif; ?>
                </td>
              </tr>
            <?php endforeach; ?>
          <?php else: ?>
            <tr>
              <td colspan="9" class="px-5 py-8 text-center text-slate-400">No admissions enquiries registered yet.</td>
            </tr>
          <?php endif; ?>
        </tbody>
      </table>
    </div>
  </div>

</div>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
