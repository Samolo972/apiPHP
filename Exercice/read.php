<?php
// Autoriser l'accès à tous les domaines
header("Access-Control-Allow-Origin: *");

// Définir le type de contenu en JSON avec encodage en UTF-8
header("Content-Type: application/json; charset=UTF-8");

// Autoriser uniquement la méthode GET pour cette API
header("Access-Control-Allow-Methods: GET");

// Définir le temps maximum pour le pré-traitement des requêtes (en secondes)
header("Access-Control-Max-Age: 3600");

// Définir les en-têtes autorisés pour les requêtes
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// Vérifier que la méthode utilisée est GET
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    //  traitement pour la méthode GET l'envoi des données aux utilisateurs
    //on inclut les fichers
    include_once '../config/database.php';
    include_once '../models/exercice.php';

    $database = new Database();
    $db = $database->getConnection();

    $exercice = new Exercice($db);
    //recup des données
    $stmt = $exercice->read();


    //on verif si il y a une réponse
    if ($stmt->rowCount() > 0) {
        // les tabs
        $tableauExercice = [];
        $tableauExercice['exercices'] = [];

        // on parcourt les exercices
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            extract($row);

            $exos = [
                'id' => $id,
                'nom' => $nom,
                'description' => $description,
                'type' => $type,
                'muscle_principale' => $muscle_principale,
                'equipement_necessaire' => $equipement_necessaire,
                'niveau_difficulte' => $niveau_difficulte,
                'created_at' => $created_at,
                'updated_at' => $updated_at
            ];

            $tableauExercice['exercices'][] = $exos;
        }

        http_response_code(200);
        echo json_encode($tableauExercice);
    }
} else {
    http_response_code(405);
    echo json_encode(["message" => "La méthode n'est pas autorisée"]);
}
