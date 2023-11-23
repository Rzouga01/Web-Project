<?php


class Project

{
    private $project_name;
    private $project_description;
    private $start_date;
    private $goal;
    private $current_amount;
    private float $percentage;
    private $org_id;
    private $type_id;


    function __construct($project_name, $project_description, $start_date, $goal, $current_amount, $percentage, $org_id, $type_id)
    {
        $this->project_name = $project_name;
        $this->project_description = $project_description;
        $this->start_date = date("Y-m-d");
        $this->goal = $goal;
        $this->current_amount = 0;
        $this->percentage = ($this->current_amount * 100) / $this->goal;
        $this->org_id = $org_id;
        $this->type_id = $type_id;
    }

    function getProject_name()
    {
        return $this->project_name;
    }
    function getProject_description()
    {
        return $this->project_description;
    }
    function getStart_date()
    {
        return $this->start_date;
    }
    function getGoal()
    {
        return $this->goal;
    }
    function getCurrent_amount()
    {
        return $this->current_amount;
    }
    function getPercentage()
    {
        return $this->percentage;
    }
    function getOrg_id()
    {
        return $this->org_id;
    }
    function getType_id()
    {
        return $this->type_id;
    }
    function setProject_name($project_name)
    {
        $this->project_name = $project_name;
    }
    function setProject_description($project_description)
    {
        $this->project_description = $project_description;
    }
    function setStart_date($start_date)
    {
        $this->start_date = $start_date;
    }
    function setGoal($goal)
    {
        $this->goal = $goal;
    }
    function setCurrent_amount($current_amount)
    {
        $this->current_amount = $current_amount;
    }
    function setPercentage($percentage)
    {
        $this->percentage = $percentage;
    }
    function setOrg_id($org_id)
    {
        $this->org_id = $org_id;
    }
    function setType_id($type_id)
    {
        $this->type_id = $type_id;
    }
}
