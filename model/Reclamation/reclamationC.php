<?php
class Reclamation
{
    private $ID_User;
    private $reclamation_text;
    private $reclamation_date;
    private $status_reclamation;

    function __construct($ID_User, $reclamation_text)
    {
        $this->ID_User = $ID_User;
        $this->reclamation_text = $reclamation_text;
        $this->reclamation_date = date('Y-m-d');
        $this->status_reclamation = 0;
    }
    function getID_User()
    {
        return $this->ID_User;
    }
    function getReclamation_text()
    {
        return $this->reclamation_text;
    }

    function getReclamation_date()
    {
        return $this->reclamation_date;
    }

    function getReclamation_status()
    {
        return $this->status_reclamation;
    }
}
