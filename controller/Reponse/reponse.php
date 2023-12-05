<?php

require_once '../../database/connect.php';
require_once '../../model/Reponse/reponseC.php';

class ResponseC
{
    public function ajouterResponse($response)
    {
        $sql = "INSERT INTO response (`#ID_Reclamation`,Response_text,Response_date)
        VALUES(:ID_Reclamation , :Response_text , :Response_date) ";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute([
                'ID_Reclamation' => $response->getID_reclamation(),
                'Response_text' => $response->getResponse_text(),
                'Response_date' => $response->getResponse_date(),
            ]);
        } catch (Exception $e) {
            echo 'Erreur: ' . $e->getMessage();
        }
    }

    function afficherResponse($ID_response)
    {
        $sql = "SELECT * FROM response WHERE ID_Response = :ID_Response";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute(['ID_Response' => $ID_response]);
            $response = $query->fetch();
            return $response;
        } catch (Exception $e) {
            die('Erreur:' . $e->getMessage());
        }
    }

    function supprimerResponse($ID_response)
    {
        $sql = "DELETE FROM response WHERE ID_Response = :ID_Response";
        $db = config::getConnexion();
        $req = $db->prepare($sql);
        try {
            $req->execute(['ID_Response' => $ID_response]);
        } catch (Exception $e) {
            die('Erreur:' . $e->getMessage());
        }
    }

    function modifierResponse($ID_Response, $Response_text, $Response_date)
    {
        try {
            $db = config::getConnexion();
            $query = $db->prepare(
                'UPDATE response SET 
                    ID_Reclamation= :ID_Reclamation
                    Response_text = :Response_text
                    Response_date = :Response_date 
                WHERE ID_Response = :ID_Response'
            );
            $query->execute([
                'ID_Response' => $ID_Response,
                'ID_Reclamation' => $ID_Reclamation,
                'Response_text' => $Response_text,
                'Response_date' => $Response_date,
            ]);
        } catch (Exception $e) {
            $e->getMessage();
        }
    }

    function listResponse()
    {
        $conn = Config::getConnexion();
        $Reps = [];

        $r = $conn->query("SELECT * FROM response");

        foreach ($r as $row) {
            $Rep = [
                'ID_Response' => $row['ID_Response'],
                '#ID_Reclamation' => $row['#ID_Reclamation'],
                'Response_text' => $row['Response_text'],
                'Response_date' => $row['Response_date'],
            ];
            $Reps[] = $Rep;
        }

        return $Reps;
    }
}
