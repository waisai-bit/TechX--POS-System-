<?php  
include('connect.php');
include('function.php');
include('headerstaff.php');

$con=mysqli_connect($host,$user,$pass,$database);

if(isset($_REQUEST['mode']))
{
	$mode=$_REQUEST['mode'];
	$ProductID=$_REQUEST['ProductID'];

	if($mode=="edit")
	{
		$Select="SELECT * FROM product p, category c, brand b, model m, color o where p.CategoryID=c.CategoryID and p.BrandID=b.BrandID and p.ModelID=m.ModelID and p.ColorID=o.ColorID and p.productID='$ProductID'";
		$Selret=mysqli_query($con,$Select);
		$array=mysqli_fetch_array($Selret);

		$txtProductID=$array['ProductID'];

		$CategoryID=$array['CategoryID'];
		$BrandID=$array['BrandID'];
		$ModelID=$array['ModelID'];
		$ColorID=$array['ColorID'];
	
		$cboCategoryName=$array['CategoryName'];
		$cboBrandName=$array['BrandName'];
		$cboModelName=$array['ModelName'];
		$cboColorName=$array['ColorName'];
		
		$txtQuantity=$array['Quantity'];
		$txtPrice=$array['Price'];		
	
	}


	else if ($mode== "delete") 
	{
		$del="DELETE FROM product WHERE ProductID='$ProductID' ";
		$delquery=mysqli_query($con,$del);
		if($delquery)
		{
		echo"<script>window.location='Product.php'</script>";
		}

	}


}

if(isset($_POST['btnUpdate']))
{
	$txtProductID=$_POST['txtProductID'];

	
	$cboCategoryID=$_POST['cboCategoryID'];
	$cboBrandID=$_POST['cboBrandID'];
	$cboModelID=$_POST['cboModelID'];
	$cboColorID=$_POST['cboColorID'];

	$txtQuantity=$_POST['txtQuantity'];
	$txtPrice=$_POST['txtPrice'];

 $update="UPDATE product
		 SET CategoryID='$cboCategoryID',
		 	 BrandID='$cboBrandID',
		 	 ModelID='$cboModelID',
		 	 ColorID='$cboColorID',
		 	 Quantity='$txtQuantity',
		 	 Price='$txtPrice'		 	
		 	 WHERE ProductID='$txtProductID'";

$retupdate=mysqli_query($con,$update);

if($retupdate)
{
	echo"<script>window.alert('Product Info is Updated')</script>";
	echo"<script>window.location='Product.php'</script>";
}
else
{
	echo"<script>window.alert('Sorry, Product is Unsuccessful')</script>";
	echo"<script>window.location='Product.php'</script>";
}
}




if(isset($_POST['btnsave'])) 
{
	
	$txtProductID=AutoID('product','ProductID','P-',4);

	$cboCategoryID=$_POST['cboCategoryID'];
	$cboBrandID=$_POST['cboBrandID'];
	$cboModelID=$_POST['cboModelID'];
	$cboColorID=$_POST['cboColorID'];

	$txtQuantity=$_POST['txtQuantity'];
	$txtPrice=$_POST['txtPrice'];



//Insert User Data---------------------------------------------

	 $insert="INSERT INTO `product`(`ProductID`, `CategoryID`, `BrandID`, `ModelID`, `ColorID`, `Quantity`, `Price`) 
			 VALUES('$txtProductID','$cboCategoryID','$cboBrandID','$cboModelID','$cboColorID','$txtQuantity','$txtPrice')";
	$result=mysqli_query($con,$insert);

//--------------------------------------------------------------

	if($result) //True 
	{
		echo "<script>window.alert('Product Inserting is Completed.')</script>";
		echo "<script>window.location='Product.php'</script>";
	}
	else
	{
		echo "<script>Something wrong in Product Inserting " . mysqli_error() . "</script>";
		echo "<script>window.location='Product.php'</script>";
	}
}
?>

<html>
<head>

<script type="text/javascript" src="js/jquery-3.1.1.slim.min.js"></script>
<link rel="stylesheet" type="text/css" href="DataTables/datatables.min.css"/>
<script type="text/javascript" src="DataTables/datatables.min.js"></script>

<title>Product Page</title>

</head>

<body>

<script>
$(document).ready( function () 
{
	$('#datatableid').DataTable();
} );
</script>
<h3 align="center">Product Registration</h3>

<form action="Product.php" method="post" enctype="multipart/form-data">

	<table cellpadding="4" align="center">
		<input type="hidden" name="txtProductID" value="<?php if (isset($txtProductID)){echo $txtProductID;} ?>">	

<tr>
		<td>Category :</td>
		<td>
			<select name="cboCategoryID" required>
				<?php if (isset($cboCategoryName))
				{
					echo "<option value='$CategoryID'>".$cboCategoryName."</option>";
				}
				else
				{
					?>
				<option>SELECT Category Name</option>
					<?php
				} ?>
				<?php
				$run=mysqli_query($con,"SELECT * FROM category");
				$c=mysqli_num_rows($run);
				for($i=0;$i<$c;$i++)
				{
					$array=mysqli_fetch_array($run);
						$CategoryID=$array['CategoryID'];
						$CategoryName=$array['CategoryName'];
						echo "<option value='$CategoryID'>($CategoryID) $CategoryName</option>";
				}
	?>
	</select>

	</td>
