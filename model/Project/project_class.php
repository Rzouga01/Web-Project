<?php


class Project
{
    private $name;
    private $description;
    private $start_date;
    private $goal;
    private $status;
    private $current_amount;
    private $percentage;
    private $type;
    private $orgID;

    function __construct($name, $description, $goal, $status, $type, $orgID)
    {
        $this->name = $name;
        $this->description = $description;
        $this->start_date = date('Y-m-d');
        $this->goal = $goal;
        $this->status = $status;
        $this->current_amount = 0;
        $this->percentage = 0;
        $this->type = $type;
        $this->orgID = $orgID;
    }
}
