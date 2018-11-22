<?php
require_once 'functions.php';
$employeeId = $_GET['id'];
//todo - check if id exists
$pdo = getConnection();
$positions = getAllPositions($pdo);
$projects = getAllProjects($pdo);
$employee = getEmployee($pdo, $employeeId);
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['name'])) {
        //tod o- field validation
        $result = updateEmployee(
            $pdo,
            (int) $_POST['id'],
            $_POST['name'],
            $_POST['surname'],
            $_POST['gender'],
            $_POST['birthday'],
            $_POST['education'],
            (int) $_POST['salary'],
            $_POST['phone'],
            (int) $_POST['idarbinimo_tipas'],
            (int) $_POST['pareigos_id'],
            (int) $_POST['project_id']
        );  
    }
    if ($result) {
        header("location: " . BASE_URL . "/index.php?pageId=1");
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
<a href="index.php"><< Atgal</a>
<h1>Redaguoti informaciją apie darbuotoją </h1>
<form method="POST">
    <div>
        <label>Vardas</label>
        <input type="text" name="name" value="<?php echo $employee['name']; ?>" />
        <div />
        <div>
            <label>Pavardė</label>
            <input type="text" name="surname"  value="<?php echo $employee['surname']; ?>" />
        </div>
        <div>
            <label>Lytis</label>
            <select name="gender">
                <option value="vyras">Vyras</option>
                <option value="moteris">Moteris</option>
            <select/>
        </div>
        <div>
            <label>Gimimo diena</label>
            <input type="text" name="birthday" class="datepicker" />
        </div>
        <div>
            <label>Išsilavinimas</label>

            <input type="text" name="education"  value="<?php echo $employee['education']; ?>" />
        </div>
        <div>
            <label>Atlyginimas</label>

            <input type="text" name="salary"  value="<?php echo $employee['salary']; ?>" />
        </div>

        <div>
            <label>Telefonas</label>

            <input type="text" name="phone"  value="<?php echo $employee['phone']; ?>" />
        </div>

        <div>
            <label>Įdarbinimo tipas</label>
            <select name="idarbinimo_tipas">
                <option value="1">Paprastas</option>
                <option value="2">Kontraktas</option>
            <select/>
        </div>
        <div>
            <label>Pareigos</label>
            <select name="pareigos_id">
            <?php foreach ($positions as $position) {?>
                <option value="<?php echo $position['id']; ?>"><?php echo $position['name']; ?></option>
            <?php }?>
            </select>
        </div>

        <div>
            <label>Projektas</label>
            <select name="project_id">
            <?php foreach ($projects as $project) {?>
                <option 
                <?php if ($employee['projekto_id'] == $project['id'] ) {echo 'selected';}?>
                value="<?php echo $project['id']; ?>"><?php echo $project['name']; ?></option>
            <?php }?>
            </select>
        </div>

        <div>
        <input type="hidden" name="id" value="<?php echo $employeeId ?>">
        <input type="submit" />
        </div>
</form>

</div>
<script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
<script>
  $( function() {
    $( ".datepicker" ).datepicker({ dateFormat: 'yy-mm-dd' });
  } );
</script>
<?php include 'includes/footer.php'?>
