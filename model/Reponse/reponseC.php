<?php
class Response
{
    private $ID_reclamation;
    private $response_text;
    private $response_date;

    function __construct($ID_reclamation,$response_text){
        $this->ID_reclamation = $ID_reclamation;
        $this->response_text = $response_text;
        $this->response_date = date('Y-m-d');
    }
    //Les Getters
    function getID_reclamation(){
        return $this->getID_reclamation;
    }

    function getResponse_text(){
        return $this->response_text;
    }
    
    function getResponse_date(){
        return $this->response_date;
    }
}
?>