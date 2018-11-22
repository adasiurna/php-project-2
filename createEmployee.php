<?php
require_once 'functions.php';

$pdo = getConnection();
$positions = getAllPositions($pdo);
$projects = getAllProjects($pdo);
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    //todo - field validation
    $result = createEmployee(
        $pdo,
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

    if ($result) {
        header('Location:index.php?pageId=1');
        exit();
    }
}

include 'includes/head.php';
?>
<body>
<div class="container">
<h1>Naujas darbuotojas </h1>
<form method="post">
    <div>
        <label>Name</label>
        <input type="text" name="name" />
        <div />
        <div>
            <label>Surname</label>
            <input type="text" name="surname" />
        </div>
        <div>
            <label>Gender</label>
            <select name="gender">
                <option value="vyras">Vyras</option>
                <option value="moteris">Moteris</option>
            <select/>
        </div>
        <div>
            <label>Birthday</label>
            <input type="text" name="birthday" class="datepicker" />
        </div>
        <div>
            <label>Education</label>

            <input type="text" name="education" />
        </div>
        <div>
            <label>Salary</label>

            <input type="text" name="salary" />
        </div>

        <div>
            <label>Telefonas</label>

            <input type="text" name="phone" />
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
                <option value="<?php echo $project['id']; ?>"><?php echo $project['name']; ?></option>
            <?php }?>
            </select>
        </div>

        <div>
        <input type="submit" />
        </div>
</form>
</div>
<script>
  $( function() {
    $( ".datepicker" ).datepicker({ dateFormat: 'yy-mm-dd' });
  } );
</script>

<?php include 'includes/footer.php'?>