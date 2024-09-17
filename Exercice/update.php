<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: PUT , POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

if ($_SERVER['REQUEST_METHOD'] == 'PUT') {
    include_once '../config/database.php';
    include_once '../models/exercice.php';

    $database = new Database();
    $db = $database->getConnection();

    $exercice = new Exercice($db);

    $data = json_decode(file_get_contents("php://input"));

    if (
        !empty($data->id) &&
        !empty($data->nom) &&
        !empty($data->description) &&
        !empty($data->type) &&
        !empty($data->muscle_principale) &&
        !empty($data->equipement_necessaire) &&
        !empty($data->niveau_difficulte)
    ) {
        // Remplir les propriétés de l'exercice
        $exercice->id = $data->id;
        $exercice->nom = $data->nom;
        $exercice->description = $data->description;
        $exercice->type = $data->type;
        $exercice->muscle_principale = $data->muscle_principale;
        $exercice->equipement_necessaire = $data->equipement_necessaire;
        $exercice->niveau_difficulte = $data->niveau_difficulte;

        if ($exercice->update()) {
            http_response_code(200);
            echo json_encode(["message" => "L'exercice a été mis à jour."]);
        } else {
            http_response_code(503);
            echo json_encode(["message" => "Impossible de mettre à jour l'exercice."]);
        }
    } else {
        http_response_code(400);
        echo json_encode(["message" => "Impossible de mettre à jour l'exercice. Données incomplètes."]);
    }
} else {
    http_response_code(405);
    echo json_encode(["message" => "La méthode n'est pas autorisée"]);
}
