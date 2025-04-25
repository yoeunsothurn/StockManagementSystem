<?php
include '../includes/connection.php';
include '../includes/sidebar.php';

// Query to check the user type (Admin/User)
$query = 'SELECT ID, t.TYPE
          FROM users u
          JOIN type t ON t.TYPE_ID = u.TYPE_ID
          WHERE ID = ' . $_SESSION['MEMBER_ID'];
$result = mysqli_query($db, $query) or die(mysqli_error($db));

while ($row = mysqli_fetch_assoc($result)) {
    $Aa = $row['TYPE'];

    if ($Aa == 'User') {
?>
        <script type="text/javascript">
            // Redirect to POS if user type is 'User'
            alert("Restricted Page! You will be redirected to POS");
            window.location = "pos.php";
        </script>
<?php
    }
}

// Query to fetch user details based on ID
$query2 = 'SELECT ID, e.FIRST_NAME, e.LAST_NAME, e.GENDER, USERNAME, PASSWORD, e.EMAIL, PHONE_NUMBER, j.JOB_TITLE, e.HIRED_DATE, t.TYPE, l.PROVINCE, l.CITY
           FROM users u
           JOIN employee e ON u.EMPLOYEE_ID = e.EMPLOYEE_ID
           JOIN job j ON e.JOB_ID = j.JOB_ID
           JOIN location l ON e.LOCATION_ID = l.LOCATION_ID
           JOIN type t ON u.TYPE_ID = t.TYPE_ID
           WHERE ID = ' . $_GET['id'];

$result2 = mysqli_query($db, $query2) or die(mysqli_error($db));
while ($row = mysqli_fetch_array($result2)) {   
    $zz = $row['ID'];
    $a = $row['FIRST_NAME'];
    $b = $row['LAST_NAME'];
    $c = $row['GENDER'];
    $d = $row['USERNAME'];
    $e = $row['PASSWORD'];
    $f = $row['EMAIL'];
    $g = $row['PHONE_NUMBER'];
    $h = $row['JOB_TITLE'];
    $i = $row['HIRED_DATE'];
    $j = $row['PROVINCE'];
    $k = $row['CITY'];
    $l = $row['TYPE'];
}

$id = $_GET['id'];
?>

<!-- User Details Card -->
<div class="card shadow-lg border-0 rounded-3 col-md-8 mx-auto">
    <div class="card-header bg-info text-white py-3 d-flex align-items-center">
        <h4 class="m-0 flex-grow-1"><i class="fas fa-user-circle"></i> <?php echo $a; ?>'s Details</h4>
        <a href="user.php?action=add" class="btn btn-light rounded-pill">
            <i class="fas fa-arrow-left"></i> Back
        </a>
    </div>
    
    <div class="card-body">
        <div class="row mb-3">
            <div class="col-sm-4 text-primary fw-bold">
                <i class="fas fa-user"></i> Full Name
            </div>
            <div class="col-sm-8">
                <?php echo $a . ' ' . $b; ?>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-sm-4 text-primary fw-bold">
                <i class="fas fa-venus-mars"></i> Gender
            </div>
            <div class="col-sm-8">
                <?php echo $c; ?>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-sm-4 text-primary fw-bold">
                <i class="fas fa-user-tag"></i> Username
            </div>
            <div class="col-sm-8">
                <?php echo $d; ?>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-sm-4 text-primary fw-bold">
                <i class="fas fa-envelope"></i> Email
            </div>
            <div class="col-sm-8">
                <?php echo $f; ?>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-sm-4 text-primary fw-bold">
                <i class="fas fa-phone"></i> Contact #
            </div>
            <div class="col-sm-8">
                <?php echo $g; ?>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-sm-4 text-primary fw-bold">
                <i class="fas fa-briefcase"></i> Role
            </div>
            <div class="col-sm-8">
                <?php echo $h; ?>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-sm-4 text-primary fw-bold">
                <i class="fas fa-calendar-alt"></i> Hired Date
            </div>
            <div class="col-sm-8">
                <?php echo $i; ?>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-sm-4 text-primary fw-bold">
                <i class="fas fa-map-marker-alt"></i> Province
            </div>
            <div class="col-sm-8">
                <?php echo $j; ?>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-sm-4 text-primary fw-bold">
                <i class="fas fa-city"></i> City / Municipality
            </div>
            <div class="col-sm-8">
                <?php echo $k; ?>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-4 text-primary fw-bold">
                <i class="fas fa-user-shield"></i> Account Type
            </div>
            <div class="col-sm-8">
                <?php echo $l; ?>
            </div>
        </div>
    </div>
</div>


<?php
include '../includes/footer.php';
?>
