<?php
require_once 'functions.php';
$pdo = getConnection();
$projectId = (int) $_GET['id'];
$employees = getEmployeesByProject($pdo, $projectId);
$project = getProject($pdo, $projectId);
include 'includes/head.php';
?>
<body>
<div class="container">
<a href="projects.php?pageId=2"><< Atgal</a>
    <h1>Darbuotojai - <?php echo $project['name']; ?></h1>
    <table class="table table-hover table-sm">
        <tr style="background-color: rgba(0,0,0,.075);">
            <th>Vardas</th>
            <th>Pavardė</th>
            <th>Išsilavinimas</th>
            <th>Atlyginimas</th>
            <th>Telefonas</th>
            <th>Veiksmai</th>

            <?php foreach ($employees as $employee) {?>
                <tr>
                <td><a href="employee.php?pageId=1&id=<?php echo $employee['id']; ?>"><?php echo $employee['name']; ?></a></td>
                <td><a href="employee.php?pageId=1&id=<?php echo $employee['id']; ?>"><?php echo $employee['surname']; ?></a></td>
                <td><?php echo $employee['education']; ?></td>
                <td><?php echo $employee['salary']; ?></td>
                <td><?php echo $employee['phone']; ?></td>
                <td>
                    <form style="display: inline-block;" action="deleteEmployeeFromProject.php" method="POST">
                        <input type="submit" class="btn btn-primary" value="Trinti iš projekto" />
                        <input type="hidden" value="<?php echo $employee['id']; ?>" name="id">
                        <input type="hidden" value="<?php echo $_GET['id']; ?>" name="projectId">
                    </form>
                </td>
                </tr>
                </a>
            <?php }?>

        </tr>
    </table>
</div>
<?php include 'includes/footer.php'?>
