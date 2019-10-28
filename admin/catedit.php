<?php include '../classes/Category.php'; ?>
<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php
if (!isset($_GET['catid']) || $_GET['catid'] == NULL) {
    echo "<script>window.location = 'catlist.php';</script>";
}else{
    $catId = preg_replace('/[^-a-zA-Z0-9_]/', '', $_GET['catid']);
}
$cat = new Category();
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
    $name       = $_POST['name'];
    $updateCat  = $cat->updateCategory($catId,$name);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['back'])) {
    echo "<script>window.location = 'catlist.php';</script>";
}

?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Update Category</h2>
        <div class="block copyblock"> 
            <?php
            if (isset($updateCat)) {
                echo $updateCat;
            }
            ?>
            <form action="" method = 'post'>
                <table class="form">					
                    <tr>
                        <td>
                        <?php
                            $getCat  = $cat->getCategoryById($catId);
                            if ($getCat) {
                                $catVal= $getCat->fetch_assoc();
                            }

                        ?>
                            <input type="text" name ='name' value="<?php echo $catVal['name']; ?>" class="medium" />
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