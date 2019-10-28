<?php include_once 'inc/header.php';?>
<?php include_once 'inc/sidebar.php';?>
<?php include_once '../helpers/Format.php';?>
<?php include_once '../classes/Product.php'; ?>
<?php 
	$fm 		= new Format();
	$product 	= new Product();
?>
<?php
if (isset($_GET['delid'])) {
	$id 		= preg_replace('/[^-a-zA-Z0-9_]/', '', $_GET['delid']);
	$getProduct  = $product->getProductById($id);
    if ($getProduct) {
        $productVal= $getProduct->fetch_assoc();
    }
    unlink($productVal['image']);
	$delProduct = $product->deleteProduct($id);
}
?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Post List</h2>
        <div class="block">  
            <table class="data display datatable" id="example">
			<thead align="center">
				<tr>
					<th>SL</th>
					<th>Product Name</th>
					<th>Category</th>
					<th>Brand</th>
					<th>Description</th>
					<th>Price</th>
					<th>Image</th>
					<th>Type</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
				<?php 
					$getProduct = $product->getAllProduct();
					$i = 0;
					if ($getProduct) {
						while ($productVal = $getProduct->fetch_assoc()) {
							$i++;
				?>
				<tr class="odd gradeX">
					<td><?php echo $i;?></td>
					<td><?php echo $productVal['name'];?></td>
					<td><?php echo $productVal['catName'];?></td>
					<td><?php echo $productVal['brandName'];?></td>
					<td><?php echo $fm->textShorten($productVal['description'], 30);?></td>
					<td><?php echo $productVal['price'];?></td>
					<td><img src="<?php echo $productVal['image'];?>" height="40" width="60" alt="Product-Image"/></td>
					<td>
						<?php 
							if ($productVal['type'] == 0) {
								echo "Featured";
							}else echo "Non-Featured";
						?>
					</td>
					
					<td><a href="productedit.php?productid=<?php echo $productVal['id']?>">Edit</a> || <a onclick="return confirm('Are you sure to delete this product?')" href="?delid=<?php echo $productVal['id']?>">Delete</a></td>
				</tr>
				<?php }} ?>
			</tbody>
		</table>

       </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function () {
        setupLeftMenu();
        $('.datatable').dataTable();
		setSidebarHeight();
    });
</script>
<?php include 'inc/footer.php';?>
