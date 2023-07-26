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

}