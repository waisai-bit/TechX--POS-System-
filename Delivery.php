<?php  
include('connect.php');
include('function.php');
include('headerstaff.php');

$con=mysqli_connect($host,$user,$pass,$database);

if(isset($_REQUEST['mode']))
{
	$mode=$_REQUEST['mode'];
	$DeliveryID=$_REQUEST['DeliveryID'];

	if($mode=="edit")
	{
		$Select="SELECT * FROM delivery d, region r, staff s where d.RegionID=r.RegionID and d.StaffID=s.StaffID and d.DeliveryID='$DeliveryID'";
		$Selret=mysqli_query($con,$Select);
		$array=mysqli_fetch_array($Selret);

		$RegionID=$array['RegionID'];
		$StaffID=$array['StaffID'];
		$cboRegionName=$array['RegionName'];
		$cboStaffName=$array['StaffName'];


		$txtDeliveryID=$array['DeliveryID'];
		$txtTransportationType=$array['Transportation_Type'];
		$txtTransportation=$array['Transportation'];
		$rdoStatus=$array['Status'];
	}


	else if ($mode== "delete") 
	{
		$del="DELETE FROM delivery WHERE DeliveryID='$DeliveryID' ";
		$delquery=mysqli_query($con,$del);
		if($delquery)
		{
		echo"<script>window.location='Delivery.php'</script>";
		}

	}


}

if(isset($_POST['btnUpdate']))
{
	$txtDeliveryID=$_POST['txtDeliveryID'];

	$txtTransportation=$_POST['txtTransportation'];
	$txtTransportationType=$_POST['txtTransportationType'];
	$rdoStatus=$_POST['rdoStatus'];
	$cboRegionID=$_POST['cboRegionID'];
	$cboStaffID=$_POST['cboStaffID'];



   $update="UPDATE delivery
		 SET Transportation='$txtTransportation',
		 	 Transportation_Type='$txtTransportationType',
		 	 Status='$rdoStatus',
		 	 RegionID='$cboRegionID',
		 	 StaffID='$cboStaffID'
		 	 WHERE DeliveryID='$txtDeliveryID'";

$retupdate=mysqli_query($con,$update);

if($retupdate)
{
	echo"<script>window.alert('Delivery info is Updated')</script>";
	echo"<script>window.location='Delivery.php'</script>";
}
else
{
	echo"<script>window.alert('Sorry, Delivery info is Unsuccessful')</script>";
	echo"<script>window.location='Delivery.php'</script>";
}
}




if(isset($_POST['btnsave'])) 
{
	
	$txtDeliveryID=AutoID('delivery','DeliveryID','Deli-',4);

	$txtTransportation=$_POST['txtTransportation'];
	$txtTransportationType=$_POST['txtTransportationType'];
	$rdoStatus=$_POST['rdoStatus'];
	$cboRegionID=$_POST['cboRegionID'];
	$cboStaffID=$_POST['cboStaffID'];



//Insert User Data---------------------------------------------

	 $insert="INSERT INTO `delivery`(`DeliveryID`, `Transportation`,`Transportation_Type`, `Status`,`RegionID`, `StaffID`)
			 VALUES('$txtDeliveryID','$txtTransportation','$txtTransportationType','$rdoStatus', '$cboRegionID', '$cboStaffID')";
	$result=mysqli_query($con,$insert);

//--------------------------------------------------------------

	if($result) //True 
	{
		echo "<script>window.alert('Delivery info is Inserted.')</script>";
		echo "<script>window.location='Delivery.php'</script>";
	}
	else
	{
		echo "<script>Something wrong in Delivery Inserting " . mysqli_error() . "</script>";
		echo "<script>window.location='Delivery.php'</script>";
	}
}
?>

<html>
<head>

<script type="text/javascript" src="js/jquery-3.1.1.slim.min.js"></script>
<link rel="stylesheet" type="text/css" href="DataTables/datatables.min.css"/>
<script type="text/javascript" src="DataTables/datatables.min.js"></script>

<title>Delivery Page</title>

</head>

<body>

<script>
$(document).ready( function () 
{
	$('#datatableid').DataTable();
} );
</script>
<h3 align="center">Delivery Registration</h3>

<form action="Delivery.php" method="post" enctype="multipart/form-data">

	<table cellpadding="9" align="center">
		<input type="hidden" name="txtDeliveryID" value="<?php if (isset($txtDeliveryID)){echo $txtDeliveryID;} ?>">	
<tr>
	<td>Transportation  :</td>
	<td>
	<input type="text" name="txtTransportation" placeholder="Enter Transportation" value="<?php if (isset($txtTransportation)){echo $txtTransportation;} ?>"  required/>
	</td>
