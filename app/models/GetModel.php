<?php

require_once "connection.php";

class GetModel
{

    // Peticiones GET sin filtro 

    static public function getData($table, $select, $orderBy, $orderMode, $startAt, $endAt)
    {
        $sql = "SELECT $select FROM $table";

        //Ordenar sin limitar datos
        if ($orderBy != null && $orderMode != null && $startAt == null && $endAt == null) {
            $sql = "SELECT $select FROM $table ORDER BY $orderBy $orderMode";
        }

        //Ordenar y limitar datos
        if ($orderBy != null && $orderMode != null && $startAt != null && $endAt != null) {
            $sql = "SELECT $select FROM $table ORDER BY $orderBy $orderMode LIMIT $startAt,  $endAt";
        }

        //Limitar sin ordenar datos
        if ($orderBy == null && $orderMode == null && $startAt != null && $endAt != null) {
            $sql = "SELECT $select FROM $table LIMIT $startAt,  $endAt";
        }

        $stmt = Connection::connect()->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_CLASS);
    }

    // Peticiones GET con filtro

    static public function getDataFilter($table, $select, $linkTo, $equalTo, $orderBy, $orderMode, $startAt, $endAt)
    {

        $linkToArray = explode(",", $linkTo);
        $equalToArray = explode("_", $equalTo);
        $linkToText = "";

        if (count($linkToArray) > 1) {
            foreach ($linkToArray as $key => $value) {
                if ($key > 0) {
                    $linkToText .= "AND " . $value . " = :" . $value . " ";
                }
            }
        }

        $sql = "SELECT $select FROM $table WHERE $linkToArray[0] = :$linkToArray[0] $linkToText";

        if ($orderBy != null && $orderMode != null) {
            $sql = "SELECT $select FROM $table WHERE $linkToArray[0] = :$linkToArray[0] $linkToText ORDER BY $orderBy $orderMode";
        }

        //Ordenar y limitar datos
        if ($orderBy != null && $orderMode != null && $startAt != null && $endAt != null) {
            $sql = "SELECT $select FROM $table WHERE $linkToArray[0] = :$linkToArray[0] $linkToText ORDER BY $orderBy $orderMode LIMIT $startAt,  $endAt";
        }

        //Limitar sin ordenar datos
        if ($orderBy == null && $orderMode == null && $startAt != null && $endAt != null) {
            $sql = "SELECT $select FROM $table WHERE $linkToArray[0] = :$linkToArray[0] $linkToText LIMIT $startAt,  $endAt";
        }

        $stmt = Connection::connect()->prepare($sql);

        foreach ($linkToArray as $key => $value) {
            $stmt->bindParam(":" . $value, $equalToArray[$key], PDO::PARAM_STR);
        }

        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_CLASS);
    }

    // Peticiones GET sin filtro entre tablas relacionadas

    static public function getRelData($rel, $type, $select, $orderBy, $orderMode, $startAt, $endAt)
    {
        $relArray = explode(",", $rel);
        $typeArray = explode(",", $type);
        $innerJoinText = "";

        if (count($relArray) > 1) {
            foreach ($relArray as $key => $value) {
                if ($key > 0) {
                    $innerJoinText .= " INNER JOIN " . $value . " ON " . $relArray[0].".id_$typeArray[$key]" . "_" . "$typeArray[0]" . " = " . "$value" . ".id_$typeArray[$key]";
                }
            }

            $sql = "SELECT $select from $relArray[0] $innerJoinText";

            //Ordenar sin limitar datos
            if ($orderBy != null && $orderMode != null && $startAt == null && $endAt == null) {
                $sql = "SELECT $select FROM $relArray[0] $innerJoinText ORDER BY $orderBy $orderMode";
            }

            //Ordenar y limitar datos
            if ($orderBy != null && $orderMode != null && $startAt != null && $endAt != null) {
                $sql = "SELECT $select FROM $relArray[0] $innerJoinText ORDER BY $orderBy $orderMode LIMIT $startAt,  $endAt";
            }

            //Limitar sin ordenar datos
            if ($orderBy == null && $orderMode == null && $startAt != null && $endAt != null) {
                $sql = "SELECT $select FROM $relArray[0] $innerJoinText LIMIT $startAt,  $endAt";
            }

            $stmt = Connection::connect()->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_CLASS);
        } else {
            null;
        }
    }

    // Peticiones GET con filtro entre tablas relacionadas

    static public function getRelDataFilter($rel, $type, $select, $linkTo, $equalTo, $orderBy, $orderMode, $startAt, $endAt)
    {
        $linkToArray = explode(",", $linkTo);
        $equalToArray = explode("_", $equalTo);
        $linkToText = "";

        if (count($linkToArray) > 1) {
            foreach ($linkToArray as $key => $value) {
                if ($key > 0) {
                    $linkToText .= "AND " . $value . " = :" . $value . " ";
                }
            }
        }

        $relArray = explode(",", $rel);
        $typeArray = explode(",", $type);
        $innerJoinText = "";

        if (count($relArray) > 1) {
            foreach ($relArray as $key => $value) {
                if ($key > 0) {
                    $innerJoinText .= " INNER JOIN " . $value . " ON " . $relArray[0].".id_$typeArray[$key]" . "_" . "$typeArray[0]" . " = " . "$value" . ".id_$typeArray[$key]";
                }
            }

            $sql = "SELECT $select from $relArray[0] $innerJoinText WHERE $linkToArray[0] = :$linkToArray[0] $linkToText";

            //Ordenar sin limitar datos
            if ($orderBy != null && $orderMode != null && $startAt == null && $endAt == null) {
                $sql = "SELECT $select FROM $relArray[0] $innerJoinText WHERE $linkToArray[0] = :$linkToArray[0] $linkToText ORDER BY $orderBy $orderMode";
            }

            //Ordenar y limitar datos
            if ($orderBy != null && $orderMode != null && $startAt != null && $endAt != null) {
                $sql = "SELECT $select FROM $relArray[0] $innerJoinText WHERE $linkToArray[0] = :$linkToArray[0] $linkToText ORDER BY $orderBy $orderMode LIMIT $startAt,  $endAt";
            }

            //Limitar sin ordenar datos
            if ($orderBy == null && $orderMode == null && $startAt != null && $endAt != null) {
                $sql = "SELECT $select FROM $relArray[0] $innerJoinText WHERE $linkToArray[0] = :$linkToArray[0] $linkToText LIMIT $startAt,  $endAt";
            }

            $stmt = Connection::connect()->prepare($sql);

            foreach ($linkToArray as $key => $value) {
                $stmt->bindParam(":" . $value, $equalToArray[$key], PDO::PARAM_STR);
            }

            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_CLASS);
        } else {
            null;
        }
    }
}
