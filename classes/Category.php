<?php
	$filepath = realpath(dirname(__FILE__));
	include_once $filepath.'/../lib/DB.php';
	include_once $filepath.'/../helpers/Format.php';
?>
<?php
	class Category {
		private $db;
		private $fm;
		function __construct(){
			$this->db = new DB();
			$this->fm = new Format();
		}
		public function addCategory($name){
			$name 		= $this->fm->validate($name);
			$name 		= mysqli_real_escape_string($this->db->link, $name);

			if (empty($name)) {
				$msg = "<span class='error'>Category field must not be empty!</span>";
				return $msg;
			}else {
				$query = "INSERT INTO category(name) VALUES('$name')";
				$result = $this->db->insertData($query);
				if ($result) {
					$msg = "<span class='success'>Category Inserted Successfully</span>";
					return $msg;
				}else {
					$msg = "<span class='error'>Category Not Inserted!</span>";
					return $msg;
				}
			}
		}
		public function getAllCategory(){
			$query 	= "SELECT * FROM category ORDER BY id ASC";
			$result = $this->db->selectData($query);
			return $result;
		}
		public function getCategoryById($id){
			$query 	= "SELECT * FROM category WHERE id = $id";
			$result = $this->db->selectData($query);
			return $result;
		}
		public function updateCategory($id, $name){
			$name 		= $this->fm->validate($name);
			$name 		= mysqli_real_escape_string($this->db->link, $name);
			if (empty($name)) {
				$msg = "<span class='error'>Category field must not be empty!</span>";
				return $msg;
			}else {
				$query 	= "UPDATE category
										SET name = '$name'
						 WHERE id = $id";
				$result = $this->db->updateData($query);
				if ($result) {
					$msg = "<span class='success'>Category Updated Successfully</span>";
					return $msg;
				}else {
					$msg = "<span class='error'>Category Not Updated!</span>";
					return $msg;
				}
			}
		}

		public function deleteCategory($id){
			$query 	= "DELETE FROM category WHERE id = $id";
			$result = $this->db->deleteData($query);
			if ($result) {
					$msg = "<span class='success'>Category Deleted Successfully</span>";
					return $msg;
				}else {
					$msg = "<span class='error'>Category Not Deleted!</span>";
					return $msg;
				}
		}
	}
?>