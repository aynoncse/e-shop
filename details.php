<?php include 'inc/header.php'; ?>

<?php
if (isset($_GET['productid'])){
	$id = preg_replace('/[^-a-zA-Z0-9_]/', '', $_GET['productid']);
}
?>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
	$quantity 	= $_POST['quantity'];
	$addCart 	= $cart->addToCart($id, $quantity);
} 
?>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['compare'])) {
	$customerId 	= Session::get('customerId'); 
	$compareId 		= preg_replace('/[^-a-zA-Z0-9_]/', '', $_POST['compareId']);
	$insertCompare	= $product->insertToCompare($customerId, $compareId);
}
?>

<div class="main">
	<div class="content">		
		<div class="section group">
			<div class="cont-desc span_1_of_2">	
				<?php
				$getFeaturedProduct = $product->getProductById($id);
				if ($getFeaturedProduct) {
					$data = $getFeaturedProduct->fetch_assoc();
					?>			
					<div class="grid images_3_of_2">
						<img src="admin/<?php echo $data['image'];?>" alt="Featured-Product" />
					</div>
					<div class="desc span_3_of_2">
						<h2><?php echo $data['name'];?></h2>				
						<div class="price">
							<p>Price: <span>$<?php echo $data['price'];?></span></p>
							<p>Category: <span><?php echo $data['catName'];?></span></p>
							<p>Brand:<span><?php echo $data['brandName'];?></span></p>
						</div>
						<div class="add-cart">
							<form action="" method="post">
								<input type="number" class="buyfield" name="quantity" value="1"/>
								<input type="submit" class="buysubmit" name="submit" value="Buy Now"/>
							</form>	
						</div>
						<?php
						if (isset($addCart)) {
							echo $addCart;
						}
						?>			

						<?php
						if (isset($insertCompare)) {
							echo $insertCompare;
						}
						?>

						<?php 
						$customerId 	= Session::get('customerId'); 
						if ($customerId) {
						?>
							<div class="add-cart">
								<form action="" method="post">
									<input type="text" class="buysubmit" name="compareId" value="<?php echo $data['id'];?>" hidden/>
									<input type="submit" class="buysubmit" name="compare" value="Add to Compare"/>
								</form>	
							</div>
						<?php } ?>
					</div>
					<div class="product-desc">
						<h2>Product Details</h2>
						<?php echo $data['description'];?>
					</div>
				<?php } ?>
			</div>
			<div class="rightsidebar span_3_of_1">
				<h2>CATEGORIES</h2>
				<ul>
					<?php
					$getCat = $cat->getAllCategory();
					if ($getCat) {
						while ($catVal = $getCat->fetch_assoc()) {
							
							?>
							<li><a href="productbycat.php?catId=<?php echo $catVal['id'];?>&catName=<?php echo $catVal['name'];?>"><?php echo $catVal['name'];?></a></li>
						<?php } }?>
					</ul>

				</div>
			</div>
		</div>
	</div>
</div>
<?php include 'inc/footer.php'; ?>