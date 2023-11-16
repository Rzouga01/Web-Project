<?php

class reclamation
{
    private $ID_User;
    private $ID_reclamation;
    private $reclamation_text;
    private $reclamation_date;
    private $status_reclamation;

    function __construct($ID_User,$ID_reclamation, $reclamation_text, $reclamation_date, $status_reclamation){
        $this->ID_User=$ID_User;
        $this->ID_reclamation = $ID_reclamation;
        $this->reclamation_text = $reclamation_text;
        $this->reclamation_date = date('Y-m-d');
        $this->status_reclamation = $status_reclamation;
    }
    function getID_User(){
        return $this->ID_User;
    }
    /**
     * Get the reclamation_text
     */
    function getID_Reclamation(){
        return $this->ID_reclamation;
    }

    /**
     * Get the reclamation_text
     */
    function getReclamation_text(){
        return $this->reclamation_text;
    }

    /**
     * Get the reclamation_date
     */
    function getReclamation_date(){
        return $this->reclamation_date;
    }

    /**
     *Get the status_reclamation
     */
    function getReclamation_status(){
        return $this->status_reclamation;
    }

}
?>
