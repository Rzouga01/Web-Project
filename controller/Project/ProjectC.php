<?php

require '../../database/connect.php';
require '../../model/Project/project_class.php';


class ProjectC
{
    
        function create_project($project_name, $project_description, $start_date, $goal, $current_amount, $percentage, $org_id, $type_id)
        {
            $conn = Config::getConnexion();
    
            $testSql = "SELECT * FROM project WHERE UPPER(Project_name) = UPPER(:project_name) AND UPPER(Project_description) = UPPER(:project_description) AND UPPER(Start_date) = UPPER(:start_date) AND UPPER(Goal) = UPPER(:goal) AND UPPER(Current_amount) = UPPER(:current_amount) AND UPPER(Percentage) = UPPER(:percentage) AND UPPER(Org_id) = UPPER(:org_id) AND UPPER(Type_id) = UPPER(:type_id)";
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
                $insertSql = "INSERT INTO project (Project_name, Project_description, Start_date, Goal, Current_amount, Percentage, Org_id, Type_id) VALUES (:project_name, :project_description, :start_date, :goal, :current_amount, :percentage, :org_id, :type_id)";
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
}