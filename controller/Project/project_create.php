<?php

require_once 'projectC.php';
require_once '../../model/Project/project_class.php';

$projectC = new ProjectC();

if (
    isset(
        $_POST["project-name"],
        $_POST["project-description"],
        $_POST["project-date"],
        $_POST["project-current"],
        $_POST["project-goal"],
        $_POST["project-type"],
        $_POST["project-organization"]
    )
) {
    $project = new Project(
        $_POST['project-name'],
        $_POST['project-description'],
        date("Y-m-d", strtotime($_POST['project-date'])), // Use $_POST['project-date'] here
        $_POST['project-goal'],
        $_POST['project-current'],
        $_POST['project-organization'],
        $_POST['project-type']
    );
    $result = $projectC->create($project);

    echo $result;
} else {
    echo "Invalid data received.";
}

header('Location: ../../view/Project/dashboard_project.php');
exit;
