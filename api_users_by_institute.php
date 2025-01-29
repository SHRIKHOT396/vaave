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

// Validate institute_id
if (!isset($_GET['institute_id']) || empty(trim($_GET['institute_id']))) {
    http_response_code(400); // Bad Request
    echo json_encode(['error' => 'Parameter "institute_id" is required']);
    exit;
}

$instituteId = $_GET['institute_id'];

// Check if institute_id is numeric
if (!is_numeric($instituteId)) {
    http_response_code(400); // Bad Request
    echo json_encode(['error' => 'Invalid "institute_id". It must be a numeric value']);
    exit;
}

// Check if the institute_id exists in the database
$db->where("id", $instituteId);
$institute = $db->getOne("institutes");
if (!$institute) {
    http_response_code(404); // Not Found
    echo json_encode(['error' => 'No institute found with the provided "institute_id"']);
    exit;
}

// Fetch users for the institute
$db->join("institutes i", "u.institute_id = i.id", "LEFT");
$db->where("u.institute_id", $instituteId);
$users = $db->get("users u", null, "u.id, u.name, u.email, i.name as institute_name");

echo json_encode($users);
?>

