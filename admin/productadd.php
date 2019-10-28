<?php include_once 'inc/header.php';?>
<?php include_once 'inc/sidebar.php';?>
<?php include_once '../classes/Category.php'; ?>
<?php include_once '../classes/Brand.php'; ?>
<?php include_once '../classes/Product.php'; ?>
<?php
$cat        = new Category();
$brand      = new Brand();
$product    = new Product();

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
    $insertProduct  = $product->addProduct($_POST, $_FILES);
}
?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Add New Product</h2>
        <?php
            if (isset($insertProduct)) {
                echo $insertProduct;
            }
            ?>   
        <div class="block">   

            <form action="" method="post" enctype="multipart/form-data">
                <table class="form">

                    <tr>
                        <td>
                            <label>Name</label>
                        </td>
                        <td>
                            <input type="text" name = 'name' placeholder="Enter Product Name..." class="medium" />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Category</label>
                        </td>
                        <td>
                            <select id="select" name="catId">
                                <option value="" selected="selected">Select Category</option>
                                <?php 
                                $getCat = $cat->getAllCategory();
                                if ($getCat) {
                                    while ($catVal = $getCat->fetch_assoc()) {
                                        ?>
                                        <option value="<?php echo $catVal['id'];?>"><?php echo $catVal['name'];?></option>

                                    <?php }} ?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Brand</label>
                            </td>
                            <td>
                                <select id="select" name="brandId">
                                    <option selected value=''>Select Brand</option>
                                    <?php 
                                    $getBrand = $brand->getAllBrand();
                                    $i = 0;
                                    if ($getBrand) {
                                        while ($brandVal = $getBrand->fetch_assoc()) {
                                            ?>
                                            <option value="<?php echo $brandVal['id'];?>"><?php echo $brandVal['name'];?></option>
                                        <?php }} ?>   
                                    </select>
                                </td>
                            </tr>

                            <tr>
                                <td style="vertical-align: top; padding-top: 9px;">
                                    <label>Description</label>
                                </td>
                                <td>
                                    <textarea class="tinymce" name ="description"></textarea>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label>Price</label>
                                </td>
                                <td>
                                    <input type="text" name="price" placeholder="Enter Price..." class="medium" />
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <label>Upload Image</label>
                                </td>
                                <td>
                                    <input type="file" name="image" />
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <label>Product Type</label>
                                </td>
                                <td>
                                    <select id="select" name="type">
                                        <option selected value=''>Select Type</option>
                                        <option value="0">Featured</option>
                                        <option value="1">Non-Featured</option>
                                    </select>
                                </td>
                            </tr>

                            <tr>
                                <td></td>
                                <td>
                                    <input type="submit" name="submit" Value="Add" />
                                </td>
                            </tr>
                        </table>
                    </form>
                </div>
            </div>
        </div>
        <!-- Load TinyMCE -->
        <script src="js/tiny-mce/jquery.tinymce.js" type="text/javascript"></script>
        <script type="text/javascript">
            $(document).ready(function () {
                setupTinyMCE();
                setDatePicker('date-picker');
                $('input[type="checkbox"]').fancybutton();
                $('input[type="radio"]').fancybutton();
            });
        </script>
        <!-- Load TinyMCE -->
        <?php include 'inc/footer.php';?>


