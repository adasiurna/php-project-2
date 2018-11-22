<?php declare (strict_types = 1);

const HOST = 'localhost';
const DB_USER = 'root';
const DB_PASSWORD = '';
const DATABASE = 'baltic_talents';
const BASE_URL = 'http://localhost/php-project-2';

const NPD = 149;
const INCOME_TAX_PERCENT = 0.15;
const HEALTH_INSURANCE_PERCENT = 0.06;
const SOCIAL_INSURANCE_PERCENT = 0.06;
const SODRA_PERCENT = 0.3098;
const WARANTY_FUND_PERCENT = 0.002;


function getConnection(): PDO
{
    return new PDO('mysql:host=' . HOST . ';dbname=' . DATABASE . ';sharset=utf8mb4', DB_USER, DB_PASSWORD);
}

function createEmployee(PDO $pdo, string $name, string $surname, string $gender, string $birthday, string $education, int $salary, string $phone, int $idarbinimoTipas, int $pareigosId, int $projekto_id): bool
{
    $sql = 'INSERT into darbuotojai(name, surname, gender, birthday, education, salary, phone, idarbinimo_tipas, pareigos_id, projekto_id)
     VALUES (:name, :surname, :gender, :birthday, :education, :salary, :phone, :idarbinimo_tipas, :pareigos_id, :projekto_id)';

    $query = $pdo->prepare($sql);
    return $query->execute([
        'name' => $name,
        'surname' => $surname,
        'gender' => $gender,
        'birthday' => $birthday,
        'education' => $education,
        'salary' => $salary,
        'phone' => $phone,
        'idarbinimo_tipas' => $idarbinimoTipas,
        'pareigos_id' => $pareigosId,
        'projekto_id' => $projekto_id,
    ]);
}

function updateEmployee(PDO $pdo, int $id, string $name, string $surname, string $gender, string $birthday, string $education, int $salary, string $phone, int $idarbinimoTipas, int $pareigosId, int $projektoId): bool
{
    $sql = 'UPDATE darbuotojai
    SET name=:name,
        surname=:surname,
        gender=:gender,
        phone=:phone,
        birthday=:birthday,
        education=:education,
        salary=:salary,
        idarbinimo_tipas=:idarbinimo_tipas,
        pareigos_id=:pareigos_id,
        projekto_id=:projekto_id
    WHERE id=:id';

    $query = $pdo->prepare($sql);

    return $query->execute([
        'id' => $id,
        'name' => $name,
        'surname' => $surname,
        'gender' => $gender,
        'phone' => $phone,
        'birthday' => $birthday,
        'education' => $education,
        'salary' => $salary,
        'idarbinimo_tipas' => $idarbinimoTipas,
        'pareigos_id' => $pareigosId,
        'projekto_id' => $projektoId
    ]);
}

function updatePosition(PDO $pdo, int $id, string $name, int $baseSalary): bool
{
    $sql = 'UPDATE pareigos SET name=:name, base_salary=:base_salary WHERE id=:id';
    $stmt = $pdo->prepare($sql);
    return $stmt->execute([
        'id' => (int) $id, 
        'name' => (string) $name, 
        'base_salary' => (int) $baseSalary
    ]);
}

function editEmployeeProject(PDO $pdo, int $employeeId, int $projectId):bool
{
    $sql = 'UPDATE darbuotojai SET projekto_id=:projekto_id WHERE id=:id';
    $stmt = $pdo->prepare($sql);
    return $stmt->execute([
        'id' => (int) $employeeId, 
        'projekto_id' => (int) $projectId
    ]);
}

function updateProject(PDO $pdo, int $id, string $name, string $year, string $income):bool
{
    $sql = 'UPDATE projektai SET name=:name, year=:year, income=:income WHERE id=:id';
    $stmt = $pdo->prepare($sql);
    return $stmt->execute([
        'id' => (int) $id, 
        'name' => (string) $name, 
        'year' => (string) $year, 
        'income' => (int) $income
    ]);
}

function deleteEmployeeFromProject(PDO $pdo, int $employeeId):bool
{
    $sql = 'UPDATE darbuotojai SET projekto_id=NULL WHERE id=:id';
    $stmt = $pdo->prepare($sql);
    return $stmt->execute([
        'id' => (int) $employeeId
    ]);
}

function getAllEmployees(PDO $pdo): array
{
    $stmt = $pdo->prepare('SELECT id, name, surname, education, salary, phone, projekto_id, pareigos_id FROM darbuotojai');
    $stmt->execute();

    return $stmt->fetchAll();
}


function getAllEmployeesByProject(PDO $pdo): array
{
    $stmt = $pdo->prepare('SELECT id, name, surname, education, salary, phone, projekto_id, pareigos_id FROM darbuotojai ORDER BY projekto_id DESC');
    $stmt->execute();

    return $stmt->fetchAll();
}


function getEmployeesByPosition(PDO $pdo, int $positionId): array
{
    $stmt = $pdo->prepare('SELECT id, name, surname, education, salary, phone FROM darbuotojai WHERE pareigos_id = :position_id ');
    $stmt->execute(['position_id' => $positionId]);

    return $stmt->fetchAll();
}

function getEmployeesByProject(PDO $pdo, int $projectId): array
{
    $stmt = $pdo->prepare('SELECT id, name, surname, education, salary, phone FROM darbuotojai WHERE projekto_id = :projekto_id ');
    $stmt->execute(['projekto_id' => $projectId]);

    return $stmt->fetchAll();
}

