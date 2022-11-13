<?php  
include('connect.php');
include('function.php');
include('headerstaff.php');

$con=mysqli_connect($host,$user,$pass,$database);

if(isset($_REQUEST['mode']))
{
	$mode=$_REQUEST['mode'];
	$RegionID=$_REQUEST['RegionID'];

	if($mode=="edit")
	{
		$Select="SELECT * FROM region where RegionID='$RegionID'";
		$Selret=mysqli_query($con,$Select);
		$array=mysqli_fetch_array($Selret);

		$txtRegionID=$array['RegionID'];
		$txtRegionName=$array['RegionName'];
		$txtDurationDate=$array['DurationDate'];
		
	}


	else if ($mode== "delete") 
	{
		$del="DELETE FROM region WHERE RegionID='$RegionID' ";
		$delquery=mysqli_query($con,$del);
		if($delquery)
		{
		echo"<script>window.location='Region.php'</script>";
		}

	}


}

if(isset($_POST['btnUpdate']))
{
	$txtRegionID=$_POST['txtRegionID'];


	$txtRegionName=$_POST['txtRegionName'];
	$txtDurationDate=$_POST['txtDurationDate'];
	



   $update="UPDATE region
		 SET RegionName='$txtRegionName',
		 	 DurationDate='$txtDurationDate'
		 	 WHERE RegionID='$txtRegionID'";

$retupdate=mysqli_query($con,$update);

if($retupdate)
{
	echo"<script>window.alert('Region is Updated')</script>";
	echo"<script>window.location='Region.php'</script>";
}
else
{
	echo"<script>window.alert('Sorry, Region is Unsuccessful')</script>";
	echo"<script>window.location='Region.php'</script>";
}
}




if(isset($_POST['btnsave'])) 
{
	
	$txtRegionID=AutoID('region','RegionID','Reg-',4);

	$txtRegionName=$_POST['txtRegionName'];
	$txtDurationDate=$_POST['txtDurationDate'];
	

	$checkregion="SELECT * FROM region
				 WHERE RegionName='$txtRegionName'";
	$result=mysqli_query($con,$checkregion);
	$count=mysqli_num_rows($result); 

	if($count!=0) 
	{
		echo "<script>window.alert('$txtRegionName Region is Already Exist !!!')</script>";
		echo "<script>window.location='Region.php'</script>";
		exit();
	}


//Insert User Data---------------------------------------------

	 $insert="INSERT INTO `region`(`RegionID`, `RegionName`, `DurationDate`)
			 VALUES('$txtRegionID','$txtRegionName','$txtDurationDate')";
	$result=mysqli_query($con,$insert);

//--------------------------------------------------------------

	if($result) //True 
	{
		echo "<script>window.alert('$txtRegionName Region is Inserted.')</script>";
		echo "<script>window.location='Region.php'</script>";
	}
	else
	{
		echo "<script>Something wrong in Region Inserting " . mysqli_error() . "</script>";
		echo "<script>window.location='Region.php'</script>";
	}
}
?>

<html>
<head>

<script type="text/javascript" src="js/jquery-3.1.1.slim.min.js"></script>
<link rel="stylesheet" type="text/css" href="DataTables/datatables.min.css"/>
<script type="text/javascript" src="DataTables/datatables.min.js"></script>

<title>Region Page</title>

</head>

<body>

<script>
$(document).ready( function () 
{
	$('#datatableid').DataTable();
} );
</script>
<h3 align="center">Region Registration</h3>

<form action="Region.php" method="post" enctype="multipart/form-data">

	<table cellpadding="9" align="center">
		<input type="hidden" name="txtRegionID" value="<?php if (isset($txtRegionID)){echo $txtRegionID;} ?>">	
	
<tr>
	<td>Region Name :</td>
	<td>
	<input type="text" name="txtRegionName" placeholder="Enter Region name" value="<?php if (isset($txtRegionName)){echo $txtRegionName;} ?>"  required/>
	</td>
</tr>
<tr>
	<td>Duration Date :</td>
	<td>
	<input type="text" name="txtDurationDate" placeholder="eg. 2-5 days" value="<?php if (isset($txtDurationDate)){echo $txtDurationDate;} ?>"  required/>
	</td>
</tr>




<tr>
<p></p>
	
				<?php

					if(isset($txtRegionID))
						{
							echo "<td><input type='submit' name='btnUpdate' class='btn_4' value='Update'></td>";
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
<legend>Region Info Listing:</legend>
<?php  
$query="SELECT * FROM region";
$result=mysqli_query($con,$query);
$count=mysqli_num_rows($result);

if($count<1) 
{
	echo "<p>No Region Data Found.</p>";
	exit();
}
?>
<table id="datatableid" class="display">
<thead>
<tr align="center">
	<th>Region ID</th>
	<th>Region Name</th>
	<th>Duration Date</th>
	<th>Action</th>
</tr>
</thead>
</body>
<?php  
for ($i=0;$i<$count;$i++) 
{ 
	$array=mysqli_fetch_array($result);

	$RegionID=$array['RegionID'];

	$RegionName=$array['RegionName'];	
	$DurationDate=$array['DurationDate'];	
	
		


	echo "<tr align='center'>";
		echo "<td>$RegionID</td>";
		echo "<td>$RegionName</td>";
		echo "<td>$DurationDate</td>";
		
		
	
		
		
		echo "<td align='center'>
			  <a href='Region.php?mode=edit&RegionID=$RegionID' class='btn_3'>Edit</a> |
			  <a href='Region.php?mode=delete&RegionID=$RegionID' class='btn_3'>Delete</a>
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