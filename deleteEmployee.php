<?php
require_once 'functions.php';
$pdo = getConnection();

//$position = getPosition($pdo, $positionId);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    //tod o- field validation
    $result = deleteEmployee($pdo, $_POST['id']);
    if ($result) {
        header("location: " . BASE_URL . "/index.php?pageId=1");
        addFlashMessage('success', 'Duomenys sėkmingai ištrinti');
        exit();
    } else {
        header("location: " . BASE_URL . "/index.php?pageId=1");
        addFlashMessage('danger', 'Duomenų ištrinti nepavyko');
        exit();
    }
}
