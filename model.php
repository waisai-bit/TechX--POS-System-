<?php  
include('connect.php');
include('function.php');
include('headerstaff.php');

$con=mysqli_connect($host,$user,$pass,$database);

if(isset($_REQUEST['mode']))
{
	$mode=$_REQUEST['mode'];
	$ModelID=$_REQUEST['ModelID'];

	if($mode=="edit")
	{
		$Select="SELECT * FROM model m, specification s where m.SpecificationID=s.SpecificationID and m.ModelID='$ModelID'";
		$Selret=mysqli_query($con,$Select);
		$array=mysqli_fetch_array($Selret);

		$cboSpecificationCode=$array['SpecificationCode'];

		$txtModelID=$array['ModelID'];
		$txtModelName=$array['ModelName'];
		$txtfrontimg=$array['FrontImage'];
		$txtbackimg=$array['BackImage'];
		$cboSpecficiationID=$array['SpecificationID'];
	
	}


	else if ($mode== "delete") 
	{
		$del="DELETE FROM model WHERE ModelID='$ModelID' ";
		$delquery=mysqli_query($con,$del);
		if($delquery)
		{
		echo"<script>window.location='model.php'</script>";
		}

	}


}

if(isset($_POST['btnUpdate']))
{
	$txtModelID=$_POST['txtModelID'];

	$txtModelName=$_POST['txtModelName'];
	$cboSpecficiationID=$_POST['cboSpecficiationID'];

	$txtfrontimg=$_FILES['txtfrontimg']['name'];
	$folder="Productphoto/";
		if ($txtfrontimg) 
		{
			$txtfrontimg=$folder."_".$txtfrontimg;
			$copied=copy($_FILES['txtfrontimg']['tmp_name'],$txtfrontimg);
			if (!$copied) 
				{
					exit("Problem occurred.Cannot upload in Front Image");
				}	

		}

	$txtbackimg=$_FILES['txtbackimg']['name'];
	$folder="Productphoto/";
		if ($txtfrontimg) 
		{
			$txtbackimg=$folder."_".$txtbackimg;
			$copied=copy($_FILES['txtbackimg']['tmp_name'],$txtbackimg);
			if (!$copied) 
				{
					exit("Problem occurred.Cannot upload in Behind Image");
				}	

		} 

 $update="UPDATE model
		 SET ModelName='$txtModelName',
		 	 FrontImage='$txtfrontimg',
		 	 BackImage='$txtbackimg',
		 	 SpecificationID='$cboSpecficiationID'		 	
		 	 WHERE ModelID='$txtModelID'";

$retupdate=mysqli_query($con,$update);

if($retupdate)
{
	echo"<script>window.alert('Model Info is Updated')</script>";
	echo"<script>window.location='model.php'</script>";
}
else
{
	echo"<script>window.alert('Sorry, Model is Unsuccessful')</script>";
	echo"<script>window.location='model.php'</script>";
}
}




if(isset($_POST['btnsave'])) 
{
	
	$txtModelID=AutoID('model','ModelID','Mod-',4);

	$txtModelName=$_POST['txtModelName'];
	$cboSpecficiationID=$_POST['cboSpecficiationID'];

	$txtfrontimg=$_FILES['txtfrontimg']['name'];
	$folder="Productphoto/";
		if ($txtfrontimg) 
		{
			$txtfrontimg=$folder."_".$txtfrontimg;
			$copied=copy($_FILES['txtfrontimg']['tmp_name'],$txtfrontimg);
			if (!$copied) 
				{
					exit("Problem occurred.Cannot upload in Front Image");
				}	

		}

	$txtbackimg=$_FILES['txtbackimg']['name'];
	$folder="Productphoto/";
		if ($txtfrontimg) 
		{
			$txtbackimg=$folder."_".$txtbackimg;
			$copied=copy($_FILES['txtbackimg']['tmp_name'],$txtbackimg);
			if (!$copied) 
				{
					exit("Problem occurred.Cannot upload in Behind Image");
				}	

		} 

//Insert User Data---------------------------------------------

	 $insert="INSERT INTO `model`(`ModelID`, `ModelName`, `FrontImage`, `BackImage`, `SpecificationID`)
			 VALUES('$txtModelID','$txtModelName','$txtfrontimg','$txtbackimg','$cboSpecficiationID')";
	$result=mysqli_query($con,$insert);

//--------------------------------------------------------------

	if($result) //True 
	{
		echo "<script>window.alert('Model Inserting is Completed.')</script>";
		echo "<script>window.location='model.php'</script>";
	}
	else
	{
		echo "<script>Something wrong in Model Inserting " . mysqli_error() . "</script>";
		echo "<script>window.location='model.php'</script>";
	}
}
?>

