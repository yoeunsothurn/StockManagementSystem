<?php
include '../includes/connection.php';
include '../includes/sidebar.php';

$query = "SELECT ID, t.TYPE FROM users u JOIN type t ON t.TYPE_ID = u.TYPE_ID WHERE ID = " . $_SESSION['MEMBER_ID'];
$result = mysqli_query($db, $query) or die(mysqli_error($db));

while ($row = mysqli_fetch_assoc($result)) {
    if ($row['TYPE'] == 'User') {
        echo "<script>alert('Restricted Page! You will be redirected to POS'); window.location = 'pos.php';</script>";
    }
}

$query = "SELECT * FROM customer WHERE CUST_ID =" . $_GET['id'];
$result = mysqli_query($db, $query) or die(mysqli_error($db));
$row = mysqli_fetch_assoc($result);

$fullName = $row['FIRST_NAME'] . ' ' . $row['LAST_NAME'];
$contact = $row['PHONE_NUMBER'];
?>

<div class="container mt-4">
    <div class="card shadow-lg border-info">
        <div class="card-header bg-info text-white text-center">
            <h4 class="m-0">Customer Details</h4>
        </div>
        <div class="card-body p-4">
            <div class="row mb-3">
                <div class="col-sm-4 fw-bold text-primary">Full Name:</div>
                <div class="col-sm-8"> <?php echo $fullName; ?> </div>
            </div>
            <div class="row mb-3">
                <div class="col-sm-4 fw-bold text-primary">Contact #:</div>
                <div class="col-sm-8"> <?php echo $contact; ?> </div>
            </div>
        </div>
        <div class="card-footer text-center">
            <a href="customer.php" class="btn btn-outline-info">
                <i class="fas fa-arrow-left"></i> Back
            </a>
        </div>
    </div>
</div>

<?php
include '../includes/footer.php';
?>
