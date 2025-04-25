<?php
include '../includes/connection.php';
include '../includes/sidebar.php';

$query = 'SELECT ID, t.TYPE FROM users u JOIN type t ON t.TYPE_ID = u.TYPE_ID WHERE ID = ' . $_SESSION['MEMBER_ID'];
$result = mysqli_query($db, $query) or die(mysqli_error($db));

while ($row = mysqli_fetch_assoc($result)) {
    if ($row['TYPE'] == 'User') {
        echo '<script>alert("Restricted Page! Redirecting to POS"); window.location = "pos.php";</script>';
    }
}
?>

<div class="card shadow-lg mb-4 rounded-3">
    <div class="card-header bg-info text-white py-3 d-flex justify-content-between align-items-center">
        <h4 class="m-0 font-weight-bold">Employee List</h4>
        <a href="#" data-toggle="modal" data-target="#employeeModal"  class="btn btn-light text-primary">
            <i class="fas fa-plus"></i> Add Employee
        </a>
        
    </div>
    
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover table-striped align-middle" id="dataTable">
                <thead >
                    <tr>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Role</th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $query = 'SELECT EMPLOYEE_ID, FIRST_NAME, LAST_NAME, j.JOB_TITLE FROM employee e JOIN job j ON e.JOB_ID = j.JOB_ID';
                    $result = mysqli_query($db, $query) or die(mysqli_error($db));
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo '<tr>';
                        echo '<td>' . htmlspecialchars($row['FIRST_NAME']) . '</td>';
                        echo '<td>' . htmlspecialchars($row['LAST_NAME']) . '</td>';
                        echo '<td>' . htmlspecialchars($row['JOB_TITLE']) . '</td>';
                        echo '<td class="text-center">';
                        echo '<a href="emp_searchfrm.php?action=edit&id=' . $row['EMPLOYEE_ID'] . '" class="btn btn-info btn-sm me-2">
                                <i class="fas fa-list-alt"></i> Details
                              </a>';
                        echo '<a href="emp_edit.php?action=edit&id=' . $row['EMPLOYEE_ID'] . '" class="btn btn-warning btn-sm">
                                <i class="fas fa-edit"></i> Edit
                              </a>';
                        echo '</td>';
                        echo '</tr>';
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php include '../includes/footer.php'; ?>
