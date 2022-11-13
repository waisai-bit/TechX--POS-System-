<?php
session_start(); 
include('connect.php'); 
include('function.php');
include('Purchase_Order_Functions.php');
include('headerstaff.php');

$con=mysqli_connect($host,$user,$pass,$database);

if(isset($_GET['btnPurchase'])) 
{
	$PurchaseID=$_GET['txtPurchaseID'];
	$PurchaseDate=$_GET['txtPurchaseDate'];
	$SupplierID=$_GET['cboSupplierID'];
	
	
	$TotalAmount=$_GET['txtTotalAmount'];
	$TotalQuantity=$_GET['txtTotalQuantity'];
	$GovTax=$_GET['txtGovTax'];
	$NetAmount=$_GET['txtNetAmount'];
	$Status="Pending";

	$query="INSERT INTO `purchase`(`PurchaseID`, `Date`, `TotalQuantity`, `TotalAmount`, `GovTax`, `NetAmount`, `Status`, `SupplierID`) 
			VALUES
	 		('$PurchaseID','$PurchaseDate','$TotalQuantity','$TotalAmount','$GovTax','$NetAmount','$Status','$SupplierID')";
	$result=mysqli_query($con,$query);

	//---------------------------------------------------------------------------------------------------

	$count=count($_SESSION['Purchase_Function']);
	for($i=0; $i < $count; $i++) 
	{ 
		$ProductID=$_SESSION['Purchase_Function'][$i]['ProductID'];
		$PurchasePrice=$_SESSION['Purchase_Function'][$i]['PurchasePrice'];
		$PurchaseQty=$_SESSION['Purchase_Function'][$i]['PurchaseQty'];

		$query_Detail="INSERT INTO `purchasedetail`
					   (`PurchaseID`, `ProductID`, `PurchaseQuantity`, `PurchasePrice`) 
					   VALUES
					   ('$PurchaseID','$ProductID','$PurchaseQty','$PurchasePrice')";
		$result=mysqli_query($con,$query_Detail);


		$update="Update product set Quantity=Quantity+$PurchaseQty where ProductID='$ProductID'";
		$ret=mysqli_query($con,$update);
	}

	if($result) //True 
	{
		unset($_SESSION['Purchase_Function']);
		echo "<script>window.alert('Purchase Process is Completed.')</script>";
		echo "<script>window.location='PurchaseSearch.php'</script>";
		ClearAll();
	}
	else
	{
		echo "<p>Something wrong in Purchase_Order" . mysqli_error() . "</p>";
	}


}

if(isset($_GET['action'])) 
{
	$action=$_GET['action'];

	if($action==="Add") 
	{
		$ProductID=$_GET['cboProductID'];
		$PurchasePrice=$_GET['txtPurchasePrice'];
		$PurchaseQty=$_GET['txtPurchaseQty'];

		AddPurchase($ProductID,$PurchaseQty,$PurchasePrice); //AddPurchase Function
	}
	elseif($action==="ClearAll")
	{
		ClearAll();
	}
	elseif($action==="Remove")
	{
		$ProductID=$_GET['ProductID'];
		Remove($ProductID);
	}
}
?>
<html>
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
<form action="Purchase_Order.php" method="get">
<input type="hidden" name="action" value="Add"/>
<h3 align="center">Purchase Form</h3>
<fieldset>
<legend >Purchase Info :</legend>
<table align="center" cellpadding="4">
<tr>
	<td>PurchaseID</td>
	<td>
	<input type="text" name="txtPurchaseID" value="<?php echo AutoID('purchase','PurchaseID','PUR-',4) ?>"readonly/>
	</td>
</tr>
<tr>
	<td>PurchaseDate</td>
	<td>
	<input type="text" name="txtPurchaseDate" value="<?php echo date('Y-m-d') ?>"readonly/>
	</td>
</tr>

<tr>
	<td>Total Quantity</td>
	<td>
	<input type="text" name="txtTotalQuantity" value="<?php 
														
														if(!isset($_SESSION['Purchase_Function'])) 
														{
															echo "---------";
														}
														else
														{

															echo CalculateTotalQty();
														}


														?>" readonly/> pcs
	</td>
</tr>
<tr>
	<td>Total Amount</td>
	<td>
	<input type="text" name="txtTotalAmount" value="<?php 
														
														if(!isset($_SESSION['Purchase_Function'])) 
														{
															echo "---------";
														}
														else
														{

															echo CalculateTotalAmount();
														}


														?>" readonly/> MMK
	</td>
</tr>
<tr>
	<td>GovTax</td>
	<td>
	<input type="text" name="txtGovTax" value="<?php 
														
														if(!isset($_SESSION['Purchase_Function'])) 
														{
															echo "---------";
														}
														else
														{

															echo (CalculateTotalQty()+CalculateTotalAmount())*0.05;
														}


														?>" readonly/> MMK
	</td>