<html>
<head>

<script type="text/javascript" src="js/jquery-3.1.1.slim.min.js"></script>
<link rel="stylesheet" type="text/css" href="DataTables/datatables.min.css"/>
<script type="text/javascript" src="DataTables/datatables.min.js"></script>

<title>Model Page</title>

</head>

<body>

<script>
$(document).ready( function () 
{
	$('#datatableid').DataTable();
} );
</script>
<h3 align="center">Model Registration</h3>

<form action="model.php" method="post" enctype="multipart/form-data">

	<table cellpadding="4" align="center">
		<input type="hidden" name="txtModelID" value="<?php if (isset($txtModelID)){echo $txtModelID;} ?>">	
		<tr>
			<td>Model Name : </td><td>
			<input type="text" name="txtModelName" placeholder="eg. Samsung Galaxy Note 10" value="<?php if (isset($txtModelName)){echo $txtModelName;} ?>" required></td>
		</tr>

<tr>
	<td>Front Image :</td><td>
	<input type="file" name="txtfrontimg" required/> 
	</td>
</tr>
<tr>
	<td>Back Image :</td><td>
	<input type="file" name="txtbackimg" required/> 
	</td>
</tr>

<tr>
		<td>Specification :</td>
		<td>
			<select name="cboSpecficiationID" required>
				<?php if (isset($cboSpecficiationID))
				{
					echo "<option value='$cboSpecficiationID'>".$cboSpecificationCode."</option>";
				}
				else
				{
					?>
				<option>SELECT Specification ID and Code</option>
					<?php
				} ?>
				<?php
				$run=mysqli_query($con,"SELECT * FROM Specification");
				$c=mysqli_num_rows($run);
				for($i=0;$i<$c;$i++)
				{
					$array=mysqli_fetch_array($run);
						$Specification=$array['SpecificationID'];
						$SpecificationCode=$array['SpecificationCode'];
						$Status=$array['Status'];
					echo "<option value='$Specification'>$Specification - ($SpecificationCode)</option>";
				}
	?>
	</select>

	</td>
</tr>
<tr>
<p></p>
	
				<?php

					if(isset($ModelID))
						{
							echo "<td><input type='submit' class='btn_4' name='btnUpdate' value='Update'></td>";
						}

					else
					{

						echo "<td align='right'><input type='submit' name='btnsave' class='btn_4' value='Save' </td>";
						echo "<td><input type='reset' class='btn_4' value='Clear'></td>";
					}
					?>

</tr>
	</table>
</form>


<fieldset>
<legend>Model Info Listing:</legend>
<?php  
$query="SELECT * FROM model m, specification s where m.SpecificationID=s.SpecificationID";
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
	<th>Model ID</th>
	<th>Model Name</th>
	<th>Front Image </th>
	<th>Back Image</th>
	
	<th>Specification Code</th>


	<th>Action</th>
</tr>
</thead>
</body>
<?php  
for ($i=0;$i<$count;$i++) 
{ 
	$array=mysqli_fetch_array($result);

	$ModelID=$array['ModelID'];


	$ModelName=$array['ModelName'];
	$FrontImage=$array['FrontImage'];
	$BackImage=$array['FrontImage'];
	

	$SpecificationCode=$array['SpecificationCode'];	


	echo "<tr align='center'>";
		echo "<td>$ModelID</td>";
		echo "<td>$ModelName</td>";
		
		echo"<td><img src='".$array['FrontImage']."' width='70px' Height='90px'></td>";
		echo"<td><img src='".$array['BackImage']."' width='70px' Height='90px'></td>";
		
		
		echo "<td>$SpecificationCode</td>";
		
		
		echo "<td align='center'>
			  <a href='model.php?mode=edit&ModelID=$ModelID' class='btn_3'>Edit</a> |
			  <a href='model.php?mode=delete&ModelID=$ModelID' class='btn_3'>Delete</a>
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