<?php 
session_start();
include('connect.php');
include('Shopping_Cart_Functions.php');
include('header.php');

$con=mysqli_connect($host,$user,$pass,$database);
if(isset($_GET['action'])) 
{
	$action=$_GET['action'];

	if($action==="Add") 
	{
		$ProductID=$_GET['ProductID'];
		$BuyQuantity=$_GET['txtBuyQty'];
		AddShoppingCart($ProductID,$BuyQuantity);
	}
	elseif($action==="Remove") 
	{
		$ProductID=$_GET['ProductID'];
		Remove($ProductID);
	}
	elseif($action==="Clear") 
	{
		ClearAll();
	}
}
else
{
	$action="";
}

?>
<html>
<head>
	<title>Shopping Cart</title>
	<script type="text/javascript" src="js/jquery-3.1.1.slim.min.js"></script>
<link rel="stylesheet" type="text/css" href="DataTables/datatables.min.css"/>
<script type="text/javascript" src="DataTables/datatables.min.js"></script>
</head>
<body>
<script>
$(document).ready( function () 
{
	$('#datatableid').DataTable();
} );
</script>

<form>
<?php  
if(!isset($_SESSION['ShoppingCart_Function'])) 
{
	echo"<div class='text-center'>";
	echo "<img src='images/Shoppingcart_empty.png' width='100px' height='100px'/>";
	echo "<p>Shopping Cart is Empty!</p><br/>";
	echo"<a href='Customer_Home.php'>Return to Product Display</a>";	
	echo"</div>";
	exit();
}
?>



<table id="datatableid"  class="display">

<tr align="center">
	<th>Image</th>
	<th>ModelName</th>
	<th>Color</th>
	<th>Storage</th>
	<th>Price</th>
	<th>Quantity</th>
	<th>Sub Total</th>
	<th>Action</th>
</tr>

<?php 
 $count=count($_SESSION['ShoppingCart_Function']);

for($i=0;$i<$count;$i++) 
{ 
	$ProductID=$_SESSION['ShoppingCart_Function'][$i]['ProductID'];
	$FrontImage=$_SESSION['ShoppingCart_Function'][$i]['FrontImage'];

	echo "<tr align='center'>";
	echo "<td><img src='$FrontImage' width='100' height='100'/></td>";
	echo "<td>" . $_SESSION['ShoppingCart_Function'][$i]['ModelName'] ."</td>";
	echo "<td>" . $_SESSION['ShoppingCart_Function'][$i]['ColorName'] ."</td>";
	echo "<td>" . $_SESSION['ShoppingCart_Function'][$i]['Rom'] ."</td>";

	echo "<td>" . $_SESSION['ShoppingCart_Function'][$i]['Price'] ." MMK</td>";
	echo "<td>" . $_SESSION['ShoppingCart_Function'][$i]['BuyQuantity'] ." pcs</td>";

	echo "<td>" . $_SESSION['ShoppingCart_Function'][$i]['BuyQuantity'] * $_SESSION['ShoppingCart_Function'][$i]['Price'] ." MMK</td>";
	
	echo "<td><a href='Shopping_Cart.php?action=Remove&ProductID=$ProductID' class='btn_3'>Remove</a></td>";
	echo "</tr>";
}

?>


<tr>
	<td>Total Amount</td>
	<td>: <b><?php echo CalculateTotalAmount() ?></b> MMK</td>
</tr>
<tr>
	<td>Total Quantity</td>
	<td>: <b><?php echo CalculateTotalQuantity() ?></b> pcs</td>
</tr>
<tr>
	<td colspan="2">
	<a href="Shopping_Cart.php?action=Clear" class="btn_3">Empty Cart</a> | 
	<a href="Checkout.php" class="btn_3">Checkout</a> |
	<a href="Customer_Home.php" class="btn_3">Add Product</a>
	</td>
</tr>

</table>
</fieldset>

</form>

</body>
</html>