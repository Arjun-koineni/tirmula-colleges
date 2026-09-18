# Client Handoff & Technical Summary Document
## Tirumala IIT & Medical Academy Website Redesign & Rebuild

---

### Executive Summary: What Changed and Why

Tirumala IIT & Medical Academy (founded 2011) is an educational group comprising **9 schools, 17 junior colleges, and 42,600+ students** across Andhra Pradesh. The prior website (`tirumalaedu.com`) suffered from template bloat, unedited placeholder text, dead links, and a lack of self-serve content management tools for staff.

This commercial rebuild provides:
1. **100% Elimination of Dead Links**: Converted all placeholder `#` links into dedicated, real content pages:
   - `Facilities > Transport` (GPS tracking, bus fleet, routes across all 5 campuses)
   - `Facilities > A/C Hostel` (segregated boys/girls hostels, dining, 24/7 security, evening study)
   - `Facilities > Computer Lab` (CBT exam preparation lab simulating NTA JEE interface)
   - `Gallery > Games` (sports events and athletics showcase)
2. **Purging of Demo Text & Broken Contact Numbers**:
   - Removed unedited Elementor template placeholders: `"Park, Melbourne, Australia"` address and `"485-826-710"` phone number.
   - Fixed the critical bug where clicking the phone link dialed an Australian number. Replaced everywhere with the real central contact details: **Katheru, Rajamahendravaram, AP 533102**, Phone **`0883 297 0077`**, Email **`admin@tirumalaedu.com`**.
3. **Database-Driven Content Management for Staff**:
   - Replaced static/hardcoded results and announcements with an intuitive **Staff Admin Panel (`/admin`)**.
   - Staff can add results, post urgent banner notices, upload PDF model papers, and add gallery photos without touching code or relying on a web agency.
4. **Interactive Public Features**:
   - **Check Your Result**: Instant student search by name or roll number (`TIMA...`) with multi-stream filters (MPC, BiPC, Foundation, JEE, NEET, Inter).
   - **Bilingual Language Switcher**: English / Telugu toggle on Home, Admissions, and Contact.
   - **Fixed Floating WhatsApp Support**: High-converting WhatsApp chat widget with pre-filled enquiry text.
   - **Model Papers Hub**: Downloadable PDFs organized by Grade and Board.
5. **Separation of Tuition Fee vs Application Fee**:
   - **Tuition Fee**: Preserved client's existing third-party portal link to `https://tirumala.onesaz.com/sign-in`.
   - **Application Fee**: Integrated Razorpay checkout modal for new applicants (₹500 application fee).

---

### Key Client-Side Dependency: Razorpay Merchant Account

> [!IMPORTANT]
> **Client Action Required**:
> To collect live application fees (₹500 INR), the client must create or link their **Razorpay Merchant Account** (`https://razorpay.com/`).
> 
> 1. In the Razorpay Dashboard, navigate to **Settings > API Keys** and generate a `Key ID` and `Key Secret`.
> 2. Open `.env` (or `config.php`) on your hosting server and update:
>    ```env
>    RAZORPAY_KEY_ID=rzp_live_YourActualKeyId
>    RAZORPAY_KEY_SECRET=YourActualKeySecret
>    ```
> 3. Razorpay directly handles the checkout popup, UPI, debit/credit cards, and netbanking. No raw card or banking details ever touch or get stored on the Tirumala website server (100% PCI-DSS compliant).

---

### Deployment Guide: Shared Hosting / cPanel (Standard Apache/MySQL)

The entire project is written in vanilla PHP 8 + PDO and does not require Node.js, Docker, or complex serverless runtimes. It is 100% compatible with standard cPanel shared hosting (Hostinger, Bluehost, GoDaddy, BigRock, etc.).

#### Step 1: Upload Files
Upload all contents of this repository into the `public_html/` folder of your web hosting account via cPanel File Manager or FTP.

#### Step 2: Create MySQL Database
1. In cPanel, open **MySQL Databases** and create a database named `tirumala_db`.
2. Create a database user (e.g. `tirumala_user`) and assign all privileges to the database.
3. Open **phpMyAdmin**, select `tirumala_db`, click **Import**, and upload [`database.sql`](file:///c:/Users/arjun/Downloads/Tirumala%20College/database.sql).

#### Step 3: Configure Database Connection
Edit `.env` (or directly edit `config.php`) with your database details:
```env
DB_HOST=localhost
DB_NAME=tirumala_db
DB_USER=tirumala_user
DB_PASS=YourDatabasePassword
```

#### Step 4: Verify Admin Login
Navigate to `https://yourdomain.com/admin` and log in with:
- **Username**: `admin`
- **Password**: `tirumala@2026`

---

### Local Testing / Development Run Command

To preview or run the site locally on your Windows computer:
```powershell
# From the project folder:
& "C:\Users\arjun\AppData\Local\Microsoft\WinGet\Packages\PHP.PHP.8.3_Microsoft.Winget.Source_8wekyb3d8bbwe\php.exe" -S localhost:8000
```
Then visit `http://localhost:8000` in your browser.
*(Note: If MySQL is not running, the application automatically uses SQLite `tirumala.sqlite` for instant local testing with zero setup!)*
