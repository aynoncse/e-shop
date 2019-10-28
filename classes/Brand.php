<?php
	$filepath = realpath(dirname(__FILE__));
	include_once $filepath.'/../lib/DB.php';
	include_once $filepath.'/../helpers/Format.php';
?>
<?php
	class Brand {
		private $db;
		private $fm;
		function __construct(){
			$this->db = new DB();
			$this->fm = new Format();
		}
		public function addBrand($name){
			$name 		= $this->fm->validate($name);
			$name 		= mysqli_real_escape_string($this->db->link, $name);

			if (empty($name)) {
				$msg = "<span class='error'>Brand Name field must not be empty!</span>";
				return $msg;
			}else {
				$query = "INSERT INTO brand(name) VALUES('$name')";
				$result = $this->db->insertData($query);
				if ($result) {
					$msg = "<span class='success'>Brand Name Inserted Successfully</span>";
					return $msg;
				}else {
					$msg = "<span class='error'>Brand Name Not Inserted!</span>";
					return $msg;
				}
			}
		}
		public function getAllBrand(){
			$query 	= "SELECT * FROM brand ORDER BY id ASC";
			$result = $this->db->selectData($query);
			return $result;
		}
		public function getBrandById($id){
			$query 	= "SELECT * FROM brand WHERE id = $id";
			$result = $this->db->selectData($query);
			return $result;
		}
		public function updateBrand($id, $name){
			$name 		= $this->fm->validate($name);
			$name 		= mysqli_real_escape_string($this->db->link, $name);
			if (empty($name)) {
				$msg = "<span class='error'>Brand Name field must not be empty!</span>";
				return $msg;
			}else {
				$query 	= "UPDATE brand
										SET name = '$name'
						 WHERE id = $id";
				$result = $this->db->updateData($query);
				if ($result) {
					$msg = "<span class='success'>Brand Name Updated Successfully</span>";
					return $msg;
				}else {
					$msg = "<span class='error'>Brand Name Not Updated!</span>";
					return $msg;
				}
			}
		}

		public function deleteBrand($id){
			$query 	= "DELETE FROM brand WHERE id = $id";
			$result = $this->db->deleteData($query);
			if ($result) {
					$msg = "<span class='success'>Brand Name Deleted Successfully</span>";
					return $msg;
				}else {
					$msg = "<span class='error'>Brand Name Not Deleted!</span>";
					return $msg;
				}
		}
	}
?>