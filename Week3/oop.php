<?php
// OOP in PHP
    // Class
    class Student {
        public $first_name;
        public $last_name;

        // Constructor 
        public function __construct($first_name, $last_name) {
            $this->first_name = $first_name;
            $this->last_name = $last_name;
        }
        
        // Access Modifiers
        public function setFirstName($first_name) {
            $this->first_name = $first_name;
        }

        public function getFirstName() {
            return $this->first_name;
        }

        // Functions
        public function start() {
            echo "Academic year far ahead! <br>";
        }
    }

    class Person extends Student {
        public $last_name;

        public function __construct($first_name, $last_name) {
            $this->first_name = $first_name;
            $this->last_name = $last_name;
        }

        public function start() {
            echo $this->first_name;
        }
    }


    // Object 
    $student1 = new Student('Sumea','Majser');
    $student1->first_name = "Haris";
    $student1->last_name = "Susic";
    $student1->start();

    $student1->setFirstName("Semha <br>");
    echo $student1->getFirstName();

    $person1 = new Person('Sumea','Majser');
    $person1->start();

?>