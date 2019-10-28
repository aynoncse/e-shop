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

</style>
<div class="main">
	<div class="content">
		<div class="section group">
			<?php
			$customerId 	= Session::get('customerId');
			$getCustomer 	= $customer->getCustomerById($customerId)->fetch_assoc();
			?>
			<table class="tblone">
				<tr>
					<td colspan="3" style="text-align: center;"><h2>Your Profile</h2></td>
				</tr>
				<tr>
					<td width="25%">Name</td>
					<td width="5%">:</td>
					<td width="70%"><?php echo $getCustomer['name'];?></td>
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
</div>
</div>
<?php include 'inc/footer.php'; ?>