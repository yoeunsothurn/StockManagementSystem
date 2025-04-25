<?php
include'../includes/connection.php';
include'../includes/sidebar.php';

$query = 'SELECT ID, t.TYPE
          FROM users u
          JOIN type t ON t.TYPE_ID = u.TYPE_ID WHERE ID = '.$_SESSION['MEMBER_ID'].'';
$result = mysqli_query($db, $query) or die (mysqli_error($db));

while ($row = mysqli_fetch_assoc($result)) {
    $Aa = $row['TYPE'];

    if ($Aa == 'User') {
?>
    <script type="text/javascript">
        alert("Restricted Page! You will be redirected to POS");
        window.location = "pos.php";
    </script>
<?php
    }           
}

$query = 'SELECT SUPPLIER_ID, COMPANY_NAME, l.PROVINCE, l.CITY, PHONE_NUMBER 
          FROM supplier e 
          JOIN location l ON l.LOCATION_ID = e.LOCATION_ID 
          WHERE SUPPLIER_ID ='.$_GET['id'];
$result = mysqli_query($db, $query) or die(mysqli_error($db));

while ($row = mysqli_fetch_array($result)) {   
    $zz = $row['SUPPLIER_ID'];
    $a = $row['COMPANY_NAME'];
    $b = $row['PROVINCE'];
    $c = $row['CITY'];
    $d = $row['PHONE_NUMBER'];
}

$id = $_GET['id'];
?>

<!-- Main Content -->
<div class="container mt-5">

    <!-- Edit Supplier Card -->
    <div class="card shadow-lg rounded-3 border-0">
        <div class="card-header bg-info text-white">
            <h4 class="m-0 font-weight-bold">Edit Supplier</h4>
        </div>

        <!-- Back Button -->
        <a href="supplier.php?" class="btn btn-info"><i class="fas fa-arrow-left fa-fw"></i> Back</a>

        <div class="card-body">
            <form role="form" method="post" action="sup_edit1.php">

                <!-- Hidden ID Input -->
                <input type="hidden" name="id" value="<?php echo $zz; ?>" />

                <!-- Company Name Input -->
                <div class="form-group row text-left">
                    <label class="col-sm-3 col-form-label text-primary" for="name">Company Name:</label>
                    <div class="col-sm-9">
                        <input class="form-control" id="name" name="name" value="<?php echo $a; ?>" placeholder="Company Name" required>
                    </div>
                </div>

                <!-- Province Input -->
                <div class="form-group row text-left">
                    <label class="col-sm-3 col-form-label text-primary" for="province">Province:</label>
                    <div class="col-sm-9">
                        <input class="form-control" id="province" name="province" value="<?php echo $b; ?>" placeholder="Province" required>
                    </div>
                </div>

                <!-- City Input -->
                <div class="form-group row text-left">
                    <label class="col-sm-3 col-form-label text-primary" for="city">City / Municipality:</label>
                    <div class="col-sm-9">
                        <input class="form-control" id="city" name="city" value="<?php echo $c; ?>" placeholder="City/Municipality" required>
                    </div>
                </div>

                <!-- Phone Number Input -->
                <div class="form-group row text-left">
                    <label class="col-sm-3 col-form-label text-primary" for="phone">Phone Number:</label>
                    <div class="col-sm-9">
                        <input class="form-control" id="phone" name="phone" value="<?php echo $d; ?>" placeholder="Phone Number" required>
                    </div>
                </div>

                <!-- Update Button -->
                <button type="submit" class="btn btn-info ">
                    <i class="fa fa-edit fa-fw"></i> Update
                </button>
            </form>  
        </div>
    </div>
</div>

<?php
include'../includes/footer.php';
?>
