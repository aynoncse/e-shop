<?php
	$filepath = realpath(dirname(__FILE__));
	include_once $filepath.'/../lib/DB.php';
	include_once $filepath.'/../helpers/Format.php';
?>
<?php
class Product {
	private $db;
	private $fm;
	function __construct(){
		$this->db = new DB();
		$this->fm = new Format();
	}
	public function addProduct($data, $file){
		$name 		= $this->fm->validate($data['name']);
		$cat_id 	= $this->fm->validate($data['catId']);
		$brand_id 	= $this->fm->validate($data['brandId']);
		$description= $this->fm->validate($data['description']);
		$price 		= $this->fm->validate($data['price']);
		$type 		= $this->fm->validate($data['type']);

		$name 		= mysqli_real_escape_string($this->db->link, $data['name']);
		$cat_id 	= mysqli_real_escape_string($this->db->link, $data['catId']);
		$brand_id 	= mysqli_real_escape_string($this->db->link, $data['brandId']);
		$description= mysqli_real_escape_string($this->db->link, $data['description']);
		$price 		= mysqli_real_escape_string($this->db->link, $data['price']);
		$type 		= mysqli_real_escape_string($this->db->link, $data['type']);

		$permited  		= array('jpg', 'jpeg', 'png', 'gif');
		$file_name 		= $file['image']['name'];
		$file_size 		= $file['image']['size'];
		$file_temp 		= $file['image']['tmp_name'];
		$div 			= explode('.', $file_name);
		$file_ext 		= strtolower(end($div));
		$unique_image 	= substr(md5(time()), 0, 10).'.'.$file_ext;
		$uploaded_image	= "uploads/".$unique_image;


		if ($name == "" || $cat_id == "" || $brand_id == "" || $description == "" || $price == "" || $type == "" || $uploaded_image == "") {
			$msg = "<span class='error'>Fields must not be empty!</span>";
			return $msg;
		}elseif ($file_size >1048567) {
			echo "<span class='error'>Image Size should be less then 1MB!
			</span>";
		} elseif (in_array($file_ext, $permited) === false) {
			echo "<span class='error'>You can upload only:-"
			.implode(', ', $permited)."</span>";
		} else{
			move_uploaded_file($file_temp, $uploaded_image);
			$query = "INSERT INTO product(name, brand_id, cat_id, description, price, image, type) VALUES('$name', '$brand_id', '$cat_id', '$description', '$price', '$uploaded_image', '$type')";
			$result = $this->db->insertData($query);
			if ($result) {
				$msg = "<span class='success'>New Product Added Successfully</span>";
				return $msg;
			}else {
				$msg = "<span class='error'>Product Name Not Added!</span>";
				return $msg;
			}
		}
	}
	public function getAllProduct(){
		$query		= "SELECT p.*, c.name AS catName, b.name AS brandName FROM product AS p, category AS c, brand AS b WHERE p.cat_id = c.id AND p.brand_id = b.id";
		/*$query 	= "SELECT product.*, category.name AS catName, brand.name AS brandName FROM product 
					INNER JOIN category ON product.cat_id = category.id
					INNER JOIN brand ON product.brand_id = brand.id";*/
		$result = $this->db->selectData($query);
		return $result;
	}
	public function getProductById($id){
		$query		= "SELECT p.*, c.name AS catName, b.name AS brandName FROM product AS p, category AS c, brand AS b WHERE p.cat_id = c.id AND p.brand_id = b.id AND p.id = $id";
		$result 	= $this->db->selectData($query);
		return $result;
	}
	public function updateProduct($data, $file, $id){
		$name 		= $this->fm->validate($data['name']);
		$cat_id 	= $this->fm->validate($data['catId']);
		$brand_id 	= $this->fm->validate($data['brandId']);
		$description= $this->fm->validate($data['description']);
		$price 		= $this->fm->validate($data['price']);
		$type 		= $this->fm->validate($data['type']);

		$name 		= mysqli_real_escape_string($this->db->link, $data['name']);
		$cat_id 	= mysqli_real_escape_string($this->db->link, $data['catId']);
		$brand_id 	= mysqli_real_escape_string($this->db->link, $data['brandId']);
		$description= mysqli_real_escape_string($this->db->link, $data['description']);
		$price 		= mysqli_real_escape_string($this->db->link, $data['price']);
		$type 		= mysqli_real_escape_string($this->db->link, $data['type']);
		$c_image 	= $data['c_image'];

		$permited  		= array('jpg', 'jpeg', 'png', 'gif');
		$file_name 		= $file['image']['name'];
		$file_size 		= $file['image']['size'];
		$file_temp 		= $file['image']['tmp_name'];
		$div 			= explode('.', $file_name);
		$file_ext 		= strtolower(end($div));
		$unique_image 	= substr(md5(time()), 0, 10).'.'.$file_ext;
		$uploaded_image	= "uploads/".$unique_image;


		if ($name == "" || $cat_id == "" || $brand_id == "" || $description == "" || $price == "" || $type == "") {
			$msg = "<span class='error'>Fields must not be empty!</span>";
			return $msg;
		}
		else{
			if (!empty($file_name)) {
				if ($file_size >1048567) {
				echo "<span class='error'>Image Size should be less then 1MB!
				</span>";
				} elseif (in_array($file_ext, $permited) === false) {
					echo "<span class='error'>You can upload only:-"
					.implode(', ', $permited)."</span>";
				} else{
					move_uploaded_file($file_temp, $uploaded_image);
					unlink($c_image);
					$query = "UPDATE product SET
								name 		= '$name', 
								brand_id	= '$brand_id',
								cat_id		= '$cat_id',
								description = '$description',
								price 		= '$price',
								image 		= '$uploaded_image',
								type 		= '$type'
							WHERE id = $id";
					$result = $this->db->updateData($query);
					if ($result) {
						$msg = "<span class='success'>Product Updated Successfully</span>";
						return $msg;
					}else {
						$msg = "<span class='error'>Product Not Updated!</span>";
						return $msg;
					}
				}
			}else{
				$query = "UPDATE product SET
								name 		= '$name', 
								brand_id	= '$brand_id',
								cat_id		= '$cat_id',
								description = '$description',
								price 		= '$price',
								type 		= '$type'
							WHERE
								id 			= $id";
				$result = $this->db->updateData($query);
				if ($result) {
					$msg = "<span class='success'>Product Updated Successfully</span>";
					return $msg;
				}else {
					$msg = "<span class='error'>Product Not Updated!</span>";
					return $msg;
				}
			}
		}
	}

