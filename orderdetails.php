<?php include 'inc/header.php'; ?>
<?php 
$login = Session::get('customerLogin');
if ($login == false) {
	header("Location: login.php");
}
?>

<?php
if (isset($_GET['ordered_id'])) {
	$id = preg_replace('/[^-a-zA-Z0-9_]/', '', $_GET['ordered_id']);
	$receivedProduct = $cart->receivedProduct($id);
}
?>

<?php
if (isset($_GET['delOrderId'])) {
	$del_id = preg_replace('/[^-a-zA-Z0-9_]/', '', $_GET['delOrderId']);
	$delProduct = $cart->deleteOrderedItem($del_id);
}
?>

<style>
	.tblone td {
	padding: 20px 10px;
	text-align: center;
}
</style>
<div class="main">
	<div class="content">
		<div class="Order">
			<h2 class="txt-center">Ordered List</h2>
			<?php 
				if (isset($receivedProduct)) {
					echo $receivedProduct;
				}
			?>
			<table class="tblone">
				<tr>
					<th>SL</th>
					<th>Product Name</th>
					<th>Image</th>
					<th>Quantity</th>
					<th>Price</th>
					<th>Date</th>
					<th>Status</th>
					<th>Action</th>
				</tr>
				<?php
				$id = Session::get('customerId');
				$totalCost = 0;
				$orderedData = $cart->getOrderedProduct($id);
				if ($orderedData) {
					$i=0;
					$sum=0;
					$vat=10;
					while ($data = $orderedData->fetch_assoc()) {
						$i++
						?>
						<tr>
							<td><?php echo $i;?></td>
							<td><?php echo $data['product_name'];?></td>
							<td><img src="admin/<?php echo $data['image'];?>" alt=""/></td>
							<td><?php echo $data['quantity'];?></td>
							<td>$<?php $total =  $data['price']; echo $total;?></td>
							<td><?php echo $fm->formatDate($data['date'])?></td>		
							<td>
								<?php
									if ($data['status'] == 0) {
										echo "Pending";
									}elseif ($data['status'] == 1) {
										echo "Delivered";
									}else{
										echo "Received";
									}
								?>					
							</td>
							<td>
								<?php
									if ($data['status'] == 0) {
										echo "N/A";
									}elseif ($data['status'] == 1) {?>
								<a onclick="return confirm('Are you sure?')" href="?ordered_id=<?php echo $data['id'];?>">Confirm</a>
								<?php }else{?>
									<a href="?delOrderId=<?php echo $data['id'];?>">X</a>
								<?php }?>		
							</td>						
						</tr>
						<?php 
					}}else{
						?>
						<tr>
							<td colspan="8" class="error">Your Don't Order any Product.</td>
						</tr>
					<?php } ?>
				</table>
			</div>
		</div>
	</div>
</div>
<?php include 'inc/footer.php';?>