</tr>
<tr>
	<td>Transportation Type :</td>
	<td>
	<input type="text" name="txtTransportationType" placeholder="Enter Transportation Type" value="<?php if (isset($txtTransportationType)){echo $txtTransportationType;} ?>"  required/>
	</td>
</tr>

<tr>
		<td>Region Name :</td>
		<td>
			<select name="cboRegionID" required>
				<?php if (isset($cboRegionName))
				{
					echo "<option value='$RegionID'>".$cboRegionName."</option>";
				}
				else
				{
					?>
				<option>SELECT Region</option>
					<?php
				} ?>
				<?php
				$run=mysqli_query($con,"SELECT * FROM region");
				$c=mysqli_num_rows($run);
				for($i=0;$i<$c;$i++)
				{
					$array=mysqli_fetch_array($run);
						$RegionID=$array['RegionID'];
						$RegionName=$array['RegionName'];
						echo "<option value='$RegionID'>($RegionID) $RegionName</option>";
				}
	?>
	</select>

	</td>
</tr>
<tr>
		<td>Staff Name :</td>
		<td>
			<select name="cboStaffID" required>
				<?php if (isset($cboStaffName))
				{
					echo "<option value='$StaffID'>".$cboStaffName."</option>";
				}
				else
				{
					?>
				<option>SELECT Staff</option>
					<?php
				} ?>
				<?php
				$run=mysqli_query($con,"SELECT * FROM staff");
				$c=mysqli_num_rows($run);
				for($i=0;$i<$c;$i++)
				{
					$array=mysqli_fetch_array($run);
						$StaffID=$array['StaffID'];
						$StaffName=$array['StaffName'];
						echo "<option value='$StaffID'>($StaffID) $StaffName</option>";
				}
	?>
	</select>

	</td>
</tr>

<tr> <td> Status : </td>
<?php 

if(isset($_REQUEST['mode']))
{
	$mode=$_REQUEST['mode'];
	$DeliveryID=$_REQUEST['DeliveryID'];
if($mode=="edit")
{
	if($rdoStatus=="Pending")
	{

		echo"<td><input type='radio' name='rdoStatus' value='Pending' checked>Pending";
		
		echo"<input type='radio' name='rdoStatus' value='Completed' >Completed</td>";

	}
	elseif ($rdoStatus=="Completed")
	{
		echo"<td><input type='radio' name='rdoStatus' value='Pending' >Pending";
		
		echo"<input type='radio' name='rdoStatus' value='Completed' checked >Completed</td>";
	}
}
}
else
{
	echo"<td><input type='radio' name='rdoStatus' value='Pending' checked required>Pending";
	echo"<input type='radio' name='rdoStatus' value='Completed' required>Completed</td>";
}
?>
</tr>


<tr>
<p></p>
	
				<?php

					if(isset($txtDeliveryID))
						{
							echo "<td colspan='2' align='right'><input type='submit' name='btnUpdate' class='btn_4' value='Update'></td>";
						}

					else
					{

						echo "<td colspan='2' align='right'><input type='submit' name='btnsave' class='btn_4' value='Save'>    ";
						echo "<input type='reset' class='btn_4' value='Clear'></td>";
					}
					?>

</tr>
	</table>
</form>


<fieldset>
<legend>Delivery Info Listing:</legend>
<?php  
$query="SELECT * FROM delivery d, region r, staff s where d.RegionID=r.RegionID and d.StaffID=s.StaffID";
$result=mysqli_query($con,$query);
$count=mysqli_num_rows($result);

if($count<1) 
{
	echo "<p>No Delivery Data Found.</p>";
	exit();
}
?>
<table id="datatableid" class="display">
<thead>
<tr align="center">
	<th>Delivery ID</th>
	<th>Transportation</th>
	<th>Transportation Type</th>
	<th>Region Name</th>
	<th>Staff Name</th>
 	<th>Status</th>

	<th>Action</th>
</tr>
</thead>
</body>
<?php  
for ($i=0;$i<$count;$i++) 
{ 
	$array=mysqli_fetch_array($result);

	$DeliveryID=$array['DeliveryID'];

	$Transportation=$array['Transportation'];	
	$Transportation_Type=$array['Transportation_Type'];	
	$RegionName=$array['RegionName'];
	$StaffName=$array['StaffName'];
	$Status=$array['Status'];	
		


	echo "<tr align='center'>";
		echo "<td>$DeliveryID</td>";
		echo "<td>$Transportation</td>";
		echo "<td>$Transportation_Type</td>";
		echo "<td>$RegionName</td>";
		echo "<td>$StaffName</td>";
		echo "<td>$Status</td>";
		
		
		echo "<td align='center'>
			  <a href='Delivery.php?mode=edit&DeliveryID=$DeliveryID' class='btn_3'>Edit</a> |
			  <a href='Delivery.php?mode=delete&DeliveryID=$DeliveryID' class='btn_3'>Delete</a>
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