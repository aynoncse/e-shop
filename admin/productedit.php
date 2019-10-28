<?php include_once 'inc/header.php';?>
<?php include_once 'inc/sidebar.php';?>
<?php include_once '../classes/Category.php'; ?>
<?php include_once '../classes/Brand.php'; ?>
<?php include_once '../classes/Product.php'; ?>

<?php
    if (!isset($_GET['productid']) || $_GET['productid'] == NULL) {
        echo "<script>window.location = 'productlist.php';</script>";
    }else{
        $productId = preg_replace('/[^-a-zA-Z0-9_]/', '', $_GET['productid']);
    }
?>

<?php
    $cat        = new Category();
    $brand      = new Brand();
    $product    = new Product();

    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
        $updateProduct  = $product->updateProduct($_POST, $_FILES, $productId);
    }
?>


<div class="grid_10">
    <div class="box round first grid">
        <h2>Update Product</h2>
        <?php
            if (isset($updateProduct)) {
                echo $updateProduct;
            }
            ?>   
        <div class="block">   

            <form action="" method="post" enctype="multipart/form-data">
                <table class="form">
                    <?php
                        $getProduct  = $product->getProductById($productId);
                        if ($getProduct) {
                            $productVal= $getProduct->fetch_assoc();
                        }
                    ?>
                    <tr>
                        <td>
                            <label>Name</label>
                        </td>
                        <td>
                            <input type="text" name = 'name' value="<?php echo $productVal['name'];?>" class="medium" />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Category</label>
                        </td>
                        <td>
                           <select id="select" name="catId">
                                <option>Select Category</option>
                                <?php 
                                $getCat = $cat->getAllCategory();
                                if ($getCat) {
                                    while ($catVal = $getCat->fetch_assoc()) {
                                        ?>
                                <option 
                                        <?php if ($catVal['id'] ==  $productVal['cat_id']) {?>
                                            selected = "selected"
                                        <?php } ?>
                                value="<?php echo $catVal['id'];?>"><?php echo $catVal['name'];?></option>

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
                                    <option>Select Brand</option>
                                    <?php 
                                    $getBrand = $brand->getAllBrand();
                                    $i = 0;
                                    if ($getBrand) {
                                        while ($brandVal = $getBrand->fetch_assoc()) {
                                            ?>
                                    <option 
                                        <?php if ($brandVal['id'] ==  $productVal['brand_id']) {?>
                                            selected = "selected"
                                        <?php } ?>
                                    value="<?php echo $brandVal['id'];?>"><?php echo $brandVal['name'];?></option>
                                        <?php }} ?>   
                                </select>
                                </td>
                            </tr>

                            <tr>
                                <td style="vertical-align: top; padding-top: 9px;">
                                    <label>Description</label>
                                </td>
                                <td>
                                    <textarea class="tinymce" name ="description"><?php echo $productVal['description'];?></textarea>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label>Price</label>
                                </td>
                                <td>
                                    <input type="text" name="price" value="<?php echo $productVal['price'];?>" class="medium" />
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <label>Upload Image</label>
                                </td>
                                <td>
                                    <img src="<?php echo $productVal['image'];?>" height="180" width="200" alt="Product-Image"/><br/>
                                    <input type="text" name='c_image' value="<?php echo $productVal['image'];?>" hidden/>
                                    <input type="file" name="image" />
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <label>Product Type</label>
                                </td>
                                <td>
                                    <select id="select" name="type">
                                        <option>Select Type</option>
                                        <?php if ($productVal['type'] == 0) {?>
                                        <option selected="selcetd" value="0">Featured</option>
                                        <option value="1">Non-Featured</option>
                                    <?php } else {?>
                                        <option value="0">Featured</option>
                                        <option selected="selected" value="1">Non-Featured</option>
                                    <?php }?>
                                    </select>
                                </td>
                            </tr>

                            <tr>
                                <td></td>
                                <td>
                                    <input type="submit" name="submit" Value="Update" />
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


