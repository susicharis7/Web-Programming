<?php
    // PHP Supports OOP

    class Car {
        private $brand;

        public function setBrand($brand) {
            $this->brand = $brand;
        }

        public function getBrand() {
            return $this->brand;
        }
    }

    $myCar = new Car();
    $myCar->setBrand("BMW");
    echo $myCar->getBrand();


    echo $_POST["ime"];  // shows what user enters

?>