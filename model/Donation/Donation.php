<?php
class Donation
{
    private int $reference;
    private int $id_user;
    private float $amount;
    private float $id_project;

    public function __construct($id_user, $amount, $id_project)
    {
        $this->id_user = $id_user;
        $this->amount = $amount;
        $this->id_project = $id_project;
    }

    public function getReference()
    {
        return $this->reference;
    }
    public function getIdUser()
    {
        return $this->id_user;
    }
    public function getAmount()
    {
        return $this->amount;
    }
    public function getIdProject()
    {
        return $this->id_project;
    }

}
?>