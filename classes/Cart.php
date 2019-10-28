<?php
$filepath = realpath(dirname(__FILE__));
include_once $filepath.'/../lib/DB.php';
include_once $filepath.'/../helpers/Format.php';
?>
<?php
class Cart {
	private $db;
	private $fm;
	function __construct(){
		$this->db = new DB();
		$this->fm = new Format();
	}
	public function addToCart($id, $quantity){
		$id			= $this->fm->validate($id);
		$quantity	= $this->fm->validate($quantity);
		$id 		= mysqli_real_escape_string($this->db->link, $id);
		$quantity 	= mysqli_real_escape_string($this->db->link, $quantity);

		$query 		="SELECT * FROM product WHERE id = $id";
		$product	= $this->db->selectData($query)->fetch_assoc();
		$pName 		= $product['name'];
		$pPrice		= $product['price'];
		$pImage		= $product['image'];
		$s_id 		= session_id();

		if (empty($quantity)||$quantity<1) {
			$msg = "<span class='error'>Plase insert the number of quantity</span>";
			return $msg;
		}else {
			$pQuery		= "SELECT * FROM cart WHERE product_id = $id AND s_id='$s_id'";
			$ckProduct 	= $this->db->selectData($pQuery);
			if ($ckProduct) {
				$msg = "<span class='error'>This product already added</span>";
				return $msg;
			}else{
				$query = "INSERT INTO cart(s_id, product_id, product_name, price, quantity, image) VALUES('$s_id', $id, '$pName', $pPrice, $quantity, '$pImage')";
				$result = $this->db->insertData($query);
				if ($result) {
					echo "<script> window.location.replace('cart.php') </script>";
				}else {
					echo "<script> window.location.replace('404.php') </script>";
				}
			}
		}
	}
	public function getAllCart(){
		$query 	= "SELECT * FROM cart ORDER BY id ASC";
		$result = $this->db->selectData($query);
		return $result;
	}
	public function getCartById($id){
		$query 	= "SELECT * FROM cart WHERE s_id = '$id'";
		$result = $this->db->selectData($query);
		return $result;
	}
	public function getCartByCustomer($id){
		$s_id 		= session_id();
		$query 		= "SELECT * FROM cart WHERE s_id = '$s_id'";
		$getProduct = $this->db->selectData($query);
		if ($getProduct) {
			while ($product = $getProduct->fetch_assoc()) {
				$product_id 	= $product['product_id'];
				$product_name 	= $product['product_name'];
				$quantity 		= $product['quantity'];
				$price 			= $product['price'] * $quantity;
				$image 			= $product['image'];

				$query = "INSERT INTO orderedproduct(customer_id, product_id, product_name, quantity, price, image) VALUES('$id', '$product_id', '$product_name', '$quantity', '$price', '$image')";
				$insertedRow = $this->db->insertData($query);
			}
		}
	}
	public function updateQuantity($id, $quantity){
		$id 			= mysqli_real_escape_string($this->db->link, $id);
		$quantity 		= mysqli_real_escape_string($this->db->link, $quantity);
		$sId 			= session_id();
		if (empty($quantity)||$quantity<1) {
			$msg = '<script>alert("Quantity value can\'t be less then 1")</script>';
			echo $msg;
		}else {
			$query 	= "UPDATE cart
			SET quantity = '$quantity'
			WHERE id = $id AND s_id='$sId'";
			$result = $this->db->updateData($query);
			if (!$result) {
				$msg = "<span class='error'>Can't update quantity!</span>";
				return $msg;
			}
		}
	}

	public function deleteCart($id){
		$query 	= "DELETE FROM cart WHERE s_id = '$id'";
		$result = $this->db->deleteData($query);
		if ($result) {
			$msg = "<span class='success'>Cart Data Deleted Successfully</span>";
			return $msg;
		}else {
			$msg = "<span class='error'>Cart Data Not Deleted!</span>";
			return $msg;
		}
	}

	public function deleteCartItem($id){
		$query 	= "DELETE FROM cart WHERE id = '$id'";
		$result = $this->db->deleteData($query);
		if ($result) {
			$msg = "<span class='success'>Cart Data Deleted Successfully</span>";
			return $msg;
		}else {
			$msg = "<span class='error'>Cart Data Not Deleted!</span>";
			return $msg;
		}
	}

	public function getOrderedPrice($id){
		$query 	= "SELECT SUM(price) AS totalPrice FROM orderedproduct WHERE customer_id = $id AND `date` = NOW()";
		$result = $this->db->selectData($query);
		return $result;
	}
	public function getOrderedProduct($id){
		$query 	= "SELECT * FROM orderedproduct WHERE customer_id = $id ORDER BY `date` DESC";
		$result = $this->db->selectData($query);
		return $result;
	}
	public function deleteOrderedItem($id){
		$query 	= "DELETE FROM orderedproduct WHERE id = '$id'";
		$result = $this->db->deleteData($query);
		if ($result) {
			$msg = "<script>alert('Deleted Successfully')</script>";
			return $msg;
		}else {
			$msg = "<script class='error'>Can't Delete!!</script>";
			return $msg;
		}
	}
	public function getAllOrderedProduct(){
		$query 	= "SELECT * FROM orderedproduct ORDER BY `date` DESC";
		$result = $this->db->selectData($query);
		return $result;
	}
	public function receivedProduct($orderId){
		$query 	= "UPDATE orderedproduct SET status = 2 WHERE id = $orderId";
		$result = $this->db->updateData($query);
		if ($result) {
			$msg = "<script>alert('Thank You for Purchasing Our Product')</script>";
			return $msg;
		}else {
			$msg = "<script>alert('Product Not Shifted!')</script>";
			$msg = "<span class='error'></span>";
			return $msg;
		}
	}
	public function shiftProduct($orderId, $productId, $customerId, $time){
		$orderId 		= mysqli_real_escape_string($this->db->link, $orderId);
		$productId 		= mysqli_real_escape_string($this->db->link, $productId);
		$customerId 	= mysqli_real_escape_string($this->db->link, $customerId);
		$time 			= mysqli_real_escape_string($this->db->link, $time);
		$query 	= "UPDATE orderedproduct
		SET status = 1
		WHERE id = $orderId AND customer_id = $customerId AND product_id = $productId AND `date` = '$time' ";
		$result = $this->db->updateData($query);
		if ($result) {
			$msg = "<span class='success'>Product Shifted Successfully</span>";
			return $msg;
		}else {
			$msg = "<span class='error'>Product Not Shifted!</span>";
			return $msg;
		}
	}
}
?>