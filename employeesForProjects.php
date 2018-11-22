<?php
require_once 'functions.php';

$pdo = getConnection();
$employees = getAllEmployeesByProject($pdo);
$positions = getAllPositions($pdo);
$projects = getAllProjects($pdo);
$employeeCounts = getEmployeeCounts($pdo);
$getEmployeeCountsByProject = getEmployeeCountsByProject($pdo);

include 'includes/head.php';
?>


    <h1>
        Darbuotojai
    </h1>
    <table class="table table-hover table-sm">
        <tr style="background-color: rgba(0,0,0,.075);">
            <th>Vardas</th>
            <th>Pavardė</th>
            <th>Pareigos</th>
            <th>Projektas</th>
            <th>Veiksmai</th>
        </tr>
            <?php foreach ($employees as $employee) {?>

            <tr>
                <td><?php echo $employee['name']; ?></td>
                <td><?php echo $employee['surname']; ?></td>
                <td>
                    <?php 
                        if ($employee['pareigos_id']) {
                            $position = getPosition($pdo, $employee['pareigos_id']);
                            echo $position['name'];
                        } else {
                            echo "Nenurodyta";
                        } 
                    ?>
                </td>
                <td>
                    <?php 
                        if ($employee['projekto_id']) {
                            $project = getProject($pdo, $employee['projekto_id']);
                            echo $project['name'];
                        } else {
                            echo "Nenurodyta";
                        } 
                    ?>
                </td>
                <td>
                <form action="editEmployeeProject.php" method="POST">   
                    <select name="projectId">
                        <?php foreach ($projects as $project) {?>
                            <option 
                                name="projectId"
                                <?php echo ($employee['projekto_id'] == $project['id'] )? 'selected' : '';?>
                                value="<?php echo $project['id']; ?>"><?php echo $project['name']; ?>
                            </option>
                        <?php }?>
                    </select>
                    <input type="hidden" name="employeeId" value="<?php echo $employee['id'] ?>">
                    <input type="submit" class="btn-sm btn-primary" value="Pasirinkti projektą">
                </form>
                </td>
            </tr>
            <?php }?>
        </tr>
    </table>
</div>

<?php include 'includes/footer.php'?>
