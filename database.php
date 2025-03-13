<?php
class Database {
    private $pdo;

    public function __construct() {
        try {
            $this->pdo = new PDO('mysql:host=localhost;dbname=info_nilai', 'root', '');
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Koneksi gagal: " . $e->getMessage());
        }
    }

    public function getConnection() {
        return $this->pdo;
    }
}
?>
