<?php

require '../../database/config.php';
require '../../model/Reclamation/reclamationC.php';

class ReclamationC
{
    public function ajouterReclamation($reclamation)
    {
        $sql = "INSERT INTO reclamation_tab (ID_User , Reclamation_text , Reclamation_date , Reclamation_status) 
        VALUES (:ID_User , :Reclamation_text , :Reclamation_date , :Reclamation_status)  ";
        $db = config::getConnexion();
        try {
            print_r($reclamation->getReclamation_date()->format('Y-m-d'));
            $query = $db->prepare($sql);
            $query->execute([
                'ID_User' => $reclamation->getID_User(),
                'Reclamation_text' => $reclamation->getReclamation_text(),
                'Reclamation_date' => $reclamation->getReclamation_date()->format('Y-m-d'),
                'Reclamation_status' => $reclamation->getReclamation_status(),

            ]);
        } catch (Exception $e) {
            echo 'Erreur: ' . $e->getMessage();
        }
    }

    function afficherReclamation($ID_reclamation)
    {
        $sql = "SELECT * FROM reclamation_tab WHERE ID_Reclamation = $ID_reclamation ";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute();
            $reclamation = $query->fetch();
            return $reclamation;
        } catch (Exception $e) {
            die('Erreur:' . $e->getMessage());
        }
    }

    function supprimerReclamation($ID_reclamation)
    {
        $sql = "DELETE FROM reclamation_tab WHERE ID_Reclamation = $ID_reclamation";
        $db = config::getConnexion();
        $req = $db->prepare($sql);
        $req->bindValue(':ID_reclamation', $ID_reclamation);
        try {
            $req->execute();
        } catch (Exception $e) {
            die('Erreur:' . $e->getMessage());
        }
    }

    function modifierReclamation($reclamation, $ID_reclamation)
    {
        try {
            $db = config::getConnexion();
            $query = $db->prepare(
                'UPDATE reclamation_tab SET 
                    Reclamation_text = :Reclamation_text, 
                    Reclamation_date = :Reclamation_date, 
                    Reclamation_status = :Reclamation_status,
                WHERE ID_Reclamation= :ID_Reclamation'
            );
            $query->execute([
                'ID_reclamation' => $ID_reclamation,
                'Reclamation_text' => $reclamation->getReclamation_text(),
                'Reclamation_date' => $reclamation->getReclamation_date()->format('Y/m/d'),
                'Reclamation_status' => $reclamation->getReclamation_status()
            ]);
        } catch (Exception $e) {
            $e->getMessage();
        }
    }

    //cette fonction permet d'afficher la liste des reclamations dans la base de données
    function listReclamation()
    {
        $sql = "SELECT * FROM reclamation_tab";
        $db = config::getConnexion();
        try {
            $liste = $db->query($sql);
            return $liste;
        } catch (Exception $e) {
            die('Erreur:' . $e->getMessage());
        }
    }
}