	public function deleteProduct($id){
		$query 	= "DELETE FROM Product WHERE id = $id";
		$result = $this->db->deleteData($query);
		if ($result) {
			$msg = "<span class='success'>Product Name Deleted Successfully</span>";
			return $msg;
		}else {
			$msg = "<span class='error'>Product Name Not Deleted!</span>";
			return $msg;
		}
	}
	public function getFeaturedProduct(){
		$query		= "SELECT * FROM product WHERE type=0 ORDER BY id ASC LIMIT 4";
		$result = $this->db->selectData($query);
		return $result;
	}
	public function getNewProduct(){
		$query		= "SELECT * FROM product ORDER BY id DESC LIMIT 4";
		$result = $this->db->selectData($query);
		return $result;
	}
	public function latestFromIphone(){
		$query		= "SELECT * FROM product WHERE brand_id = 1 ORDER BY id DESC LIMIT 1";
		$result = $this->db->selectData($query);
		return $result;
	}
	public function latestFromSamsung(){
		$query		= "SELECT * FROM product WHERE brand_id = 2 ORDER BY id DESC LIMIT 1";
		$result = $this->db->selectData($query);
		return $result;
	}
	public function latestFromAcer(){
		$query		= "SELECT * FROM product WHERE brand_id = 3 ORDER BY id DESC LIMIT 1";
		$result = $this->db->selectData($query);
		return $result;
	}
	public function latestFromCanon(){
		$query		= "SELECT * FROM product WHERE brand_id = 4 ORDER BY id DESC LIMIT 1";
		$result = $this->db->selectData($query);
		return $result;
	}
	public function getProductByCat($id){
		$query = "SELECT * FROM product WHERE cat_id = '$id' ORDER BY id DESC LIMIT 8";
		$result = $this->db->selectData($query);
		return $result;
	}
	public function insertToCompare($customerId, $compareId){
		$customer_id 	= mysqli_real_escape_string($this->db->link, $customerId);
		$compareId 		= mysqli_real_escape_string($this->db->link, $compareId);

		$query 			= "SELECT * FROM product WHERE id = $compareId";
		$result 		= $this->db->selectData($query)->fetch_assoc();


		if ($result) {
			$product_id 	= $result['id'];
			$product_name 	= $result['name'];
			$price 			= $result['price'];
			$image 			= $result['image'];
		}

		$productquery 	= "SELECT * FROM compare WHERE product_id = '$product_id' AND customer_id = $customer_id LIMIT 1";
			$productchk 	= $this->db->selectData($productquery);
			if ($productchk != false) {
				$msg = "<span class='error'>Added Already!</span>";
				return $msg;
			}else {

			$query 		= "INSERT INTO compare (customer_id, product_id, product_name, price, image) VALUES ('$customer_id', '$product_id', '$product_name', '$price', '$image')";

			$inserted_row = $this->db->insertData($query);
				if ($inserted_row) {
					$msg = "<span class='success'>Added to Compare</span>";
					return $msg;
				}else {
					$msg = "<span class='error'>Not Added!</span>";
					return $msg;
				}
			}
	}
	public function getCompareData($id) {
		$productquery 	= "SELECT * FROM compare WHERE customer_id = '$id' ORDER BY id DESC";
			$productchk 	= $this->db->selectData($productquery);
			if ($productchk != false) {
				return $productchk;
			}
	}
	public function deleteCompare($id) {
		$query 	= "DELETE FROM compare WHERE customer_id = $id";
		$result = $this->db->deleteData($query);
	}
}
?>