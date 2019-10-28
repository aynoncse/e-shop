<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/Brand.php'; ?>
<?php
$brand = new Brand();
?>
<?php
if (isset($_GET['delid'])) {
	$id = preg_replace('/[^-a-zA-Z0-9_]/', '', $_GET['delid']);
	$delBrand = $brand->deleteBrand($id);
}
?>
<div class="grid_10">
	<div class="box round first grid">
		<h2>Brand List</h2>
		<?php
		if (isset($delBrand)) {
			echo $delBrand;
		}
		?> 
		<div class="block"> 

			<table class="data display datatable" id="example">
				<thead>
					<tr>
						<th>Serial No.</th>
						<th>Brand Name</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					<tr class="odd gradeX">
						<?php 
						$getBrand = $brand->getAllBrand();
						$i = 0;
						if ($getBrand) {
							while ($brandVal = $getBrand->fetch_assoc()) {
								$i++;
								?>
								<td><?php echo $i; ?></td>
								<td><?php echo $brandVal['name']; ?></td>
								<td><a href="brandedit.php?brandid=<?php echo $brandVal['id'];?>">Edit</a> || <a onclick="return confirm('Are you sure to delete this brand?')" href="?delid=<?php echo $brandVal['id'];?>">Delete</a></td>
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

