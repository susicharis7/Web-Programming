<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

class Database {
    private static $host = "localhost";
    private static $dbName = "university";
    private static $dbPort = 3306;
    private static $username = "root";
    private static $password = "harkeking333";

    private $connection = null;
    private $table;

    public function __construct($table) {
        $this->table = $table;

        try {
            $this->connection = new PDO(
                "mysql:host=" . self::$host . ";dbname=" . self::$dbName . ";port=" . self::$dbPort,
                self::$username,
                self::$password,
                [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
                ]
            );
        } catch (PDOException $e) {
            die("Greška u konekciji: " . $e->getMessage());
        }
    }

    public function insertTestStudent() {
        $sql = "INSERT INTO students (first_name, last_name) VALUES (:first_name, :last_name)";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute([
            'first_name' => 'Harkiz',
            'last_name' => 'Student'
        ]);

        echo "Uspjesno ubacen harkiz student!";
    }
}

echo "START<br>";

$db = new Database("students");

echo "KONEKCIJA OK<br>";

$db->insertTestStudent();

echo "<br>Script reached the end.";
