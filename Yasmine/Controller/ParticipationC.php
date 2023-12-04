<?php

require_once '..\..\config.php';
require_once '..\..\Model\Participation.php';


    Class ParticipationC {

       
        function getByUserId($id)
        {
            $requete = "select * from participation where id_user=:id";
            $config = config::getConnexion();
            try {
                $querry = $config->prepare($requete);
                $querry->execute(
                    [
                        'id'=>$id
                    ]
                );
                $result = $querry->fetchAll();
                return $result ;
            } catch (PDOException $th) {
                 $th->getMessage();
            }
        }
       
       

        function getOneById($id)
        {
            $requete = "select * from participation where id=:id";
            $config = config::getConnexion();
            try {
                $querry = $config->prepare($requete);
                $querry->execute(
                    [
                        'id'=>$id
                    ]
                );
                $result = $querry->fetch();
                return $result ;
            } catch (PDOException $th) {
                 $th->getMessage();
            }
        }

      

        function Ajouter($p)
        {
            $config = config::getConnexion();
            try {
                $querry = $config->prepare('
                INSERT INTO participation
                (id_event,id_user,etat)
                VALUES
                (:id_event,:id_user,:etat)
                ');
                $querry->execute([
                    'id_event'=>$p->getId_event(),
                    'id_user'=>$p->getId_user(),
                    'etat'=>$p->getEtat()
                   
                   
                   
                    
                ]);
            } catch (PDOException $th) {
                 $th->getMessage();
            }
        }
        
       



        function Supprimer($id)
        {
            $sql="DELETE FROM participation WHERE id= :id";
			$db = config::getConnexion();
			$req=$db->prepare($sql);
			$req->bindValue(':id',$id);
			try{
				$req->execute();
			}
			catch (Exception $e){
				die('Erreur: '.$e->getMessage());
			}
        }


        
    }
