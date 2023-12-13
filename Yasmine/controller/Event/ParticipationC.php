<?php

require_once "../../../database/connect.php";
require_once '..\..\..\Model\Event\Event.php';


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


        function Check($iduser,$idevent) : int
        {

            $servername = "localhost";
$username = "root";
$password = "";
$dbname = "recoverybutterfly";
$conn = new mysqli($servername, $username, $password, $dbname);

// Check for errors in connecting to the database
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Set the variable for the id you want to search for


// Prepare the SQL statement to get the number of rows where idposte = id
$sql = "SELECT COUNT(*) as total FROM participation WHERE id_event = $idevent AND id_user = $iduser";

// Execute the SQL statement and get the result
$result = $conn->query($sql);

// Check for errors in executing the SQL statement
if (!$result) {
    die("Error executing query: " . $conn->error);
}

// Get the number of rows where idposte = id from the result
$row = $result->fetch_assoc();
$total = $row['total'];



// Close the database connection
$conn->close();

if ($total==0)
{
    return 0;
}
else

return 1;

            
        }


        
    }
