<?php include 'inc/header.php'; ?>
<style>
.psuccess {
	width: 500px;
	margin: 0 auto;
	border: 1px solid #ddd;
	text-align: center;
	padding: 50px;
}
.psuccess h2 {
	border-bottom: 1px solid #ddd;
	margin-bottom: 20px;
	padding-bottom: 5px;
	font-size: 28px;
	color: #16890f;
}

.psuccess p {
	line-height: 30px;
	text-transform: capitalize;
	text-align: left;
	font-size: 18px;
	color: #a73535;
}
.psuccess p:first-of-type {
	margin-bottom: 5px;
	color: #ef0000;
}
.psuccess a {
	color: #ef0000;
}
</style>
<?php 
$login = Session::get('customerLogin');
if ($login == false) {
	header("Location: login.php");
}
?>
<div class="main">
	<div class="content">
		<div class="section group">
			<div class="psuccess">'
				<h2>Success</h2>
				<?php
					$customerId = Session::get('customerId');
					$getPrice 	= $cart->getOrderedPrice($customerId);
					if ($getPrice) {
						$result = $getPrice->fetch_assoc();
						$price 	= $result['totalPrice'];
						$vat 	= (10/100);
						$total 	= $price + ($price * $vat);
					}
				?>
				<p>Total Payable Ampunt (Including VAT): $ <?php echo $total; ?></p>
				<p>Thanks <span class="text-lwcase">for</span> purchase. Receive your order successfully. we will contact you <abbr title="As Soon As Possible" style="text-decoration: none !important;">ASAP <span class="text-lwcase">with</span> delevery details. Here is your details....<a href="orderdetails.php">Visit Here</a></abbr></p>
			</div>
		</div>
	</div>
</div>
</div>
<?php include 'inc/footer.php'; ?>