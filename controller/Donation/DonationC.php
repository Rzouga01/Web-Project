<?php
require_once "../../database/connect.php";
require_once "../../model/Donation/Donation.php";

class DonationC
{
    public function addDonation($donation)
    {
        $sql = "INSERT INTO donation (id_user,amount,id_project)
    VALUES (:id_user, :amount, :id_project)";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute([
                'id_user' => $donation->getIdUser(),
                'amount' => $donation->getAmount(),
                'id_project' => $donation->getIdProject(),
            ]);
        } catch (Exception $e) {
            $e->getMessage();
        }
    }
    public function getDonationStats()
    {
        $sql = "SELECT id_project, SUM(amount) as total_amount FROM donation GROUP BY id_project";
        $db = config::getConnexion();
        try {
            $stmt = $db->query($sql);
            $stats = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $stats;
        } catch (Exception $e) {
            $e->getMessage();
        }
    }
    public function showDonation()
    {
        $sql = "SELECT * FROM donation";
        $db = config::getConnexion();
        try {
            $stmt = $db->query($sql);
            $liste = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $liste;
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public function showDonationOrderd()
    {
        $sql = "SELECT * FROM donation ORDER BY amount DESC";
        $db = config::getConnexion();
        try {
            $stmt = $db->query($sql);
            $liste = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $liste;
        } catch (Exception $e) {
            $e->getMessage();
        }
    }
    public function deleteDonation($ref)
    {
        $sql = " DELETE FROM donation WHERE Ref_Donation=:ref";
        $db = config::getConnexion();
        $req = $db->prepare($sql);
        $req->bindValue(':ref', $ref);
        try {
            $req->execute();
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
    public function getDonation($reference)
    {
        $sql = "SELECT * from donation where Ref_Donation=$reference";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute();
            $donation = $query->fetch();
            return $donation;
        } catch (Exception $e) {
            $e->getMessage();
        }
    }
    public function updateDonation($reference, $donation)
    {
        try {
            $db = config::getConnexion();
            $query = $db->prepare('UPDATE donation SET id_user = :id_user, amount = :amount, id_project = :id_project  WHERE Ref_Donation = :reference');
            $query->execute([
                'id_user' => $donation->getIdUser(),
                'amount' => $donation->getAmount(),
                'id_project' => $donation->getIdProject(),
                'reference' => $reference
            ]);
        } catch (Exception $e) {
            $e->getMessage();
        }
    }
}
?>