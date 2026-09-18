<?php
/**
 * Admin Login Page
 */
require_once __DIR__ . '/../config.php';

$error = '';

if (isAdminLoggedIn()) {
    header('Location: /admin/index.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = trim($_POST['password'] ?? '');

    if (!empty($username) && !empty($password)) {
        try {
            $db = getDB();
            $stmt = $db->prepare("SELECT * FROM admin_users WHERE username = ? LIMIT 1");
            $stmt->execute([$username]);
            $user = $stmt->fetch();

            if ($user && password_verify($password, $user['password_hash'])) {
                $_SESSION['tirumala_admin_id'] = $user['id'];
                $_SESSION['tirumala_admin_user'] = $user['username'];
                $_SESSION['tirumala_admin_name'] = $user['full_name'];
                header('Location: /admin/index.php');
                exit;
            } else {
                $error = "Invalid username or password. Please try again.";
            }
        } catch (Throwable $e) {
            $error = "Database authentication error: " . $e->getMessage();
        }
    } else {
        $error = "Please enter both username and password.";
    }
}

$adminTitle = "Staff Login";
require_once __DIR__ . '/includes/header.php';
?>

<div class="max-w-md mx-auto my-12 bg-white rounded-2xl shadow-xl p-8 border border-slate-200">
  <div class="text-center space-y-2 mb-6">
    <img src="/assets/images/round_logo.png" alt="Logo" class="w-16 h-16 rounded-full mx-auto p-1 bg-slate-50 border border-slate-200">
    <h2 class="text-2xl font-bold text-slate-900">Staff Portal Login</h2>
    <p class="text-xs text-slate-500">Authorized school staff & admissions administration only.</p>
  </div>

  <?php if ($error): ?>
    <div class="bg-red-50 border-l-4 border-red-500 text-red-700 p-3 text-xs rounded mb-5">
      <?php echo htmlspecialchars($error); ?>
    </div>
  <?php endif; ?>

  <form method="POST" action="/admin/login.php" class="space-y-4">
    <div>
      <label class="block text-xs font-bold text-slate-700 mb-1">Username</label>
      <input type="text" name="username" required value="<?php echo htmlspecialchars($_POST['username'] ?? 'admin'); ?>" class="w-full text-sm px-3.5 py-2.5 rounded-lg border border-slate-300 focus:ring-2 focus:ring-amber-500 outline-none">
    </div>

    <div>
      <label class="block text-xs font-bold text-slate-700 mb-1">Password</label>
      <input type="password" name="password" required placeholder="••••••••" class="w-full text-sm px-3.5 py-2.5 rounded-lg border border-slate-300 focus:ring-2 focus:ring-amber-500 outline-none">
    </div>

    <button type="submit" class="w-full bg-slate-900 hover:bg-slate-800 text-white font-bold py-3 px-4 rounded-lg text-sm shadow transition mt-2">
      Sign In to Dashboard
    </button>
  </form>

  <div class="mt-6 p-3 bg-amber-50 rounded-lg border border-amber-200 text-[11px] text-amber-900">
    <strong class="block font-bold">Default Credentials for Handoff:</strong>
    Username: <code class="font-mono bg-white px-1 rounded">admin</code> | Password: <code class="font-mono bg-white px-1 rounded">tirumala@2026</code>
  </div>
</div>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
