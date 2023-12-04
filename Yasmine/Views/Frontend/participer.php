<?php 
include '../../Controller/EventC.php';
require_once '../../model/Event.php';
include '../../Controller/ParticipationC.php';
require_once '../../model/Participation.php';

if(isset($_GET['id']))
{
    $partC = new ParticipationC();
    $p = new Participation(1,$_GET['id'],1,0);
    $partC->Ajouter($p);
    header('Location:MesParticipation.php');
}