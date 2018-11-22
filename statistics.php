<?php
require_once 'functions.php';
$pdo = getConnection();
$educationSalaryStatistics = getEducationSalaryStatistics($pdo);
$employeeCount = getTotalEmployeeCount($pdo);
$genderStatistics = getGenderStatistics($pdo);
$projectStatistics = getProjectIncomeStatistics($pdo);

include 'includes/head.php';
?>

    <h1>Darbuotojų išsilavinimo statistika</h1>
    <table class="table table-hover table-sm">
        <tr style="background-color: rgba(0,0,0,.075);">
            <th>Išsilavinimas</th>
            <th>Darbuotojų kiekis</th>
            <th>Vidutinis darbo užmokestis</th>
        <?php foreach ($educationSalaryStatistics as $educationSalaryStatisticsItem) {?>
        <tr>
            <td><?php echo $educationSalaryStatisticsItem['education']; ?></td>
            <td><?php echo $educationSalaryStatisticsItem['employee_count']; ?></td>
            <td><?php echo round($educationSalaryStatisticsItem['average_salary'], 2); ?></td>
        </tr>
        <?php }?>
        </tr>
    </table>

    <h1>Darbuotojų lyties statistika</h1>
    <table class="table table-hover table-sm">
        <tr style="background-color: rgba(0,0,0,.075);">
            <th>Lytis</th>
            <th>Darbuotojų kiekis</th>
        <?php foreach ($genderStatistics as $genderStatisticsItem) {?>
        <tr>
            <td><?php echo $genderStatisticsItem['gender']; ?></td>
            <td><?php echo round(100 * $genderStatisticsItem['employee_count'] / $employeeCount, 2); ?>%</td>
        </tr>
        <?php }?>
        </tr>
    </table>


    <h1>Projektų pajamų statistika</h1>
    <table class="table table-hover table-sm">
        <tr style="background-color: rgba(0,0,0,.075);">
            <th>Metai</th>
            <th>Pajamos</th>
        <?php foreach ($projectStatistics as $projectStatisticsItem) {?>
        <tr>
            <td><?php echo $projectStatisticsItem['year']; ?></td>
            <td><?php echo $projectStatisticsItem['income_count']?></td>
        </tr>
        <?php }?>
        </tr>
    </table>


</div>
<?php include 'includes/footer.php'?>
