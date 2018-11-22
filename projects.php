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


    <h1>Projektai 
    <a style="text-decoration: none; font-size: 18px;" href="http://localhost/php-project-2/createProject.php?pageId=3">
         | Pridėti projektą |
    </a>
    <a style="text-decoration: none; font-size: 18px;" href="http://localhost/php-project-2/employeesForProjects.php?pageId=3">
         | Darbuotojų priskyrimas projektams |
    </a>
    </h1>
    <table class="table table-hover table-sm">
        <tr style="background-color: rgba(0,0,0,.075);">
            <th>Pavadinimas</th>
            <th>Metai</th>
            <th>Pajamos</th>
            <th>Darbuotojų skaičius</th>
            <th>Veiksmai</th>
            <?php foreach ($projects as $project) {?>
        <tr>
            <td><a href="project.php?pageId=3&id=<?php echo $project['id']; ?>">
                    <?php echo $project['name']; ?></a></td>
            <td>
                <?php echo $project['year']; ?>
            </td>
            <td>
                <?php echo $project['income']; ?>
            </td>
            <td>
                <?php echo isset($getEmployeeCountsByProject[$project['id']]) ? $getEmployeeCountsByProject[$project['id']] : 0; ?>
            </td>
            <td>
                <form style="display: inline-block;" action="deleteProject.php" method="POST">
                    <input type="submit" class="btn btn-primary" value="Trinti" />
                    <input type="hidden" value="<?php echo $project['id']; ?>" name="id">
                </form>
                <a href="editProject.php?pageId=3&id=<?php echo $project['id']; ?>">Redaguoti</a>
            </td>
        </tr>
        <?php }?>
        </tr>
    </table>
</div>
<?php include 'includes/footer.php'?>