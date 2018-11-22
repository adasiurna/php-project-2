<?php
require_once 'functions.php';
$employeeId = (int) $_POST['id'];
$projectId = (int) $_POST['projectId'];
//todo - check if id exists
$pdo = getConnection();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    //tod o- field validation
    $result = deleteEmployeeFromProject($pdo, $employeeId);
    if ($result) {
        header("location: " . BASE_URL . "/project.php?pageId=3&id=$projectId");
        addFlashMessage('success', 'Darbuotojas sėkmingai ištrintas iš projekto');
        exit();
    } else {
        header("location: " . BASE_URL . "/project.php?pageId=3&id=$projectId");
        addFlashMessage('danger', 'Darbuotojo iš projekto ištrinti nepavyko');
        exit();
    }
}
