<?php
class Participation
{
    private $id;
    private $id_event;
    private $id_user;
    private $etat;

    public function __construct(int $id,int $id_event,int $id_user,int $etat)
    {
        $this->id=$id;
        $this->id_event=$id_event;
        $this->id_user=$id_user;
        $this->etat=$etat;
    }
    public function getId() : int 
    {
        return $this->id;
    }
    public function getId_event() : int 
    {
        return $this->id_event;
    }
    public function getId_user() : int 
    {
        return $this->id_user;
    }
    public function getEtat() : int 
    {
        return $this->etat;
    }
}