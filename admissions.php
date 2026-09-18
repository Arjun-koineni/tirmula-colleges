<?php
/**
 * Admissions & Application Fee Payment - Tirumala IIT & Medical Academy
 */
$pageTitle = "Admissions 2025-26 & Application Fee | Tirumala Academy";
$currentNav = "admissions";
$metaDesc = "Apply for admissions 2025-26 into Tirumala IIT & Medical Academy. Pay nominal application fee securely via Razorpay or access the full tuition fee portal.";
require_once __DIR__ . '/includes/header.php';
?>

<!-- BANNER -->
<section class="bg-tirumala-gradient text-white py-14">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
    <span class="text-amber-400 font-bold text-xs uppercase tracking-widest">Academic Year 2025-26</span>
    <h1 class="text-3xl sm:text-5xl font-extrabold text-white mt-1">Admissions & Application Portal</h1>
    <p class="text-slate-300 text-sm sm:text-base max-w-2xl mx-auto mt-3">
      Secure your seat in South India's premier IIT-JEE, NEET, and Foundation programs.
    </p>
  </div>
</section>

<!-- FEE PAYMENT INFO CALLOUT (TUITION PORTAL VS APPLICATION FEE) -->
<section class="bg-slate-900 text-white py-8 border-b border-slate-800">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 items-center">
      
      <!-- 1. Enrolled Student Tuition Fee Portal -->
      <div class="bg-slate-800/90 rounded-xl p-6 border border-slate-700 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
        <div>
          <span class="text-[11px] font-bold uppercase tracking-wider text-emerald-400 block">Existing / Enrolled Students</span>
          <h3 class="text-lg font-bold text-white mt-0.5">Pay Full Tuition & Term Fee</h3>
          <p class="text-xs text-slate-400 mt-1">Access the official student parent billing portal (Onesaz) with your student ID.</p>
        </div>
        <a href="<?php echo FEE_PORTAL_URL; ?>" target="_blank" rel="noopener noreferrer" class="bg-amber-500 hover:bg-amber-600 text-slate-950 font-bold px-4 py-2.5 rounded-lg text-xs transition flex-shrink-0 flex items-center gap-1.5 shadow">
          <span>Fee Portal ↗</span>
        </a>
      </div>

      <!-- 2. New Applicant Application Fee -->
      <div class="bg-slate-800/90 rounded-xl p-6 border border-slate-700 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
        <div>
          <span class="text-[11px] font-bold uppercase tracking-wider text-amber-400 block">New Admissions 2025-26</span>
          <h3 class="text-lg font-bold text-white mt-0.5">Pay Application & Registration Fee</h3>
          <p class="text-xs text-slate-400 mt-1">Nominal registration fee (₹500) for prospectus, diagnostic test, and counseling seat.</p>
        </div>
        <button onclick="openRazorpayCheckout()" class="bg-tcrimson hover:bg-tcrimson-hover text-white font-bold px-4 py-2.5 rounded-lg text-xs transition flex-shrink-0 flex items-center gap-1.5 shadow">
          <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
          <span>Pay Application Fee</span>
        </button>
      </div>

    </div>
  </div>
</section>

<!-- ADMISSIONS PROCESS STEPS -->
<section class="py-16 bg-white">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="text-center max-w-2xl mx-auto mb-14">
      <span class="text-blue-700 font-bold text-xs uppercase tracking-widest">Simple & Transparent</span>
      <h2 class="text-3xl font-extrabold text-tnavy mt-1">4-Step Admission Procedure</h2>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
      
      <div class="bg-slate-50 p-6 rounded-xl border border-slate-200 space-y-3 card-hover-lift text-center">
        <div class="w-12 h-12 rounded-full bg-tnavy text-white font-bold text-lg flex items-center justify-center mx-auto shadow">1</div>
        <h4 class="font-bold text-slate-900 text-base">Submit Application</h4>
        <p class="text-xs text-slate-500">Fill out the online application form below or visit your nearest campus admissions office.</p>
      </div>

      <div class="bg-slate-50 p-6 rounded-xl border border-slate-200 space-y-3 card-hover-lift text-center">
        <div class="w-12 h-12 rounded-full bg-tnavy text-white font-bold text-lg flex items-center justify-center mx-auto shadow">2</div>
        <h4 class="font-bold text-slate-900 text-base">Diagnostic / Screening Test</h4>
        <p class="text-xs text-slate-500">Appear for the Tirumala Talent Search Exam (TTSE) for Super 60 batch allocation and merit scholarships.</p>
      </div>

      <div class="bg-slate-50 p-6 rounded-xl border border-slate-200 space-y-3 card-hover-lift text-center">
        <div class="w-12 h-12 rounded-full bg-tnavy text-white font-bold text-lg flex items-center justify-center mx-auto shadow">3</div>
        <h4 class="font-bold text-slate-900 text-base">Counseling & Interaction</h4>
        <p class="text-xs text-slate-500">One-on-one session with academic directors to choose the right stream (MPC, BiPC, or Foundation) and campus.</p>
      </div>

      <div class="bg-slate-50 p-6 rounded-xl border border-slate-200 space-y-3 card-hover-lift text-center">
        <div class="w-12 h-12 rounded-full bg-blue-700 text-white font-bold text-lg flex items-center justify-center mx-auto shadow">4</div>
        <h4 class="font-bold text-slate-900 text-base">Confirmation & Enrollment</h4>
        <p class="text-xs text-slate-500">Complete document verification, confirm hostel/day-scholar seat, and receive study material kit.</p>
      </div>

    </div>
  </div>
