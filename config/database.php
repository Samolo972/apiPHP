<?php
class Database {
    private $host = 'localhost';
    private $db_name = 'apimuscu';
    private $username = 'root';
    private $password = '';

    private $connexion;

    public function getConnection() {
        $this->connexion = null;
        try {
            $dsn = "mysql:host=" . $this->host . ";dbname=" . $this->db_name;
            $this->connexion = new PDO($dsn, $this->username, $this->password);
            $this->connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo "Erreur de connexion : " . $e->getMessage();
        }
        return $this->connexion;
    }
}
?>