<?php 
session_start();
require_once('server_admin.php');
/* This is homepage,  Admin will add categorys, products and price which will available to users to buy/add into basket */
?>
<!DOCTYPE HTML>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>ADMIN portal</title>
	
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.9/css/all.css">
<style>
body {font-family:"Helvetica Neue", Helvetica, Arial;margin:0;padding:0;background:#FFF;padding-top:60px; padding-bottom:0px;}
body,html{height:100%;width:100%}
 </style>
 <link rel="stylesheet" type="text/css" href="/user/style.css">
</head>


<body>

<nav class="navbar navbar-default navbar-fixed-top">
  <div class="container">
  <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#">Sales Platform Admin Portal</a>
    </div>

  <ul class="nav navbar-nav">
        <li><a href="viewanddelete.php">Product Management</span></a></li>
        <li><a href="product.php">Add Products</a></li>
        <li><a href="deleteusers.php">Delete users</a></li>
        
        
      </ul>
      <ul class="nav navbar-nav navbar-right">
      <li><a href="logout.php">Logout</a></li>
</ul>
</div>
</nav>
<div class="container">
	

	<div class="header"style="text-align:center;">
	<h1> ESIGELEC admin portal site </h1>

		<h2>Add the products into user database</h2>
	</div>

	<form method="post" action="product.php/" style="text-align:center;">



		<?php // include('errors.php'); ?>


<div class="input-group">
			

<div class="option-group"><label>Add image</label>
<div class="input-group">
		<input type="checkbox" name="image"  value="<?php echo $image ="mobile.jpg";?>">mobile</option>
		<input type="checkbox" name="image"  value="<?php echo $image ="laptop.jpg";?>">laptop-</option>
	
	</div>
		
		<div class="input-group">
			<label>Add category</label>
			<input type="text" name="category" value="<?php echo $category; ?>">
		</div>
		<div class="input-group">
			<label>Add product</label>
			<input type="text" name="product" value="<?php echo $product; ?>">
		</div>
  
		<div class="input-group">
			<label>Add price</label>
			<input type="text" name="price" value="<?php echo $price; ?>">
		</div>
  
		<div class="input-group">
			<button type="submit" class="btn" name="add_product"> Add product</button>
		</div>
<br>
<hr><br>
</h4> Delete customer accounts </h4>
<a href ="deleteusers.php">click here</a><br><hr>
</h4> Delete products from the list already added in the customer database</h4>
<a href ="viewanddelete.php">click here</a>
</form>


</body>
</html>
