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

$opt = "<select class='form-control' name='category' required>
        <option value='' disabled selected hidden>Select Category</option>";
while ($row = mysqli_fetch_assoc($result)) {
    $opt .= "<option value='".$row['CATEGORY_ID']."'>".$row['CNAME']."</option>";
}

$opt .= "</select>";

$query = 'SELECT PRODUCT_ID, PRODUCT_CODE, NAME, DESCRIPTION, QTY_STOCK, PRICE, c.CNAME FROM product p JOIN category c ON p.CATEGORY_ID=c.CATEGORY_ID WHERE PRODUCT_ID ='.$_GET['id'];
$result = mysqli_query($db, $query) or die(mysqli_error($db));
while($row = mysqli_fetch_array($result)) {   
    $zz = $row['PRODUCT_ID'];
    $zzz = $row['PRODUCT_CODE'];
    $A = $row['NAME'];
    $B = $row['DESCRIPTION'];
    $C = $row['PRICE'];
    $D = $row['CNAME'];
}
$id = $_GET['id'];
?>

<!-- Edit Product Form -->
<div class="container mt-5">
    <div class="card shadow-lg mb-4 ">
        <div class="card-header bg-info text-white">
            <h4 class="m-0 font-weight-bold">Edit Product</h4>
        </div>
        <div class="card-body">
            <a href="product.php?action=add" class="btn btn-info mb-3">
                <i class="fas fa-arrow-left"></i> Back
            </a>
            <form role="form" method="post" action="pro_edit1.php">
                <input type="hidden" name="id" value="<?php echo $zz; ?>" />
                <div class="form-group row">
                    <label class="col-sm-3 text-primary" for="prodcode">Product Code:</label>
                    <div class="col-sm-9">
                        <input class="form-control" id="prodcode" placeholder="Product Code" name="prodcode" value="<?php echo $zzz; ?>" readonly>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 text-primary" for="prodname">Product Name:</label>
                    <div class="col-sm-9">
                        <input class="form-control" id="prodname" placeholder="Product Name" name="prodname" value="<?php echo $A; ?>" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 text-primary" for="description">Description:</label>
                    <div class="col-sm-9">
                        <textarea class="form-control" id="description" placeholder="Description" name="description"><?php echo $B; ?></textarea>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 text-primary" for="price">Price:</label>
                    <div class="col-sm-9">
                        <input class="form-control" id="price" placeholder="Price" name="price" value="<?php echo $C; ?>" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 text-primary" for="category">Category:</label>
                    <div class="col-sm-9">
                        <?php echo $opt; ?>
                    </div>
                </div>
                <hr>
                <button type="submit" class="btn btn-warning">
                    <i class="fa fa-edit fa-fw"></i> Update
                </button>    
            </form>  
        </div>
    </div>
</div>

<?php
include'../includes/footer.php';
?>
