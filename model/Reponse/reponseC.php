<?php
class response
{
    private $ID_response;
    private $ID_reclamation;
    private $response_text;
    private $response_date;

    function __construct($ID_response,$ID_reclamation,$response_text,$response_date){
        $this->ID_response = $ID_response ; 
        $this->ID_reclamation = $ID_reclamation;
        $this->response_text = $response_text;
        $this->response_date = date('Y-m-d');
    }
    //Les Getters
    function getID_response(){
        return $this->ID_response;
    }

    function getID_reclamation(){
        return $this->ID_reclamation;
    }

    function getResponse_text(){
        return $this->response_text;
    }

    function getResponse_date(){
        return $this->response_date;
    }
    //Les setters
    function setID_response($ID_response){
        return $this->ID_response = $ID_response ;
    }

    function setID_reclamation($ID_reclamation){
        return $this->ID_reclamation = $ID_reclamation ;
    }

    function setResponse_text($response_text){
        return $this->response_text = $response_text ;
    }

    function setResponse_date($response_date){
        return $this->response_date = date('Y-m-d');
    }
}
?>