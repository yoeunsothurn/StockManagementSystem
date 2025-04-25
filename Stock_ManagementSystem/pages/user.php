<?php
include '../includes/connection.php';
include '../includes/sidebar.php';

// Check if the user is an Admin
$query = 'SELECT ID, t.TYPE
          FROM users u
          JOIN type t ON t.TYPE_ID = u.TYPE_ID 
          WHERE ID = ' . $_SESSION['MEMBER_ID'] . '';
$result = mysqli_query($db, $query) or die(mysqli_error($db));

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

<!-- Admin Accounts Section -->
<div class="card shadow mb-4 border-0">
    <div class="card-header bg-gradient-info text-white py-3">
        <h4 class="m-2 font-weight-bold">Admin Accounts</h4>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Username</th>
                        <th>Type</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
<?php
$query = 'SELECT ID, FIRST_NAME, LAST_NAME, USERNAME, t.TYPE
          FROM users u
          JOIN employee e ON e.EMPLOYEE_ID = u.EMPLOYEE_ID
          JOIN type t ON t.TYPE_ID = u.TYPE_ID
          WHERE u.TYPE_ID = 1';
$result = mysqli_query($db, $query) or die(mysqli_error($db));

while ($row = mysqli_fetch_assoc($result)) {
    echo '<tr>';
    echo '<td>' . $row['FIRST_NAME'] . ' ' . $row['LAST_NAME'] . '</td>';
    echo '<td>' . $row['USERNAME'] . '</td>';
    echo '<td>' . $row['TYPE'] . '</td>';
    echo '<td class="text-center">
            <div class="btn-group">
                <a href="us_searchfrm.php?action=edit&id=' . $row['ID'] . '" class="btn btn-sm btn-info text-white">
                    <i class="fas fa-fw fa-list-alt"></i> Details
                </a>
                <button type="button" class="btn btn-sm btn-info dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <span class="caret"></span>
                </button>
                <div class="dropdown-menu dropdown-menu-right">
                    <a class="dropdown-item text-warning" href="us_edit.php?action=edit&id=' . $row['ID'] . '">
                        <i class="fas fa-fw fa-edit"></i> Edit
                    </a>
                    <a class="dropdown-item text-danger" href="us_delete.php?id=' . $row['ID'] . '" onclick="return confirm(\'Are you sure you want to delete this account?\')">
                        <i class="fas fa-fw fa-trash-alt"></i> Delete
                    </a>
                </div>
            </div>
        </td>';
    echo '</tr>';
}
?>         
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- User Accounts Section -->
<div class="card shadow mb-4 border-0">
    <div class="card-header bg-gradient-info text-white py-3">
        <h4 class="m-2 font-weight-bold">
            User Accounts 
            <a href="#" data-toggle="modal" data-target="#supplierModal" class="btn btn-sm btn-light text-primary ml-2" style="border-radius: 30px;">
                <i class="fas fa-fw fa-plus"></i> Add User
            </a>
        </h4>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Username</th>
                        <th>Type</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
<?php
$query = 'SELECT ID, FIRST_NAME, LAST_NAME, USERNAME, t.TYPE
          FROM users u
          JOIN employee e ON e.EMPLOYEE_ID = u.EMPLOYEE_ID
          JOIN type t ON t.TYPE_ID = u.TYPE_ID
          WHERE u.TYPE_ID = 2';
$result = mysqli_query($db, $query) or die(mysqli_error($db));

while ($row = mysqli_fetch_assoc($result)) {
    echo '<tr>';
    echo '<td>' . $row['FIRST_NAME'] . ' ' . $row['LAST_NAME'] . '</td>';
    echo '<td>' . $row['USERNAME'] . '</td>';
    echo '<td>' . $row['TYPE'] . '</td>';
    echo '<td class="text-center">
            <div class="btn-group">
                <a href="us_searchfrm.php?action=edit&id=' . $row['ID'] . '" class="btn btn-sm btn-info text-white">
                    <i class="fas fa-fw fa-list-alt"></i> Details
                </a>
                <button type="button" class="btn btn-sm btn-info dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <span class="caret"></span>
                </button>
                <div class="dropdown-menu dropdown-menu-right">
                    <a class="dropdown-item text-warning" href="us_edit.php?action=edit&id=' . $row['ID'] . '">
                        <i class="fas fa-fw fa-edit"></i> Edit
                    </a>
                    <a class="dropdown-item text-danger" href="us_delete.php?id=' . $row['ID'] . '" onclick="return confirm(\'Are you sure you want to delete this account?\')">
                        <i class="fas fa-fw fa-trash-alt"></i> Delete
                    </a>
                </div>
            </div>
        </td>';
    echo '</tr>';
}
?>         
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php
include '../includes/footer.php';

// Employee Selection Dropdown
$sql = "SELECT EMPLOYEE_ID, FIRST_NAME, LAST_NAME, j.JOB_TITLE
        FROM employee e
        JOIN job j ON j.JOB_ID = e.JOB_ID
        ORDER BY e.LAST_NAME ASC";
$res = mysqli_query($db, $sql) or die("Bad SQL: $sql");

$opt = "<select class='form-control' name='empid' required>
        <option value='' disabled selected hidden>Select Employee</option>";
while ($row = mysqli_fetch_assoc($res)) {
    $opt .= "<option value='" . $row['EMPLOYEE_ID'] . "'>" . $row['LAST_NAME'] . ', ' . $row['FIRST_NAME'] . ' - ' . $row['JOB_TITLE'] . "</option>";
}
$opt .= "</select>";
?>

<!-- User Account Modal -->
<div class="modal fade" id="supplierModal" tabindex="-1" aria-labelledby="supplierModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-info text-white">
                <h5 class="modal-title" id="supplierModalLabel">
                    <i class="fas fa-user-plus"></i> Add User Account
                </h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
            </div>
            <div class="modal-body">
                <form method="post" action="us_transac.php?action=add">
                    <div class="mb-3">
                        <?php echo $opt; ?>
                    </div>
                    <div class="mb-3">
                        <input type="text" class="form-control" placeholder="Username" name="username" required>
                    </div>
                    <div class="mb-3">
                        <input type="password" class="form-control" placeholder="Password" name="password" required>
                    </div>
                    <hr>
                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-success"><i class="fas fa-check"></i> Save</button>
                        <button type="reset" class="btn btn-danger"><i class="fas fa-times"></i> Reset</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="fas fa-times-circle"></i> Cancel</button>
                    </div>
                </form>  
            </div>
        </div>
    </div>
</div>