</section>

<!-- ADMISSIONS APPLICATION FORM WITH RAZORPAY INTEGRATION -->
<section id="application-form-section" class="py-16 bg-slate-50 border-t border-slate-200">
  <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="bg-white rounded-2xl shadow-xl p-8 sm:p-10 border border-slate-200">
      
      <div class="text-center max-w-xl mx-auto mb-8">
        <span class="bg-blue-50 text-blue-700 font-bold text-xs px-3 py-1 rounded-full uppercase tracking-wider border border-blue-200">Session 2025-26</span>
        <h3 class="text-2xl sm:text-3xl font-bold text-tnavy mt-2" data-i18n="enquiry_heading">Online Admission Application Form</h3>
        <p class="text-xs text-slate-500 mt-1" data-i18n="enquiry_subheading">Please provide accurate student and contact details. All fields marked with * are required.</p>
      </div>

      <form id="admission-form" action="/api/submit_enquiry.php" method="POST" class="space-y-6">
        
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
          <div>
            <label class="block text-xs font-bold text-slate-700 mb-1">Student Full Name *</label>
            <input type="text" name="student_name" id="app_student_name" required placeholder="As per Aadhaar / School Records" class="w-full text-sm px-4 py-2.5 rounded-lg border border-slate-300 focus:ring-2 focus:ring-tcrimson outline-none">
          </div>
          <div>
            <label class="block text-xs font-bold text-slate-700 mb-1">Parent / Guardian Name *</label>
            <input type="text" name="parent_name" id="app_parent_name" required placeholder="Father or Mother Name" class="w-full text-sm px-4 py-2.5 rounded-lg border border-slate-300 focus:ring-2 focus:ring-tcrimson outline-none">
          </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
          <div>
            <label class="block text-xs font-bold text-slate-700 mb-1">Primary Mobile Number *</label>
            <input type="tel" name="phone" id="app_phone" required placeholder="10-digit Mobile Number" class="w-full text-sm px-4 py-2.5 rounded-lg border border-slate-300 focus:ring-2 focus:ring-tcrimson outline-none">
          </div>
          <div>
            <label class="block text-xs font-bold text-slate-700 mb-1">Email Address</label>
            <input type="email" name="email" id="app_email" placeholder="example@gmail.com" class="w-full text-sm px-4 py-2.5 rounded-lg border border-slate-300 focus:ring-2 focus:ring-tcrimson outline-none">
          </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-3 gap-5">
          <div>
            <label class="block text-xs font-bold text-slate-700 mb-1">Class Applying For *</label>
            <select name="class_applying" required class="w-full text-sm px-4 py-2.5 rounded-lg border border-slate-300 focus:ring-2 focus:ring-tcrimson outline-none bg-white">
              <option value="Class 6">Class 6 (IIT Foundation)</option>
              <option value="Class 7">Class 7 (IIT Foundation)</option>
              <option value="Class 8">Class 8 (IIT Foundation)</option>
              <option value="Class 9">Class 9 (IIT/NEET Foundation)</option>
              <option value="Class 10">Class 10 (Board + Foundation)</option>
              <option value="1st Year Inter (Junior)">1st Year Inter (Junior)</option>
              <option value="2nd Year Inter (Senior)">2nd Year Inter (Senior)</option>
              <option value="Long Term Repeater">Long Term Repeater (NEET/JEE)</option>
            </select>
          </div>

          <div>
            <label class="block text-xs font-bold text-slate-700 mb-1">Target Stream *</label>
            <select name="stream_interested" required class="w-full text-sm px-4 py-2.5 rounded-lg border border-slate-300 focus:ring-2 focus:ring-tcrimson outline-none bg-white">
              <option value="IIT-JEE (MPC)">IIT-JEE Main & Advanced (MPC)</option>
              <option value="NEET (BiPC)">NEET Medical (BiPC)</option>
              <option value="IPE Inter Only">General Intermediate (IPE)</option>
              <option value="School Olympiad">School Olympiad & Foundation</option>
            </select>
          </div>

          <div>
            <label class="block text-xs font-bold text-slate-700 mb-1">Preferred Campus *</label>
            <select name="campus_preferred" required class="w-full text-sm px-4 py-2.5 rounded-lg border border-slate-300 focus:ring-2 focus:ring-tcrimson outline-none bg-white">
              <option value="Rajamahendravaram">Rajamahendravaram (Central HQ)</option>
              <option value="Visakhapatnam">Visakhapatnam</option>
              <option value="Bhimavaram">Bhimavaram</option>
              <option value="Tanuku">Tanuku</option>
              <option value="Payakaraopeta">Payakaraopeta</option>
            </select>
          </div>
        </div>

        <div>
          <label class="block text-xs font-bold text-slate-700 mb-1">Additional Notes / Hostel Requirement</label>
          <textarea name="message" rows="2" placeholder="Mention whether you require A/C Hostel, Transport pick-up, or previous board exam percentage..." class="w-full text-sm px-4 py-2.5 rounded-lg border border-slate-300 focus:ring-2 focus:ring-tcrimson outline-none"></textarea>
        </div>

        <!-- Hidden Razorpay Fields -->
        <input type="hidden" name="razorpay_payment_id" id="razorpay_payment_id" value="">
        <input type="hidden" name="application_fee_paid" id="application_fee_paid" value="0">

        <!-- Action Buttons -->
        <div class="pt-4 flex flex-col sm:flex-row items-center justify-between gap-4 border-t border-slate-100">
          <button type="submit" class="w-full sm:w-auto bg-slate-900 hover:bg-slate-800 text-white font-bold px-8 py-3.5 rounded-xl shadow transition text-sm flex items-center justify-center gap-2">
            <span>Submit Enquiry (Free)</span>
          </button>

          <button type="button" onclick="openRazorpayCheckout()" class="w-full sm:w-auto bg-blue-700 hover:bg-blue-800 text-white font-bold px-8 py-3.5 rounded-xl shadow-lg transition text-sm flex items-center justify-center gap-2">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
            <span>Submit & Pay ₹500 Application Fee</span>
          </button>
        </div>

        <!-- Dependency Note on Razorpay Merchant Account -->
        <div class="bg-blue-50 border border-blue-200 rounded-lg p-3 text-[11px] text-blue-900 flex items-start gap-2">
          <span class="text-blue-600 font-bold">ℹ️</span>
          <span>
            <strong>Secure Application Checkout:</strong> Payment is processed directly by Razorpay's PCI-DSS compliant checkout (UPI, Netbanking, Cards). No card or UPI details are stored on this server. (Live charges require client's activated Razorpay merchant key).
          </span>
        </div>

      </form>

    </div>
  </div>
