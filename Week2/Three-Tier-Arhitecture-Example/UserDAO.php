<?php
// This part returns customers (just like from database)

class UserDAO {
    public static function getAllUsers() {
        // Think this as its coming from DB (later we will be doing that)

        return [
            ["id"=> 1, "name"=> "Haris", "email"=> "haris.susic@stu.ibu.edu.ba"],
            ["id"=> 2, "name"=> "Sumea", "email"=> "sumea.majser@stu.ibu.edu.ba"],
            ["id"=> 3, "name"=> "Becir", "email"=> "becir.isakovic@ibu.edu.ba"]
        ];
    }
}

?>