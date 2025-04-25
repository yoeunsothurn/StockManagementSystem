<?php
include'../includes/connection.php';
include'../includes/sidebar.php';

$query = 'SELECT ID, t.TYPE
          FROM users u
          JOIN type t ON t.TYPE_ID=u.TYPE_ID WHERE ID = '.$_SESSION['MEMBER_ID'].'';
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

<!-- Product's Detail Card -->
<div class="container mt-5">
    <div class="card shadow-lg mb-4">
        <div class="card-header bg-info text-white">
            <h4 class="m-0 font-weight-bold">Product's Detail</h4>
        </div>
        <div class="card-body">
            <a href="product.php?action=add" class="btn btn-info mb-3">
                <i class="fas fa-arrow-left"></i> Back
            </a>
            <?php 
                $query = 'SELECT PRODUCT_ID, PRODUCT_CODE, NAME, DESCRIPTION, COUNT(QTY_STOCK) AS "QTY_STOCK", COUNT(ON_HAND) AS "ON_HAND", PRICE, c.CNAME 
                          FROM product p 
                          JOIN category c ON p.CATEGORY_ID = c.CATEGORY_ID 
                          WHERE PRODUCT_CODE ='.$_GET['id'];
                $result = mysqli_query($db, $query) or die(mysqli_error($db));
                while($row = mysqli_fetch_array($result)) {   
                    $zz = $row['PRODUCT_ID'];
                    $zzz = $row['PRODUCT_CODE'];
                    $i = $row['NAME'];
                    $a = $row['DESCRIPTION'];
                    $c = $row['PRICE'];
                    $d = $row['CNAME'];
                }
                $id = $_GET['id'];
            ?>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label class="text-primary"><strong>Product Code</strong></label>
                        <p><?php echo $zzz; ?></p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label class="text-primary"><strong>Product Name</strong></label>
                        <p><?php echo $i; ?></p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label class="text-primary"><strong>Description</strong></label>
                        <p><?php echo $a; ?></p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label class="text-primary"><strong>Price</strong></label>
                        <p><?php echo $c; ?></p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label class="text-primary"><strong>Category</strong></label>
                        <p><?php echo $d; ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Inventory Card -->
    <div class="card shadow-lg mb-4">
        <div class="card-header bg-info text-white">
            <h4 class="m-0 font-weight-bold">Inventory</h4>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-bordered table-hover" id="dataTable" width="100%" cellspacing="0"> 
                    <thead>
                        <tr>
                            <th>Product Code</th>
                            <th>Name</th>
                            <th>Quantity</th>
                            <th>On Hand</th>
                            <th>Category</th>
                            <th>Supplier</th>
                            <th>Date Stock In</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $query = 'SELECT PRODUCT_ID, PRODUCT_CODE, NAME, COUNT(QTY_STOCK) AS QTY_STOCK, COUNT(ON_HAND) AS ON_HAND, CNAME, COMPANY_NAME, p.SUPPLIER_ID, DATE_STOCK_IN 
                                      FROM product p 
                                      JOIN category c ON p.CATEGORY_ID = c.CATEGORY_ID 
                                      JOIN supplier s ON p.SUPPLIER_ID = s.SUPPLIER_ID 
                                      WHERE PRODUCT_CODE = '.$zzz.' 
                                      GROUP BY SUPPLIER_ID, DATE_STOCK_IN';
                            $result = mysqli_query($db, $query) or die (mysqli_error($db));

                            while ($row = mysqli_fetch_assoc($result)) {
                                echo '<tr>';
                                echo '<td>' . $row['PRODUCT_CODE'] . '</td>';
                                echo '<td>' . $row['NAME'] . '</td>';
                                echo '<td>' . $row['QTY_STOCK'] . '</td>';
                                echo '<td>' . $row['ON_HAND'] . '</td>';
                                echo '<td>' . $row['CNAME'] . '</td>';
                                echo '<td>' . $row['COMPANY_NAME'] . '</td>';
                                echo '<td>' . $row['DATE_STOCK_IN'] . '</td>';
                                echo '</tr>';
                            }
                        ?> 
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php
include'../includes/footer.php';
?>
