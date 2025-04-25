<?php
include '../includes/connection.php';
include '../includes/sidebar.php';
?>
<?php 
$query = 'SELECT ID, t.TYPE FROM users u JOIN type t ON t.TYPE_ID=u.TYPE_ID WHERE ID = '.$_SESSION['MEMBER_ID'];
$result = mysqli_query($db, $query) or die (mysqli_error($db));
while ($row = mysqli_fetch_assoc($result)) {
    if ($row['TYPE'] == 'User') {
        echo '<script>alert("Restricted Page! You will be redirected to POS"); window.location = "pos.php";</script>';
    }
}
?>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-3">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Customers</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                <?php 
                                $query = "SELECT COUNT(*) FROM customer";
                                $result = mysqli_query($db, $query) or die(mysqli_error($db));
                                $row = mysqli_fetch_array($result);
                                echo "$row[0] Records";
                                ?>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-users fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Suppliers</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                <?php 
                                $query = "SELECT COUNT(*) FROM supplier";
                                $result = mysqli_query($db, $query) or die(mysqli_error($db));
                                $row = mysqli_fetch_array($result);
                                echo "$row[0] Records";
                                ?>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-truck fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Employees</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                <?php 
                                $query = "SELECT COUNT(*) FROM employee";
                                $result = mysqli_query($db, $query) or die(mysqli_error($db));
                                $row = mysqli_fetch_array($result);
                                echo "$row[0] Records";
                                ?>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-user-tie fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-left-danger shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">Registered Accounts</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                <?php 
                                $query = "SELECT COUNT(*) FROM users WHERE TYPE_ID=2";
                                $result = mysqli_query($db, $query) or die(mysqli_error($db));
                                $row = mysqli_fetch_array($result);
                                echo "$row[0] Records";
                                ?>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-user fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-4">
        <div class="col-md-12">
            <div class="card shadow h-100">
                <div class="card-body">
                    <div class="panel-heading font-weight-bold">Recent Products</div>
                    <div class="list-group mt-3">
                        <?php 
                        $query = "SELECT NAME FROM product ORDER BY PRODUCT_ID DESC LIMIT 10";
                        $result = mysqli_query($db, $query) or die(mysqli_error($db));
                        while ($row = mysqli_fetch_array($result)) {
                            echo "<a href='#' class='list-group-item text-gray-800'><i class='fa fa-box'></i> $row[0]</a>";
                        }
                        ?>
                    </div>
                    <a href="product.php" class="btn btn-primary btn-block mt-3">View All Products</a>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include '../includes/footer.php'; ?>
