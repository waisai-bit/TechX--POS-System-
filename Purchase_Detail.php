<?php  
session_start(); 
include('connect.php'); 
include('function.php');
include('Purchase_Order_Functions.php');
include('headerstaff.php');

$con=mysqli_connect($host,$user,$pass,$database);

if(isset($_REQUEST['action']))
{
 if($_REQUEST['action']=="complete")
 {
 	$PURID=$_REQUEST['PurchaseID'];
 	$update=mysqli_query($con,"UPDATE purchase SET Status='Complete' WHERE PurchaseID='$PURID'");

 	echo "<script>location='Purchase_Detail.php?PurchaseID=$PURID'</script>";
 }
 else if($_REQUEST['action']=="pending")
 {
 	$PURID=$_REQUEST['PurchaseID'];
 	$update=mysqli_query($con,"UPDATE purchase SET Status='Pending' WHERE PurchaseID='$PURID'");

 	echo "<script>location='Purchase_Detail.php?PurchaseID=$PURID'</script>";
 }
}


$PurchaseID=$_GET['PurchaseID'];

$query1="SELECT *
		 FROM purchase p, supplier s, purchasedetail pd
				WHERE p.PurchaseID='$PurchaseID'
				AND pd.PurchaseID=p.PurchaseID
				AND p.SupplierID=s.SupplierID";
$ret1=mysqli_query($con,$query1);
$array1=mysqli_fetch_array($ret1);

$query2="SELECT * 
		 From supplier s, purchase p, purchasedetail pd, product pr, model m 
				where s.SupplierID=p.SupplierID 
				and p.PurchaseID=pd.PurchaseID 
				and pr.ProductID=pd.ProductID 
				and pr.ModelID=m.ModelID 
				and p.PurchaseID='$PurchaseID' ";
$ret2=mysqli_query($con,$query2);

?>
<html>
<head>
	<!--smallheader end-->
	</div>
	</div>
	</div>
	</div>
	</div>
	<title>Purchase Detail : <?php echo $PurchaseID ?></title>
</head>
<body>

	
<form>

<fieldset>
<legend>Purchase Detail Report for PurchaseID : <?php echo $PurchaseID ?></legend>
<table align="center">
<tr>
	<td align="center">
		<h3> TechX Company</h3>
		<p><small>No-99 Insein Road, Hledan Township, Yangon</small></p>
	</td>
</tr>
<tr>
	<td>
		<table border="1" cellpadding="13" align="center">
		<tr>
			<td>PurchaseID : <?php echo $PurchaseID ?></td>
			<td>Date : <?php echo $array1['Date'] ?></td>
			<td>Action</td>
		</tr>
		<tr>
			<td>Supplier : <?php echo $array1['SupplierName'] ?></td>
			<td>Status : <?php echo $array1['Status'] ?></td>
			<?php 
			$PURID=$_REQUEST['PurchaseID'];
				if($array1['Status']=="Pending")
				{
					echo '<td><a href="Purchase_Detail.php?PurchaseID='.$PURID.'&action=complete" class="btn btn-primary btn-sm">Complete</a></td>';
					
				}
				else if($array1['Status']=="Complete")
				{
					echo '<td><a href="Purchase_Detail.php?PurchaseID='.$PURID.'&action=pending" class="btn btn-primary btn-sm">Pending</a></td>';
					
				}
			 ?>
		</tr>
		</table>
	</td>
</tr>
<tr>
	<td>
	<hr/>
	<table cellpadding="15" border="1">
	<tr align="center">
		<th>ModelName</th>
		
		<th>Price</th>
		<th>Quantity</th>
		<th>SubAmount</th>
	</tr>
	<?php  
	$count=mysqli_num_rows($ret2);

	for ($i=0;$i<$count;$i++) 
	{ 
		$array2=mysqli_fetch_array($ret2);

		echo "<tr align='center'>";
		echo "<td>" . $array2['ModelName'] . "</td>";
		
		echo "<td>" . $array2['PurchasePrice'] . "</td>";
		echo "<td>" . $array2['PurchaseQuantity'] . "</td>";
		echo "<td>" . $array2['PurchaseQuantity'] * $array2['PurchasePrice']  . " MMK</td>";
		echo "</tr>";
	}
	?>
	</table>
	</td>
</tr>
<tr>
	<td align="right">
	<hr/>
	Total Amount : <b><?php echo $array1['TotalAmount'] ?> </b> MMK <br/>
	NetAmount : <b><?php echo $array1['NetAmount'] ?></b> MMK <br/>
	GovTax : <b><?php echo $array1['GovTax'] ?></b> MMK<br/>
	TotalQty : <b><?php echo $array1['TotalQuantity'] ?></b> Pcs
	</td>
</tr>
<tr>
	<td align="center">
	<hr/>
	Thanks for Purchasing
	</td>
</tr>
</table>

<!--Print Button ___________________________________-->
<div class="text-center">
<script>var pfHeaderImgUrl = '';var pfHeaderTagline = 'Order%20Report';var pfdisableClickToDel = 0;var pfHideImages = 0;var pfImageDisplayStyle = 'right';var pfDisablePDF = 0;var pfDisableEmail = 0;var pfDisablePrint = 0;var pfCustomCSS = '';var pfBtVersion='1';(function(){var js, pf;pf = document.createElement('script');pf.type = 'text/javascript';if('https:' == document.location.protocol){js='https://pf-cdn.printfriendly.com/ssl/main.js'}else{js='http://cdn.printfriendly.com/printfriendly.js'}pf.src=js;document.getElementsByTagName('head')[0].appendChild(pf)})();</script>
<a href="http://www.printfriendly.com" target="_blank" style="color:#6D9F00;text-decoration:none;" class="printfriendly" onClick="window.print();return false;" title="Printer Friendly and PDF"><img style="border:none;-webkit-box-shadow:none;box-shadow:none;" src="http://cdn.printfriendly.com/button-print-grnw20.png" alt="Print Friendly and PDF"/></a>
<br>
<a href="PurchaseSearch.php" class="btn_3"><b> Return to Purchase Search </b></a>
</div>
<!--Print Button ___________________________________-->

</fieldset>

</form>
</body>
</html>
