<?php 
include '../../../Controller/Event/EventC.php';
require_once '../../../model/Event/Event.php';
include '../../../Controller/Event/ParticipationC.php';
require_once '../../../model/Event/Participation.php';
session_start();
if(isset($_GET['id']))
{
    $evC = new ParticipationC();
    $evC->Supprimer($_GET['id']);
    header('Location:MesParticipation.php');
}
?>