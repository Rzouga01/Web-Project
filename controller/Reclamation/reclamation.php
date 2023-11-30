<?php

require_once '../../database/connect.php';
require_once '../../model/Reclamation/reclamationC.php';

class ReclamationC
{
    public function ajouterReclamation($reclamation)
    {
        $sql = "INSERT INTO reclamation_tab (ID_User , Reclamation_text , Reclamation_date , Reclamation_status) 
        VALUES (:ID_User , :Reclamation_text , :Reclamation_date , :Reclamation_status)  ";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute([
                'ID_User' => $reclamation->getID_User(),
                'Reclamation_text' => $reclamation->getReclamation_text(),
                'Reclamation_date' => $reclamation->getReclamation_date(),
                'Reclamation_status' => $reclamation->getReclamation_status()

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
        $sql = "DELETE FROM reclamation_tab WHERE ID_reclamation = $ID_reclamation";
        $db = config::getConnexion();
        $req = $db->prepare($sql);
        try {
            $req->execute();
        } catch (Exception $e) {
            die('Erreur:' . $e->getMessage());
        }
    }
    function modifierReclamation($ID_reclamation, $Reclamation_text, $Reclamation_date, $Reclamation_status)
    {
        try {
            $db = config::getConnexion();
            $query = $db->prepare(
                'UPDATE reclamation_tab SET 
                    Reclamation_text = :Reclamation_text, 
                    Reclamation_date = :Reclamation_date, 
                    Reclamation_status = :Reclamation_status
                WHERE ID_Reclamation = :ID_reclamation'
            );
            $query->execute([
                'ID_reclamation' => $ID_reclamation,
                'Reclamation_text' => $Reclamation_text,
                'Reclamation_date' => $Reclamation_date,
                'Reclamation_status' => $Reclamation_status
            ]);
        } catch (Exception $e) {
            echo $e->getMessage(); // Output the error message for debugging
        }
    }


    //cette fonction permet d'afficher la liste des reclamations dans la base de données
    function listReclamation()
    {
        $conn = Config::getConnexion();
        $Recs = [];

        $r = $conn->query("SELECT * FROM reclamation_tab");

        foreach ($r as $row) {
            $Rec = [
                'ID_Reclamation' => $row['ID_Reclamation'],
                'ID_User' => $row['ID_User'],
                'Reclamation_text' => $row['Reclamation_text'],
                'Reclamation_date' => $row['Reclamation_date'],
                'Reclamation_status'  => $row['Reclamation_status']
            ];
            $Recs[] = $Rec;
        }

        return $Recs;
    }
}
