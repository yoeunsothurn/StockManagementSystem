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
?>

<!-- Bootstrap 5 Supplier Detail Page -->
<div class="container mt-5">

    <!-- Supplier Detail Card -->
    <div class="card shadow-lg border-0 rounded-4">
        <div class="card-header bg-info text-white d-flex justify-content-between align-items-center">
            <h4 class="m-0 fw-bold"><i class="fas fa-building"></i> Supplier Details</h4>
            <a href="supplier.php?action=add" class="btn btn-light btn-sm">
                <i class="fas fa-arrow-left"></i> Back
            </a>
        </div>
        <div class="card-body">
            
            <?php 
            // Secure SQL Query using Prepared Statements
            $supplier_id = intval($_GET['id']); 
            $stmt = $db->prepare('SELECT SUPPLIER_ID, COMPANY_NAME, l.PROVINCE, l.CITY, PHONE_NUMBER 
                                  FROM supplier e 
                                  JOIN location l ON e.LOCATION_ID = l.LOCATION_ID 
                                  WHERE e.SUPPLIER_ID = ?');
            $stmt->bind_param('i', $supplier_id);
            $stmt->execute();
            $result = $stmt->get_result();
            $supplier = $result->fetch_assoc();
            ?>

            <!-- Supplier Info Section -->
            <div class="row g-4">
                <div class="col-md-6">
                    <div class="p-3 border rounded bg-light">
                        <h6 class="text-primary fw-bold"><i class="fas fa-industry"></i> Company Name:</h6>
                        <p class="fs-5"><?php echo htmlspecialchars($supplier['COMPANY_NAME']); ?></p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="p-3 border rounded bg-light">
                        <h6 class="text-primary fw-bold"><i class="fas fa-map-marked-alt"></i> Province:</h6>
                        <p class="fs-5"><?php echo htmlspecialchars($supplier['PROVINCE']); ?></p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="p-3 border rounded bg-light">
                        <h6 class="text-primary fw-bold"><i class="fas fa-city"></i> City:</h6>
                        <p class="fs-5"><?php echo htmlspecialchars($supplier['CITY']); ?></p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="p-3 border rounded bg-light">
                        <h6 class="text-primary fw-bold"><i class="fas fa-phone"></i> Phone Number:</h6>
                        <p class="fs-5"><?php echo htmlspecialchars($supplier['PHONE_NUMBER']); ?></p>
                    </div>
                </div>
            </div>

        </div>
    </div>

</div>

<!-- Include FontAwesome for Icons -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">


<?php
include'../includes/footer.php';
?>
