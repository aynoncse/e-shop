<?php include '../classes/Cart.php'; ?>
<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>

<?php 
	$cart 		= new Cart();
	$fm 		= new Format(); 
?>

<?php
if (isset($_GET['orderId'])) {
	 $orderId 		= $_GET['orderId'];
	 $productId 	= $_GET['productId'];
	 $customerId 	= $_GET['customerId'];
	 $time 			= $_GET['time'];
	 $shift 		= $cart->shiftProduct($orderId, $productId, $customerId, $time);
}
?>

<?php
if (isset($_GET['removeOrderId'])) {
	$del_id 	= preg_replace('/[^-a-zA-Z0-9_]/', '', $_GET['removeOrderId']);
	$delProduct = $cart->deleteOrderedItem($del_id);
}
?>

<div class="grid_10">
	<div class="box round first grid">
		<h2>Inbox</h2>
		<div class="block">        
			<table class="data display datatable" id="example">
				<thead>
					<tr>
						<th>Order ID</th>
						<th>Date & Time</th>
						<th>Product</th>
						<th>Quantity</th>
						<th>Price</th>
						<th>Customer ID</th>
						<th>Address</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
			<?php				
				$getOrdered = $cart->getAllOrderedProduct();
				if ($getOrdered) {
					while ($ordered = $getOrdered->fetch_assoc()) {
			?>
					<tr class="odd gradeX">
						<td><?php echo $ordered['id'];?></td>
						<td><?php echo $fm->formatDate($ordered['date']);?></td>
						<td><?php echo $ordered['product_name'];?></td>
						<td><?php echo $ordered['quantity'];?></td>
						<td>$<?php echo $ordered['price'];?></td>	
						<td><?php echo $ordered['customer_id'];?></td>	
						<td><a href="customerdetails.php?cid=<?php echo $ordered['customer_id'];?>">View Details</a></td>
						<?php if ($ordered['status'] == 0) {?>
						<td><a href="?orderId=<?php echo $ordered['id'];?>&productId=<?php echo $ordered['product_id'];?>&customerId=<?php echo $ordered['customer_id'];?>&time=<?php echo $ordered['date'];?>">Shift</a>
						</td>
					<?php }elseif ($ordered['status'] == 2) {?>
						<td><a href="?removeOrderId=<?php echo $ordered['id'];?>">Remove</a></td>
					<?php }else {
							echo "<td>Not Receved</td>";
						}
					?>

					</tr>

						<?php }} ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
		<script type="text/javascript">
			$(document).ready(function () {
				setupLeftMenu();

				$('.datatable').dataTable();
				setSidebarHeight();
			});
		</script>
		<?php include 'inc/footer.php';?>
