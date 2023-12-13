<?php 
include '../../../controller/Event/EventC.php';
require_once '../../../model/Event/Event.php';
include '../../../controller/Event/ParticipationC.php';
require_once '../../../model/Event/Participation.php';
session_start();
if(isset($_GET['id']))
{
    $evC = new EventC();
    $evC->Supprimer($_GET['id']);
    header('Location:back.php');
}
?>