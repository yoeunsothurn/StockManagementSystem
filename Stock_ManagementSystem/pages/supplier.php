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

<!-- Main Container -->
<div>

    <!-- Supplier Card -->
    <div class="card shadow-lg rounded-3 border-0">
        <div class="card-header py-4 d-flex justify-content-between align-items-center bg-info text-white">
            <h4 class="m-0">Supplier</h4>
            <button class="btn btn-light" data-toggle="modal" data-target="#supplierModal">
                <i class="fas fa-fw fa-plus"></i> Add Supplier
            </button>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-hover" id="dataTable" width="100%" cellspacing="0">
                    <thead class="thead-info">
                        <tr>
                            <th>Company Name</th>
                            <th>Province</th>
                            <th>City</th>
                            <th>Phone Number</th>
                            <th>Option</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php  
                    $query = 'SELECT SUPPLIER_ID, COMPANY_NAME, l.PROVINCE, l.CITY, PHONE_NUMBER 
                              FROM supplier s 
                              JOIN location l ON s.LOCATION_ID = l.LOCATION_ID';
                    $result = mysqli_query($db, $query) or die (mysqli_error($db));

                    while ($row = mysqli_fetch_assoc($result)) {
                        echo '<tr>';
                        echo '<td>' . $row['COMPANY_NAME'] . '</td>';
                        echo '<td>' . $row['PROVINCE'] . '</td>';
                        echo '<td>' . $row['CITY'] . '</td>';
                        echo '<td>' . $row['PHONE_NUMBER'] . '</td>';
                        echo '<td class="text-right">
                                <div class="btn-group">
                                    <a href="sup_searchfrm.php?action=edit&id=' . $row['SUPPLIER_ID'] . '" class="btn btn-info">
                                        <i class="fas fa-fw fa-list-alt"></i> Details
                                    </a>
                                    <div class="btn-group">
                                        <a href="#" class="btn btn-info dropdown-toggle" data-toggle="dropdown" style="color:white;">
                                            ... <span class="caret"></span>
                                        </a>
                                        <ul class="dropdown-menu text-center">
                                            <li>
                                                <a href="sup_edit.php?action=edit&id=' . $row['SUPPLIER_ID'] . '" class="btn btn-warning btn-block">
                                                    <i class="fas fa-fw fa-edit"></i> Edit
                                                </a>
                                            </li> 
                                        </ul>
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

    <!-- Supplier Modal -->
    <div class="modal fade" id="supplierModal" tabindex="-1" role="dialog" aria-labelledby="supplierModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-info text-white">
                    <h5 class="modal-title" id="supplierModalLabel">Add Supplier</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form role="form" method="post" action="sup_transac.php?action=add">
                        <div class="form-group">
                            <input class="form-control" placeholder="Company Name" name="companyname" required>
                        </div>
                        <div class="form-group">
                            <select class="form-control" id="province" name="province" required>
                                <option value="" disabled selected>Select Province</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <select class="form-control" id="city" name="city" required>
                                <option value="" disabled selected>Select City</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <input class="form-control" placeholder="Phone Number" name="phonenumber" required>
                        </div>
                        <div class="d-flex justify-content-between">
                            <button type="submit" class="btn btn-success"><i class="fa fa-check fa-fw"></i> Save</button>
                            <button type="reset" class="btn btn-danger"><i class="fa fa-times fa-fw"></i> Reset</button>
                            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>

<?php
include'../includes/footer.php';
?>

