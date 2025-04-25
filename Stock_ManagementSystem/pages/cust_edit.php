<?php
include '../includes/connection.php';
include '../includes/sidebar.php';

$query = "SELECT ID, t.TYPE FROM users u JOIN type t ON t.TYPE_ID = u.TYPE_ID WHERE ID = " . $_SESSION['MEMBER_ID'];
$result = mysqli_query($db, $query) or die(mysqli_error($db));

while ($row = mysqli_fetch_assoc($result)) {
    if ($row['TYPE'] == 'User') {
        echo "<script>alert('Restricted Page! Redirecting to POS...'); window.location = 'pos.php';</script>";
        exit();
        
    }
}

$query = "SELECT * FROM customer WHERE CUST_ID = " . $_GET['id'];
$result = mysqli_query($db, $query) or die(mysqli_error($db));
$row = mysqli_fetch_array($result);

$id = $row['CUST_ID'];
$firstName = $row['FIRST_NAME'];
$lastName = $row['LAST_NAME'];
$phone = $row['PHONE_NUMBER'];
?>

<div class="container mt-4">
    <div class="card shadow-lg border-0 rounded-lg">
        <div class="card-header bg-info text-white text-center">
            <h4 class="m-2">Edit Customer</h4>
        </div>
        <div class="card-body">
            <form method="post" action="cust_edit1.php">
                <input type="hidden" name="id" value="<?php echo $id; ?>" />
                
                <div class="mb-3">
                    <label class="form-label text-primary">First Name</label>
                    <input type="text" class="form-control" name="firstname" value="<?php echo $firstName; ?>" required>
                </div>
                
                <div class="mb-3">
                    <label class="form-label text-primary">Last Name</label>
                    <input type="text" class="form-control" name="lastname" value="<?php echo $lastName; ?>" required>
                </div>
                
                <div class="mb-3">
                    <label class="form-label text-primary">Contact #</label>
                    <input type="text" class="form-control" name="phone" value="<?php echo $phone; ?>" required>
                </div>
                
                <div class="d-flex justify-content-between">
                    <a href="customer.php" class="btn btn-info">
                        <i class="fas fa-arrow-left"></i> Back
                    </a>
                    <button type="submit" class="btn btn-warning">
                        <i class="fas fa-save"></i> Update
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php include '../includes/footer.php'; ?>
