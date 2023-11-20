<?php

require '../../database/config.php';
require '../../model/Reponse/reponseC.php';

class ResponseC{
    public function ajouterResponse($response){
        $sql = "INSERT TO response (ID_Response,Response_text,Response_date)
        VALUES(:ID_Response , :Response_text , :Response_date) ";
        $db = config::getConnexion();
        try{
            print_r($response->getResponse_date()->format('Y-m-d'));
            $query = $db->prepare($sql);
            $query->execute([
                'ID_Response'=>$response->getID_response(),
                'Response_text'=>$response->getResponse_text(),
                'Response_date'=>$response->getResponse_date()->format('Y-m-d'),
            ]);
        }catch (Exception $e) {
            echo 'Erreur: ' . $e->getMessage();
        }
    }

    function afficherResponse(){
        $sql = "SELECT * FROM response WHERE ID_Response = $ID_response";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query -> execute();
            $response = $query->fetch();
            return $response;
        }catch (Exception $e) {
            die('Erreur:' . $e->getMessage());
        }
    }

    function supprimerResponse($ID_response){
        $sql = "DELETE FROM response WHERE ID_Response = $ID_response";
        $db = config::getConnexion();
        $req = $db->prepare($sql);
        $req->bindValue(':ID_Response',$ID_response);
        try{
            $req->execute();
        }catch (Exception $e) {
            die('Erreur:' . $e->getMessage());
        }
    }

    function modifierResponse($response,$ID_response)
    {
        try{
            $db = config::getConnexion();
            $query = $db->prepare(
                'UPDATE response SET 
                    Response_text = :Respone_text, 
                    Response_date = :Response_date, 
                WHERE ID_Response= :ID_Response'
            );
            $query->execute([
                'ID_response' => $ID_response,
                'Response_text' => $response->getResponse_text(),
                'Response_date' => $response->getResponse_date()->format('Y/m/d'),
            ]);
        }catch (Exception $e){
            $e->getMessage();
    }
    }

     //cette fonction permet d'afficher la liste des reponses dans la base de données
     function listResponse()
     {
         $sql = "SELECT * FROM response";
         $db = config::getConnexion();
         try {
             $liste = $db->query($sql);
             return $liste;
         } catch (Exception $e) {
             die('Erreur:' . $e->getMessage());
         }
     }
}




?>
