<?php
// Database Configuration
// হোস্টিং-এ গিয়ে এই মানগুলো পরিবর্তন করবে

define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'bangla_newspaper');

// Admin credentials (প্রথমে সহজ রাখা হয়েছে, পরে hash করে নেবে)
define('ADMIN_USERNAME', 'admin');
define('ADMIN_PASSWORD', 'admin123'); // লাইভে অবশ্যই পরিবর্তন করবে

// Site settings
define('SITE_NAME', 'সকল বাংলা সংবাদপত্র');
define('SITE_URL', 'http://localhost/all-bangla-newspaper'); // তোমার ডোমেইন দিয়ে পরিবর্তন করো

session_start();

// Database connection
function getDB() {
    static $conn = null;
    if ($conn === null) {
        try {
            $conn = new PDO(
                "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=utf8mb4",
                DB_USER,
                DB_PASS,
                [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                    PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8mb4"
                ]
            );
        } catch (PDOException $e) {
            die("ডাটাবেস কানেকশন ব্যর্থ: " . $e->getMessage());
        }
    }
    return $conn;
}

// Check if admin is logged in
function isAdminLoggedIn() {
    return isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] === true;
}

// Redirect helper
function redirect($url) {
    header("Location: $url");
    exit;
}
