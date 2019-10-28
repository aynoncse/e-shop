<?php 
	$filepath = realpath(dirname(__FILE__));
	include_once $filepath.'/../lib/Session.php';
	Session::checkLogin();
	include_once $filepath.'/../lib/DB.php';
	include_once $filepath.'/../helpers/Format.php';

?>
<?php
	class Adminlogin {
		private $db;
		private $fm;
		function __construct(){
			$this->db = new DB();
			$this->fm = new Format();
		}
		public function adminLogin($admin_username, $admin_pass){
			$admin_username = $this->fm->validate($admin_username);
			$admin_pass 	= $this->fm->validate($admin_pass);
			$admin_username = mysqli_real_escape_string($this->db->link, $admin_username);
			$admin_pass 	= mysqli_real_escape_string($this->db->link, $admin_pass);

			if (empty($admin_username) || empty($admin_pass)) {
				$loginmsg = "Username or Password must not be empty!";
				return $loginmsg;
			}else {
				$query = "SELECT * FROM admin WHERE admin_username = '$admin_username' AND admin_pass = '$admin_pass'";
				$result = $this->db->selectData($query);
				if ($result) {
					$value = $result->fetch_assoc();
					Session::set("login", true);
					Session::set("adminId", $value['admin_id']);
					Session::set("adminName", $value['admin_name']);
					Session::set("adminUsername", $value['admin_username']);
					Session::set("adminEmail", $value['admin_email']);
					Session::set("adminLevel", $value['level']);
					header("Location: dashboard.php");
				}else {
					$loginmsg = "Username or Password not matched!";
					return $loginmsg;
				}
			}
		}
	}
?>