<?php

require '../Connection/connection.php';
require_once 'reclamation_class.php';
class ReclamationCrud {
   public function ajouter_reclamation($reclamation)
   {
    $sql = "INSERT INTO reclamation_tab (ID_Reclamation, Reclamation_text, Reclamation_date, Reclamation_status) VALUES (:ID_Reclamation, :Reclamation_text, :Reclamation_date, :Reclamation_status)";
    $db = config::getconnexion();
    try{
        $query = $db->prepare($sql);
        $query->execute([
            'ID_Reclamation'=>$reclamation->getID_reclamation(),
            'Reclamation_text' => $reclamation->getReclamation_text(),
            'Reclamation_date' => $reclamation->getReclamation_date()->format('Y-m-d'),
            'Reclamation_status' => $reclamation->getReclamation_status(),
        ]);
    }catch ( Exception $e) {
        die('Erreur:' . $e->getMessage()); 
    }

    function afficherReclamation()
    {
        $sql = "SELECT * FROM reclamation_tab";
        $db = config::getConnexion();
        try {
            $list = $db->query($sql);
            return $list;
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }

    function supprimerReclamation($ID_reclamation)
    {
        $sql = " DELETE FROM reclamation_tab WHERE ID_reclamation=:ID_reclamation";
        $db = config::getConnexion();
        $req = $db->prepare($sql);
        $req->bindValue(':ID_reclamation', $ID_reclamation);
        try {
            $req->execute();
        } catch (Exception $e) {
            die('Erreur:' . $e->getMessage());
        }
    }

    function recupererReclamation($ID_reclamation)
    {
        $sql = "SELECT * from reclamation_tab where ID_reclamation=$ID_reclamation";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute();
            $reclamation = $query->fetch();
            return $reclamation;
        }catch (Exception $e) {
            die('Erreur:' . $e->getMessage());
        }
    }


    }   
}


?>
