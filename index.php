<?php
require_once 'config.php';

// Test Database Connection
if ($db->ping()) {
    echo 'Database connected successfully!';
} else {
    echo 'Failed to connect to the database.';
}
?>
