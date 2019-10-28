<?php include 'inc/header.php'; ?>
<style>
.division {
	width: 50%;
	float: left;
	margin: 0;
}
.tblone {
	width: 95%;
	box-shadow: 0px 0px 5px #3c1271;
	font-family: "Monda";
}

.tblone td, .tbltwo td{
	text-align: justify;
	padding: 10px;
}
.tblone th {
	font-size: 16px;
}
.tbltwo {
	float: right;
	border: 1px solid #fff;
	margin-top: 12px;
	width: 60%;
	margin-right: 25px;
	box-shadow: 0 0 5px 0;
}
.content h2 {
	font-size: 23px;
	color: #C4AEE4;
	font-family: 'Monda', sans-serif;
}
.ordernow {
	width: 120px;
	margin: 30px auto 15px;
	text-align: center;
}
.ordernow a {
	background: #FC2530;
	padding: 10px 20px;
	color: #fff;
}
</style>

<?php 
	$login = Session::get('customerLogin');
	if ($login == false) {
		header("Location: login.php");
	}
?>

<?php
	$customerId 	= Session::get('customerId');
	$getCustomer 	= $customer->getCustomerById($customerId)->fetch_assoc();
	?>
<?php
	if (isset($_GET['order']) && $_GET['order'] == 'order') {
		$insertOrderedProduct = $cart->getCartByCustomer($customerId);
		$s_id = session_id();
		$delCart = $cart->deleteCart($s_id);
		header("Location: success.php");
	}
?>
<div class="main">
	<div class="content">
		<div class="section group">
			<div class="division">
				<table class="tblone">
					<tr>
						<th>No.</th>
						<th>Product</th>
						<th>Price</th>
						<th>Quantity</th>
						<th>Total</th>
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
								
								<td>$<?php echo $data['price'];?></td>
								<td><?php echo $data['quantity'];?></td>
								<td>
									$<?php
									$total =  ($data['price']*$data['quantity']);
									echo $total;
									?>									
								</td>
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

					<table class="tbltwo">
						<tr>
							<td>Sub Total </td>
							<td>:</td>
							<td>$<?php if(isset($sum)){ echo $sum;}else echo '0'; ?>
						</td>
					</tr>
					<tr>
						<td>VAT </td>
						<td> : </td>
						<td>
							<?php if(isset($vat)){ 
								echo "$".$sum*$vat/100;
								echo " (".$vat."%)";
							}else {echo '0';}?>
						</td>
					</tr>
					<tr>
						<td>Grand Total</td>
						<td>:</td>
						<td>$<?php if(isset($vat)){ echo $totalCost = $sum+($sum*$vat/100);}else {echo '0';}?>	
					</td>
				</tr>
				<?php Session::set('totalCost', $totalCost);?>
			</table>
		</div>

		
		<div class="division">
			<table class="tblone" style="float: right;">
				<tr>
					<td colspan="3" style="text-align: center;"><h2>Your Profile</h2></td>
				</tr>
				<tr>
					<td>Name</td>
					<td>:</td>
					<td><?php echo $getCustomer['name'];?></td>
				</tr>
				<tr>
					<td>Phone</td>
					<td>:</td>
					<td><?php echo $getCustomer['phone'];?></td>
				</tr>
				<tr>
					<td>Email</td>
					<td>:</td>
					<td><?php echo $getCustomer['email'];?></td>
				</tr>
				<tr>
					<td>Address</td>
					<td>:</td>
					<td><?php echo $getCustomer['address'];?></td>
				</tr>
				<tr>
					<td>City</td>
					<td>:</td>
					<td><?php echo $getCustomer['city'];?></td>
				</tr>
				<tr>
					<td>Zip Code</td>
					<td>:</td>
					<td><?php echo $getCustomer['zip'];?></td>
				</tr>
				<tr>
					<td>Country</td>
					<td>:</td>
					<td><?php echo $getCustomer['country'];?></td>
				</tr>
				<tr>
					<td></td>
					<td></td>
					<td><a href="editprofile.php?<?php echo $getCustomer['id'];?>">Update Profile</a></td>
				</tr>
			</table>
		</div>
	</div>
	<div class="ordernow"><a href="?order=order">Order Now</a></div>

</div>
</div>
</div>
<?php include 'inc/footer.php'; ?>