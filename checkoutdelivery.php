<?php 
session_start(); 
include('connect.php'); 
include('header.php');


$con=mysqli_connect($host,$user,$pass,$database);
if(isset($_REQUEST['OrderID'])) 
{
	$OrderID=$_REQUEST['OrderID'];

	$query="SELECT * FROM Orders WHERE OrderID='$OrderID'";
	$result=mysqli_query($con,$query);
	$array=mysqli_fetch_array($result);


	$OrderID=$array['OrderID'];
}

if (isset($_POST['btnsave'])) 
{

	$OrderID=$_POST['OrderID'];
	$cboregion=$_POST['cboregion'];
	$txtaddress=$_POST['txtaddress'];
	$EnrollDate=$_POST['EnrollDate'];
	$txtphone=$_POST['txtphone'];

	$insert="INSERT into delivery values('$OrderID',$EnrollDate','$txtphone',''$txtaddress','$cboregion')";
	$run=mysqli_query($con,$insert);
	if ($run) 
	{
		echo "<script>window.alert('Delivery info is Successfully Confirmed!')</script>";
		echo "<script>window.location='PrintInVoice.php?OrderID=$OrderID'</script>";
	}
	else
	{
		echo mysqli_error();
	}
}




 ?>
 <html>
 <head>
 	<title>Delivery Form</title>

<script type="text/javascript" src="js/jquery-3.1.1.slim.min.js"></script>
<link rel="stylesheet" type="text/css" href="DataTables/datatables.min.css"/>
<script type="text/javascript" src="DataTables/datatables.min.js"></script>


 <script type="text/javascript">

function showDuration()
{
  var element=document.getElementById("singleSelect");
  var op=element.options[element.selectedIndex].getAttribute("data-value2");
  document.getElementById("durationbox").value=op;
}
</script>
 </head>
 <body>
 	<script>
$(document).ready( function () 
{
	$('#datatableid').DataTable();
} );
</script>
 	<fieldset><legend><h2>Fill Delivery Information</h2></legend>
 <form action="Delivery.php" method="POST">
 	<input type="hidden" name="OrderID" value="<?php echo $OrderID ?>">
 	<table  id="datatableid" class="display">
	<tr>
	<td>Choose Region</td>
	<td>
	<select name="cboregion" id="singleSelect" onChange="showDuration()">
		<option>Choose Region</option>
		<?php 
		$query="SELECT * FROM Region";
		$ret=mysql_query($query);
		$count=mysql_num_rows($ret);

		for ($i=0; $i <$count ; $i++) 
		{ 
			$row=mysql_fetch_array($ret);

			 echo "<option value='".$row['RegionID']."' data-value2='".$row['DurationDate']."'>".$row['RegionName']."</option>";
		}

		 ?>	 
	</select>
	</td>
	</tr>

	<tr><td>Delivery Duration</td>
    <td><input id="durationbox" type="text" name="duration" readonly></td>

    <tr><td>Enroll Date</td>
    <td><input type="text" name="EnrollDate" 
      value="<?php echo date('d-M-Y')?>" readonly></td></tr>

 		<tr>
 			<td>Delivery Address</td>
 			<td><textarea name="txtaddress" placeholder="Enter Detail Address" required></textarea></td>
 		</tr>

 		<tr>
 			<td>Delivery PhoneNumber</td>
 			<td><input type="text" name="txtphone" placeholder="Enter Phone Number" required></td>
 		</tr>

 		<tr>
 			<td></td>
 			<td><input type="submit" name="btnsave" class="btn_4" value="Confirm">
 				<input type="reset" name="btnclear" class="btn_4" value="Clear">
 			</td>
 		</tr>
 	</table>
 	</fieldset>
 </form>
 </body>
 </html>
