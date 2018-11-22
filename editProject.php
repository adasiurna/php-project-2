<?php
require_once 'functions.php';
$projectId = (int) $_GET['id'];
//todo - check if id exists
$pdo = getConnection();

$project = getProject($pdo, $projectId);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['name'])) {
        //tod o- field validation
        $result = updateProject(
            $pdo,
            (int) $_POST['id'],
            $_POST['name'],
            $_POST['year'],
            (int) $_POST['income']
        );
    }
    if ($result) {
        header("location: " . BASE_URL . "/projects.php?pageId=3");
        addFlashMessage('success', 'Duomenys sėkmingai atnaujinti');
        exit();
    } else {
        header("location: " . BASE_URL . "/projects.php?pageId=3");
        addFlashMessage('danger', 'Duomenų atnaujinti nepavyko');
        exit();
    }
}

include 'includes/head.php';
?>
<a href="projects.php"><< Atgal</a>
<h1>Projekto redagavimas - <?php echo $project['name']; ?></h1>
<form method="POST">
<div>
Pavadinimas: <input type="text" name="name" value="<?php echo $project['name']; ?>">
</div>
<div>
Metai: <input type="text" name="year" value="<?php echo $project['year']; ?>">
</div>
<div>
Pajamos: <input type="text" name="income" value="<?php echo $project['income']; ?>">
</div>
<input name="id" type="hidden" value="<?php echo $project['id']; ?>" />
<input type="submit">
</form>
</div>
</body>
</html>
