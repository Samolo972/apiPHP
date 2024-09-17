<?php
class Exercice
{
    private $connexion;
    private $table = 'exercices';


    public $id;
    public $nom;
    public $description;
    public $type;
    public $muscle_principale;
    public $equipement_necessaire;
    public $niveau_difficulte;
    public $created_at;
    public $updated_at;

    public function __construct($db)
    {
        $this->connexion = $db;
    }

    // Lire tous les exercices
    public function read()
    {
        $sql = "SELECT * FROM " . $this->table;
        $query = $this->connexion->prepare($sql);
        $query->execute();

        return $query;
    }

    public function create()
    {
        $sql = "INSERT INTO " . $this->table . "
                SET
                    nom = :nom,
                    description = :description,
                    type = :type,
                    muscle_principale = :muscle_principale,
                    equipement_necessaire = :equipement_necessaire,
                    niveau_difficulte = :niveau_difficulte";

        $query = $this->connexion->prepare($sql);

        $this->nom = htmlspecialchars(strip_tags($this->nom));
        $this->description = htmlspecialchars(strip_tags($this->description));
        $this->type = htmlspecialchars(strip_tags($this->type));
        $this->muscle_principale = htmlspecialchars(strip_tags($this->muscle_principale));
        $this->equipement_necessaire = htmlspecialchars(strip_tags($this->equipement_necessaire));
        $this->niveau_difficulte = htmlspecialchars(strip_tags($this->niveau_difficulte));


        $query->bindParam(":nom", $this->nom);
        $query->bindParam(":description", $this->description);
        $query->bindParam(":type", $this->type);
        $query->bindParam(":muscle_principale", $this->muscle_principale);
        $query->bindParam(":equipement_necessaire", $this->equipement_necessaire);
        $query->bindParam(":niveau_difficulte", $this->niveau_difficulte);


        if ($query->execute()) {
            return true;
        }

        return false;
    }

    public function update()
    {
        $sql = "UPDATE " . $this->table . "
                SET
                    nom = :nom,
                    description = :description,
                    type = :type,
                    muscle_principale = :muscle_principale,
                    equipement_necessaire = :equipement_necessaire,
                    niveau_difficulte = :niveau_difficulte
                WHERE
                    id = :id";

        $query = $this->connexion->prepare($sql);

        // Protection contre les injections SQL
        $this->id = htmlspecialchars(strip_tags($this->id));
        $this->nom = htmlspecialchars(strip_tags($this->nom));
        $this->description = htmlspecialchars(strip_tags($this->description));
        $this->type = htmlspecialchars(strip_tags($this->type));
        $this->muscle_principale = htmlspecialchars(strip_tags($this->muscle_principale));
        $this->equipement_necessaire = htmlspecialchars(strip_tags($this->equipement_necessaire));
        $this->niveau_difficulte = htmlspecialchars(strip_tags($this->niveau_difficulte));

        // Liaison des paramètres
        $query->bindParam(":id", $this->id);
        $query->bindParam(":nom", $this->nom);
        $query->bindParam(":description", $this->description);
        $query->bindParam(":type", $this->type);
        $query->bindParam(":muscle_principale", $this->muscle_principale);
        $query->bindParam(":equipement_necessaire", $this->equipement_necessaire);
        $query->bindParam(":niveau_difficulte", $this->niveau_difficulte);

        // Exécution de la requête
        if ($query->execute()) {
            return true;
        }

        return false;
    }


    public function delete()
    {
        $sql = "DELETE FROM " . $this->table . " WHERE id = :id";

        $query = $this->connexion->prepare($sql);


        $this->id = htmlspecialchars(strip_tags($this->id));


        $query->bindParam(":id", $this->id);


        if ($query->execute()) {
            return true;
        }

        return false;
    }
}
