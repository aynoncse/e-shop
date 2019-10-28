<?php include 'inc/header.php'; ?>
<?php 
$login = Session::get('customerLogin');
if ($login == false) {
	header("Location: login.php");
}
?>
<style>
.tblone {
	width: 650px;
	margin: 0 auto;
	box-shadow: 0px 0px 15px #3c1271;
	font-family: "monda";
}
.tblone td{
	text-align: justify;
	padding: 10px 30px;
}
.content h2 {
	font-size: 23px;
	color: #C4AEE4;
	font-family: 'Monda', sans-serif;
}
.updatebtn {
	background: #fff;
	border: none;
	padding: 5px 30px;
	color: #710ba7;
	font-size: 18px;
	cursor: pointer;
	transition: 1s;
}
.updatebtn:hover {
	background: #c4bada;
}

</style>
<div class="main">

	<div class="content">
		<div class="section group">
			<?php
			$customerId 	= Session::get('customerId');
			$getCustomer 	= $customer->getCustomerById($customerId)->fetch_assoc();
			?>
			<?php
			if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update'])) {
				$updateCustomer = $customer->updateCustomer($customerId, $_POST);
			}
			?>
			<?php if (isset($updateCustomer)) {
				echo '<div style = "text-align:center; margin-bottom:10px;">'.$updateCustomer.'</div>';
			} ?>
			<form action="" method="post" class="contact-form">
				<table class="tblone">
					<tr>
						<td colspan="3" style="text-align: center;"><h2>Update Your Details</h2></td>
					</tr>
					<tr>
						<td width="25%">Name</td>
						<td width="5%">:</td>
						<td width="70%"><input type="text" name="name" value="<?php echo $getCustomer['name'];?>"/></td>
					</tr>
					<tr>
						<td>Phone</td>
						<td>:</td>
						<td><input type="text" name="phone" value="<?php echo $getCustomer['phone'];?>"/></td>
					</tr>
					<tr>
						<td>Email</td>
						<td>:</td>
						<td><input type="text" name="email" value="<?php echo $getCustomer['email'];?>"/></td>
					</tr>
					<tr>
						<td>Address</td>
						<td>:</td>
						<td><input type="text" name="address" value="<?php echo $getCustomer['address'];?>"/></td>
					</tr>
					<tr>
						<td>City</td>
						<td>:</td>
						<td><input type="text" name="city" value="<?php echo $getCustomer['city'];?>"/></td>
					</tr>
					<tr>
						<td>Zip Code</td>
						<td>:</td>
						<td><input type="text" name="zip" value="<?php echo $getCustomer['zip'];?>"/></td>
					</tr>
					<tr>
						<td>Country</td>
						<td>:</td>
						<td><input type="text" name="country" value="<?php echo $getCustomer['country'];?>"/></td>
					</tr>
					<tr>
						<td></td>
						<td></td>
						<td><button class="updatebtn" type="submit" name="update">Update</button> </td>
					</tr>
				</table>
			</form>
		</div>
	</div>
</div>
</div>
<?php include 'inc/footer.php'; ?>