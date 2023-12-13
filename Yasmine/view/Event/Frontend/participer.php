<?php 
include '../../../Controller/Event/EventC.php';
require_once '../../../model/Event/Event.php';
include '../../../Controller/Event/ParticipationC.php';
require_once '../../../model/Event/Participation.php';

if(isset($_GET['id']))
{
    $partC = new ParticipationC();
    $p = new Participation(1,$_GET['id'],1,0);
    $partC->Ajouter($p);
    header('Location:MesParticipation.php');
}