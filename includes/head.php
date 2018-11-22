<?php
require_once 'functions.php';

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Visos programavimo paslaugos</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
    integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm"
    crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</head>
<body>
<div class="container">
    <nav style="margin-bottom: 40px; background-color: aliceblue;">
        <ul class="nav nav-tabs">
            <li class="nav-item">
                <a class="nav-link <?php if (($_GET['pageId'] == 1) || (!isset($_GET['pageId']))) {echo 'active';}?>" href="index.php?pageId=1">Pradinis puslapis - darbuotojai</a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?php if ($_GET['pageId'] == 2) {echo 'active';}?>" href="positions.php?pageId=2">Pareigos</a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?php if ($_GET['pageId'] == 3) {echo 'active';}?>" href="projects.php?pageId=3">Projektai</a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?php if ($_GET['pageId'] == 4) {echo 'active';}?>" href="statistics.php?pageId=4">Statistika</a>
            </li>
        </ul>
    </nav>
</div>
<main style="min-height: calc(100vh - 172px); margin-bottom: 40px">
<?php

if (isset($_SESSION['flash_messages'])) {
    foreach ($_SESSION['flash_messages'] as $message) {
        $messageType = $message['type'];
        $message = $message['text'];
        include 'flashMessage.php';
    }

    unset($_SESSION['flash_messages']);
}
?>
<div class="container">