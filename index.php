<?php include 'inc/header.php'; ?>
<?php include 'inc/slider.php'; ?>
 <div class="main">
    <div class="content">
    	<div class="content_top">
    		<div class="heading">
    		<h3>Feature Products</h3>
    		</div>
    		<div class="clear"></div>
    	</div>
	      <div class="section group">
	      	<?php
	      		$getFeaturedProduct = $product->getFeaturedProduct();
	      		if ($getFeaturedProduct) {
	      			while($data = $getFeaturedProduct->fetch_assoc()){
	      		
	      	?>
				<div class="grid_1_of_4 images_1_of_4">
					 <a href="details.php?productid=<?php echo $data['id'];?>"><img src="admin/<?php echo $data['image'];?>" alt="Featured-Product" /></a>
					 <h2><?php echo $data['name'];?></h2>
					 <p><?php echo $fm->textShorten($data['description'], 65);?></p>
					 <p><span class="price"><?php echo '$'.$data['price'];?></span></p>
				     <div class="button"><span><a href="details.php?productid=<?php echo $data['id'];?>" class="details">Details</a></span></div>
				</div>
			<?php }} ?>
			</div>
			<div class="content_bottom">
    		<div class="heading">
    		<h3>New Products</h3>
    		</div>
    		<div class="clear"></div>
    	</div>
			<div class="section group">
			<?php
	      		$getNewProduct = $product->getNewProduct();
	      		if ($getNewProduct) {
	      			while($data = $getNewProduct->fetch_assoc()){
	      		
	      	?>
				<div class="grid_1_of_4 images_1_of_4">
					 <a href="details.php?productid=<?php echo $data['id'];?>"><img src="admin/<?php echo $data['image'];?>" alt="Featured-Product" /></a>
					 <h2><?php echo $data['name'];?></h2>
					 <p><span class="price"><?php echo '$'.$data['price'];?></span></p>
				     <div class="button"><span><a href="details.php?productid=<?php echo $data['id'];?>" class="details">Details</a></span></div>
				</div>
			<?php }} ?>
			</div>
    </div>
 </div>
</div>
<?php include 'inc/footer.php';?>