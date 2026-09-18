<?php
/**
 * Contact Us Page - Tirumala IIT & Medical Academy
 * Complete directory for all 5 campuses, embedded map, and enquiry form.
 */
$pageTitle = "Contact Us | 5 Campus Locations in Andhra Pradesh";
$currentNav = "contact";
$metaDesc = "Contact Tirumala IIT & Medical Academy. Campuses in Rajamahendravaram, Visakhapatnam, Bhimavaram, Tanuku, and Payakaraopeta. Phone: 0883 297 0077.";
require_once __DIR__ . '/includes/header.php';
?>

<!-- BANNER -->
<section class="bg-tirumala-gradient text-white py-14">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
    <span class="text-amber-400 font-bold text-xs uppercase tracking-widest">Connect With Us</span>
    <h1 class="text-3xl sm:text-5xl font-extrabold text-white mt-1">Our Campuses & Contact Directory</h1>
    <p class="text-slate-300 text-sm sm:text-base max-w-2xl mx-auto mt-3">
      Reach out to our central administrative headquarters at Katheru or contact your nearest campus in Andhra Pradesh.
    </p>
  </div>
</section>

<!-- MAIN CONTACT CONTENT -->
<section class="py-16 bg-white">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-12">
      
      <!-- Left: Contact Form -->
      <div class="lg:col-span-7 bg-slate-50 rounded-2xl p-8 border border-slate-200 shadow-sm">
        <span class="text-tcrimson font-bold text-xs uppercase tracking-widest">Enquiry & Counseling</span>
        <h2 class="text-2xl sm:text-3xl font-bold text-tnavy mt-1">Send an Enquiry to Admissions</h2>
        <p class="text-xs sm:text-sm text-slate-500 mt-1 mb-8">
          Fill out the form below and an academic counselor from your nearest campus will get in touch with you.
        </p>

        <form action="/api/submit_enquiry.php" method="POST" class="space-y-5">
          <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div>
              <label class="block text-xs font-bold text-slate-700 mb-1">Student Name *</label>
              <input type="text" name="student_name" required placeholder="Full Name of Student" class="w-full text-sm px-3.5 py-2.5 rounded-lg border border-slate-300 focus:ring-2 focus:ring-tcrimson outline-none bg-white">
            </div>
            <div>
              <label class="block text-xs font-bold text-slate-700 mb-1">Parent / Guardian Name</label>
              <input type="text" name="parent_name" placeholder="Parent / Guardian Name" class="w-full text-sm px-3.5 py-2.5 rounded-lg border border-slate-300 focus:ring-2 focus:ring-tcrimson outline-none bg-white">
            </div>
          </div>

          <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div>
              <label class="block text-xs font-bold text-slate-700 mb-1">Phone / Mobile Number *</label>
              <input type="tel" name="phone" required placeholder="10-digit mobile number" class="w-full text-sm px-3.5 py-2.5 rounded-lg border border-slate-300 focus:ring-2 focus:ring-tcrimson outline-none bg-white">
            </div>
            <div>
              <label class="block text-xs font-bold text-slate-700 mb-1">Email Address</label>
              <input type="email" name="email" placeholder="student@example.com" class="w-full text-sm px-3.5 py-2.5 rounded-lg border border-slate-300 focus:ring-2 focus:ring-blue-600 outline-none bg-white">
            </div>
          </div>

          <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div>
              <label class="block text-xs font-bold text-slate-700 mb-1">Preferred Campus *</label>
              <select name="campus_preferred" required class="w-full text-sm px-3.5 py-2.5 rounded-lg border border-slate-300 focus:ring-2 focus:ring-blue-600 outline-none bg-white">
                <option value="Rajamahendravaram">Rajamahendravaram (Central)</option>
                <option value="Visakhapatnam">Visakhapatnam</option>
                <option value="Bhimavaram">Bhimavaram</option>
                <option value="Tanuku">Tanuku</option>
                <option value="Payakaraopeta">Payakaraopeta</option>
              </select>
            </div>
            <div>
              <label class="block text-xs font-bold text-slate-700 mb-1">Stream / Course *</label>
              <select name="stream_interested" required class="w-full text-sm px-3.5 py-2.5 rounded-lg border border-slate-300 focus:ring-2 focus:ring-blue-600 outline-none bg-white">
                <option value="IIT-JEE (MPC)">IIT-JEE (MPC)</option>
                <option value="NEET (BiPC)">NEET (BiPC)</option>
                <option value="IPE Intermediate">Intermediate State/CBSE</option>
                <option value="School Class 6-10">High School (Classes 6-10)</option>
              </select>
            </div>
          </div>

          <div>
            <label class="block text-xs font-bold text-slate-700 mb-1">Message / Questions (Optional)</label>
            <textarea name="message" rows="3" placeholder="Tell us about hostel requirement, scholarship inquiry, or past grades..." class="w-full text-sm px-3.5 py-2.5 rounded-lg border border-slate-300 focus:ring-2 focus:ring-blue-600 outline-none bg-white"></textarea>
          </div>

          <button type="submit" class="w-full bg-blue-700 hover:bg-blue-800 text-white font-bold py-3 px-6 rounded-lg shadow-md transition text-sm flex items-center justify-center gap-2">
            <span>Submit Admissions Enquiry</span>
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
          </button>
        </form>
      </div>

      <!-- Right: Central Contact Card & Quick Info -->
      <div class="lg:col-span-5 space-y-6">
        
        <div class="bg-slate-900 text-white rounded-2xl p-8 shadow-xl space-y-5 border border-slate-800">
          <div class="flex items-center gap-3">
            <div class="w-10 h-10 rounded-full bg-amber-400 text-slate-950 flex items-center justify-center font-bold text-lg">HQ</div>
            <div>
              <h3 class="text-lg font-bold text-white leading-tight">Central Administrative Campus</h3>
              <p class="text-xs text-amber-400">Rajamahendravaram (Rajahmundry)</p>
            </div>
          </div>

          <div class="space-y-3 text-xs text-slate-300 border-t border-slate-800 pt-4">
            <div class="flex items-start gap-3">
              <span class="text-red-400 font-bold">ðŸ“</span>
              <div>
                <strong class="text-white block font-semibold">Campus Address:</strong>
                <span>Katheru, Rajamahendravaram (Rajahmundry), Andhra Pradesh 533102</span>
              </div>
            </div>

            <div class="flex items-start gap-3">
              <span class="text-amber-400 font-bold">ðŸ“ž</span>
              <div>
                <strong class="text-white block font-semibold">Helpline:</strong>
                <a href="tel:<?php echo INSTITUTE_PHONE_TEL; ?>" class="hover:text-amber-400 font-mono text-sm"><?php echo INSTITUTE_PHONE; ?></a>
              </div>
            </div>

            <div class="flex items-start gap-3">
              <span class="text-emerald-400 font-bold">âœ‰ï¸</span>
              <div>
                <strong class="text-white block font-semibold">Official Email:</strong>
                <a href="mailto:<?php echo INSTITUTE_EMAIL; ?>" class="hover:text-emerald-400"><?php echo INSTITUTE_EMAIL; ?></a>
              </div>
            </div>

            <div class="flex items-start gap-3">
              <span class="text-green-400 font-bold">ðŸ’¬</span>
              <div>
                <strong class="text-white block font-semibold">WhatsApp Admissions:</strong>
                <a href="https://wa.me/<?php echo INSTITUTE_WHATSAPP; ?>" target="_blank" class="hover:underline text-green-400">+91 883 297 0077</a>
              </div>
            </div>
          </div>
        </div>

        <!-- Embedded Map Frame -->
        <div class="rounded-2xl overflow-hidden shadow-sm border border-slate-200 bg-slate-100 aspect-[16/9] relative">
          <iframe 
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3813.784561845612!2d81.77663247515835!3d17.034320983804826!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3a37a3f890cf257b%3A0xe54e6fa189ad92bc!2sKatheru%2C%20Rajamahendravaram%2C%20Andhra%20Pradesh%20533102!5e0!3m2!1sen!2sin!4v1710000000000!5m2!1sen!2sin" 
            width="100%" 
            height="100%" 
            style="border:0;" 
            allowfullscreen="" 
            loading="lazy" 
            referrerpolicy="no-referrer-when-downgrade"
            title="Tirumala Academy Central Campus Location"
          ></iframe>
        </div>

      </div>

    </div>
  </div>
