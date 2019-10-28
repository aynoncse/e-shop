<?php include 'inc/header.php'; ?>
<style>
.payment {
	width: 500px;
	margin: 0 auto;
	border: 1px solid #ddd;
	text-align: center;
	padding: 50px;
}
.payment h2 {
	border-bottom: 1px solid #ddd;
	margin-bottom: 40px;
	padding-bottom: 5px;
	font-size: 28px;
}
.payment a {
	background: #fc0303;
	padding: 10px 30px;
	color: #fff;
	border-radius: 5px;
	margin: 0 5px;
	font-size: 25px;
	transition: 1s;
}
.payment a:hover {
	background: #b71b1b;
	color: #ffcfcf;
}
.back {
	width: 150px;
	margin: 0 auto;
	background: #464350;
	text-align: center;
	padding: 10px 5px;
	margin-top: 20px;
	border-radius: 3px;
	transition: 1s;
}
.back:hover {
	background: #2c2727;
}
.back a{
	color: #fff;
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
			<div class="payment">'
				<h2>Choose Payment Option</h2>
				<a href="payoffline.php">Offline Payment</a>
				<a href="payonline.php">Online Payment</a>
			</div>
			<div class="back"><a href="cart.php" title="Go to Previous Page">Back</a></div>
		</div>
	</div>
</div>
</div>
<?php include 'inc/footer.php'; ?>