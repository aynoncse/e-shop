<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/Category.php'; ?>
<?php
$cat = new Category();
?>
<?php
if (isset($_GET['delid'])) {
	$id = preg_replace('/[^-a-zA-Z0-9_]/', '', $_GET['delid']);
	$delCat = $cat->deleteCategory($id);
}
?>
<div class="grid_10">
	<div class="box round first grid">
		<h2>Category List</h2>
		<?php
		if (isset($delCat)) {
			echo $delCat;
		}
		?> 
		<div class="block"> 

			<table class="data display datatable" id="example">
				<thead>
					<tr>
						<th>Serial No.</th>
						<th>Category Name</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					<tr class="odd gradeX">
						<?php 
						$getCat = $cat->getAllCategory();
						$i = 0;
						if ($getCat) {
							while ($catVal = $getCat->fetch_assoc()) {
								$i++;
								?>
								<td><?php echo $i; ?></td>
								<td><?php echo $catVal['name']; ?></td>
								<td><a href="catedit.php?catid=<?php echo $catVal['id'];?>">Edit</a> || <a onclick="return confirm('Are you sure to delete this category?')" href="?delid=<?php echo $catVal['id'];?>">Delete</a></td>
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

