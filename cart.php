<?php include 'inc/header.php';?>
<?php
if (isset($_GET['delcartid'])) {
	$id = preg_replace('/[^-a-zA-Z0-9_]/', '', $_GET['delcartid']);
	$delCart = $cart->deleteCartItem($id);
}
?>
<?php
//refresh page
	if (!isset($_GET['cid'])) {
		echo '<meta http-equiv="refresh" content="0;URL=?cid=cart"/>';
	}
?>
<?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['upQuantity'])) {
        $quantity 	= $_POST['quantity'];
        $cartid	= $_POST['cartid'];
        $addCart 	= $cart->updateQuantity($cartid, $quantity);
    } 
?>
 <div class="main">
    <div class="content">
    	<div class="cartoption">		
			<div class="cartpage">
			    	<h2>Your Cart</h2>
						<table class="tblone">
							<tr>
								<th width="5%">SL</th>
								<th width="30%">Product Name</th>
								<th width="15%">Image</th>
								<th width="10%">Price</th>
								<th width="10%">Quantity</th>
								<th width="20%">Total Price</th>
								<th width="10%">Action</th>
							</tr>
							<?php
								$id = session_id();
								$totalCost = 0;
								$cartData = $cart->getCartById($id);
								if ($cartData) {
									$i=0;
									$sum=0;
									$vat=10;
									while ($data = $cartData->fetch_assoc()) {
										$i++;
							?>
							<tr>
								<td><?php echo $i;?></td>
								<td><?php echo $data['product_name'];?></td>
								<td><img src="admin/<?php echo $data['image'];?>" alt=""/></td>
								<td>$<?php echo $data['price'];?></td>
								<td>
									<form action="" method="post">
										<input type="number" name="cartid" value="<?php echo $data['id'];?>" hidden/>
										<input type="number" name="quantity" value="<?php echo $data['quantity'];?>"/>
										<input type="submit" name="upQuantity" value="Update"/>
									</form>
								</td>
								<td>
									$<?php
										$total =  ($data['price']*$data['quantity']);
										echo $total;
									?>									
								</td>
								<td><a onclick="return confirm('Are you sure to delete?')" href="?delcartid=<?php echo $data['id'];?>">X</a></td>
							</tr>
						<?php 
							$sum = $sum+$total;
							}}else{
						?>
							<tr>
								<td colspan="7" class="error">Your cart is empty.</td>
							</tr>
						<?php } ?>
						</table>
						<table style="float:right;text-align:left;" width="40%">
							<tr>
								<th>Sub Total : </th>
								<td>$
									<?php if(isset($sum)){ echo $sum;}else echo '0'; ?>
									</td>
							</tr>
							<tr>
								<th>VAT : </th>
								<td>$
									<?php if(isset($vat)){ echo $vat.'%';}else echo '0';?>							
								</td>
							</tr>
							<tr>
								<th>Grand Total :</th>
								<td>$
									<?php if(isset($vat)){ echo $totalCost = $sum+($sum*$vat/100);}else {echo '0';}?>	
								</td>
							</tr>
							<?php Session::set('totalCost', $totalCost);?>
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