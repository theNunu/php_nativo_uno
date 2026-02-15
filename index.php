<?php


require_once __DIR__ . "/src/config/database.php";
require_once __DIR__ . "/src/controllers/UserController.php";

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

} else {

    echo "Ruta no encontrada";

}