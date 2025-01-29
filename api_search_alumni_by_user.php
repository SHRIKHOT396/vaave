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

// Function for finding user's lat and long 
function get_user_latlong($db, $user_id) {
    $query = "SELECT latitude, longitude FROM users WHERE id = ?";
    $user_loc = $db->rawQuery($query, [$user_id]);

    if (!$user_loc || empty($user_loc)) {
        http_response_code(404);
        echo json_encode(['error' => 'No location data found for the user.']);
        exit;
    }

    return $user_loc[0]; // Return the first record as an associative array
}

// Authenticate the request
authenticate($db);

// Get input parameters
$user_id = isset($_GET['user_id']) ? (int) $_GET['user_id'] : null;
$radius = isset($_GET['radius']) ? (float) $_GET['radius'] : null;

if (!$user_id || $user_id < 1) {
    http_response_code(400);
    echo json_encode(['error' => 'Invalid user ID.']);
    exit;
}

if ($radius <= 0) {
    http_response_code(400);
    echo json_encode(['error' => 'Invalid radius value. It must be a positive number.']);
    exit;
}

// Fetch user location
$user_location = get_user_latlong($db, $user_id);
$latitude = $user_location['latitude'];
$longitude = $user_location['longitude'];

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
