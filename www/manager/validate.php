<?php
if(!isset($_COOKIE["manager"])){
	header("Location: login-form.php");
	exit;
}
?>

<!DOCTYPE HTML>
<html>
<head>
<title>Manager portal</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>

<body> 
<h1 style="text-align:center;">Hi manager! please check and validate customer orders </h1>

<br><hr>

<form name="form1" action="" method="post">
<?php
require "../connManager.php";
/*Manager will access the customer orders to delete orders */
mysqli_select_db($link,"checkbox");
$res=mysqli_query($link,"select * from orders");
echo "<table>";
while($row=mysqli_fetch_array($res))
{
echo "<tr>";
echo "<td>"; ?> <input type="checkbox" name="num[]" class="other" value="<?php echo $row["id"]; ?>" /> <?php echo "</td>";
echo "<th>"; echo 'ID';
echo "<td>"; echo $row["id"]; echo "</td>";
echo "<th>"; echo 'CATEGORY';
echo "<td>"; echo $row["category"]; echo "</td>";
echo "<th>"; echo 'PRODUCT';
echo "<td>"; echo $row["product"]; echo "</td>";
echo "<th>"; echo 'QUANTITY';
echo "<td>"; echo $row["quantity"]; echo "</td>";
echo "<th>"; echo 'PRICE';
echo "<td>"; echo $row["price"]; echo "</td>";
/*echo "<td>"; ?> <input type="text" name="newName" class="other" value="<?php echo $row["status"]; ?>" /> <?php echo "</td>"; */
echo "</tr>";
}
echo "</table>";
?>
<input type="submit" name="submit1" value="Delete">
<input type="submit" name="edit" value=" Update "/>
<button type="button" onclick="location.href='logout.php'" >Log out </button>
</form>


<?php
if(isset($_POST["submit1"]))
{
	$box=$_POST['num'];
	while (list ($key,$val) = @each ($box)) 
	{	
	   mysqli_query($link,"delete from orders where id=$val"); 
	}
	
?>
	<script type="text/javascript">
	window.location.href=window.location.href;
	</script>
<?php
}
if( isset($_GET['edit']) )
{
		$item_id = $_GET['edit'];
		$link= mysql_query("SELECT * FROM orders WHERE id='$id'");
		$row= mysql_fetch_array($link);
}
?>

</body>
</html>
