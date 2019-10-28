<?php include 'inc/header.php'; ?>
<div class="main">
	<div class="content">
		<div class="content_top">
			<div class="heading">
				<?php
				if (!isset($_GET['catId']) && !isset($_GET['catName'])){
					echo "<script>window.location = '404.php';</script>";
				}else{
					$catId 		= preg_replace('/[^-a-zA-Z0-9_]/', '', $_GET['catId']);
					$catName 	= $fm->validate($_GET['catName']);
				}
				?>
				<h3><?php echo $catName; ?></h3>
			</div>
			<div class="clear"></div>
		</div>

		<div class="section group">
			<?php
			$getProduct = $product->getProductByCat($catId);
			if ($getProduct) {
				while ($product = $getProduct->fetch_assoc()){
					
					?>
					<div class="grid_1_of_4 images_1_of_4">
						<a href="details-3.php"><img src="admin/<?php echo $product['image']; ?>" alt="" /></a>
						<h2><?php echo $product['name']; ?></h2>
						<p><?php echo $fm->textShorten($product['description'], 100);?></p>
						<p><span class="price">$<?php echo $product['price']; ?></span></p>
						<div class="button"><span><a href="details.php?productid=<?php echo $product['id'];?>" class="details">Details</a></span></div>
					</div>
				<?php }}else{
					echo "<script>window.location = '404.php';</script>";
				} ?>
			</div>

		</div>
	</div>
</div>
<?php include 'inc/footer.php'; ?>