function getPosition(PDO $pdo, int $positionId): array
{
    $stmt = $pdo->prepare('SELECT id, name, base_salary FROM pareigos WHERE id =:id');
    $stmt->execute(['id' => $positionId]);

    return $stmt->fetch();
}

function getProject(PDO $pdo, int $projectId): array
{
    $stmt = $pdo->prepare('SELECT id, name, year, income FROM projektai WHERE id =:id');
    $stmt->execute(['id' => $projectId]);

    return $stmt->fetch();
}

function createPosition(PDO $pdo, string $name, string $salary): bool
{
    $sql = 'INSERT into pareigos(name, base_salary)
     VALUES (:name, :base_salary)';

    $query = $pdo->prepare($sql);
    return $query->execute([
        'name' => $name,
        'base_salary' => $salary,
    ]);
}


function createProject(PDO $pdo, string $name, string $year, int $income): bool
{
    $sql = 'INSERT into projektai(name, year, income)
     VALUES (:name, :year, :income)';

    $query = $pdo->prepare($sql);
    return $query->execute([
        'name' => $name,
        'year' => $year,
        'income' => $income
    ]);
}

function getEmployee(PDO $pdo, $employeeId): array
{
    $stmt = $pdo->prepare('SELECT id, name, surname, education, salary, phone, idarbinimo_tipas, pareigos_id, projekto_id FROM darbuotojai WHERE id =:id');
    $stmt->execute(['id' => $employeeId]);
    return $stmt->fetch();
}

function getAllPositions(PDO $pdo): array
{
    $stmt = $pdo->prepare('SELECT id, name, base_salary FROM pareigos');
    $stmt->execute();

    return $stmt->fetchAll();
}

function getAllProjects(PDO $pdo): array
{
    $stmt = $pdo->prepare('SELECT id, name, year, income FROM projektai');
    $stmt->execute();

    return $stmt->fetchAll();
}

function getEmployeeCounts(PDO $pdo): array
{
    $stmt = $pdo->prepare('SELECT pareigos_id, count(*) employee_count FROM darbuotojai GROUP BY pareigos_id');
    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_KEY_PAIR);//hidreitinimas. čia yra flag. kaip tu nori kad duomenis surūšiuotų. padaro masyvą patogesnį naudoti.
}

function getEmployeeCountsByProject(PDO $pdo): array
{
    $stmt = $pdo->prepare('SELECT projekto_id, count(*) employee_count FROM darbuotojai GROUP BY projekto_id');
    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_KEY_PAIR);//hidreitinimas. čia yra flag. kaip tu nori kad duomenis surūšiuotų. padaro masyvą patogesnį naudoti.
}

//paprasta yra masyvai. mode yra daug kaip gražina duomenis iš lentelės. 
function getEducationSalaryStatistics(PDO $pdo): array
{
    $stmt = $pdo->prepare('SELECT education, COUNT(*) employee_count, AVG(salary) average_salary FROM darbuotojai GROUP BY education');
    $stmt->execute();

    return $stmt->fetchAll();
}

function getTotalEmployeeCount(PDO $pdo): int
{
    $stmt = $pdo->prepare('SELECT COUNT(*) employee_count FROM darbuotojai');
    $stmt->execute();
    $result = $stmt->fetch();

    return (int) $result['employee_count'];
}

function getGenderStatistics(PDO $pdo)
{
    $stmt = $pdo->prepare('SELECT gender, COUNT(*) employee_count FROM darbuotojai GROUP BY gender');
    $stmt->execute();

    return $stmt->fetchAll();
}

function getProjectIncomeStatistics(PDO $pdo)
{
    $stmt = $pdo->prepare('SELECT year, SUM(income) income_count FROM projektai GROUP BY year;');
    $stmt->execute();

    return $stmt->fetchAll();
}

function getSalaryData(float $salary): array
{
    $incomeTax = ($salary - NPD) * INCOME_TAX_PERCENT;
    $healthSecurityTax = $salary * HEALTH_INSURANCE_PERCENT;
    $socialSecurityTax = $salary * SOCIAL_INSURANCE_PERCENT;
    $netSalary = $salary - $incomeTax - $healthSecurityTax - $socialSecurityTax;

    return [
        'income_tax' => $incomeTax,
        'health_security_tax' => $healthSecurityTax,
        'social_security_tax' => $socialSecurityTax,
        'net_salary' => $netSalary,
    ];
}

function getExpenses(float $salary): array
{
    return [
        'sodra' => $salary * SODRA_PERCENT,
        'warranty_fund' => $salary * WARANTY_FUND_PERCENT,
        'salary' => $salary,
        'total' => $salary * SODRA_PERCENT + $salary * WARANTY_FUND_PERCENT + $salary,
    ];
}


function deletePosition(PDO $pdo, int $id): bool
{
    $stmt = $pdo->prepare('DELETE FROM pareigos WHERE id=:id');
    return $stmt->execute(['id' => $id]);
}

function deleteEmployee(PDO $pdo, int $id): bool
{
    $stmt = $pdo->prepare('DELETE FROM darbuotojai WHERE id=:id');
    return $stmt->execute(['id' => $id]);
}

function deleteProject(PDO $pdo, int $id): bool
{
    $stmt = $pdo->prepare('DELETE FROM projektai WHERE id=:id');
    return $stmt->execute(['id' => $id]);
}

function addFlashMessage(string $messageType, string $text)
{
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    if (!isset($_SESSION['flash_messages'])) {
        $_SESSION['flash_messages'] = [];
    }

    $_SESSION['flash_messages'][] = [
        'type' => $messageType,
        'text' => $text,
    ];
}