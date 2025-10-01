<?php
// Database configuration
define('DB_HOST', 'localhost');
define('DB_NAME', 'certiverify');
define('DB_USER', 'your_username');
define('DB_PASS', 'your_password');

// Site configuration
define('SITE_URL', 'http://yourdomain.com');
define('SITE_NAME', 'CertiVerify');

// File upload configuration
define('UPLOAD_DIR', __DIR__ . '/../uploads/certificates/');
define('MAX_FILE_SIZE', 5 * 1024 * 1024); // 5MB
define('ALLOWED_FILE_TYPES', ['jpg', 'jpeg', 'png', 'pdf']);

// Start session
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Error reporting (disable in production)
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
?>