</tr>

<tr>
		<td>Brand :</td>
		<td>
			<select name="cboBrandID" required>
				<?php if (isset($cboBrandName))
				{
					echo "<option value='$BrandID'>".$cboBrandName."</option>";
				}
				else
				{
					?>
				<option>SELECT Brand Name</option>
					<?php
				} ?>
				<?php
				$run=mysqli_query($con,"SELECT * FROM brand");
				$c=mysqli_num_rows($run);
				for($i=0;$i<$c;$i++)
				{
					$array=mysqli_fetch_array($run);
						$BrandID=$array['BrandID'];
						$BrandName=$array['BrandName'];
						echo "<option value='$BrandID'>($BrandID) $BrandName</option>";
				}
	?>
	</select>

	</td>
</tr>


<tr>
		<td>Model :</td>
		<td>
			<select name="cboModelID" required>
				<?php if (isset($cboModelName))
				{
					echo "<option value='$ModelID'>".$cboModelName."</option>";
				}
				else
				{
					?>
				<option>SELECT Model Name</option>
					<?php
				} ?>
				<?php
				$run=mysqli_query($con,"SELECT * FROM model");
				$c=mysqli_num_rows($run);
				for($i=0;$i<$c;$i++)
				{
					$array=mysqli_fetch_array($run);
					$ModelID=$array['ModelID'];
					$ModelName=$array['ModelName'];
					echo "<option value='$ModelID'>($ModelID) $ModelName</option>";
				}
	?>
	</select>

	</td>
</tr>

<tr>
		<td>Color :</td>
		<td>
			<select name="cboColorID" required>
				<?php if (isset($cboColorName))
				{
					echo "<option value='$ColorID'>".$cboColorName."</option>";
				}
				else
				{
					?>
				<option>SELECT Color Name</option>
					<?php
				} ?>
				<?php
				$run=mysqli_query($con,"SELECT * FROM color");
				$c=mysqli_num_rows($run);
				for($i=0;$i<$c;$i++)
				{
					$array=mysqli_fetch_array($run);
						$ColorID=$array['ColorID'];
						$ColorName=$array['ColorName'];
						echo "<option value='$ColorID'>($ColorID) $ColorName</option>";
				}
	?>
	</select>

	</td>
</tr>

<tr>
			<td>Quantity: </td><td>
			<input type="text" name="txtQuantity" placeholder="Enter the quantity no" value="<?php if (isset($txtQuantity)){echo $txtQuantity;} ?>" required></td>
</tr>
<tr>
			<td>Price : </td><td>
			<input type="text" name="txtPrice" placeholder="Enter price amount" value="<?php if (isset($txtPrice)){echo $txtPrice;} ?>" required>  MMK</td>
</tr>

<tr>
<p></p>
	
				<?php

					if(isset($ProductID))
						{
							echo "<td><input type='submit' name='btnUpdate' class='btn_4' value='Update'></td>";
						}

					else
					{

						echo "<td colspan='2' align='right'><input type='submit' class='btn_4' name='btnsave' value='Save'>    ";
						echo "<input type='reset' class='btn_4' value='Clear'></td>";
					}
					?>

</tr>
	</table>
</form>


<fieldset>
<legend>Product Info Listing:</legend>
<?php  
$query="SELECT * FROM product p, category c, brand b, model m, color o where p.CategoryID=c.CategoryID and p.BrandID=b.BrandID and p.ModelID=m.ModelID and p.ColorID=o.ColorID";
$result=mysqli_query($con,$query);
$count=mysqli_num_rows($result) ;

if($count<1) 
{
	echo "<p>No Product Data Found.</p>";
	exit();
}
?>
<table id="datatableid" class="display">
<thead>
<tr align="center">
	<th>Product ID</th>
	<th>Category Name</th>
	<th>Brand Name</th>
	<th>Model Name</th>
	<th>Color Name</th>
	
	<th>Quantity</th>
	<th>Price (MMK)</th>
	<th>Total Price (MMK)</th>


	<th>Action</th>
</tr>
</thead>
</body>
<?php  
for ($i=0;$i<$count;$i++) 
{ 
	$array=mysqli_fetch_array($result);

	$ProductID=$array['ProductID'];


	$CategoryName=$array['CategoryName'];
	$BrandName=$array['BrandName'];
	$ModelName=$array['ModelName'];
	$ColorName=$array['ColorName'];
	

	$Quantity=$array['Quantity'];
	$Price=$array['Price'];		
	$Totalprice=$array['Price']*$array['Quantity'];



	echo "<tr align='center'>";
		echo "<td>$ProductID</td>";
		echo "<td>$CategoryName</td>";
		echo "<td>$BrandName</td>";
		echo "<td>$ModelName</td>";	
		echo "<td>$ColorName</td>";

		echo "<td>$Quantity</td>";
		echo "<td>$Price</td>";
		echo "<td>$Totalprice</td>";
		
		
		echo "<td align='center'>
			  <a href='Product.php?mode=edit&ProductID=$ProductID' class='btn_3'>Edit</a> |
			  <a href='Product.php?mode=delete&ProductID=$ProductID' class='btn_3'>Delete</a>
			  </td>";

	echo "</tr>";
}
?>

</tbody>
</table>
</fieldset>
</form>
</body>
</html>