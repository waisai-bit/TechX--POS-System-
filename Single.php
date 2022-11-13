<?php 
session_start(); 
include('connect.php');
include('header.php');

$con=mysqli_connect($host,$user,$pass,$database);

$ProductID=$_GET['ProductID'];

$query="SELECT * FROM product p, model m, category ca, brand b , color c, specification s where m.ModelID=p.ModelID and m.SpecificationID=s.SpecificationID and ca.CategoryID=p.CategoryID and b.BrandID=p.BrandID and p.ColorID=c.ColorID and p.ProductID='$ProductID'";
$result=mysqli_query($con,$query);
$arr=mysqli_fetch_array($result);
$ModelName=$arr['ModelName'];
$Price=$arr['Price'];
$Quantity=$arr['Quantity'];
$Network=$arr['Network'];
$ColorName=$arr['ColorName'];
$CategoryName=$arr['CategoryName'];
$BrandName=$arr['BrandName'];
//Image ArrayList................................
$FrontImage=$arr['FrontImage'];
list($width,$height)=getimagesize($FrontImage);
$w=$width/2;
$h=$height/2;

$BackImage=$arr['BackImage'];
//..................................

//Specification ArrayList................................
$Sim=$arr['Sim'];
$Network=$arr['Network'];
$CPU=$arr['CPU'];
$DisplaySize=$arr['DisplaySize'];
$Resolution=$arr['Resolution'];
$Front_Camera=$arr['Front_Camera'];
$Rear_Camera=$arr['Rear_Camera'];
$Ram=$arr['Ram'];
$Rom=$arr['Rom'];
$OS=$arr['OS'];
$Version=$arr['Version'];
$Battery=$arr['Battery'];
$Weight=$arr['Weight'];


?>
<html>
<head>
	<title>Product Detail :</title>
</head>
<body>
<form action="Shopping_Cart.php" method="get">
<input type="hidden" name="ProductID" value="<?php echo $ProductID ?>"/>
<input type="hidden" name="action" value="Add"/>
<fieldset>
<legend align="center"><?php echo $arr['ModelName'] ?> Detail :</legend>
<table align="center">
<tr>
<td>
	<img src="<?php echo $FrontImage ?>" width="<?php echo $w ?>" height="<?php echo $h ?>"/>
	<br/>
	<img src="<?php echo $FrontImage ?>" width="100" height="100"/>
	
	<img src="<?php echo $BackImage ?>" width="100" height="100"/>
</td>
<td>
	<table cellspacing="3px">
	<tr>
		<td>Model Name</td>
		<td>:</td><td><?php echo $ModelName ?></td>
	</tr>
	<tr>
		<td>Category </td>
		<td>:</td><td><?php echo $CategoryName ?></td>
	</tr>
	<tr>
		<td>Brand </td>
		<td>:</td><td><?php echo $BrandName ?></td>
	</tr>	
	<tr>
		<td>Color</td>
		<td>:</td><td><?php echo $ColorName ?> </td>
	</tr>
	<tr>
		<td>Storage</td>
		<td>:</td><td><?php echo $Rom ?></td>
	</tr>
	<tr>
		<td>Price</td>
		<td>:</td><td><?php echo $Price ?> MMK</td>
	</tr>
	<tr>
		<td>Quantity</td>
		<td>:</td><td><?php echo $Quantity ?> pcs</td>
	</tr>
	<tr>
		<td></td>
		<td></td>
		<td>
		<input type="number" name="txtBuyQty" value="1"/>
		<input type="submit" name="btnAddtoCart" class="btn_4" value="Add to Cart"/>
		</td>
	</tr>
	</table>
</td>
</tr>
<tr>
	<td colspan='2'>
	<hr>
	<h4>Specification of <?php echo $ModelName ?></h4>
	<hr>

<table align="left">
<tr>
		<td align="left">Sim</td>
		<td>:</td>
		<td><?php echo $Sim ?></td>
</tr>
<tr>
		<td align="left">Network</td>
		<td>:</td>
		<td><?php echo $Network ?></td>
</tr>
<tr>	
		<td align="left">CPU</td>
		<td>:</td>
		<td><?php echo $CPU ?></td>
</tr>
<tr>		
		<td align="left">Display Size</td>
		<td>:</td>
		<td><?php echo $DisplaySize ?></td>
</tr>
<tr>		
		<td align="left">Resolution</td>
		<td>:</td>
		<td><?php echo $Resolution ?></td>
</tr>
<tr>		
		<td align="left">Front Camera</td>
		<td>:</td>
		<td><?php echo $Front_Camera ?></td>
</tr>
<tr>		
		<td align="left">Rear Camera</td>
		<td>:</td>
		<td><?php echo $Rear_Camera ?></td>
</tr>
</table>


<table align="center">
<tr>		
		<td align="left">Ram</td>
		<td>:</td>
		<td><?php echo $Ram ?></td>
</tr>
<tr>		
		<td align="left">Storage</td>
		<td>:</td>
		<td><?php echo $Rom ?></td>
</tr>
<tr>	
		<td align="left">OS</td>
		<td>:</td>
		<td><?php echo $OS ?></td>
</tr>
<tr>	
		<td align="left">Version</td>
		<td>:</td>
		<td><?php echo $Version ?></td>
</tr>
<tr>	
		<td align="left">Battery</td>
		<td>:</td>
		<td><?php echo $Battery ?></td>
</tr>
<tr>	
		<td align="left">Weight</td>
		<td>:</td>
		<td><?php echo $Weight ?></td>
</tr>


</td>
</tr>
</table>
</fieldset>

</form>
</body>
</html>
