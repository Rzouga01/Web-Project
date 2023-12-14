<?php

class organization
{
    private $name;
    private $description;
    private $user_id;
    private $id;

    public function __construct($name, $description, $user_id, $id)
    {
        $this->name = $name;
        $this->description = $description;
        $this->user_id = $user_id;
        $this->id = $id;
    }


    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function setDescription($description)
    {
        $this->description = $description;
    }

    public function getUserId()
    {
        return $this->user_id;
    }

    public function setUserId($user_id)
    {
        $this->user_id = $user_id;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }
}