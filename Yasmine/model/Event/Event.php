<?php 
class Event 
{
    // attributs de classe (Encapsulation declarer les attributs private pour raion de securite et isolation des classes)
    private $ID_Event;
    private $Event_date;
    private $Eventtype;
    private $Event_name;
    private $Event_description;
    private $Location;

   
  // constructeur (permet de creer l'objet Event)
    public function __construct(int $ID_Event,DateTime $Event_date,string $Event_type,string $Event_name,string $Event_description,string $Location)
    {
        $this->ID_Event=$ID_Event;
        $this->Event_date=$Event_date;
        $this->Eventtype=$Event_type;
        $this->Event_name=$Event_name;
        $this->Event_description=$Event_description;
        $this->Location=$Location;
    }

    // getters (permet de récupperer l'attribut x) setters (permet de donner une valeur a un attribut x)

    public function getID_Event() : int 
    {
        return $this->ID_Event;
    }
    public function getEvent_date() : DateTime 
    {
        return $this->Event_date;
    }
    public function getEvent_name() : string 
    {
        return $this->Event_name;
    }
    public function getEvent_description() : string 
    {
        return $this->Event_description;
    }
    public function getLocation() : string 
    {
        return $this->Location;
    }
    public function getEvent_type(): string 
    {
        return $this->Eventtype;
    }

    public function setID_Event($id) : void 
    {
        $this->ID_Event=$id;
    }
    public function setEvent_name($x) : void 
    {
        $this->Event_name=$x;
    }
    public function setEvent_date($x) : void 
    {
        $this->Event_date=$x;
    }
    public function setEvent_type($x) : void 
    {
        $this->Event_type=$x;
    }
    public function setLocation($x) : void 
    {
        $this->Location=$x;
    }
    public function setEvent_description($x) : void 
    {
        $this->Event_description=$x;
    }
    
}
