<?php 
if (!isset($_COOKIE["admin"])){
	header("Location:login-form.php");
  exit;
}
session_start();
require_once('server_admin.php');

/* Admin manager will view and delete the products from the database @basket and table products */

/* Admin will delete the users, will access 
@registration database of users and delete */
if(isset($_POST["submit1"]))
{
	$box=$_POST['num'];
	$stmt = $pdo->prepare('DELETE FROM users where id = :val') ;

	while (list ($key,$val) = @each ($box)) 
	{	
	   //mysqli_query($link,"delete from users where id=$val"); 

	   				$stmt->execute(array(
					':val' => $val,

				));

	}
	
	header('Location: deleteusers.php');
	exit();
}

$stmt = $pdo->prepare("SELECT id,username,email  FROM users");
$stmt->execute();

?>


<!DOCTYPE HTML>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Admin portal delete users</title>
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.9/css/all.css">
<style>
body {font-family:"Helvetica Neue", Helvetica, Arial;margin:0;padding:0;background:#FFF;padding-top:60px; padding-bottom:0px;}
body,html{height:100%;width:100%}
 </style>
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

<h3 style="text-align:center;">Delete registered users</h3>
<form name="form1" action="" method="post">
<?php


echo "<table>";

while($row = $stmt->fetch())
{

echo "<tr>";
echo "<td>"; ?> <input type="checkbox" name="num[]" class="other" value="<?php echo $row["id"]; ?>" /> <?php echo "</td>";
echo "<th>"; echo 'ID';
echo "<td>"; echo $row["id"]; echo "</td>";
echo "<th>"; echo 'USER';
echo "<td>"; echo $row["username"]; echo "</td>";
echo "<th>"; echo 'EMAIL';
echo "<td>"; echo $row["email"]; echo "</td>";
//echo "<th>"; echo 'PASSWORD[MP5]';
//echo "<td>"; echo $row["password"]; echo "</td>";
echo "</tr>"; echo "</th>";
}
echo "</table>";
?>
<input type="submit" name="submit1" value="delete selected">
<a href ="product.php">go back admin page</a>
</form>





</body>
</html>
