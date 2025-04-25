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

<!-- Inventory Table -->
<div >
    <div class="card shadow-lg mb-4">
        <div class="card-header bg-info text-white">
            <h4 class="m-0 font-weight-bold">Inventory</h4>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0"> 
                    <thead>
                        <tr>
                            <th>Product Code</th>
                            <th>Name</th>
                            <th>Quantity</th>
                            <th>On Hand</th>
                            <th>Category</th>
                            <th>Date Stock In</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
<?php                  
    $query = 'SELECT PRODUCT_ID, PRODUCT_CODE, NAME, COUNT(`QTY_STOCK`) AS "QTY_STOCK", COUNT(`ON_HAND`) AS "ON_HAND", CNAME, DATE_STOCK_IN FROM product p JOIN category c ON p.CATEGORY_ID=c.CATEGORY_ID GROUP BY PRODUCT_CODE';
    $result = mysqli_query($db, $query) or die (mysqli_error($db));

    while ($row = mysqli_fetch_assoc($result)) {
        echo '<tr>';
        echo '<td>' . $row['PRODUCT_CODE'] . '</td>';
        echo '<td>' . $row['NAME'] . '</td>';
        echo '<td>' . $row['QTY_STOCK'] . '</td>';
        echo '<td>' . $row['ON_HAND'] . '</td>';
        echo '<td>' . $row['CNAME'] . '</td>';
        echo '<td>' . $row['DATE_STOCK_IN'] . '</td>';
        echo '<td align="center">
                <a type="button" class="btn btn-info bg-gradient-info" href="inv_searchfrm.php?action=edit&id=' . $row['PRODUCT_CODE'] . '">
                    <i class="fas fa-eye"></i> View
                </a>
              </td>';
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
