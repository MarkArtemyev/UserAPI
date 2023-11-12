<?php
header("Content-Type: application/json");

$method = $_SERVER['REQUEST_METHOD'];
$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$paths = explode('/', $path);
$resource = $paths[2]; 

switch ($resource) {
    case 'user':
        switch ($method) {
            case 'POST':
                $data = json_decode(file_get_contents('php://input'), true);
                echo json_encode(["status" => "success", "message" => "User created"]);
                break;
            case 'PUT':
                $id = $paths[3];
                $data = json_decode(file_get_contents('php://input'), true);
                echo json_encode(["status" => "success", "message" => "User updated"]);
                break;
            case 'DELETE':
                $id = $paths[3];
                echo json_encode(["status" => "success", "message" => "User deleted"]);
                break;
            case 'GET':
                if(isset($paths[3])){
                    $id = $paths[3];
                    echo json_encode(["status" => "success", "data" => "User data here"]);
                }
                break;
            default:
                header("HTTP/1.1 405 Method Not Allowed");
                break;
        }
        break;
    case 'login':
        if ($method == 'POST') {
            $data = json_decode(file_get_contents('php://input'), true);
            echo json_encode(["status" => "success", "message" => "User logged in"]);
        } else {
            header("HTTP/1.1 405 Method Not Allowed");
        }
        break;
    default:
        header("HTTP/1.1 404 Not Found");
        break;
}

?>
