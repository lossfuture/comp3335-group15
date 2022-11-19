<?php 
require("../pdoAdmin.php");
$pdoAdmin = new pdoadmin();
$pdo = $pdoAdmin-> pdoConnection();
	

	// variable declaration
	$image = "";
	$category = "";
	$product = "";
	$price = "";
	//$messae= "";
	$errors = array(); 
	$_SESSION['success'] = "";

	

/*  Admin manager server page to insert the 
*values into database @products in @basket */

	// REGISTER USER
if (isset($_POST['add_product'] )) {


		// receive all input values from the form
		/*
		$image = mysqli_real_escape_string($connect, $_POST['image']);
		$category = mysqli_real_escape_string($connect, $_POST['category']);	
		$product = mysqli_real_escape_string($connect, $_POST['product']);
		$price = mysqli_real_escape_string($connect, $_POST['price']);
*/
			//$query = "INSERT INTO products (image,category,product, price) 
			//VALUES('$image','$category', '$product','$price')";	 
			//mysqli_query($connect, $query);
	
			$image = $_POST['image'];
			$category =  $_POST['category'];	
			$product = $_POST['product'];
			$price =  $_POST['price'];

			$stmt = $pdo->prepare('INSERT INTO products (image,category,product, price)  VALUES (:image1, :category, :product, :price)') ;
				$stmt->execute(array(
					':image1' => $image,
					':category' => $category,
					':product' => $product,
					':price' => $price
				));

				$_SESSION['category'] = $category;
				$_SESSION['success'] = "added";

				//redirect to index page
			header('location: ./product.php');
			exit();


	

}	
	
?>
