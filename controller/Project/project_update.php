<?php

require_once 'projectC.php';
require_once '../../model/Project/project_class.php';

$projectC = new ProjectC();

if (
    isset(
        $_POST["project-name-update"],
        $_POST["project-description-update"],
        $_POST["project-date-update"],
        $_POST["project-current-update"],
        $_POST["project-goal-update"],
        $_POST["project-type-update"],
        $_POST["project-organization-update"],
        $_POST["project-id-update"]
    )
) {
    $projectName = $_POST['project-name-update'];
    $projectDescription = $_POST["project-description-update"];
    $projectDate = date("Y-m-d", strtotime($_POST["project-date-update"]));
    $projectGoal = $_POST["project-goal-update"];
    $projectCurrent = $_POST["project-current-update"];
    $projectOrganization = $_POST["project-organization-update"];
    $projectType = $_POST["project-type-update"];
    $projectId = $_POST["project-id-update"];

    // Perform validation, e.g., check if required fields are not empty
    if (empty($projectName) || empty($projectDescription) || empty($projectDate) || empty($projectGoal) || empty($projectCurrent) || empty($projectOrganization) || empty($projectType)) {
        echo "Invalid data received. Please fill in all required fields.";
        exit;
    }

    // You can add more validation as needed, e.g., validate date format, numeric values, etc.

    $project = new Project($projectName, $projectDescription, $projectDate, $projectGoal, $projectCurrent, $projectOrganization, $projectType);

    // Update the project
    $projectC->update($projectId, $project);

    // Redirect to the dashboard after successful update
    header('Location: ../../view/Project/dashboard_project.php');
    exit;
} else {
    echo "Invalid data received.";
    exit;
}
