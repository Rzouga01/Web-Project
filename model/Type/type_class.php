
<?php

class Type
{
    private $name;
    private $description;


    function __construct($name, $description)
    {
        $this->name = $name;
        $this->description = $description;
    }
    function getName()
    {
        return $this->name;
    }
    function getDescription()
    {
        return $this->description;
    }
    function setName($name)
    {
        $this->name = $name;
    }
    function setDescription($description)
    {
        $this->description = $description;
    }
}
