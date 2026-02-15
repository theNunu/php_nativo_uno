<?php


require_once __DIR__ . "/src/config/database.php";
require_once __DIR__ . "/src/controllers/UserController.php";
require_once __DIR__ . "/src/controllers/AuthController.php";

$database = new Database();
$db = $database->connect();
$controller = new UserController($db);

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$method = $_SERVER['REQUEST_METHOD'];

if ($uri === '/users' && $method === 'GET') {

    $users = $controller->index();
    require __DIR__ . "/src/views/users/index.php";

} elseif ($uri === '/users/create' && $method === 'GET') {

    require __DIR__ . "/src/views/users/create.php";

} elseif ($uri === '/users/store' && $method === 'POST') {

    $controller->store($_POST);
    header("Location: /users");
    exit;

} elseif ($uri === '/send-otp' && $method === 'POST') {

    $data = json_decode(file_get_contents("php://input"), true);

    $auth = new AuthController();
    $response = $auth->sendOtp($data['email']);

    echo json_encode($response);
} else {

    echo "Ruta no encontrada";

}