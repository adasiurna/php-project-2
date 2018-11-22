<?php
require_once 'functions.php';

// if (session_status() == PHP_SESSION_NONE) {
//     session_start();
// }

$pdo = getConnection();
$employees = getAllEmployees($pdo);
$positions = getAllPositions($pdo);
$projects = getAllProjects($pdo);
$employeeCounts = getEmployeeCounts($pdo);
$getEmployeeCountsByProject = getEmployeeCountsByProject($pdo);

include 'includes/head.php';
?>


    <h1>
        Darbuotojai
        <a style="text-decoration: none; font-size: 18px;" href="http://localhost/php-project-2/createEmployee.php?pageId=1">
            | Pridėti darbuotoją |
        </a>
    </h1>
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
                    <form style="display: inline-block;" action="deleteEmployee.php" method="POST">
                        <input type="submit" class="btn btn-primary" value="Trinti" />
                        <input type="hidden" value="<?php echo $employee['id']; ?>" name="id">
                    </form>
                    <a href="editEmployee.php?pageId=1&id=<?php echo $employee['id']; ?>">Redaguoti</a>
                </td>
                </tr>
            <?php }?>
        </tr>
    </table>
</div>

<?php include 'includes/footer.php'?>
