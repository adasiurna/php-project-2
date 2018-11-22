<?php
require_once 'functions.php';

$employeeId = (int) $_POST['employeeId'];
$projectId = (int) $_POST['projectId'];
//todo - check if id exists
$pdo = getConnection();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    //tod o- field validation
    $result = editEmployeeProject($pdo, $employeeId, $projectId);
    if ($result) {
        header("location: " . BASE_URL . "/employeesForProjects.php?pageId=3");
        addFlashMessage('success', 'Darbuotojas sėkmingai priskirtas pasirinktam projektui');
        exit();
    } else {
        header("location: " . BASE_URL . "/employeesForProjects.php?pageId=3");
        addFlashMessage('danger', 'Darbuotojo priskirti pasirinktam projektui nepavyko');
        exit();
    }
}
