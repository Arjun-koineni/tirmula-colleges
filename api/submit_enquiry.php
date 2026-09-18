<?php
/**
 * API: Submit Admissions Enquiry / Application
 */
require_once __DIR__ . '/../config.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: /admissions.php');
    exit;
}

$student_name = sanitizeInput($_POST['student_name'] ?? '');
$parent_name = sanitizeInput($_POST['parent_name'] ?? '');
$phone = sanitizeInput($_POST['phone'] ?? '');
$email = sanitizeInput($_POST['email'] ?? '');
$class_applying = sanitizeInput($_POST['class_applying'] ?? 'Intermediate');
$stream_interested = sanitizeInput($_POST['stream_interested'] ?? 'IIT-JEE (MPC)');
$campus_preferred = sanitizeInput($_POST['campus_preferred'] ?? 'Rajamahendravaram');
$message = sanitizeInput($_POST['message'] ?? '');
$fee_paid = !empty($_POST['application_fee_paid']) ? 1 : 0;
$razorpay_id = sanitizeInput($_POST['razorpay_payment_id'] ?? '');

// Validation
if (empty($student_name) || empty($phone)) {
    die("Error: Student Name and Phone are required fields. <a href='/admissions.php'>Go back</a>");
}

try {
    $db = getDB();
    $stmt = $db->prepare("INSERT INTO enquiries 
        (student_name, parent_name, phone, email, class_applying, stream_interested, campus_preferred, message, application_fee_paid, razorpay_payment_id, status)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, 'Pending')");
    
    $stmt->execute([
        $student_name,
        $parent_name,
        $phone,
        $email,
        $class_applying,
        $stream_interested,
        $campus_preferred,
        $message,
        $fee_paid,
        $razorpay_id
    ]);

    // Stub: Email notification to admissions team
    $mailTo = INSTITUTE_EMAIL;
    $subject = "New Admissions Enquiry: $student_name ($campus_preferred)";
    $emailBody = "New enquiry received:\nStudent: $student_name\nPhone: $phone\nCampus: $campus_preferred\nStream: $stream_interested\nFee Paid: " . ($fee_paid ? "Yes ($razorpay_id)" : "No") . "\n";
    @mail($mailTo, $subject, $emailBody, "From: webmaster@tirumalaedu.com");

    // Stub: WhatsApp Notification Webhook (Integration Ready)
    // if (getenv('WHATSAPP_WEBHOOK_URL')) { ... }

} catch (Throwable $e) {
    error_log("Enquiry submission error: " . $e->getMessage());
}

// Render clean confirmation screen
$pageTitle = "Enquiry Submitted Successfully | Tirumala Academy";
require_once __DIR__ . '/../includes/header.php';
?>

<section class="py-20 bg-slate-50 min-h-[65vh] flex items-center justify-center">
  <div class="max-w-xl mx-auto px-4 text-center">
    <div class="bg-white rounded-2xl shadow-xl p-8 sm:p-10 border border-slate-200 space-y-5">
      <div class="w-16 h-16 bg-emerald-100 text-emerald-600 rounded-full flex items-center justify-center text-3xl mx-auto shadow-sm">
        ✓
      </div>
      <h2 class="text-2xl sm:text-3xl font-bold text-tnavy">Thank You, <?php echo htmlspecialchars($student_name); ?>!</h2>
      <p class="text-sm text-slate-600 leading-relaxed">
        Your admissions enquiry has been successfully registered in our admissions database. An academic counselor from the <strong><?php echo htmlspecialchars($campus_preferred); ?></strong> campus will review your details and contact you at <strong><?php echo htmlspecialchars($phone); ?></strong> within 24 hours.
      </p>

      <?php if ($fee_paid && $razorpay_id): ?>
        <div class="bg-emerald-50 border border-emerald-200 rounded-xl p-4 text-xs text-emerald-900 space-y-1">
          <p class="font-bold">Application Fee Payment Confirmed (₹500.00)</p>
          <p class="font-mono text-[11px] text-emerald-700">Transaction ID: <?php echo htmlspecialchars($razorpay_id); ?></p>
        </div>
      <?php endif; ?>

      <div class="pt-4 flex flex-col sm:flex-row items-center justify-center gap-3">
        <a href="/index.php" class="w-full sm:w-auto bg-tnavy hover:bg-slate-900 text-white font-bold px-6 py-2.5 rounded-lg text-xs transition">
          Return to Home
        </a>
        <a href="https://wa.me/<?php echo INSTITUTE_WHATSAPP; ?>" target="_blank" class="w-full sm:w-auto bg-[#25D366] hover:bg-[#20ba5a] text-white font-bold px-6 py-2.5 rounded-lg text-xs transition flex items-center justify-center gap-1.5 shadow">
          <span>Chat on WhatsApp</span>
        </a>
      </div>
    </div>
  </div>
</section>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>
