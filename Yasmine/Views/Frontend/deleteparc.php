<?php 
include '../../Controller/ParticipationC.php';

require_once '../../Model/Participation.php';
session_start();
if(isset($_GET['id']))
{
    $evC = new ParticipationC();
    $evC->Supprimer($_GET['id']);
    header('Location:MesParticipation.php');
}
?>