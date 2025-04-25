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

<div>
    <div class="card shadow-lg mb-4">
        <div class="card-header bg-info text-white">
            <h4 class="m-0 font-weight-bold">Transaction</h4>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped" id="dataTable" width="100%" cellspacing="0">
                    <thead >
                        <tr>
                            <th width="19%">Transaction Number</th>
                            <th>Customer</th>
                            <th width="13%"># of Items</th>
                            <th width="11%">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php                  
                            $query = 'SELECT *, FIRST_NAME, LAST_NAME
                                      FROM transaction T
                                      JOIN customer C ON T.`CUST_ID`=C.`CUST_ID`
                                      ORDER BY TRANS_D_ID ASC';
                            $result = mysqli_query($db, $query) or die (mysqli_error($db));

                            while ($row = mysqli_fetch_assoc($result)) {
                                echo '<tr>';
                                echo '<td>'.$row['TRANS_D_ID'].'</td>';
                                echo '<td>'.$row['FIRST_NAME'].' '.$row['LAST_NAME'].'</td>';
                                echo '<td>'.$row['NUMOFITEMS'].'</td>';
                                echo '<td align="center">
                                          <a href="trans_view.php?action=edit&id='.$row['TRANS_ID'].'" class="btn btn-info btn-sm" data-toggle="tooltip" data-placement="top" title="View Transaction">
                                              <i class="fas fa-fw fa-eye"></i> View
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
