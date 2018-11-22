<?php
require_once 'functions.php';
$pdo = getConnection();
$id = (int) $_GET['id'];
$employee = getEmployee($pdo, $id);
if ($employee['projekto_id']) {
    $project = getProject($pdo, $employee['projekto_id']);
}
if ($employee['pareigos_id']) {
    $position = getPosition($pdo, $employee['pareigos_id']);
}

if (!is_null($employee['salary'])) {
    $expenses = getExpenses($employee['salary']);
    $salaryData = getSalaryData($employee['salary']);
}
include 'includes/head.php';
?>

<a href="index.php"><< Atgal</a>
<form style="display: inline-block;" action="deleteEmployee.php" method="POST">
                        <input type="submit" class="btn btn-primary" value="Trinti" />
                        <input type="hidden" value="<?php echo $employee['id']; ?>" name="id">
                    </form>
                    <a href="editEmployee.php?pageId=1&id=<?php echo $employee['id']; ?>">Redaguoti</a>
    <h1>Darbuotojas - <?php echo $employee['name']; ?> <?php echo $employee['surname']; ?></h1>
        <ul>
            <li>Vardas - <?php echo $employee['name']; ?></li>
            <li>Pavardė - <?php echo $employee['surname']; ?></li>
            <li>Išsilavinimas - <?php echo $employee['education']; ?></li>
            <li>Atlyginimas - <?php echo $employee['salary']; ?></li>
            <li>Telefonas - <?php echo $employee['phone']; ?></li>
            <li>Pareigos - <?php echo ($employee['pareigos_id']) ? $position['name'] : 'Nenurodyta';   ?></li>
            <li>Projektas - <?php echo ($employee['projekto_id']) ? $project['name'] : 'Nenurodyta'; ?></li>
        </ul>
    <?php if (isset($salaryData)) {?>
    <h2>Atlyginimas</h2>
    <ul>
        <li>Pajamų mokestis - <?php echo $salaryData['income_tax']; ?></li>
        <li>Gyvybės draudimas - <?php echo $salaryData['health_security_tax']; ?></li>
        <li>Soc. draudimas - <?php echo $salaryData['social_security_tax']; ?></li>
        <li>Atlyginimas į rankas - <?php echo $salaryData['net_salary']; ?></li>
    </ul>
    <?php }?>
    <?php if (isset($expenses)) {?>
    <h2>Sąnaudos</h2>
    <ul>
        <li>Sodra - <?php echo $expenses['sodra']; ?></li>
        <li>Draudimo fondas - <?php echo $expenses['warranty_fund']; ?></li>
        <li>Atlyginimas - <?php echo $expenses['salary']; ?></li>
        <li>Viso - <?php echo $expenses['total']; ?></li>
    </ul>
    <?php }?>
</div>
<?php include 'includes/footer.php'?>
