<?php  
session_start(); 
include('connect.php'); 
include('AutoID_Helper.php');
include('headerstaff.php');

$con=mysqli_connect($host,$user,$pass,$database);

if(isset($_REQUEST['action']))
{
 if($_REQUEST['action']=="complete")
 {
 	$OID=$_REQUEST['OrderID'];
 	$update=mysqli_query($con,"UPDATE orders SET Status='Complete' WHERE OrderID='$OID'");

 	echo "<script>location='OrderDetail.php?OrderID=$OID'</script>";
 }
 else if($_REQUEST['action']=="pending")
 {
 	$OID=$_REQUEST['OrderID'];
 	$update=mysqli_query($con,"UPDATE orders SET Status='Pending' WHERE OrderID='$OID'");

 	echo "<script>location='OrderDetail.php?OrderID=$OID'</script>";
 }
}

$OrderID=$_GET['OrderID'];

$query1="SELECT * FROM orders o, customer c 
		WHERE o.OrderID='$OrderID'
		AND o.CustomerID=c.CustomerID";
$ret1=mysqli_query($con,$query1);
$array1=mysqli_fetch_array($ret1);


$query2="SELECT *
			FROM product p, orders o, orderdetail od, model m, color c, specification s
			where p.ProductID=od.ProductID
			and s.SpecificationID=m.SpecificationID
			and p.ColorID=c.ColorID
			and m.ModelID=p.ModelID
			and o.OrderID=od.OrderID
			and o.OrderID='$OrderID'";
$ret2=mysqli_query($con,$query2);

?>
<html>
<head>
	<title>Order Detail : <?php echo $OrderID ?></title>
</head>
<body>
<form>

<fieldset>
<legend>Order Detail Report for OrderID : <?php echo $OrderID ?></legend>
<table align="center">
<tr>
	<td align="center">
		<h3> TechX Company</h3>
		<p><small>No-99 Insein Road, Hledan Township, Yangon</small></p>
	</td>
</tr>

<tr>
	<td>
		<table cellpadding="12" border="1" align="center">
		<tr>
			<td>OrderID : <?php echo $OrderID ?></td>
			<td>Order Date : <?php echo $array1['Order_Date'] ?></td>
			<td align="center">Action</td>
		</tr>
		<tr>
			<td>DeliveryID : <?php echo $array1['DeliveryID']?></td>
			<td>Status : <?php  echo $array1['Status']?> </td>
				<?php 
				$OID=$_REQUEST['OrderID'];
				if($array1['Status']=="Pending")
				{
					echo '<td><a href="OrderDetail.php?OrderID='.$OID.'&action=complete" class="btn btn-primary btn-sm">Complete</a></td>';
					
				}
				else if($array1['Status']=="Complete")
				{
					echo '<td><a href="OrderDetail.php?OrderID='.$OID.'&action=pending" class="btn btn-primary btn-sm">Pending</a></td>';
					
				}
			 ?>
			

			
		</tr>
		<tr>
			<td>Customer : <?php echo $array1['Surname']." ". $array1['Forename']?></td>
			
			<td>Phoneno : <?php echo $array1['Contact_Phoneno'] ?></td>
		</tr>
		<tr>
			<td>PaymentType : <?php echo $array1['PaymentType']?></td>
			<td>Card : <?php echo $array1['CardNo'] ?></td>
			
		</tr>
		<tr>
			
			<td>Address : <?php echo $array1['Delivery_Address']?></td>
		</tr>

		
		</table>
	</td>
</tr>
<tr>
	<td>
	<hr/>
	<table cellpadding="13" border="1">
	<tr>
 			
 			<th>Product Name</th> 
 			<th>Color</th>	
 			<th>Storage</th>	
 			<th>Quantity</th> 
 			<th>Price</th>		
 			<th>Sub Total</th>	
 		</tr>
	<?php  
	$count=mysqli_num_rows($ret2);

	for ($i=0;$i<$count;$i++) 
	{ 
		$array2=mysqli_fetch_array($ret2);

		echo "<tr align='center'>";
		
		echo "<td>" . $array2['ModelName'] . "</td>";
		echo "<td>" . $array2['ColorName'] . "</td>";
		echo "<td>" . $array2['Rom'] . "</td>";
		
		

		echo "<td>" . $array2['OrderQuantity'] . "</td>";
		echo "<td>" . $array2['OrderPrice'] . "</td>";
		echo "<td>" . $array2['OrderQuantity'] * $array2['OrderPrice']  . " MMK</td>";
		
		echo "</tr>";
	}
	?>
	</table>
	</td>
</tr>
<tr>
	<td align="right">
	<hr/>
	TotalAmount : <b><?php echo $array1['Total_Amount'] ?></b> MMK
	
<br>
	TotalQty : <b><?php echo $array1['Total_Quantity'] ?></b> Pcs
	</td>
</tr>
<tr>
	<td align="center">
	<hr/>
	Thanks
	<hr/>
	
	</td>
</tr>
</table>

<!--Print Button ___________________________________-->
<div class="text-center">
<script>var pfHeaderImgUrl = '';var pfHeaderTagline = 'Order%20Report';var pfdisableClickToDel = 0;var pfHideImages = 0;var pfImageDisplayStyle = 'right';var pfDisablePDF = 0;var pfDisableEmail = 0;var pfDisablePrint = 0;var pfCustomCSS = '';var pfBtVersion='1';(function(){var js, pf;pf = document.createElement('script');pf.type = 'text/javascript';if('https:' == document.location.protocol){js='https://pf-cdn.printfriendly.com/ssl/main.js'}else{js='http://cdn.printfriendly.com/printfriendly.js'}pf.src=js;document.getElementsByTagName('head')[0].appendChild(pf)})();</script>
<a href="http://www.printfriendly.com" style="color:#6D9F00;text-decoration:none;" class="printfriendly" onClick="window.print();return false;" title="Printer Friendly and PDF"><img style="border:none;-webkit-box-shadow:none;box-shadow:none;" src="http://cdn.printfriendly.com/button-print-grnw20.png" alt="Print Friendly and PDF"/></a>
<br><a align="center" href="OrderSearch.php" class="btn_3">Return To Order Search</a>
</div>
<!--Print Button ___________________________________-->

</fieldset>

</form>
</body>
</html>