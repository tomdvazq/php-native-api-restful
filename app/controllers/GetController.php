<?php 

require_once "./app/models/GetModel.php";

class GetController {

    static public function getData($table, $select, $orderBy, $orderMode, $startAt, $endAt) {

        $response = GetModel::getData($table, $select, $orderBy, $orderMode, $startAt, $endAt);
        $return = new GetController();
        $return -> fncResponse($response);

    }

    static public function getDataFilter($table, $select, $linkTo, $equalTo, $orderBy, $orderMode, $startAt, $endAt) {
        $response = GetModel::getDataFilter($table, $select, $linkTo, $equalTo, $orderBy, $orderMode, $startAt, $endAt);
        $return = new GetController();
        $return -> fncResponse($response);
    }
    
    static public function getRelData($rel, $type, $select, $orderBy, $orderMode, $startAt, $endAt) {

        $response = GetModel::getRelData($rel, $type, $select, $orderBy, $orderMode, $startAt, $endAt);
        $return = new GetController();
        $return -> fncResponse($response);
    }


    public function fncResponse($response) {
        if(!empty($response)) {
            $json = array(
                'status' => 200,
                'total' => count($response),
                'result' => $response
            );
        } else {
            $json = array(
                'status' => 404,
                'result' => 'Información no'
            );
        }
        echo json_encode($json, http_response_code($json["status"]));
    }
}