<?php
/**
 * Facilities: Transport - Tirumala IIT & Medical Academy
 */
$pageTitle = "Transport & Fleet Safety | GPS-Tracked Campus Buses";
$currentNav = "facilities-transport";
$metaDesc = "Safe, air-conditioned and GPS-enabled student bus transportation network across Rajamahendravaram, Vizag, Bhimavaram, Tanuku, and Payakaraopeta.";
require_once __DIR__ . '/../includes/header.php';
?>

<!-- BANNER -->
<section class="bg-tirumala-gradient text-white py-14">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
    <span class="text-amber-400 font-bold text-xs uppercase tracking-widest">Campus Infrastructure</span>
    <h1 class="text-3xl sm:text-5xl font-extrabold text-white mt-1">Student Transportation & Fleet Safety</h1>
    <p class="text-slate-300 text-sm sm:text-base max-w-2xl mx-auto mt-3">
      Connecting over 140+ route pick-up points across Coastal Andhra with modern GPS-tracked, speed-regulated buses.
    </p>
  </div>
</section>

<!-- MAIN CONTENT -->
<section class="py-16 bg-white">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
      
      <div class="lg:col-span-6 space-y-5">
        <span class="text-tcrimson font-bold text-xs uppercase tracking-widest">Reliable & Punctual</span>
        <h2 class="text-3xl font-extrabold text-tnavy">Peace of Mind for Every Parent</h2>
        <p class="text-slate-600 text-sm leading-relaxed">
          At Tirumala Academy, we understand that a safe journey to school is the prerequisite for a productive academic day. We operate our own dedicated fleet of over 65+ school buses serving all 5 campus zones.
        </p>
        <p class="text-slate-600 text-sm leading-relaxed">
          Every vehicle is monitored round-the-clock via a central transport operations desk located at our Katheru Central Campus, ensuring strict adherence to schedules and traffic safety laws.
        </p>

        <!-- Feature Points -->
        <div class="space-y-3 pt-2">
          <div class="flex items-start gap-3">
            <span class="w-6 h-6 rounded-full bg-emerald-100 text-emerald-700 flex items-center justify-center text-xs font-bold flex-shrink-0">✓</span>
            <div>
              <strong class="text-sm text-slate-800">Real-Time GPS Tracking & Speed Governors</strong>
              <p class="text-xs text-slate-500">Buses are restricted to safe speeds (under 40 km/h) with automated alerts if deviation occurs.</p>
            </div>
          </div>

          <div class="flex items-start gap-3">
            <span class="w-6 h-6 rounded-full bg-emerald-100 text-emerald-700 flex items-center justify-center text-xs font-bold flex-shrink-0">✓</span>
            <div>
              <strong class="text-sm text-slate-800">Female Bus Attendants & CCTV In Every Bus</strong>
              <p class="text-xs text-slate-500">Trained female support staff accompany students on all primary and high school routes.</p>
            </div>
          </div>

          <div class="flex items-start gap-3">
            <span class="w-6 h-6 rounded-full bg-emerald-100 text-emerald-700 flex items-center justify-center text-xs font-bold flex-shrink-0">✓</span>
            <div>
              <strong class="text-sm text-slate-800">First Aid & Emergency Protocols</strong>
              <p class="text-xs text-slate-500">Every bus is equipped with a certified first-aid kit, fire extinguisher, and direct wireless line to campus medical bays.</p>
            </div>
          </div>
        </div>

      </div>

      <div class="lg:col-span-6">
        <div class="bg-slate-50 rounded-2xl p-8 border border-slate-200 shadow-sm space-y-6">
          <h3 class="text-xl font-bold text-tnavy">Transport Coverage Zones</h3>
          
          <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-xs">
            <div class="bg-white p-4 rounded-xl border border-slate-200">
              <strong class="text-slate-900 block font-bold mb-1">📍 Rajamahendravaram</strong>
              <p class="text-slate-500">Katheru, Morampudi, Danavaipeta, Kotipalli, Dowleswaram, Prakash Nagar, Bommuru, Lalacheruvu.</p>
            </div>

            <div class="bg-white p-4 rounded-xl border border-slate-200">
              <strong class="text-slate-900 block font-bold mb-1">📍 Visakhapatnam</strong>
              <p class="text-slate-500">MVP Colony, Maddilapalem, Gajuwaka, Pendurthi, Seethammadhara, Madhurawada, Kurmannapalem.</p>
            </div>

            <div class="bg-white p-4 rounded-xl border border-slate-200">
              <strong class="text-slate-900 block font-bold mb-1">📍 Bhimavaram</strong>
              <p class="text-slate-500">PP Road, Undi Road, Palakollu route, Veeravasaram, Sompeta, Juvvalapalem.</p>
            </div>

            <div class="bg-white p-4 rounded-xl border border-slate-200">
              <strong class="text-slate-900 block font-bold mb-1">📍 Tanuku & Payakaraopeta</strong>
              <p class="text-slate-500">Overbridge center, Old Town, Peravali route, Tuni Highway, Nakkapalli link.</p>
            </div>
          </div>

          <div class="bg-amber-50 border border-amber-200 p-4 rounded-xl flex items-center justify-between text-xs">
            <div>
              <span class="font-bold text-amber-900 block">Need a Custom Pick-Up Point?</span>
              <span class="text-amber-700">Contact our Transport In-Charge for route additions.</span>
            </div>
            <a href="tel:<?php echo INSTITUTE_PHONE_TEL; ?>" class="bg-amber-500 hover:bg-amber-600 text-slate-950 font-bold px-3 py-1.5 rounded text-xs transition">Enquire</a>
          </div>

        </div>
      </div>

    </div>
  </div>
</section>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>
