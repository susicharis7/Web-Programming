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
        // prava poenta preparedStatementa -> mozemo ubacivati vise studenata
        $stmt->execute([
            'first_name' => 'Harkiz',
            'last_name' => 'Student'
        ]);

        $stmt->execute([
            'first_name' => 'Semha',
            'last_name' => 'Majser'
        ]);

        $stmt->execute([
            'first_name' => 'Tarik',
            'last_name' => 'Skender'
        ]);

        

        echo "Uspjesno ubaceni svi studenti!";
    }

    public function getConnection() {
        return $this->connection;
    }
}

$db = new Database("students");

$stmt = $db->getConnection()->query("SELECT COUNT(*) as broj FROM students WHERE first_name = 'Harkiz' AND last_name = 'Student'");
$broj = $stmt->fetch()['broj'];

if ($broj == 0) {
    $db->insertTestStudent();
} else {
    echo "You already inserted him!";
}
?>