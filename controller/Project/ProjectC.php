<?php

require '../../database/connect.php';
require '../../model/Project/project_class.php';

class ProjectC
{
    public function create_project($project_name, $project_description, $start_date, $goal, $current_amount, $percentage, $org_id, $type_id)
    {
        $conn = Config::getConnexion();

        $testSql = "SELECT * FROM project WHERE UPPER(Project_name) = UPPER(:project_name) 
        AND UPPER(Project_description) = UPPER(:project_description) 
        AND UPPER(Start_date) = UPPER(:start_date) 
        AND UPPER(Goal) = UPPER(:goal) 
        AND UPPER(Current_amount) = UPPER(:current_amount) 
        AND UPPER(Percentage) = UPPER(:percentage) 
        AND UPPER(Org_id) = UPPER(:org_id) 
        AND UPPER(Type_id) = UPPER(:type_id)";
        $testStmt = $conn->prepare($testSql);
        $testStmt->bindParam(':project_name', $project_name, PDO::PARAM_STR);
        $testStmt->bindParam(':project_description', $project_description, PDO::PARAM_STR);
        $testStmt->bindParam(':start_date', $start_date, PDO::PARAM_STR);
        $testStmt->bindParam(':goal', $goal, PDO::PARAM_STR);
        $testStmt->bindParam(':current_amount', $current_amount, PDO::PARAM_STR);
        $testStmt->bindParam(':percentage', $percentage, PDO::PARAM_STR);
        $testStmt->bindParam(':org_id', $org_id, PDO::PARAM_STR);
        $testStmt->bindParam(':type_id', $type_id, PDO::PARAM_STR);
        $testStmt->execute();

        if ($testStmt->rowCount() > 0) {
            return "Project already exists";
        } else {
            $insertSql = "INSERT INTO project (Project_name, Project_description, Start_date, Goal, Current_amount, Percentage, Org_id, Type_id) 
                VALUES (:project_name, :project_description, :start_date, :goal, :current_amount, :percentage, :org_id, :type_id)";
            $insertStmt = $conn->prepare($insertSql);
            $insertStmt->bindParam(':project_name', $project_name, PDO::PARAM_STR);
            $insertStmt->bindParam(':project_description', $project_description, PDO::PARAM_STR);
            $insertStmt->bindParam(':start_date', $start_date, PDO::PARAM_STR);
            $insertStmt->bindParam(':goal', $goal, PDO::PARAM_STR);
            $insertStmt->bindParam(':current_amount', $current_amount, PDO::PARAM_STR);
            $insertStmt->bindParam(':percentage', $percentage, PDO::PARAM_STR);
            $insertStmt->bindParam(':org_id', $org_id, PDO::PARAM_STR);
            $insertStmt->bindParam(':type_id', $type_id, PDO::PARAM_STR);

            if ($insertStmt->execute()) {
                return "Project created successfully";
            } else {
                return "Error creating project";
            }
        }
    }

    public function read_project()
    {
        $conn = Config::getConnexion();
        $projects = [];

        $r = $conn->query("SELECT * FROM project");
        foreach ($r as $row) {
            $Project = [
                'ID_Project' => $row['ID_Project'],
                'Project_name' => $row['Project_name'],
                'Project_description' => $row['Project_description'],
                'start_date' => $row['start_date'],
                'Goal' => $row['Goal'],
                'Current_amount' => $row['Current_amount'],
                'Percentage' => $row['Percentage'],
                'ID_Org' => $row['ID_Org'],
                'ID_Type' => $row['ID_Type']
            ];
            $projects[] = $Project;
        }

        return $projects;
    }

    public function delete($ID)
    {
        try {
            $conn = Config::getConnexion();
            $sql = "DELETE FROM project WHERE ID_Project = :ID";
            $deleteStmt = $conn->prepare($sql);
            $deleteStmt->bindParam(':ID', $ID, PDO::PARAM_INT);
            $deleteStmt->execute();
            return "Project deleted successfully";
        } catch (PDOException $e) {
            return "Error deleting project: " . $e->getMessage();
        }
    }
}