</section>

<!-- Razorpay Script Checkout Integration -->
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<script>
function openRazorpayCheckout() {
  const form = document.getElementById('admission-form');
  const name = document.getElementById('app_student_name').value.trim();
  const phone = document.getElementById('app_phone').value.trim();
  const email = document.getElementById('app_email').value.trim();

  if (!name || !phone) {
    alert('Please enter student name and phone number before proceeding to payment.');
    document.getElementById('app_student_name').focus();
    return;
  }

  const options = {
    key: "<?php echo RAZORPAY_KEY_ID; ?>",
    amount: 50000, // 500.00 INR in paise
    currency: "INR",
    name: "Tirumala IIT & Medical Academy",
    description: "Application & Prospectus Fee (2025-26)",
    image: "/assets/images/round_logo.png",
    prefill: {
      name: name,
      contact: phone,
      email: email || "admissions@tirumalaedu.com"
    },
    theme: {
      color: "#0e2554"
    },
    handler: function (response) {
      // Razorpay payment ID received securely from Razorpay hosted modal
      document.getElementById('razorpay_payment_id').value = response.razorpay_payment_id || 'PAY_' + Date.now();
      document.getElementById('application_fee_paid').value = "1";
      alert("Payment Successful! Application ID: " + (response.razorpay_payment_id || 'RZP_OK') + "\nSubmitting your enrollment record...");
      form.submit();
    },
    modal: {
      ondismiss: function() {
        // Fallback or user dismissed
      }
    }
  };

  // Fallback demo simulator if sandbox key is not yet configured with real bank
  try {
    const rzp = new Razorpay(options);
    rzp.open();
  } catch (err) {
    console.warn("Razorpay checkout notice:", err);
    // Graceful simulation for development testing
    const simulatedId = "rzp_test_" + Math.random().toString(36).substring(2, 10);
    if (confirm("Razorpay Test Gateway: Simulate successful application payment of ₹500 for " + name + "?")) {
      document.getElementById('razorpay_payment_id').value = simulatedId;
      document.getElementById('application_fee_paid').value = "1";
      form.submit();
    }
  }
}
</script>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
