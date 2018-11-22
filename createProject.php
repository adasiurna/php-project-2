<?php
require_once 'functions.php';

$pdo = getConnection();

if (isset($_POST['name']) && isset($_POST['year'])) {
    //tod o- field validation
    createProject($pdo, $_POST['name'], $_POST['year'], (int) $_POST['income']);
    header("location: " . BASE_URL . "/projects.php?pageId=3");
}
include 'includes/head.php';
?>
<body>
<div class="container">
<h1>Projekto sukūrimas</h1>
<form method="POST">
<div>
Pavadinimas: <input type="text" name="name">
</div>
<div>
Metai: <input type="text" name="year">
</div>
<div>
Pelnas: <input type="text" name="income">
</div>
<input name="id" type="hidden"/>
<input type="submit">

</form>
</div>
<?php include 'includes/footer.php'?>
