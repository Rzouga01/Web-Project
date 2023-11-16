<?php

require '../Connection/connection.php';
require_once 'reclamation_class.php';
class ReclamationCrud
{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }
    public function ajouter_reclamation($reclamation)
    {
        $sql = "INSERT INTO reclamation_tab (ID_Reclamation, Reclamation_text, Reclamation_date, Reclamation_status) VALUES (:ID_Reclamation, :Reclamation_text, :Reclamation_date, :Reclamation_status)";
        try {
            $query = $this->db->prepare($sql);
            $query->execute([
                'ID_Reclamation' => $reclamation->getID_reclamation(),
                'Reclamation_text' => $reclamation->getReclamation_text(),
                'Reclamation_date' => $reclamation->getReclamation_date()->format('Y-m-d'),
                'Reclamation_status' => $reclamation->getReclamation_status(),
            ]);
        } catch (Exception $e) {
            error_log('Error:' . $e->getMessage());
            throw $e;
        }
    }

    function afficherReclamation($db)
    {
        $sql = "SELECT * FROM reclamation_tab";

        try {
            $list = $db->query($sql);
            return $list;
        } catch (Exception $e) {
            error_log('Error:' . $e->getMessage());
            throw $e;
        }
    }

    function supprimerReclamation($db, $ID_reclamation)
    {
        $sql = " DELETE FROM reclamation_tab WHERE ID_reclamation=:ID_reclamation";
        $req = $db->prepare($sql);
        $req->bindValue(':ID_reclamation', $ID_reclamation);
        try {
            $req->execute();
        } catch (Exception $e) {
            error_log('Erreur:' . $e->getMessage());
            throw $e;
        }
    }
}
$db = new PDO('mysql:host=localhost;dbname=recoverybutterfly', 'root', '');
$reclamationCRUD = new ReclamationCRUD($db);
$reclamationCRUD->ajouter_reclamation($reclamation);


?>