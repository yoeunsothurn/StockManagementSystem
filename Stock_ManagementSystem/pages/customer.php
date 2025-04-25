<?php
include '../includes/connection.php';
include '../includes/sidebar.php';

$query = "SELECT ID, t.TYPE FROM users u JOIN type t ON t.TYPE_ID=u.TYPE_ID WHERE ID = {$_SESSION['MEMBER_ID']}";
$result = mysqli_query($db, $query) or die(mysqli_error($db));

while ($row = mysqli_fetch_assoc($result)) {
    if ($row['TYPE'] == 'User') {
        echo "<script>alert('Restricted Page! You will be redirected to POS'); window.location = 'pos.php';</script>";
    }
}
?>

<div class="card shadow mb-4">
<div class="card-header bg-info text-white py-3 d-flex justify-content-between align-items-center">
        <h4 class="m-0 font-weight-bold">Customers</h4>
        <button class="btn btn-light" data-toggle="modal" data-target="#customerModal">
            <i class="fas fa-plus"></i> Add Customer
        </button>
    </div>
    
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover table-striped" id="dataTable" width="100%" cellspacing="0">
                <thead >
                    <tr>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Phone Number</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php                  
                    $query = 'SELECT * FROM customer';
                    $result = mysqli_query($db, $query) or die(mysqli_error($db));
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td>{$row['FIRST_NAME']}</td>";
                        echo "<td>{$row['LAST_NAME']}</td>";
                        echo "<td>{$row['PHONE_NUMBER']}</td>";
                        echo "<td>
                                <div class='btn-group'>
                                    <a href='cust_searchfrm.php?action=edit&id={$row['CUST_ID']}' class='btn btn-info btn-sm'>
                                        <i class='fas fa-list-alt'></i> Details
                                    </a>
                                    <button class='btn btn-warning btn-sm dropdown-toggle' data-toggle='dropdown'>
                                        <i class='fas fa-edit'></i>
                                    </button>
                                    <div class='dropdown-menu'>
                                        <a href='cust_edit.php?action=edit&id={$row['CUST_ID']}' class='dropdown-item'>Edit</a>
                                    </div>
                                </div>
                              </td>";
                        echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php
include '../includes/footer.php';
?>
