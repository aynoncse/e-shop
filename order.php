<?php include 'inc/header.php'; ?>
<?php 
	$login = Session::get('customerLogin');
	if ($login == false) {
		header("Location: login.php");
	}
?>
<div class="main">
	<div class="content">
		<div class="Order">
			<h2>Order Page</h2>
		</div>
	</div>
</div>
</div>
<?php include 'inc/footer.php';?>