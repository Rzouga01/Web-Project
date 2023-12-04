<?php 
include '../../Controller/EventC.php';

require_once '../../Model/Event.php';
session_start();
if(isset($_GET['id']))
{
    $evC = new EventC();
    $evC->Supprimer($_GET['id']);
    header('Location:back.php');
}
?>