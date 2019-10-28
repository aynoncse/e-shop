	<div class="header_bottom">
		<div class="header_bottom_left">
			<div class="section group">
				<?php
					$getIphone = $product->latestFromIphone();
					if ($getIphone) {
						$iphone = $getIphone->fetch_assoc();
				?>
				<div class="listview_1_of_2 images_1_of_2">
					<div class="listimg listimg_2_of_1">
						 <a href="details.php?productid=<?php echo $iphone['id'];?>"> <img src="admin/<?php echo $iphone['image'];?>" alt="Latest Iphone Product"/></a>
					</div>
					
				    <div class="text list_2_of_1">
						<h2>Iphone</h2>
						<p><?php echo $iphone['name'];?></p>
						<div class="button"><span><a href="details.php?productid=<?php echo $iphone['id'];?>">Add to cart</a></span></div>
				   </div>
			   </div>
			   <?php } ?>
			   <?php
					$getSamsung = $product->latestFromSamsung();
					if ($getSamsung) {
						$samsung = $getSamsung->fetch_assoc();
				?>			
				<div class="listview_1_of_2 images_1_of_2">
					<div class="listimg listimg_2_of_1">
						 <a href="details.php?productid=<?php echo $samsung['id'];?>"> <img src="admin/<?php echo $samsung['image'];?>" alt="Latest Samsung Product"/></a>
					</div>
					
				    <div class="text list_2_of_1">
						<h2>Samsung</h2>
						<p><?php echo $samsung['name'];?></p>
						<div class="button"><span><a href="details.php?productid=<?php echo $samsung['id'];?>">Add to cart</a></span></div>
				   </div>
			   </div>
			   <?php } ?>
			</div>
			<div class="section group">
				<?php
					$getAcer = $product->latestFromAcer();
					if ($getAcer) {
						$acer = $getAcer->fetch_assoc();
				?>
				<div class="listview_1_of_2 images_1_of_2">
					<div class="listimg listimg_2_of_1">
						 <a href="details.php?productid=<?php echo $acer['id'];?>"> <img src="admin/<?php echo $acer['image'];?>" alt="Latest Acer Product"/></a>
					</div>
					
				    <div class="text list_2_of_1">
						<h2>Acer</h2>
						<p><?php echo $acer['name'];?></p>
						<div class="button"><span><a href="details.php?productid=<?php echo $acer['id'];?>">Add to cart</a></span></div>
				   </div>
			   </div>
			   <?php } ?>
			   <?php
					$getcanon = $product->latestFromcanon();
					if ($getcanon) {
						$canon = $getcanon->fetch_assoc();
				?>			
				<div class="listview_1_of_2 images_1_of_2">
					<div class="listimg listimg_2_of_1">
						 <a href="details.php?productid=<?php echo $canon['id'];?>"> <img src="admin/<?php echo $canon['image'];?>" alt="Latest canon Product"/></a>
					</div>
					
				    <div class="text list_2_of_1">
						<h2>Canon</h2>
						<p><?php echo $canon['name'];?></p>
						<div class="button"><span><a href="details.php?productid=<?php echo $canon['id'];?>">Add to cart</a></span></div>
				   </div>
			   </div>
			   <?php } ?>
			</div>
		  <div class="clear"></div>
		</div>
			 <div class="header_bottom_right_images">
		   <!-- FlexSlider -->
             
			<section class="slider">
				  <div class="flexslider">
					<ul class="slides">
						<li><img src="images/1.jpg" alt=""/></li>
						<li><img src="images/2.jpg" alt=""/></li>
						<li><img src="images/3.jpg" alt=""/></li>
						<li><img src="images/4.jpg" alt=""/></li>
				    </ul>
				  </div>
	      </section>
<!-- FlexSlider -->
	    </div>
	  <div class="clear"></div>
  </div>	
