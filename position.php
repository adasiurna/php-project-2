<?php
require_once 'functions.php';
$pdo = getConnection();
$positionId = (int) $_GET['id'];
$employees = getEmployeesByPosition($pdo, $positionId);
$position = getPosition($pdo, $positionId);
include 'includes/head.php';
?>

<a href="positions.php?pageId=2"><< Atgal</a>
    <h1>Darbuotojai - <?php echo $position['name']; ?></h1>
    <table class="table table-hover table-sm">
        <tr style="background-color: rgba(0,0,0,.075);">
            <th>Vardas</th>
            <th>Pavardė</th>
            <th>Išsilavinimas</th>
            <th>Atlyginimas</th>
            <th>Telefonas</th>

            <?php foreach ($employees as $employee) {?>
                <tr>
                <td><a href="employee.php?pageId=1&id=<?php echo $employee['id']; ?>"><?php echo $employee['name']; ?></a></td>
                <td><a href="employee.php?pageId=1&id=<?php echo $employee['id']; ?>"><?php echo $employee['surname']; ?></a></td>
                <td><?php echo $employee['education']; ?></td>
                <td><?php echo $employee['salary']; ?></td>
                <td><?php echo $employee['phone']; ?></td>
                </tr>
                </a>
            <?php }?>

        </tr>
    </table>
</div>
<?php include 'includes/footer.php'?>