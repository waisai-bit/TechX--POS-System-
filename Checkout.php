<?php  
session_start(); 
include('connect.php'); 
include('function.php');
include('Shopping_Cart_Functions.php');
include('header.php');


if (!isset($_SESSION['CustomerID']))
 {
	echo"<script>window.alert('Please Login')".mysqli_error()."</script>";
	echo"<script>window.location='Login.php'</script>";
}

$con=mysqli_connect($host,$user,$pass,$database);
if(isset($_POST['btnCheckout'])) 
{
	$txtOrderID=$_POST['txtOrderID'];
	$txtOrderDate=$_POST['txtOrderDate'];
	$txtAddress=$_POST['txtAddress'];
	$txtPhone=$_POST['txtPhone'];
	$CardType=$_POST['rdoCardType'];

	$DeliveryID=$_POST['cboDeliveryID'];


	$TotalAmount=CalculateTotalAmount();
	$TotalQuantity=CalculateTotalQuantity();
	$Status="Pending";

	$CustomerID=$_SESSION['CustomerID'];

	$cardno=$_REQUEST['rdoType'];


	 $query="INSERT INTO `orders`
		VALUES
			('$txtOrderID','$txtOrderDate','$TotalQuantity','$TotalAmount','$txtAddress','$txtPhone', '$Status','$CardType','$cardno','$CustomerID','$DeliveryID')";
	$result=mysqli_query($con,$query);

	//OrderDetail Save======================================================

	$count=count($_SESSION['ShoppingCart_Function']);
	for($i=0; $i < $count; $i++) 
	{ 
		$ProductID=$_SESSION['ShoppingCart_Function'][$i]['ProductID'];
		$Price=$_SESSION['ShoppingCart_Function'][$i]['Price'];
		$Quantity=$_SESSION['ShoppingCart_Function'][$i]['BuyQuantity'];

		 $query_Detail="INSERT INTO `orderdetail`
					   VALUES 
					   ('$txtOrderID','$ProductID','$Quantity','$Price')";
		$result=mysqli_query($con,$query_Detail);
	
	//=======================================================================

	$Update_Qty="UPDATE product
				 SET Quantity=Quantity - '$Quantity'
				 WHERE ProductID='$ProductID'";
	$result=mysqli_query($con,$Update_Qty);
}
	if($result) 
	{
		unset($_SESSION['ShoppingCart_Function']);
		echo "<script>window.alert('Checkout Process is Completed.')</script>";
		echo "<script>window.location='PrintInVoice.php?OrderID=$txtOrderID'</script>";
	}
	else
	{
		echo "<p>Something wrong in Checkout" . mysqli_error() . "</p>";
	}

}
?>

<html>
<head>
	<title>Secure Checkout</title>
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
<form action="Checkout.php" method="post">
<fieldset>


<legend>Enter Checkout Info:</legend>

<table id="datatableid"  class="display">
<script type="text/javascript">
	function showMPU()
	{
		
		document.getElementById("Visa").style="display:hide";
	}
	function showVisa()
	{
		document.getElementById("Visa").style="display:hide";
	}

	function showMaster()
	{
		
		document.getElementById("Visa").style="display:hide";
		
	}
	
	function showMyanPay()
	{
		
		document.getElementById("Visa").style="display:hide";
	}

	function allhide()
	{
		
		document.getElementById("Visa").style="display:none";
	}
</script>


<tr>
	<td>Order ID :</td>
	<td>
	<input type="text" name="txtOrderID" value="<?php echo AutoID('orders','OrderID','Order-',4) ?>" readonly/>
	</td>
</tr>
<tr>
	<td>Order Date :</td>
	<td>
	<input type="text" name="txtOrderDate" value="<?php echo date('Y-m-d') ?>" readonly/>
	</td>
</tr>
<tr>
	<td>Customer Name :</td>
	<td>
	<input type="text" value="<?php echo $_SESSION['Surname'] . " " . $_SESSION['Forename'] ?>" readonly/>
	</td>
