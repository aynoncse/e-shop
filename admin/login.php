<?php include '../classes/Adminlogin.php'; ?>
<?php
	$al = new Adminlogin();
	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		$admin_username = $_POST['admin_username'];
		$admin_pass 	= md5($_POST['admin_pass']);

		$loginChk = $al->adminLogin($admin_username, $admin_pass);
	}
?>
<!DOCTYPE html>
<head>
<meta charset="utf-8">
<title>Admin Login</title>
    <link rel="stylesheet" type="text/css" href="css/stylelogin.css" media="screen" />
</head>
<body>
<div class="container">
	<section id="content">
		<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
			<h1>Admin Login</h1>
			<?php if (isset($loginChk)) {
				
			?>
			<div class="error">
				<?php echo $loginChk; ?>
			</div>
		<?php } ?>
			<div>
				<input type="text" placeholder="Username" name="admin_username"/>
			</div>
			<div>
				<input type="password" placeholder="Password" name="admin_pass"/>
			</div>
			<div>
				<input type="submit" value="Log in" />
			</div>
		</form><!-- form -->
		<div class="button">
			<a href="#">Training with Aynonbiz</a>
		</div><!-- button -->
	</section><!-- content -->
</div><!-- container -->
</body>
</html>