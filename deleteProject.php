<?php
require_once 'functions.php';
$projectId = $_POST['id'];
//todo - check if id exists
$pdo = getConnection();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    //todo- field validation
    $result = deleteProject($pdo, $_POST['id']);
    if ($result) {
        header("location: " . BASE_URL . "/projects.php?pageId=3");
        addFlashMessage('success', 'Duomenys sėkmingai ištrinti');
        exit();
    } else {
        header("location: " . BASE_URL . "/projects.php?pageId=3");
        addFlashMessage('danger', 'Duomenų ištrinti nepavyko');
        exit();
    }
}
