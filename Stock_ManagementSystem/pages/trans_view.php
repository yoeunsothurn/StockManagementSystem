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

$query = 'SELECT *, FIRST_NAME, LAST_NAME, PHONE_NUMBER, EMPLOYEE, ROLE
          FROM transaction T
          JOIN customer C ON T.`CUST_ID`=C.`CUST_ID`
          JOIN transaction_details tt ON tt.`TRANS_D_ID`=T.`TRANS_D_ID`
          WHERE TRANS_ID ='.$_GET['id'];
$result = mysqli_query($db, $query) or die (mysqli_error($db));
while ($row = mysqli_fetch_assoc($result)) {
    $fname = $row['FIRST_NAME'];
    $lname = $row['LAST_NAME'];
    $pn = $row['PHONE_NUMBER'];
    $date = $row['DATE'];
    $tid = $row['TRANS_D_ID'];
    $cash = $row['CASH'];
    $sub = $row['SUBTOTAL'];
    $less = $row['LESSVAT'];
    $net = $row['NETVAT'];
    $add = $row['ADDVAT'];
    $grand = $row['GRANDTOTAL'];
    $role = $row['EMPLOYEE'];
    $roles = $row['ROLE'];
}
?>

<div class="container mt-5">
    <div class="card shadow-lg mb-4">
        <div class="card-body">
            <!-- Sales and Inventory Header -->
            <div class="row align-items-center">
                <div class="col-md-9">
                    <h5 class="fw-bold text-primary">Sales and Inventory</h5>
                </div>
                <div class="col-md-3 text-md-end">
                    <h6 class="mb-0">Date: <?php echo $date; ?></h6>
                </div>
            </div>
            <hr>

            <!-- Transaction Details -->
            <div class="row mb-3">
                <div class="col-md-4">
                    <h6 class="fw-bold"><?php echo $fname . ' ' . $lname; ?></h6>
                    <h6>Phone: <?php echo $pn; ?></h6>
                </div>
                <div class="col-md-4"></div>
                <div class="col-md-4 text-md-end">
                    <h6>Transaction #<?php echo $tid; ?></h6>
                    <h6 class="fw-bold">Encoder: <?php echo $role; ?></h6>
                    <h6><?php echo $roles; ?></h6>
                </div>
            </div>

            <!-- Sales Table -->
            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead class="table-info text-center">
                        <tr>
                            <th>Products</th>
                            <th width="8%">Qty</th>
                            <th width="20%">Price</th>
                            <th width="20%">Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php  
                        $query = "SELECT * FROM transaction_details WHERE TRANS_D_ID = $tid";
                        $result = mysqli_query($db, $query) or die(mysqli_error($db));
                        while ($row = mysqli_fetch_assoc($result)) {
                            $Sub = $row['QTY'] * $row['PRICE'];
                            echo '<tr>';
                            echo '<td>'.$row['PRODUCTS'].'</td>';
                            echo '<td class="text-center">'.$row['QTY'].'</td>';
                            echo '<td class="text-end">$ '.number_format($row['PRICE'], 2).'</td>';
                            echo '<td class="text-end">$ '.number_format($Sub, 2).'</td>';
                            echo '</tr>';
                        }
                        ?>
                    </tbody>
                </table>
            </div>

            <!-- Total Calculation Section -->
            <div class="row mt-4">
                <div class="col-md-4"></div>
                <div class="col-md-3"></div>
                <div class="col-md-4">
                    <h4>Cash Amount: <span class="text-success">$ <?php echo number_format($cash, 2); ?></span></h4>
                    <table class="table">
                        <tr>
                            <td class="fw-bold">Subtotal</td>
                            <td class="text-end">$ <?php echo number_format($sub, 2); ?></td>
                        </tr>
                        <tr>
                            <td class="fw-bold">Less VAT</td>
                            <td class="text-end">$ <?php echo number_format($less, 2); ?></td>
                        </tr>
                        <tr>
                            <td class="fw-bold">Net of VAT</td>
                            <td class="text-end">$ <?php echo number_format($net, 2); ?></td>
                        </tr>
                        <tr>
                            <td class="fw-bold">Add VAT</td>
                            <td class="text-end">$ <?php echo number_format($add, 2); ?></td>
                        </tr>
                        <tr>
                            <td class="fw-bold">Total</td>
                            <td class="fw-bold text-end text-primary">$ <?php echo number_format($grand, 2); ?></td>
                        </tr>
                    </table>
                </div>
            </div>

        </div>
    </div>
</div>


<?php
include'../includes/footer.php';
?>
