<?php
require_once 'MysqliDb.php';

// Database connection settings
$db = new MysqliDb([
    'host' => '127.0.0.1',   // XAMPP MySQL host
    'username' => 'root',    // Default username in XAMPP
    'password' => '',        // Default password in XAMPP
    'db'=> 'vaave_alumni_search',  // Your database name
    'port' => 3306,          // MySQL default port
    'charset' => 'utf8mb4'
]);

// Create connection mysqli
$dbcon = mysqli_connect('localhost','root','','vaave_alumni_search');
?>
