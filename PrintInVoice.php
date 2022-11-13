<?php 
session_start();
include('connect.php');
include('header.php');

$con=mysqli_connect($host,$user,$pass,$database);

$OrderID=$_REQUEST['OrderID'];

   $select="SELECT *
			FROM customer c, orders o, orderdetail od, delivery d, region r
			where c.CustomerID=o.CustomerID
			and d.RegionID=r.RegionID
			and d.DeliveryID=o.DeliveryID
			and o.OrderID=od.OrderID
			and o.OrderID='$OrderID'";
    $ret=mysqli_query($con,$select);
    $row=mysqli_fetch_array($ret);
 ?>
 <html>
 <head>
 	<title>Sale Invoice</title>
 	<link rel="stylesheet" type="text/css" href="style.css">
 </head>
 <body>
 	<div id="header">
 		Order INVOICE
 	</div>
 	<div id="identity">
 		<div id="address">
 			INFORMATION
 		</div>
 	</div>
 	<div id="customer">
 		<table id="meta">
 			<tr>
 				<td class="meta-head">Inovice</td>
 				<td><?php echo $row['OrderID']; ?> </td>
 			</tr>
 			<tr>
 				<td class="meta-head">Order Date</td>
 				<td id="date"><?php echo $row['Order_Date']; ?> </td>
 			</tr>
 			<tr>
 				<td class="meta-head">Payment Type</td>
 				<td id="date"><?php echo $row['PaymentType']; ?> </td>
 			</tr>
 			<tr>
 				<td class="meta-head">Delivery Address</td>
 				<td id="date"><?php echo $row['Delivery_Address']; ?> </td>
 			</tr>
 			<tr>
 				<td class="meta-head">Region</td>
 				<td id="date"><?php echo $row['RegionName']; ?> </td>
 			</tr>
 			<tr>
 				<td class="meta-head">Duration</td>
 				<td id="date"><?php echo $row['DurationDate']; ?> </td>
 			</tr>
 		</table>
 	</div>
 	<table id="item">

 		<tr>
 			<th>Product ID</th>
 			<th>Product Name</th> 
 			<th>Color</th>	
 			<th>Storage</th>	
 			<th>Quantity</th> 
 			<th>Price</th>		
 			<th>Sub Total</th>	
 		</tr>
<?php 


$OrderID=$_REQUEST['OrderID'];

 $selects="SELECT *
			FROM product p, orders o, orderdetail od, model m, color c, specification s
			where p.ProductID=od.ProductID
			and s.SpecificationID=m.SpecificationID
			and p.ColorID=c.ColorID
			and m.ModelID=p.ModelID
			and o.OrderID=od.OrderID
			and o.OrderID='$OrderID'";


    $rets=mysqli_query($con,$selects);
    $count=mysqli_num_rows($rets);
    for ($i=0; $i < $count ; $i++) 
    { 
    	$rows=mysqli_fetch_array($rets);

   
 ?>



 		<tr class="item-row">
 			<td class="item-name"><?php echo $rows['ProductID']; ?></td>
 			<td class="description"><?php echo $rows['ModelName']; ?></td>
 			<td class="description"><?php echo $rows['ColorName']; ?></td>
 			<td class="description"><?php echo $rows['Rom']; ?></td>
 			<td class="description"><?php echo $rows['OrderQuantity']; ?></td>
 			<td class="description"><?php echo $rows['OrderPrice']; ?></td>
 			<td class="description"><?php echo $rows['OrderPrice'] * $rows['OrderQuantity']; ?></td>
 		
 		</tr>
<?php
}
?>



 		<tr>
 	 
 			
 			<td colspan="6" align="right" class="total-line balance">Total Balance</td>
 			<td class="total-value balance"><div class="due"><?php echo $row['Total_Amount']; ?> MMK</div></td>
 		</tr>
 	</table>

 	<div id="terms">
		  <h5>Terms</h5>
		  <a href="Customer_Home.php" class="btn_3">Return To Product Display ? 
		  <textarea></textarea>
		</div>
		 <script>
		 var pfHeaderImgUrl = '';
		 var pfHeaderTagline = 'Order%20Report';
		 var pfdisableClickToDel = 0;
		 var pfHideImages = 0;
		 var pfImageDisplayStyle = 'right';
		 var pfDisablePDF = 0;
		 var pfDisableEmail = 0;
		 var pfDisablePrint = 0;
		 var pfCustomCSS = '';
		 var pfBtVersion='1';
		 (function(){
		 	var js, pf;
		 		pf = document.createElement('script');
		 		pf.type = 'text/javascript';
		 		if('https:' == document.location.protocol){
		 			js='https://pf-cdn.printfriendly.com/ssl/main.js'
		 		}
		 		else
		 		{
		 			js='http://cdn.printfriendly.com/printfriendly.js'
		 		}
		 		pf.src=js;
		 		document.getElementsByTagName('head')[0].appendChild(pf)})();
		 		</script>
		 		<div class="text-center">
                <a href="http://www.printfriendly.com" target="_blank" style="color:#6D9F00;text-decoration:none;" class="printfriendly" onClick="window.print();return false;" title="Printer Friendly and PDF"><img style="border:none;-webkit-box-shadow:none;box-shadow:none;" src="http://cdn.printfriendly.com/button-print-grnw20.png" alt="Print Friendly and PDF"/></a> <br/>
                </div>
 </body>
 </html>