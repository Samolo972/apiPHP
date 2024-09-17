<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include_once '../config/database.php';
    include_once '../models/exercice.php';

    $database = new Database();
    $db = $database->getConnection();

    $exercice = new Exercice($db);

    // Récupération des données envoyées
    $data = json_decode(file_get_contents("php://input"));

    if (
        !empty($data->nom) &&
        !empty($data->description) &&
        !empty($data->type) &&
        !empty($data->muscle_principale) &&
        !empty($data->equipement_necessaire) &&
        !empty($data->niveau_difficulte)
    ) {
        $exercice->nom = $data->nom;
        $exercice->description = $data->description;
        $exercice->type = $data->type;
        $exercice->muscle_principale = $data->muscle_principale;
        $exercice->equipement_necessaire = $data->equipement_necessaire;
        $exercice->niveau_difficulte = $data->niveau_difficulte;

        if ($exercice->create()) {
            http_response_code(201);
            echo json_encode(["message" => "L'exercice a été créé."]);
        } else {
            http_response_code(503);
            echo json_encode(["message" => "Impossible de créer l'exercice."]);
        }
    } else {
        http_response_code(400);
        echo json_encode(["message" => "Impossible de créer l'exercice. Données incomplètes."]);
    }
} else {
    http_response_code(405);
    echo json_encode(["message" => "La méthode n'est pas autorisée"]);
}
