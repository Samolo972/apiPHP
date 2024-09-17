<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: DELETE,POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

if ($_SERVER['REQUEST_METHOD'] == 'DELETE') {
    include_once '../config/database.php';
    include_once '../models/exercice.php';

    $database = new Database();
    $db = $database->getConnection();

    $exercice = new Exercice($db);

    $data = json_decode(file_get_contents("php://input"));

    if (!empty($data->id)) {
        $exercice->id = $data->id;

        if ($exercice->delete()) {
            http_response_code(200);
            echo json_encode(["message" => "L'exercice a été supprimé."]);
        } else {
            http_response_code(503);
            echo json_encode(["message" => "Impossible de supprimer l'exercice."]);
        }
    } else {
        http_response_code(400);
        echo json_encode(["message" => "Impossible de supprimer l'exercice. ID manquant."]);
    }
} else {
    http_response_code(405);
    echo json_encode(["message" => "La méthode n'est pas autorisée"]);
}
