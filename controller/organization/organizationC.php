<?php
require_once  "../../database/connect.php";
require_once  "../../model/Donation/Donation.php";

class organizationC{
    public function addOrg($entity)
    {
        $sql = "INSERT INTO organization (org_name,org_description, id_user)
        VALUES (:name, :description, :user_id)";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute([
                'name' => $entity->getName(),
                'description' => $entity->getDescription(),
                'user_id' => $entity->getUserId(),
            ]);
        } catch (Exception $e) {
            $e->getMessage();
        }
    }
public function showOrg(){
    $sql="SELECT * FROM organization";
    $db = config::getConnexion();
    try{
        $stmt = $db->query($sql);
        $liste = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $liste;
    }
    catch(Exception $e){
       $e->getMessage();
    }
}
public function deleteOrg($ref){
    $sql=" DELETE FROM organization WHERE id_org=:ref";
    $db = config::getConnexion();
    $req = $db->prepare($sql);
    $req->bindValue(':ref' , $ref);
    try{
        $req->execute();
    }
    catch(Exception $e){
        $e->getMessage();
    }
}
public function getOrg($reference){
    $sql="SELECT * from organization where id_org=$reference";
    $db = config::getConnexion();
try{
    $query = $db->prepare($sql);
$query->execute();
$donation = $query->fetch();
return $donation;
}catch (Exception $e){
    $e->getMessage();}
}
public function updateOrg($reference,$org){
    try{
        $db = config::getConnexion();
$query = $db->prepare('UPDATE organization SET org_name = :name, org_description = :desc  WHERE id_org = :id');
$query->execute([
    'name'=> $org->getName(),
    'desc'=> $org->getDescription(),
    'id'=> $reference,
]);
    } catch (Exception $e){
        $e->getMessage();
}
}
}
?>