</tr>
<tr>
	<td>Net Amount</td>
	<td>
	<input type="text" name="txtNetAmount" value="<?php 
														
														if(!isset($_SESSION['Purchase_Function'])) 
														{
															echo "---------";
														}
														else
														{

															echo (CalculateTotalAmount()+(CalculateTotalQty()+CalculateTotalAmount())*0.05);
														}


														?>" readonly/> MMK
	</td>
</tr>
<tr>
	<td colspan="2">
	<hr/>
	</td>
</tr>
<tr>
	<td>Product Info</td>
	<td>
	<select name="cboProductID">
	<option>Choose ProductID</option>
	<?php  
	$query="SELECT * FROM product p,model m, specification s where p.ModelID=m.ModelID and s.SpecificationID=m.specificationID";
	$result=mysqli_query($con,$query);
	$count=mysqli_num_rows($result);

	for($i=0;$i<$count;$i++) 
	{ 
		$array=mysqli_fetch_array($result);
		$ProductID=$array['ProductID'];
		$ModelName=$array['ModelName'];
		$SpecificationCode=$array['SpecificationCode'];

		echo "<option value='$ProductID'>$ProductID - $ModelName - $SpecificationCode</option>";
	}

	?>
	</select>
	</td>
</tr>
<tr>
	<td>PurchasePrice</td>
	<td>
	<input type="number" name="txtPurchasePrice" value="---------" placeholder="Price Amount"/> MMK
	</td>
</tr>
<tr>
	<td>Purchase Qty</td>
	<td>
	<input type="number" name="txtPurchaseQty"  value="---------" placeholder="Quantity Amount" /> pcs
	</td>
</tr>
<tr>
	<td></td>
	<td>
	<input type="submit" name="btnAdd"  class="btn_4 "value="Add to Cart"/>
	<input type="submit" name="btnClear" class="btn_4" value="ClearCart"/>
	</td>
</tr>
</table>
</fieldset>
 </div>
      </div>
      
    </div>
<fieldset>
<legend>Purchase Details :</legend>
<?php  
if(!isset($_SESSION['Purchase_Function'])) 
{
	
	echo "<div class='text-center'><img src='images/Shoppingcart_empty.png' width='100px' height='100px'/></div>";
	echo "<p class='text-center'>No Purchase Record Found.</p>";
	exit();
}
?>
<b>Product in your Purchase</b><br/>
<hr>

<table id="datatableid"  class="display">
<tr algin="left">
	<th>FrontImage</th>
	<th>Model Name</th>
	<th>Price</th>
	<th>Quantity</th>
	<th>SubTotal</th>
	<th>Action</th>
</tr>
<?php 
 $count=count($_SESSION['Purchase_Function']);

for($i=0;$i<$count;$i++) 
{ 
	$ProductID=$_SESSION['Purchase_Function'][$i]['ProductID'];
	$FrontImage=$_SESSION['Purchase_Function'][$i]['FrontImage'];

	echo "<tr align='left'>";
	echo "<td><img src='$FrontImage' width='100' height='100'/></td>";
	echo "<td>" . $_SESSION['Purchase_Function'][$i]['ModelName'] ."</td>";
	echo "<td>" . $_SESSION['Purchase_Function'][$i]['PurchasePrice'] ." MMK</td>";
	echo "<td>" . $_SESSION['Purchase_Function'][$i]['PurchaseQty'] ." pcs</td>";

	echo "<td>" . $_SESSION['Purchase_Function'][$i]['PurchaseQty'] * $_SESSION['Purchase_Function'][$i]['PurchasePrice'] ." MMK</td>";
	
	echo "<td><a href='Purchase_Order.php?action=Remove&ProductID=$ProductID' class='btn_3'>Remove</a></td>";
	echo "</tr>";
}

?>
<tr>
	<td colspan="6" align="right">

	<select name="cboSupplierID">
	<option>Choose Supplier</option>
	<?php  
	$query="SELECT * FROM supplier";
	$result=mysqli_query($con,$query);
	$count=mysqli_num_rows($result);

	for($i=0;$i<$count;$i++) 
	{ 
		$array=mysqli_fetch_array($result);
		$SupplierID=$array['SupplierID'];
		$SupplierName=$array['SupplierName'];

		echo "<option value='$SupplierID'>$SupplierID - $SupplierName</option>";
	}

	?>
	</select>
	|
	<input type="submit" name="btnPurchase" data-text="Add To Cart" class="btn_4" value="Purchase"/> 
	</td>
</tr>
</table>
<a href="Purchase_Order.php?action=ClearAll" class='btn_3'><b>Remove All<b></a>
</fieldset>
</form>
</div>
         
   
</body>
</html>