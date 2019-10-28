<?php include 'inc/header.php';?>
<?php 
$login = Session::get('customerLogin');
if ($login == false) {
	header("Location: login.php");
}
?>
 <div class="main">
    <div class="content">
    	<div class="cartoption">		
			<div class="cartpage">
			    	<h2>Product Comparison</h2>
						<table class="tblone">
							<tr>
								<th>SL</th>
								<th>Product Name</th>
								<th>Price</th>
								<th>Image</th>
								<th>Action</th>
							</tr>
							<?php
								$id = Session::get('customerId');
								$compareData = $product->getCompareData($id);
								if ($compareData) {
									$i=0;
									while ($data = $compareData->fetch_assoc()) {
										$i++;
							?>
							<tr>
								<td><?php echo $i;?></td>
								<td><?php echo $data['product_name'];?></td>
								<td>$<?php echo $data['price'];?></td>
								<td><img src="admin/<?php echo $data['image'];?>" alt=""/></td>
								<td><a href="details.php?productid=<?php echo $data['product_id'];?>">View</a></td>
							</tr>
						<?php 
							}}else{
						?>
							<tr>
								<td colspan="7" class="error">Your list is empty.</td>
							</tr>
						<?php } ?>
						</table>
					</div>
					<div class="shopping">
						<div class="shopleft">
							<a href="index.php"> <img src="images/shop.png" alt="" /></a>
						</div>
						<div class="shopright">
							<a href="payment.php"> <img src="images/check.png" alt="" /></a>
						</div>
					</div>
    	</div>  	
       <div class="clear"></div>
    </div>
 </div>
</div>
<?php include 'inc/footer.php'; ?>