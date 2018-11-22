<?php
require_once 'functions.php';
$positionId = $_POST['id'];
//todo - check if id exists
$pdo = getConnection();

//$position = getPosition($pdo, $positionId);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    //tod o- field validation
    $result = deletePosition($pdo, $_POST['id']);
    if ($result) {
        header("location: " . BASE_URL . "/positions.php?pageId=2");
        addFlashMessage('success', 'Duomenys sėkmingai ištrinti');
        exit();
    } else {
        header("location: " . BASE_URL . "/positions.php?pageId=2");
        addFlashMessage('danger', 'Duomenų ištrinti nepavyko');
        exit();
    }
}
