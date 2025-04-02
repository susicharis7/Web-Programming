<?php
ini_set('display_errors',1);
error_reporting(E_ALL);

class secondDatabase {
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
                "mysql:host=" . self::$host . ";dbname=" . self::$dbName . ";port=" . self::$dbPort, self::$username, self::$password, [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
                ]
                );
        } catch(Exception $e) {
            die("Greska u konekciji" . $e->getMessage());
        }
    }

    public function insertIntoStudents() {
        $students = [
            ['first_name' => 'Haris', 'last_name' => 'Susic'],
            ['first_name' => 'Semha', 'last_name' => 'Majser'],
            ['first_name' => 'Haris', 'last_name' => 'Susic'] // duplicate for testing
        ];

        foreach($students as $s) {
            $stnt = $this->connection->prepare(
                "SELECT COUNT(*) as broj FROM students WHERE first_name = :first_name AND last_name = :last_name"
            );

            $stnt->execute([
                'first_name' => $s['first_name'],
                'last_name' => $s['last_name']
            ]);

            $broj = $stnt->fetch()['broj'];

            if($broj == 0) {
                $insert = $this->connection->prepare(
                    "INSERT INTO students (first_name,last_name) VALUES (:first_name, :last_name)"
                );

                $insert->execute([
                    'first_name' => $s['first_name'],
                    'last_name' => $s['last_name']
                ]);
            } else {
                echo "DUPLIKAT!";
            }
        }
    }

    public function getConnection() {
        return $this->connection;
    }
}

$db = new secondDatabase("students");
$db->insertIntoStudents();

?>