<?php
include '../includes/connection.php';
include '../includes/sidebar.php';

// Restrict access for 'User' type
$query = "SELECT ID, t.TYPE FROM users u JOIN type t ON t.TYPE_ID=u.TYPE_ID WHERE ID = " . $_SESSION['MEMBER_ID'];
$result = mysqli_query($db, $query) or die(mysqli_error($db));
$row = mysqli_fetch_assoc($result);
if ($row['TYPE'] == 'User') {
    echo "<script>alert('Restricted Page! Redirecting to POS...'); window.location = 'pos.php';</script>";
    exit;
}

// Fetch categories
$sql = "SELECT DISTINCT CNAME, CATEGORY_ID FROM category ORDER BY CNAME ASC";
$result = mysqli_query($db, $sql) or die("Bad SQL: $sql");
$categoryOptions = "<select class='form-select' name='category' required>
                     <option disabled selected hidden>Select Category</option>";
while ($row = mysqli_fetch_assoc($result)) {
    $categoryOptions .= "<option value='" . $row['CATEGORY_ID'] . "'>" . $row['CNAME'] . "</option>";
}
$categoryOptions .= "</select>";

// Fetch suppliers
$sql2 = "SELECT DISTINCT SUPPLIER_ID, COMPANY_NAME FROM supplier ORDER BY COMPANY_NAME ASC";
$result2 = mysqli_query($db, $sql2) or die("Bad SQL: $sql2");
$supplierOptions = "<select class='form-select' name='supplier' required>
                     <option disabled selected hidden>Select Supplier</option>";
while ($row = mysqli_fetch_assoc($result2)) {
    $supplierOptions .= "<option value='" . $row['SUPPLIER_ID'] . "'>" . $row['COMPANY_NAME'] . "</option>";
}
$supplierOptions .= "</select>";
?>

<div >
    <div class="card shadow-sm">
        <div class="card-header bg-info text-white d-flex justify-content-between align-items-center">
            <h4 class="m-0">Products</h4>
            <button class="btn btn-light" data-toggle="modal" data-target="#addProductModal">
                <i class="fas fa-plus"></i> Add Product
            </button>
        </div>
        <div class="card-body">
            <table class="table table-hover table-striped text-center align-middle">
                <thead>
                    <tr>
                        <th>Product Code</th>
                        <th>Name</th>
                        <th>Price</th>
                        <th>Category</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $query = "SELECT PRODUCT_ID, PRODUCT_CODE, NAME, PRICE, CNAME FROM product p 
                              JOIN category c ON p.CATEGORY_ID=c.CATEGORY_ID GROUP BY PRODUCT_CODE";
                    $result = mysqli_query($db, $query) or die(mysqli_error($db));
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>
                                <td>{$row['PRODUCT_CODE']}</td>
                                <td>{$row['NAME']}</td>
                                <td>\${$row['PRICE']}</td>
                                <td>{$row['CNAME']}</td>
                                <td>
                                    <a class='btn btn-info btn-sm' href='pro_searchfrm.php?action=edit&id={$row['PRODUCT_CODE']}'>
                                        <i class='fas fa-info-circle'></i> Details
                                    </a>
                                    <a class='btn btn-warning btn-sm' href='pro_edit.php?action=edit&id={$row['PRODUCT_ID']}'>
                                        <i class='fas fa-edit'></i> Edit
                                    </a>
                                </td>
                              </tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Add Product Modal -->
<div class="modal fade" id="addProductModal" tabindex="-1">
    <div class="modal-dialog modal-lg"> <!-- Increased width -->
        <div class="modal-content">
            <div class="modal-header bg-info text-white">
                <h5 class="modal-title"><i class="fas fa-box"></i> Add New Product</h5>     
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
            </div>
            <div class="modal-body">
                <form method="post" action="pro_transac.php?action=add">
                    <div class="row">
                        <!-- Left Column -->
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Product Code</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-barcode"></i></span>
                                    <input class="form-control" placeholder="Enter Product Code" name="prodcode" required>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Name</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-tag"></i></span>
                                    <input class="form-control" placeholder="Enter Product Name" name="name" required>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Description</label>
                                <textarea class="form-control" rows="3" placeholder="Enter Description" name="description" required></textarea>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Quantity</label>
                                <input type="number" class="form-control" placeholder="Enter Quantity" name="quantity" min="1" required>
                            </div>
                        </div>

                        <!-- Right Column -->
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">On Hand</label>
                                <input type="number" class="form-control" placeholder="Enter Stock on Hand" name="onhand" min="1" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Price ($)</label>
                                <input type="number" class="form-control" placeholder="Enter Price" name="price" min="1" step="0.01" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Category</label>
                                <?= $categoryOptions; ?>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Supplier</label>
                                <?= $supplierOptions; ?>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Date Stock In</label>
                                <input type="date" class="form-control" name="datestock" required>
                            </div>
                        </div>
                    </div>

                    <!-- Buttons -->
                    <div class="d-flex justify-content-end mt-3">
                        <button type="submit" class="btn btn-success me-2"><i class="fas fa-save"></i> Save</button>
                        <button type="reset" class="btn btn-danger"><i class="fas fa-undo"></i> Reset</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="fas fa-times"></i> Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<?php include '../includes/footer.php'; ?>
