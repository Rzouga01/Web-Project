<?php
class UserClass
{
    private $ID_USER;
    private $First_Name;
    private $Last_Name;
    private $Email;
    private $Password;
    private $Phone_number;
    private $Birthdate;
    private $Country;

    private $Role;

    public function __construct($ID_USER, $First_Name, $Last_Name, $Email, $Phone_number, $Password, $Birthdate, $Country, $Role)
    {
        $this->ID_USER = $ID_USER;
        $this->First_Name = $First_Name;
        $this->Last_Name = $Last_Name;
        $this->Email = $Email;
        $this->Phone_number = $Phone_number;
        $this->Password = $Password;
        $this->Birthdate = date('Y-m-d');
        $this->Country = $Country;
        $this->Role = $Role;
    }
    //getters
    public function getID_USER()
    {
        return $this->ID_USER;
    }
    public function setID_USER($ID_USER)
    {
        $this->ID_USER = $ID_USER;
    }

    public function getFirst_Name()
    {
        return $this->First_Name;
    }

    public function getLast_Name()
    {
        return $this->Last_Name;
    }

    public function getEmail()
    {
        return $this->Email;
    }

    public function getPhone_number()
    {
        return $this->Phone_number;
    }

    public function getPassword()
    {
        return $this->Password;
    }

    public function getBirthdate()
    {
        return $this->Birthdate;
    }

    public function getCountry()
    {
        return $this->Country;
    }

    public function getRole()
    {
        return $this->Role;
    }

}