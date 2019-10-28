<?php
	$filepath = realpath(dirname(__FILE__));
	include_once $filepath.'/../lib/DB.php';
	include_once $filepath.'/../helpers/Format.php';
?>
<?php
	class Customer {
		private $db;
		private $fm;
		function __construct(){
			$this->db = new DB();
			$this->fm = new Format();
		}
		public function customerRegistration($data){
			$name 		= $this->fm->validate($data['name']);
			$city 		= $this->fm->validate($data['city']);
			$zip 		= $this->fm->validate($data['zip']);
			$email 		= $this->fm->validate($data['email']);
			$address	= $this->fm->validate($data['address']);
			$country 	= $this->fm->validate($data['country']);
			$phone 		= $this->fm->validate($data['phone']);
			$password 	= $this->fm->validate($data['password']);
			$name 		= mysqli_real_escape_string($this->db->link, $name);
			$city 		= mysqli_real_escape_string($this->db->link, $city);
			$zip 		= mysqli_real_escape_string($this->db->link, $zip);
			$email 		= mysqli_real_escape_string($this->db->link, $email);
			$address	= mysqli_real_escape_string($this->db->link, $address);
			$country 	= mysqli_real_escape_string($this->db->link, $country);
			$phone 		= mysqli_real_escape_string($this->db->link, $phone);
			$password 	= mysqli_real_escape_string($this->db->link, $password);
			$password 	= md5($password);

			if ($name == "" || $city == "" || $zip == "" || $email == "" || $address == "" || $country == "" || $phone == "" || $password == "") {
				$msg = "<span class='error'>Fields must not be empty!</span>";
				return $msg;
			}
			$mailquery 	= "SELECT * FROM customer WHERE email = '$email' LIMIT 1";
			$mailchk 	= $this->db->selectData($mailquery);
			if ($mailchk != false) {
				$msg = "<span class='error'>Email already exists!</span>";
				return $msg;
			}else {
				$query = "INSERT INTO `customer`(`name`, `city`, `zip`, `email`, `address`, `country`, `phone`, `password`) VALUES ('$name', '$city', '$zip', '$email', '$address', '$country', '$phone', '$password')";
				$result = $this->db->insertData($query);
				if ($result) {
					$msg = "<span class='success'>Customer Data Inserted Successfully</span>";
					return $msg;
				}else {
					$msg = "<span class='error'>Customer Data Not Inserted!</span>";
					return $msg;
				}
			}
		}

		public function customerLogin($data){
			$email 		= $this->fm->validate($data['email']);
			$password 	= $this->fm->validate($data['password']);
			$email 		= mysqli_real_escape_string($this->db->link, $email);
			$password 	= mysqli_real_escape_string($this->db->link, $password);
			$password 	= md5($password);

			if ($email == "" || $password == "") {
				$msg = "<span class='error'>Fields must not be empty!</span>";
				return $msg;
			}else{
				$query 	= "SELECT * FROM customer WHERE email = '$email' AND password = '$password'";
				$result = $this->db->selectData($query);
				if ($result != false) {
					$customer = $result->fetch_assoc();
					Session::set("customerLogin", true);
					Session::set("customerId", $customer['id']);
					Session::set("customerName", $customer['name']);
					Session::set("customerEmail",$customer['email'] );
					header("Location: index.php");
				}else{
					$msg = "<span class='error'>Email or password not matched!</span>";
					return $msg;
				}
			}

		}
		public function getAllCustomer(){
			$query 	= "SELECT * FROM customer ORDER BY id ASC";
			$result = $this->db->selectData($query);
			return $result;
		}
		public function getCustomerById($id){
			$query 	= "SELECT * FROM customer WHERE id = $id";
			$result = $this->db->selectData($query);
			return $result;
		}
		public function updateCustomer($id, $data){
			$name 		= $this->fm->validate($data['name']);
			$city 		= $this->fm->validate($data['city']);
			$zip 		= $this->fm->validate($data['zip']);
			$email 		= $this->fm->validate($data['email']);
			$address	= $this->fm->validate($data['address']);
			$country 	= $this->fm->validate($data['country']);
			$phone 		= $this->fm->validate($data['phone']);

			$name 		= mysqli_real_escape_string($this->db->link, $name);
			$city 		= mysqli_real_escape_string($this->db->link, $city);
			$zip 		= mysqli_real_escape_string($this->db->link, $zip);
			$email 		= mysqli_real_escape_string($this->db->link, $email);
			$address	= mysqli_real_escape_string($this->db->link, $address);
			$country 	= mysqli_real_escape_string($this->db->link, $country);
			$phone 		= mysqli_real_escape_string($this->db->link, $phone);
			if ($name == "" || $city == "" || $zip == "" || $email == "" || $address == "" || $country == "" || $phone == "") {
				$msg = "<span class='error'>Fields must not be empty!</span>";
				return $msg;
			}
			$mailquery 	= "SELECT * FROM customer WHERE email = '$email' AND id !='$id' LIMIT 1";
			$mailchk 	= $this->db->selectData($mailquery);
			if ($mailchk != false) {
				$msg = "<span class='error'>Email already exists!</span>";
				return $msg;
			}else {
				$query 	= "UPDATE customer SET 
										name 	= '$name', 
										city 	= '$city', 
										zip	 	= '$zip', 
										email 	= '$email', 
										address = '$address', 
										country = '$country', 
										phone 	= '$phone'
						 WHERE id = $id";
				$result = $this->db->updateData($query);
				if ($result) {
					$msg = "<span class='success'>Updated Successfully</span>";
					return $msg;
				}else {
					$msg = "<span class='error'>Not Updated!</span>";
					return $msg;
				}
			}
		}

		public function deleteCustomer($id){
			$query 	= "DELETE FROM customer WHERE id = $id";
			$result = $this->db->deleteData($query);
			if ($result) {
					$msg = "<span class='success'>Customer Data Deleted Successfully</span>";
					return $msg;
				}else {
					$msg = "<span class='error'>Customer Data Not Deleted!</span>";
					return $msg;
				}
		}
	}
?>