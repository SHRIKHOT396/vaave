<?php
require_once 'config.php';

// Helper function for basic authentication
function authenticate($db) {
    if (!isset($_SERVER['PHP_AUTH_USER'], $_SERVER['PHP_AUTH_PW'])) {
        http_response_code(401);
        header('WWW-Authenticate: Basic realm="Restricted Area"');
        echo json_encode(['error' => 'Authentication required']);
        exit;
    }

    $username = $_SERVER['PHP_AUTH_USER'];
    $password = $_SERVER['PHP_AUTH_PW'];

    // Verify credentials against the database
    $query = "SELECT * FROM api_auth_creds WHERE username = ? AND password = ?";
    $credentials = $db->rawQuery($query, [$username, $password]);

    if (!$credentials) {
        http_response_code(401);
        echo json_encode(['error' => 'Invalid credentials']);
        exit;
    }
}

// Authenticate the request
authenticate($db);

// Get input parameters
$latitude = isset($_GET['latitude']) ? (float) $_GET['latitude'] : null;
$longitude = isset($_GET['longitude']) ? (float) $_GET['longitude'] : null;
$radius = isset($_GET['radius']) ? (float) $_GET['radius'] : null;

// Validate input
if ($latitude === null || $longitude === null || $radius === null) {
    http_response_code(400);
    echo json_encode(['error' => 'Missing required parameters: latitude, longitude, or radius']);
    exit;
}

if ($latitude < -90 || $latitude > 90 || $longitude < -180 || $longitude > 180) {
    http_response_code(400);
    echo json_encode(['error' => 'Invalid latitude or longitude values']);
    exit;
}

if ($radius <= 0) {
    http_response_code(400);
    echo json_encode(['error' => 'Invalid radius value. It must be a positive number.']);
    exit;
}

// Query to find alumni within the specified radius
$query = "
    SELECT id, name, email, latitude, longitude, 
           ST_Distance_Sphere(location, POINT(?, ?)) AS distance
    FROM users
    WHERE ST_Distance_Sphere(location, POINT(?, ?)) <= ?
";

try {
    $results = $db->rawQuery($query, [$longitude, $latitude, $longitude, $latitude, $radius * 1000]);

    if ($results) {
        http_response_code(200);
        echo json_encode($results);
    } else {
        http_response_code(404);
        echo json_encode(['message' => 'No alumni found within the specified radius.']);
    }
} catch (Exception $e) {
    error_log('Database error: ' . $e->getMessage());
    http_response_code(500);
    echo json_encode(['error' => 'An internal server error occurred.']);
}
?>
