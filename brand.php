<?php  
include('connect.php');
include('function.php');
include('headerstaff.php');

$con=mysqli_connect($host,$user,$pass,$database);

if(isset($_REQUEST['mode']))
{
	$mode=$_REQUEST['mode'];
	$BrandID=$_REQUEST['BrandID'];

	if($mode=="edit")
	{
		$Select="SELECT * FROM brand where BrandID='$BrandID'";
		$Selret=mysqli_query($con,$Select);
		$array=mysqli_fetch_array($Selret);

		$txtBrandID=$array['BrandID'];
		$txtBrandName=$array['BrandName'];
		$txtBrandLogo=$array['BrandLogo'];
		$rdoStatus=$array['Status'];
	}


	else if ($mode== "delete") 
	{
		$del="DELETE FROM brand WHERE BrandID='$BrandID' ";
		$delquery=mysqli_query($con,$del);
		if($delquery)
		{
		echo"<script>window.location='brand.php'</script>";
		}

	}


}

if(isset($_POST['btnUpdate']))
{
	$txtBrandID=$_POST['txtBrandID'];


	$txtBrandName=$_POST['txtBrandName'];
	$rdoStatus=$_POST['rdoStatus'];

	$txtBrandLogo=$_FILES['txtBrandLogo']['name'];
	$folder="BrandLogo/";
		if ($txtBrandLogo) 
		{
			$txtBrandLogo=$folder."_".$txtBrandLogo;
			$copied=copy($_FILES['txtBrandLogo']['tmp_name'],$txtBrandLogo);
			if (!$copied) 
				{
					exit("Problem occurred.Cannot upload in Brand Logo");
				}	

		}


   $update="UPDATE brand
		 SET BrandName='$txtBrandName',
		 	 BrandLogo='$txtBrandLogo',
		 	 Status='$rdoStatus'
		 	 WHERE BrandID='$txtBrandID'";

$retupdate=mysqli_query($con,$update);

if($retupdate)
{
	echo"<script>window.alert('Brand is Updated')</script>";
	echo"<script>window.location='brand.php'</script>";
}
else
{
	echo"<script>window.alert('Sorry, Brand is Unsuccessful')</script>";
	echo"<script>window.location='brand.php'</script>";
}
}




if(isset($_POST['btnsave'])) 
{
	
	$txtBrandID=AutoID('brand','BrandID','B-',4);

	$txtBrandName=$_POST['txtBrandName'];
	$rdoStatus=$_POST['rdoStatus'];

	$txtBrandLogo=$_FILES['txtBrandLogo']['name'];
	$folder="BrandLogo/";
		if ($txtBrandLogo) 
		{
			$txtBrandLogo=$folder."_".$txtBrandLogo;
			$copied=copy($_FILES['txtBrandLogo']['tmp_name'],$txtBrandLogo);
			if (!$copied) 
				{
					exit("Problem occurred.Cannot upload in Brand Logo");
				}	

		}

//Insert User Data---------------------------------------------

	 $insert="INSERT INTO `brand`(`BrandID`, `BrandName`, `BrandLogo`, `Status`)
			 VALUES('$txtBrandID','$txtBrandName','$txtBrandLogo','$rdoStatus')";
	$result=mysqli_query($con,$insert);

//--------------------------------------------------------------

	if($result) //True 
	{
		echo "<script>window.alert('Brand $txtBrandName Inserting is Completed.')</script>";
		echo "<script>window.location='brand.php'</script>";
	}
	else
	{
		echo "<script>Something wrong in Brand Inserting " . mysqli_error() . "</script>";
		echo "<script>window.location='brand.php'</script>";
	}
}
?>

<html>
<head>

<script type="text/javascript" src="js/jquery-3.1.1.slim.min.js"></script>
<link rel="stylesheet" type="text/css" href="DataTables/datatables.min.css"/>
<script type="text/javascript" src="DataTables/datatables.min.js"></script>

<title>Brand Page</title>

</head>

<body>

<script>
$(document).ready( function () 
{
	$('#datatableid').DataTable();
} );
</script>
<h3 align="center">Brand Registration</h3>

<form action="brand.php" method="post" enctype="multipart/form-data">

	<table cellpadding="4" align="center">
		<input type="hidden" name="txtBrandID" value="<?php if (isset($txtBrandID)){echo $txtBrandID;} ?>">	
	
<tr>
	<td>Brand Name</td>
	<td>
	<input type="text" name="txtBrandName" placeholder="Eg.SAMSUNG" value="<?php if (isset($txtBrandName)){echo $txtBrandName;} ?>"  required/>
	</td>
</tr>
<tr>
	<td>Brand Logo</td>
	<td>
	<input type="File" name="txtBrandLogo" required/>
	</td>
</tr>


<tr>
<?php 

if(isset($_REQUEST['mode']))
{
	$mode=$_REQUEST['mode'];
	$BrandID=$_REQUEST['BrandID'];
if($mode=="edit")
{
	if($rdoStatus=="Active")
	{

		echo"<td><input type='radio' name='rdoStatus' value='Active' checked>Active</td>";
		
		echo"<td><input type='radio' name='rdoStatus' value='InActive' >InActive</td>";

	}
	elseif ($rdoStatus=="InActive")
	{
		echo"<td><input type='radio' name='rdoStatus' value='Active' >Active</td>";
		
		echo"<td><input type='radio' name='rdoStatus' value='InActive' checked >InActive</td>";
	}
}
}
else
{
	echo"<td><input type='radio' name='rdoStatus' value='Active' checked required>Active</td>";
	echo"<td><input type='radio' name='rdoStatus' value='InActive' required>InActive</td>";
}
?>
</tr>
<tr>
<p></p>
	
				<?php

					if(isset($txtBrandID))
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
<legend>Brand Info Listing:</legend>
<?php  
$query="SELECT * FROM brand";
$result=mysqli_query($con,$query);
$count=mysqli_num_rows($result);

if($count<1) 
{
	echo "<p>No Model Data Found.</p>";
	exit();
}
?>
<table id="datatableid" class="display">
<thead>
<tr align="center">
	<th>Brand ID</th>
	<th>Brand Name</th>
	<th>Brand Logo </th>
	<th>Status</th>



	<th>Action</th>
</tr>
</thead>
</body>
<?php  
for ($i=0;$i<$count;$i++) 
{ 
	$array=mysqli_fetch_array($result);

	$BrandID=$array['BrandID'];


	$BrandName=$array['BrandName'];
	
	$BrandLogo=$array['BrandLogo'];
	

	$Status=$array['Status'];	


	echo "<tr align='center'>";
		echo "<td>$BrandID</td>";
		echo "<td>$BrandName</td>";
		
		echo"<td><img src='".$array['BrandLogo']."' width='100px' Height='90px'></td>";
		
		
		
		echo "<td>$Status</td>";
		
		
		echo "<td align='center'>
			  <a href='brand.php?mode=edit&BrandID=$BrandID' class='btn_3'>Edit</a> |
			  <a href='brand.php?mode=delete&BrandID=$BrandID' class='btn_3'>Delete</a>
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