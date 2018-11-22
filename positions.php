<?php
require_once 'functions.php';
$pdo = getConnection();
$employees = getAllEmployees($pdo);
$positions = getAllPositions($pdo);
$projects = getAllProjects($pdo);
$employeeCounts = getEmployeeCounts($pdo);
$getEmployeeCountsByProject = getEmployeeCountsByProject($pdo);

include 'includes/head.php';
?>


    <h1>Pareigos     <a style="text-decoration: none; font-size: 18px;" href="http://localhost/php-project-2/createPosition.php?pageId=2"> | Pridėti pareigų |</a></h1>
    <table class="table table-hover table-sm">
        <tr style="background-color: rgba(0,0,0,.075);">
            <th>Pavadinimas</th>
            <th>Bazinis atlyginimas</th>
            <th>Darbuotojų skaičius</th>
            <th>Veiksmai</th>
            <?php foreach ($positions as $position) {?>
        <tr>
            <td><a href="position.php?pageId=2&id=<?php echo $position['id']; ?>">
                    <?php echo $position['name']; ?></a></td>
            <td>
                <?php echo $position['base_salary']; ?>
            </td>
            <td>
                <?php echo isset($employeeCounts[$position['id']]) ? $employeeCounts[$position['id']] : 0; ?>
            </td>
            <td>
                <form style="display: inline-block;" action="deletePosition.php" method="POST">
                    <input type="submit" class="btn btn-primary" value="Trinti" />
                    <input type="hidden" value="<?php echo $position['id']; ?>" name="id">
                </form>
                <a href="editPosition.php?pageId=2&id=<?php echo $position['id']; ?>">Redaguoti</a>
            </td>
        </tr>
        <?php }?>
        </tr>
    </table>
</div>
<?php include 'includes/footer.php'?>