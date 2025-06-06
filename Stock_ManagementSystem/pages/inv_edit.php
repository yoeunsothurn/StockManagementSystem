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

$sql = "SELECT DISTINCT CNAME, CATEGORY_ID FROM category ORDER BY CNAME ASC";
$result = mysqli_query($db, $sql) or die ("Bad SQL: $sql");

$opt = "<select class='form-control' name='category'>
        <option disabled selected>Select Category</option>";
while ($row = mysqli_fetch_assoc($result)) {
    $opt .= "<option value='".$row['CATEGORY_ID']."'>".$row['CNAME']."</option>";
}

$opt .= "</select>";

$query = 'SELECT PRODUCT_ID, PRODUCT_CODE, NAME, QTY_STOCK, ON_HAND, COMPANY_NAME, c.CNAME 
          FROM product p 
          JOIN category c ON p.CATEGORY_ID = c.CATEGORY_ID 
          JOIN supplier s ON p.SUPPLIER_ID = s.SUPPLIER_ID 
          WHERE PRODUCT_ID ='.$_GET['id'];
$result = mysqli_query($db, $query) or die(mysqli_error($db));

while ($row = mysqli_fetch_array($result)) {   
    $zz = $row['PRODUCT_ID'];
    $zzz = $row['PRODUCT_CODE'];
    $A = $row['NAME'];
    $B = $row['QTY_STOCK'];
    $C = $row['ON_HAND'];
    $D = $row['COMPANY_NAME'];
    $E = $row['CNAME'];
}

$id = $_GET['id'];
?>

<!-- Edit Inventory Form -->
<div class="container mt-5">
    <div class="card shadow-lg mb-4">
        <div class="card-header bg-info text-white">
            <h4 class="m-0 font-weight-bold">Edit Inventory for: <?php echo $A; ?></h4>
        </div>
        <div class="card-body">
            <a href="inv_searchfrm.php?action=edit&id=<?php echo $zzz; ?>" class="btn btn-info mb-3">
                <i class="fas fa-arrow-left"></i> Back
            </a>

            <form role="form" method="post" action="inv_edit1.php">
                <input type="hidden" name="idd" value="<?php echo $zz; ?>" />
                
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label text-left ">Product Code:</label>
                    <div class="col-sm-9">
                        <input class="form-control" value="<?php echo $zzz; ?>" readonly>
                    </div>
                </div>
                
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label text-left ">Product Name:</label>
                    <div class="col-sm-9">
                        <input class="form-control" value="<?php echo $A; ?>" readonly>
                    </div>
                </div>
                
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label text-left ">Quantity:</label>
                    <div class="col-sm-9">
                        <input class="form-control" placeholder="Quantity" name="qty" value="<?php echo $B; ?>" required>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-3 col-form-label text-left ">On Hand:</label>
                    <div class="col-sm-9">
                        <input class="form-control" placeholder="On Hand" name="oh" value="<?php echo $C; ?>" required>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-3 col-form-label text-left ">Supplier:</label>
                    <div class="col-sm-9">
                        <input class="form-control" value="<?php echo $D; ?>" readonly>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-3 col-form-label text-left ">Category:</label>
                    <div class="col-sm-9">
                        <input class="form-control" value="<?php echo $E; ?>" readonly>
                    </div>
                </div>
                
                <hr>
                <button type="submit" class="btn btn-warning ">
                    <i class="fa fa-edit fa-fw"></i> Update
                </button>    
            </form>  
        </div>
    </div>
</div>

<?php
include'../includes/footer.php';
?>
