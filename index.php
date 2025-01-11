<?php
// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Handle all requests to the API
if ($_SERVER['REQUEST_URI'] === '/swaap-api/api/users') {
    require_once 'api/users.php';
} else if ($_SERVER['REQUEST_URI'] === '/swaap-api/api/admin') {
    require_once 'api/admin.php';
} else {
    http_response_code(404); // Not Found
    echo json_encode(["error" => "Route not found"]);
}
