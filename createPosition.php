<?php
require_once 'functions.php';

$pdo = getConnection();

if (isset($_POST['name']) && isset($_POST['base_salary'])) {
    //tod o- field validation
    //PDO $pdo, string $name, string $salary
    createPosition($pdo, $_POST['name'], (int) $_POST['base_salary']);
    header("location: " . BASE_URL . "/positions.php?pageId=2");
}
include 'includes/head.php';
?>

<a href="positions.php?id=2"><< Atgal</a>
<h1>Pozicijos sukūrimas</h1>
<form method="POST">
<div>
Pavadinimas: <input type="text" name="name">
</div>
<div>
Atlyginimas: <input type="text" name="base_salary">
</div>
<input name="id" type="hidden"/>
<input type="submit">

</form>
</div>
<?php include 'includes/footer.php'?>