</section>

<!-- ALL 5 CAMPUSES DIRECTORY -->
<section class="py-16 bg-slate-50 border-t border-slate-200">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="text-center max-w-2xl mx-auto mb-12">
      <span class="text-tcrimson font-bold text-xs uppercase tracking-widest">Regional Directory</span>
      <h2 class="text-3xl font-extrabold text-tnavy mt-1">Our 5 Campus Locations in AP</h2>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 text-xs">
      
      <!-- 1. Rajamahendravaram -->
      <div class="bg-white p-6 rounded-xl border border-slate-200 shadow-sm space-y-3 card-hover-lift">
        <div class="flex items-center justify-between">
          <h3 class="text-base font-bold text-tnavy">1. Rajamahendravaram</h3>
          <span class="bg-amber-100 text-amber-800 text-[10px] font-bold px-2 py-0.5 rounded">Central HQ</span>
        </div>
        <p class="text-slate-600">Katheru Main Campus, Near Morampudi Junction, Rajamahendravaram, East Godavari, AP 533102</p>
        <p class="font-semibold text-slate-800">Phone: <a href="tel:08832970077" class="text-tcrimson hover:underline">0883 297 0077</a></p>
        <p class="text-slate-500 text-[11px]">Courses: Schools (Classes 6-10), Jr. College (MPC, BiPC), Super 60 Residential</p>
        <div class="pt-2">
          <a href="https://www.google.com/maps/search/?api=1&query=Tirumala+IIT+Academy+Katheru+Rajahmundry" target="_blank" rel="noopener noreferrer" class="inline-flex items-center gap-1.5 text-xs font-bold text-blue-700 hover:text-blue-800 hover:underline">
            <span>Open in Google Maps</span>
            <span>↗</span>
          </a>
        </div>
      </div>

      <!-- 2. Visakhapatnam -->
      <div class="bg-white p-6 rounded-xl border border-slate-200 shadow-sm space-y-3 card-hover-lift">
        <div class="flex items-center justify-between">
          <h3 class="text-base font-bold text-tnavy">2. Visakhapatnam</h3>
          <span class="bg-blue-100 text-blue-800 text-[10px] font-bold px-2 py-0.5 rounded">Port City Hub</span>
        </div>
        <p class="text-slate-600">Maddilapalem & MVP Colony Main Road, Visakhapatnam, AP 530017</p>
        <p class="font-semibold text-slate-800">Phone: <a href="tel:08912784077" class="text-tcrimson hover:underline">0891 278 4077</a></p>
        <p class="text-slate-500 text-[11px]">Courses: IIT-JEE Elite Batches, NEET Intensive, Day Scholar & Hostel</p>
        <div class="pt-2">
          <a href="https://www.google.com/maps/search/?api=1&query=Tirumala+Junior+College+Maddilapalem+Visakhapatnam" target="_blank" rel="noopener noreferrer" class="inline-flex items-center gap-1.5 text-xs font-bold text-blue-700 hover:text-blue-800 hover:underline">
            <span>Open in Google Maps</span>
            <span>↗</span>
          </a>
        </div>
      </div>

      <!-- 3. Bhimavaram -->
      <div class="bg-white p-6 rounded-xl border border-slate-200 shadow-sm space-y-3 card-hover-lift">
        <div class="flex items-center justify-between">
          <h3 class="text-base font-bold text-tnavy">3. Bhimavaram</h3>
          <span class="bg-emerald-100 text-emerald-800 text-[10px] font-bold px-2 py-0.5 rounded">Delta Center</span>
        </div>
        <p class="text-slate-600">PP Road Campus, Near Sompeta Junction, Bhimavaram, West Godavari, AP 534202</p>
        <p class="font-semibold text-slate-800">Phone: <a href="tel:08816225077" class="text-tcrimson hover:underline">08816 225 077</a></p>
        <p class="text-slate-500 text-[11px]">Courses: High School Foundation, Intermediate IPE + Entrance</p>
        <div class="pt-2">
          <a href="https://www.google.com/maps/search/?api=1&query=Tirumala+School+PP+Road+Bhimavaram" target="_blank" rel="noopener noreferrer" class="inline-flex items-center gap-1.5 text-xs font-bold text-blue-700 hover:text-blue-800 hover:underline">
            <span>Open in Google Maps</span>
            <span>↗</span>
          </a>
        </div>
      </div>

      <!-- 4. Tanuku -->
      <div class="bg-white p-6 rounded-xl border border-slate-200 shadow-sm space-y-3 card-hover-lift">
        <div class="flex items-center justify-between">
          <h3 class="text-base font-bold text-tnavy">4. Tanuku</h3>
          <span class="bg-purple-100 text-purple-800 text-[10px] font-bold px-2 py-0.5 rounded">Academic Wing</span>
        </div>
        <p class="text-slate-600">Near Overbridge, Bypass Road, Tanuku, West Godavari, AP 534211</p>
        <p class="font-semibold text-slate-800">Phone: <a href="tel:08819245077" class="text-tcrimson hover:underline">08819 245 077</a></p>
        <p class="text-slate-500 text-[11px]">Courses: Integrated Intermediate, Olympiad Foundation</p>
        <div class="pt-2">
          <a href="https://www.google.com/maps/search/?api=1&query=Tirumala+Junior+College+Tanuku" target="_blank" rel="noopener noreferrer" class="inline-flex items-center gap-1.5 text-xs font-bold text-blue-700 hover:text-blue-800 hover:underline">
            <span>Open in Google Maps</span>
            <span>↗</span>
          </a>
        </div>
      </div>

      <!-- 5. Payakaraopeta -->
      <div class="bg-white p-6 rounded-xl border border-slate-200 shadow-sm space-y-3 card-hover-lift">
        <div class="flex items-center justify-between">
          <h3 class="text-base font-bold text-tnavy">5. Payakaraopeta</h3>
          <span class="bg-rose-100 text-rose-800 text-[10px] font-bold px-2 py-0.5 rounded">Highway Campus</span>
        </div>
        <p class="text-slate-600">National Highway 16, Payakaraopeta, Anakapalli Dist, AP 531126</p>
        <p class="font-semibold text-slate-800">Phone: <a href="tel:08932233077" class="text-tcrimson hover:underline">08932 233 077</a></p>
        <p class="text-slate-500 text-[11px]">Courses: Residential High School, Girls & Boys A/C Hostel Wings</p>
        <div class="pt-2">
          <a href="https://www.google.com/maps/search/?api=1&query=Tirumala+Academy+Payakaraopeta" target="_blank" rel="noopener noreferrer" class="inline-flex items-center gap-1.5 text-xs font-bold text-blue-700 hover:text-blue-800 hover:underline">
            <span>Open in Google Maps</span>
            <span>↗</span>
          </a>
        </div>
      </div>

    </div>
  </div>
</section>

<?php require_once __DIR__ . '/includes/footer.php'; ?>

