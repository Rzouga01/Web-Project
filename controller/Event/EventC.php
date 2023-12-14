<?php

require_once(__DIR__ . '/../../database/connect.php');
require_once(__DIR__ . '/../../model/Event/Event.php');



    Class EventC {

        function Afficher()
        {
            $requete = "select * from event";
            $config = config::getConnexion();//create database connection
            try {
                $querry = $config->prepare($requete); // preparer la requete avant l'execution
                $querry->execute(); // execution de la requete au niveau base de donnée
                $result = $querry->fetchAll(); // récupperer les resultats de la requete
                return $result ;
            } catch (PDOException $th) {
                 $th->getMessage();
            }
        }

       
       

        function getOneById($id)
        {
            $requete = "select * from event where ID_Event=:id";
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

      

        function Ajouter($event)
        {
            $config = config::getConnexion();
            try {
                $querry = $config->prepare('
                INSERT INTO event
                (Event_date,Event_type,Event_name,Event_description,Location)
                VALUES
                (:Event_date,:Event_type,:Event_name,:Event_description,:Location)
                ');
                $querry->execute([
                    'Event_type'=>$event->getEvent_type(),
                    'Event_name'=>$event->getEvent_name(),
                    'Event_description'=>$event->getEvent_description(),
                    'Event_date'=>$event->getEvent_date()->format('Y-m-d'),
                    'Location'=>$event->getLocation()
                   
                   
                    
                ]);
            } catch (PDOException $th) {
                 $th->getMessage();
            }
        }
        
        function Modifier($event)
        {
            $config = config::getConnexion();
            try {
                $querry = $config->prepare('
                UPDATE event SET
                Event_date=:Event_date,Event_type=:Event_type,Event_name=:Event_name,Event_description=:Event_description,Location=:Location
                where ID_Event=:id');
                
                $querry->execute([
                    'id'=>$event->getID_Event(),
                    'Event_type'=>$event->getEvent_type(),
                    'Event_name'=>$event->getEvent_name(),
                    'Event_description'=>$event->getEvent_description(),
                    'Event_date'=>$event->getEvent_date()->format('Y-m-d'),
                    'Location'=>$event->getLocation()

                  
                ]);
            } catch (PDOException $th) {
                 $th->getMessage();
            }
        }



        function Supprimer($id)
        {
            $sql="DELETE FROM event WHERE ID_Event= :id";
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


        function searchform($search)
        {
            $requete = "select * from event  WHERE Event_name LIKE '%$search%'";
            $config = config::getConnexion();
            try {
                $querry = $config->prepare($requete);
                $querry->execute();
                $result = $querry->fetchAll();
                return $result ;
            } catch (PDOException $th) {
                 $th->getMessage();
            }
        }
    }
