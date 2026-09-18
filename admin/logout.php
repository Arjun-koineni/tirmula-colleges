<?php
/**
 * Admin Logout
 */
require_once __DIR__ . '/../config.php';

unset($_SESSION['tirumala_admin_id']);
unset($_SESSION['tirumala_admin_user']);
unset($_SESSION['tirumala_admin_name']);
session_destroy();

header('Location: /admin/login.php');
exit;
