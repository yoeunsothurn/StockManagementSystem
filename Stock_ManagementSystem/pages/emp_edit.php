<?php
include '../includes/connection.php';
include '../includes/sidebar.php';

$query = "SELECT ID, t.TYPE FROM users u JOIN type t ON t.TYPE_ID = u.TYPE_ID WHERE ID = {$_SESSION['MEMBER_ID']}";
$result = mysqli_query($db, $query) or die(mysqli_error($db));
$row = mysqli_fetch_assoc($result);
if ($row['TYPE'] == 'User') {
    echo "<script>alert('Restricted Page! You will be redirected to POS'); window.location = 'pos.php';</script>";
}

$sql = "SELECT DISTINCT JOB_TITLE, JOB_ID FROM job";
$result = mysqli_query($db, $sql) or die("Bad SQL: $sql");
$jobOptions = "<select class='form-control' name='jobs' required><option value='' disabled selected>Select Role</option>";
while ($row = mysqli_fetch_assoc($result)) {
    $jobOptions .= "<option value='{$row['JOB_ID']}'>{$row['JOB_TITLE']}</option>";
}
$jobOptions .= "</select>";

$query = "SELECT EMPLOYEE_ID, FIRST_NAME, LAST_NAME, EMAIL, PHONE_NUMBER, j.JOB_TITLE, HIRED_DATE, l.PROVINCE, l.CITY FROM employee e JOIN location l ON l.LOCATION_ID = e.LOCATION_ID JOIN job j ON j.JOB_ID = e.JOB_ID WHERE EMPLOYEE_ID = {$_GET['id']}";
$result = mysqli_query($db, $query) or die(mysqli_error($db));
$row = mysqli_fetch_array($result);
?>

<div class="container mt-4">
    <div class="card shadow-lg border-0 rounded-lg">
        <div class="card-header bg-info text-white text-center">
            <h4 class="m-0">Edit Employee</h4>
        </div>
        <div class="card-body">
            <form method="post" action="emp_edit1.php">
                <input type="hidden" name="id" value="<?php echo $row['EMPLOYEE_ID']; ?>">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">First Name</label>
                        <input type="text" class="form-control" name="firstname" value="<?php echo $row['FIRST_NAME']; ?>" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Last Name</label>
                        <input type="text" class="form-control" name="lastname" value="<?php echo $row['LAST_NAME']; ?>" required>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" class="form-control" name="email" value="<?php echo $row['EMAIL']; ?>" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Contact #</label>
                        <input type="text" class="form-control" name="phone" value="<?php echo $row['PHONE_NUMBER']; ?>" required>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Role</label>
                        <input type="text" class="form-control" value="<?php echo $row['JOB_TITLE']; ?>" disabled>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Hired Date</label>
                        <input type="date" class="form-control" name="hireddate" value="<?php echo $row['HIRED_DATE']; ?>" required>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Province</label>
                        <input type="text" class="form-control" name="province" value="<?php echo $row['PROVINCE']; ?>" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">City / Municipality</label>
                        <input type="text" class="form-control" name="city" value="<?php echo $row['CITY']; ?>" required>
                    </div>
                </div>
                <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-success">Update Employee</button>
                    <a href="employee.php" class="btn btn-info">Back</a>
                </div>
            </form>
        </div>
    </div>
</div>

<?php include '../includes/footer.php'; ?>
