<?php
require_once 'functions.php';
$positionId = $_GET['id'];
//todo - check if id exists
$pdo = getConnection();

$position = getPosition($pdo, $positionId);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['name'])) {
        //tod o- field validation
        $result = updatePosition(
            $pdo,
            (int) $_POST['id'],
            $_POST['name'],
            (int) $_POST['base_salary']
        );
    }
    if ($result) {
        header("location: " . BASE_URL . "/positions.php?pageId=2");
        addFlashMessage('success', 'Duomenys sėkmingai atnaujinti');
        exit();
    } else {
        header("location: " . BASE_URL . "/positions.php?pageId=2");
        addFlashMessage('danger', 'Duomenų atnaujinti nepavyko');
        exit();
    }
}

include 'includes/head.php';
?>
<a href="positions.php?id=2"><< Atgal</a>
<h1>Pozicijos redagavimas - <?php echo $position['name']; ?></h1>
<form method="POST">
<div>
Name: <input type="text" name="name" value="<?php echo $position['name']; ?>">
</div>
<div>
Salary: <input type="text" name="base_salary" value="<?php echo $position['base_salary']; ?>">
</div>
<input name="id" type="hidden" value="<?php echo $position['id']; ?>" />
<input type="submit">
</form>
</div>
<?php include 'includes/footer.php'?>
