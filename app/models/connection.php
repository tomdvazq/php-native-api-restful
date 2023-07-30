<?php

class Connection {
    
    static public function infoDatabase(){

        $infoDB = array (
            "database" => "php_apirest",
            "user" => "root",
            "password" => "",
        );

        return $infoDB;
    }

    static public function connect(){
        try{
            $link = NEW PDO(
                "mysql:host=localhost;dbname=" . Connection::infoDatabase()["database"],
                Connection::infoDatabase()["user"],
                Connection::infoDatabase()["password"],
            );
            $link->exec("SET NAMES UTF8");
        } catch (PDOException $e) {
            die("ERROR: " . $e->getMessage());
        }
        return $link;
    }

    // Validar existencia de una tabla en la base de datos

    static public function getColumnsData($table, $columns){

        $database = Connection::infoDatabase()["database"];

        $validate = Connection::connect()
        ->query("SELECT COLUMN_NAME AS item FROM information_schema.columns WHERE table_schema = '$database' AND table_name = '$table'")
        ->fetchAll(PDO::FETCH_OBJ);

        if(empty($validate)) {
            return null;
        } else {
            if($columns[0] == "*") {
                array_shift($columns);
            }

            $sum = 0;

            foreach($validate as $key => $value) {
                $sum += in_array($value->item, $columns);
            }

            return $sum == count($columns) ? $validate : null; 
        }
    }

}