<?php

require '../../database/connect.php';
require '../../model/Project/project_class.php';

class ProjectC
{
    public function create($project)
    {
        $conn = Config::getConnexion();

        $name = $project->getProject_name();
        $description = $project->getProject_description();
        $start_date = $project->getStart_date();
        $goal = $project->getGoal();
        $current_amount = $project->getCurrent_amount();
        $percentage = $project->getPercentage();

        if ($percentage > 100) {
            $percentage = 100;
        }
        $org_id = $project->getOrg_id();
        $type_id = $project->getType_id();

        $testSql = "SELECT * FROM project WHERE UPPER(Project_name) = UPPER(:name) AND UPPER(Project_description) = UPPER(:description)";
        $testStmt = $conn->prepare($testSql);
        $testStmt->bindParam(':name', $name, PDO::PARAM_STR);
        $testStmt->bindParam(':description', $description, PDO::PARAM_STR);
        $testStmt->execute();

        if ($testStmt->rowCount() > 0) {
            return "Project already exists";
        } else {
            $insertSql = "INSERT INTO project (Project_name, Project_description, start_date, Goal, Current_amount, Percentage, ID_Org, ID_Type) VALUES (:name, :description, :start_date, :goal, :current_amount, :percentage, :org_id, :type_id)";
            $insertStmt = $conn->prepare($insertSql);
            $insertStmt->bindParam(':name', $name, PDO::PARAM_STR);
            $insertStmt->bindParam(':description', $description, PDO::PARAM_STR);
            $insertStmt->bindParam(':start_date', $start_date, PDO::PARAM_STR);
            $insertStmt->bindParam(':goal', $goal, PDO::PARAM_INT);
            $insertStmt->bindParam(':current_amount', $current_amount, PDO::PARAM_INT);
            $insertStmt->bindParam(':percentage', $percentage, PDO::PARAM_STR);
            $insertStmt->bindParam(':org_id', $org_id, PDO::PARAM_INT);
            $insertStmt->bindParam(':type_id', $type_id, PDO::PARAM_INT);

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


    public function update($project)
    {
        $conn = Config::getConnexion();

        $id = $project->getID_Project();
        $name = $project->getProject_name();
        $description = $project->getProject_description();
        $start_date = $project->getStart_date();
        $goal = $project->getGoal();
        $current_amount = $project->getCurrent_amount();
        $percentage = $project->getPercentage();
        $org_id = $project->getOrg_id();
        $type_id = $project->getType_id();
        $sql = "UPDATE project SET Project_name=:name, Project_description=:description, start_date=:start_date, Goal=:goal, Current_amount=:current_amount, Percentage=:percentage, ID_Org=:org_id, ID_Type=:type_id WHERE ID_Project=:id";
        $updateStmt = $conn->prepare($sql);
        $updateStmt->bindParam(':id', $id, PDO::PARAM_INT);
        $updateStmt->bindParam(':name', $name, PDO::PARAM_STR);
        $updateStmt->bindParam(':description', $description, PDO::PARAM_STR);
        $updateStmt->bindParam(':start_date', $start_date, PDO::PARAM_STR);
        $updateStmt->bindParam(':goal', $goal, PDO::PARAM_INT);
        $updateStmt->bindParam(':current_amount', $current_amount, PDO::PARAM_INT);
        $updateStmt->bindParam(':percentage', $percentage, PDO::PARAM_STR);
        $updateStmt->bindParam(':org_id', $org_id, PDO::PARAM_INT);
        $updateStmt->bindParam(':type_id', $type_id, PDO::PARAM_INT);
        if ($updateStmt->execute()) {
            return "Project updated successfully";
        } else {
            return "Error updating project";
        }
    }
}