</tr>
<tr>
	<td>Total Amount :</td>
	<td>
	<input type="text" value="<?php echo CalculateTotalAmount() ?>" readonly/> MMK
	</td>
</tr>


<tr>
	<td>Total Quantity :</td>
	<td>
	<input type="text" value="<?php echo CalculateTotalQuantity() ?>" readonly/> pcs
	</td>
</tr>

<tr>
	<td>Payment Type :</td>
	<td>
	<input type="radio" name="rdoCardType" value="MPU"    onclick="showMPU()"    required/> MPU
	<input type="radio" name="rdoCardType" value="Visa"    onclick="showVisa()"   required /> Visa
	<input type="radio" name="rdoCardType" value="Master"  onclick="showMaster()"  required /> Master
	
	<input type="radio" name="rdoCardType" value="COD"     onclick="allhide()"  required /> COD
	</td>
</tr>


<tr style="display:none" id="Visa">
	<td>Card Number :</td>
	<td > <input type="text" placeholder="XXXXXXXXXXXXXXXXX" name="rdoType"  checked/></td>
</tr>


<tr>
	<td>Contact PhoneNo :</td>
	<td>
	<input type="text" name="txtPhone" placeholder="----------------------" required/>
	</td>
</tr>

<tr>
		<td>Region & Duration:</td>
		<td>
			<select name="cboDeliveryID" required>
				<option>SELECT Region & Duration </option>
				<?php
				
				$run=mysqli_query($con,"SELECT * FROM region r, delivery d where d.RegionID=r.RegionID");
				$c=mysqli_num_rows($run);
				for($i=0;$i<$c;$i++)
				{
					$array=mysqli_fetch_array($run);
					$DeliveryID=$array['DeliveryID'];
						$RegionID=$array['RegionID'];
						$RegionName=$array['RegionName'];
						$DurationDate=$array['DurationDate'];
						
						echo "<option value='$DeliveryID'>$RegionName ($DurationDate)</option>";
						
				}

	?>
	</select>

	</td>
</tr>

<tr>
	<td>Delivery Address :</td>
	<td>
	<textarea name="txtAddress" required></textarea>
	</td>
</tr>
<tr>
	<td></td>
	<td>
	<input type="submit" name="btnCheckout" data-text="Add To Cart" class="btn_4" value="Checkout"/>
	<input type="reset"  data-text="Add To Cart" class="btn_4" value="Cancel"/>
	</td>
</tr>
<hr>

<tr align="center">
	<th>Image</th>
	<th>ProductName</th>
	<th >Color</th>
	<th>Storage</th>
	<th>Price</th>
	<th>Quantity</th>
	<th>Sub Total</th>
	
</tr>
<?php 
 $count=count($_SESSION['ShoppingCart_Function']);

for($i=0;$i<$count;$i++) 
{ 
	$ProductID=$_SESSION['ShoppingCart_Function'][$i]['ProductID'];
	$FrontImage=$_SESSION['ShoppingCart_Function'][$i]['FrontImage'];

	echo "<tr align='center'>";
	echo "<td><img src='$FrontImage' width='100' height='100'/></td>";
	echo "<td >" .$_SESSION['ShoppingCart_Function'][$i]['ModelName'] ."</td>";
	echo "<td>" . $_SESSION['ShoppingCart_Function'][$i]['ColorName'] ."</td>";
	echo "<td>" . $_SESSION['ShoppingCart_Function'][$i]['Rom'] ."</td>";
	echo "<td>" . $_SESSION['ShoppingCart_Function'][$i]['Price'] ." MMK</td>";
	echo "<td>" . $_SESSION['ShoppingCart_Function'][$i]['BuyQuantity'] ." pcs</td>";

	echo "<td>" . $_SESSION['ShoppingCart_Function'][$i]['BuyQuantity'] * $_SESSION['ShoppingCart_Function'][$i]['Price'] ." MMK</td>";
	
	echo "</tr>";
}

?>

</table>


</fieldset>
</form>
</body>
</html>
