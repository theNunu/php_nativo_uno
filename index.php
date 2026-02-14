<?php

header("Content-Type: application/json");

require_once "src/config/database.php";
require_once "src/controllers/UserController.php";

$database = new Database();
$db = $database->connect();

$controller = new UserController($db);

$method = $_SERVER['REQUEST_METHOD'];
$data = json_decode(file_get_contents("php://input"), true);

switch($method) {

    case 'GET':
        echo json_encode($controller->index());
        break;

    case 'POST':
        if ($controller->store($data)) {
            echo json_encode(["message" => "Usuario creado"]);
        }
        break;

    case 'PUT':
        $id = $_GET['id'];
        if ($controller->update($id, $data)) {
            echo json_encode(["message" => "Usuario actualizado"]);
        }
        break;

    case 'DELETE':
        $id = $_GET['id'];
        if ($controller->destroy($id)) {
            echo json_encode(["message" => "Usuario eliminado"]);
        }
        break;

    default:
        echo json_encode(["message" => "Método no permitido"]);
}
