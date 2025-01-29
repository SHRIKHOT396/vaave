<?php
require_once 'config.php';

// Get POST data
$id = $_POST['id'];
$name = $_POST['name'];
$email = $_POST['email'];
$latitude = $_POST['latitude'];
$longitude = $_POST['longitude'];

// Validate inputs
if (empty($id) || !is_numeric($id)) {
    http_response_code(400); // Bad Request
    echo json_encode(['status' => 'error', 'message' => 'Invalid or missing ID']);
    exit;
}

if (empty($name) || strlen($name) > 255) {
    http_response_code(400); // Bad Request
    echo json_encode(['status' => 'error', 'message' => 'Invalid or missing name']);
    exit;
}

if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
    http_response_code(400); // Bad Request
    echo json_encode(['status' => 'error', 'message' => 'Invalid or missing email']);
    exit;
}

if (empty($latitude) || !is_numeric($latitude) || $latitude < -90 || $latitude > 90) {
    http_response_code(400); // Bad Request
    echo json_encode(['status' => 'error', 'message' => 'Invalid latitude']);
    exit;
}

if (empty($longitude) || !is_numeric($longitude) || $longitude < -180 || $longitude > 180) {
    http_response_code(400); // Bad Request
    echo json_encode(['status' => 'error', 'message' => 'Invalid longitude']);
    exit;
}

// Sanitize inputs to prevent XSS or other harmful input
$name = htmlspecialchars($name, ENT_QUOTES, 'UTF-8');
$email = htmlspecialchars($email, ENT_QUOTES, 'UTF-8');

// Prepare the query with parameters (for SQL injection protection)
$query = "UPDATE users SET name = ?, email = ?, latitude = ?, longitude = ?, location = ST_GeomFromText('POINT($longitude $latitude)') WHERE id = ?";

// Prepare statement
$stmt = mysqli_prepare($dbcon, $query);

// Bind parameters (s - string, d - double, i - integer)
mysqli_stmt_bind_param($stmt, "ssddi", $name, $email, $latitude, $longitude, $id);

// Execute the query
if (mysqli_stmt_execute($stmt)) {
    echo json_encode(['status' => 'success', 'message' => 'User updated successfully']);
} else {
    echo json_encode(['status' => 'error', 'message' => mysqli_stmt_error($stmt)]);
}

// Close statement and connection
mysqli_stmt_close($stmt);
mysqli_close($dbcon);
?>
