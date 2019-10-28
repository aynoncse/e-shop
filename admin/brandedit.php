<?php include '../classes/Brand.php'; ?>
<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php
if (!isset($_GET['brandid']) || $_GET['brandid'] == NULL) {
    echo "<script>window.location = 'brandlist.php';</script>";
}else{
    $brandId = preg_replace('/[^-a-zA-Z0-9_]/', '', $_GET['brandid']);
}
$brand = new Brand();
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
    $name       = $_POST['name'];
    $updateBrand  = $brand->updateBrand($brandId,$name);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['back'])) {
    echo "<script>window.location = 'brandlist.php';</script>";
}

?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Update Brand</h2>
        <div class="block copyblock"> 
            <?php
            if (isset($updateBrand)) {
                echo $updateBrand;
            }
            ?>
            <form action="" method = 'post'>
                <table class="form">					
                    <tr>
                        <td>
                        <?php
                            $getBrand  = $brand->getBrandById($brandId);
                            if ($getBrand) {
                                $brandVal= $getBrand->fetch_assoc();
                            }

                        ?>
                            <input type="text" name ='name' value="<?php echo $brandVal['name']; ?>" class="medium" />
                        </td>
                    </tr>
                    <tr> 
                        <td>
                            <input type="submit" name="submit" Value="Update" />
                            <input type="submit" name="back" Value="Back" />

                        </td>
                        
                    </tr>
                </table>
            </form>
        </div>
    </div>
</div>
<?php include 'inc/footer.php';?>