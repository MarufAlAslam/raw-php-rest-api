<?php
// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Handle all requests to the API
if ($_SERVER['REQUEST_URI'] === '/swaap-api/api/admin') {
    require_once 'api/admin.php';
} else {
    http_response_code(404); // Not Found
    echo json_encode(["error" => "Route not found"]);
}

require_once __DIR__ . '/../config/database.php';

header('Content-Type: application/json');
// Allow cross-origin requests from your frontend
header('Access-Control-Allow-Origin: *');  // Allow all domains (or specify your frontend domain)
header('Access-Control-Allow-Methods: GET, POST, DELETE');  // Allow these HTTP methods
header('Access-Control-Allow-Headers: Content-Type');  // Allow these headers (usually needed for POST/PUT requests)

// Handle pre-flight requests (for browsers)
if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    http_response_code(200);
    exit;
}

// Route handling based on HTTP method
$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
    case 'GET':
        getAdmin();
        break;
    case 'POST':
        createAdmin();
        break;
    case 'DELETE':
        deleteAdmin();
        break;
    default:
        http_response_code(405); // Method Not Allowed
        echo json_encode(["error" => "Method not allowed"]);
        break;
}

function getAdmin()
{
    global $pdo;

    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $stmt = $pdo->prepare("SELECT * FROM admin WHERE id = ?");
        $stmt->execute([$id]);
        $admin = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($admin) {
            echo json_encode($admin);
        } else {
            http_response_code(404); // Not Found
            echo json_encode(["error" => "Admin not found"]);
        }
    } else {
        $stmt = $pdo->query("SELECT * FROM admin");
        $admin = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($admin);
    }
}

function createAdmin()
{
    global $pdo;

    $data = json_decode(file_get_contents('php://input'), true);
    $stmt = $pdo->prepare("INSERT INTO admin (username, password) VALUES (?, ?)");
    $stmt->execute([$data['username'], $data['password']]);
    echo json_encode(["message" => "Admin created"]);
}

function deleteAdmin()
{
    global $pdo;

    $data = json_decode(file_get_contents('php://input'), true);
    $stmt = $pdo->prepare("DELETE FROM admin WHERE id = ?");
    $stmt->execute([$data['id']]);
    echo json_encode(["message" => "Admin deleted"]);
}

// Close the database connection
$pdo = null;

?>