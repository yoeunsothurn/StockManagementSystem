<?php
include '../includes/connection.php';
include '../includes/sidebar.php';

$query = "SELECT ID, t.TYPE FROM users u JOIN type t ON t.TYPE_ID = u.TYPE_ID WHERE ID = " . $_SESSION['MEMBER_ID'];
$result = mysqli_query($db, $query) or die(mysqli_error($db));

while ($row = mysqli_fetch_assoc($result)) {
    if ($row['TYPE'] == 'User') {
        echo "<script>alert('Restricted Page! You will be redirected to POS'); window.location = 'pos.php';</script>";
        exit();
    }
}

$query = "SELECT EMPLOYEE_ID, FIRST_NAME, LAST_NAME, GENDER, EMAIL, PHONE_NUMBER, j.JOB_TITLE, HIRED_DATE, l.PROVINCE, l.CITY 
          FROM employee e 
          JOIN location l ON e.LOCATION_ID = l.LOCATION_ID 
          JOIN job j ON j.JOB_ID = e.JOB_ID 
          WHERE e.EMPLOYEE_ID = " . $_GET['id'];
$result = mysqli_query($db, $query) or die(mysqli_error($db));
$row = mysqli_fetch_array($result);

?>

<div class="container mt-4">
    <div class="card shadow-lg border-0 rounded-lg">
        <div class="card-header bg-info text-white text-center">
            <h3 class="m-0">Employee Details</h3>
        </div>
        <div class="card-body p-4">
            <div class="row mb-3">
                <div class="col-sm-3 font-weight-bold">Full Name</div>
                <div class="col-sm-9">: <?= htmlspecialchars($row['FIRST_NAME'] . ' ' . $row['LAST_NAME']); ?></div>
            </div>
            <div class="row mb-3">
                <div class="col-sm-3 font-weight-bold">Gender</div>
                <div class="col-sm-9">: <?= htmlspecialchars($row['GENDER']); ?></div>
            </div>
            <div class="row mb-3">
                <div class="col-sm-3 font-weight-bold">Email</div>
                <div class="col-sm-9">: <?= htmlspecialchars($row['EMAIL']); ?></div>
            </div>
            <div class="row mb-3">
                <div class="col-sm-3 font-weight-bold">Contact #</div>
                <div class="col-sm-9">: <?= htmlspecialchars($row['PHONE_NUMBER']); ?></div>
            </div>
            <div class="row mb-3">
                <div class="col-sm-3 font-weight-bold">Role</div>
                <div class="col-sm-9">: <?= htmlspecialchars($row['JOB_TITLE']); ?></div>
            </div>
            <div class="row mb-3">
                <div class="col-sm-3 font-weight-bold">Hired Date</div>
                <div class="col-sm-9">: <?= htmlspecialchars($row['HIRED_DATE']); ?></div>
            </div>
            <div class="row mb-3">
                <div class="col-sm-3 font-weight-bold">Address</div>
                <div class="col-sm-9">: <?= htmlspecialchars($row['CITY'] . ', ' . $row['PROVINCE']); ?></div>
            </div>
        </div>
        <div class="card-footer text-center">
            <a href="employee.php" class="btn btn-info">Back</a>
        </div>
    </div>
</div>

<?php include '../includes/footer.php'; ?>
