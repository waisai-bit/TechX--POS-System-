<?php  
include('connect.php');
include('function.php');
include('headerstaff.php');

$con=mysqli_connect($host,$user,$pass,$database);

if(isset($_REQUEST['mode']))
{
	$mode=$_REQUEST['mode'];
	$SpecificationID=$_REQUEST['SpecificationID'];

	if($mode=="edit")
	{
		$Select="SELECT * FROM specification where SpecificationID='$SpecificationID'";
		$Selret=mysqli_query($con,$Select);
		$array=mysqli_fetch_array($Selret);

		$txtSpecificationID=$array['SpecificationID'];
		$txtSpecificationCode=$array['SpecificationCode'];
		$cboSim=$array['Sim'];
		$cboNetwork=$array['Network'];
		$txtCPU=$array['CPU'];
		$txtDisplay=$array['DisplaySize'];
		$txtResolution=$array['Resolution'];
		$txtFront=$array['Front_Camera'];
		$txtRear=$array['Rear_Camera'];
		$txtRam=$array['Ram'];	
		$txtRom=$array['Rom'];	
		$cboOS=$array['OS'];	
		$txtVersion=$array['Version'];	
		$txtBattery=$array['Battery'];	
		$txtWeight=$array['Weight'];	
	}


	else if ($mode== "delete") 
	{
		$del="DELETE FROM specification WHERE SpecificationID='$SpecificationID' ";
		$delquery=mysqli_query($con,$del);
		if($delquery)
		{
		echo"<script>window.location='specification.php'</script>";
		}
	}

}

if(isset($_POST['btnUpdate']))
{
	$txtSpecificationID=$_POST['txtSpecificationID'];

	$txtSpecificationCode=$_POST['txtSpecificationCode'];
	$cboSim=$_POST['cboSim'];
	$cboNetwork=$_POST['cboNetwork'];
	$txtCPU=$_POST['txtCPU'];
	$txtDisplay=$_POST['txtDisplay'];
	$txtResolution=$_POST['txtResolution'];
	$txtFront=$_POST['txtFront'];
	$txtRear=$_POST['txtRear'];
	$txtRam=$_POST['txtRam'];
	$txtRom=$_POST['txtRom'];
	$cboOS=$_POST['cboOS'];
	$txtVersion=$_POST['txtVersion'];
	$txtBattery=$_POST['txtBattery'];
	$txtWeight=$_POST['txtWeight'];
	

 $update="UPDATE specification
		 SET SpecificationCode='$txtSpecificationCode',
		 	 Sim='$cboSim',
		 	 Network='$cboNetwork',
		 	 CPU='$txtCPU',
		 	 DisplaySize='$txtDisplay',
		 	 Resolution='$txtResolution',
		 	 Front_Camera='$txtFront',
		 	 Rear_Camera='$txtRear',
		 	 Ram='$txtRam',
		 	 Rom='$txtRom',
			 OS='$cboOS',
			 Version='$txtVersion',
			 Battery='$txtBattery',
			 Weight='$txtWeight'
		 	 WHERE SpecificationID='$txtSpecificationID'";

$retupdate=mysqli_query($con,$update);

if($retupdate)
{
	echo"<script>window.alert('Specification Info is Updated')</script>";
	echo"<script>window.location='specification.php'</script>";
}
else
{
	echo"<script>window.alert('Sorry, Update is Unsuccessful')</script>";
	echo"<script>window.location='specification.php'</script>";
}
}




if(isset($_POST['btnsave'])) 
{
	
	$txtSpecificationID=AutoID('specification','SpecificationID','Spec-',4);

	$txtSpecificationCode=$_POST['txtSpecificationCode'];
	$cboSim=$_POST['cboSim'];
	$cboNetwork=$_POST['cboNetwork'];
	$txtCPU=$_POST['txtCPU'];
	$txtDisplay=$_POST['txtDisplay'];
	$txtResolution=$_POST['txtResolution'];
	$txtFront=$_POST['txtFront'];
	$txtRear=$_POST['txtRear'];
	$txtRam=$_POST['txtRam'];
	$txtRom=$_POST['txtRom'];
	$cboOS=$_POST['cboOS'];
	$txtVersion=$_POST['txtVersion'];
	$txtBattery=$_POST['txtBattery'];
	$txtWeight=$_POST['txtWeight'];

//Insert User Data---------------------------------------------

	$insert="INSERT INTO `specification`(`SpecificationID`,`SpecificationCode`, `Sim`, `Network`, `CPU`, `DisplaySize`, `Resolution`, `Front_Camera`, `Rear_Camera`, `Ram`, `Rom`, `OS`, `Version`, `Battery`, `Weight`) 
			 VALUES('$txtSpecificationID','$txtSpecificationCode','$cboSim','$cboNetwork','$txtCPU','$txtDisplay','$txtResolution','$txtFront','$txtRear','$txtRam','$txtRom','$cboOS','$txtVersion','$txtBattery','$txtWeight')";
	$result=mysqli_query($con,$insert);

//--------------------------------------------------------------

	if($result) //True 
	{
		echo "<script>window.alert('Specification Inserting is Completed.')</script>";
		echo "<script>window.location='specification.php'</script>";
	}
	else
	{
		echo "<script>Something wrong in Specification Inserting " . mysqli_error() . "</script>";
		echo "<script>window.location='specification.php'</script>";
	}
}
?>

<html>
<head>

<script type="text/javascript" src="js/jquery-3.1.1.slim.min.js"></script>
<link rel="stylesheet" type="text/css" href="DataTables/datatables.min.css"/>
<script type="text/javascript" src="DataTables/datatables.min.js"></script>

<title>Specification Page</title>

</head>

<body>

<script>
$(document).ready( function () 
{
	$('#datatableid').DataTable();
} );
</script>
<h3 align="center">Specification Registration</h3>

<form action="specification.php" method="post" enctype="multipart/form-data">
	<table cellpadding="4" align="center">

		<input type="hidden" name="txtSpecificationID" value="<?php if (isset($txtSpecificationID)){echo $txtSpecificationID;} ?>">	
		
		<tr>
		<td>Specification Code :</td>
		<td>
			<input type="text" name="txtSpecificationCode" placeholder="Eg.ip-11pro-RA-4-RO-256" value="<?php if (isset($txtSpecificationCode)){echo $txtSpecificationCode;} ?>"  required>
		</td>
	</tr>
	<tr>
		<td>Sim :</td>
		<td>
			<select name="cboSim"  required>
				<?php if (isset($cboSim))
				{
					echo "<option>".$cboSim."</option>";
				}
				else
				{
					?>
				<option>SELECT Sim</option>
					<?php
				} ?>
				<option>Single-Sim</option>
				<option>Single-Sim + Hybrid-Sim</option>
				<option>Dual-Sim</option>
				<option>E-Sim</option>
			</select>
		</td>
	</tr>
		<td>Network :</td>
		<td>
			<select name="cboNetwork" required>
			<?php if (isset($cboNetwork))
			{
				echo"<option>".$cboNetwork. "</option>";
			}
			else
			{
				?>
			<option>SELECT Network</option>
			<?php
			} ?>
			<option>2G</option>
			<option>3G</option>
			<option>4G</option>
			<option>5G</option>
			 ?>
			</select>
		</td>
	</tr>
	<tr>
		<td>CPU :</td>
		<td>
			<input type="text" name="txtCPU" placeholder="Eg. Snapdragon 855" value="<?php if (isset($txtCPU)){echo $txtCPU;} ?>"  required>
		</td>
	</tr>

	<tr>
		<td>Display Size :</td>
		<td>
			<input type="text" name="txtDisplay" placeholder="6.18 inches"  value="<?php if (isset($txtDisplay)){echo $txtDisplay;} ?>" required>
		</td>
	</tr>
	<tr>
		<td>Resolution :</td>
		<td>
			<input type="text" name="txtResolution" placeholder="eg. AMOLED 1080x2340 px" value="<?php if (isset($txtResolution)){echo $txtResolution;} ?>" required/>
	</tr>
	<tr>
		<td>Front Camera :</td>
		<td>
			<input type="text" name="txtFront" placeholder="eg. 13 MP" value="<?php if (isset($txtFront)){echo $txtFront;} ?>" required/>
		</td>
	</tr>	
	<tr>
		<td>Rear Camera :</td>
		<td>
			<input type="text" name="txtRear" placeholder="eg. Dual 13+5 MP" value="<?php if (isset($txtRear)){echo $txtRear;} ?>" required/>
		</td>
	</tr>
	<tr>
		<td>Ram :</td>
		<td>
			<input type="text" name="txtRam" placeholder="eg. 4 GB" value="<?php if (isset($txtRam)){echo $txtRam;} ?>" required/>
		</td>
	</tr>
	<tr>
		<td>Rom :</td>
		<td>
			<input type="text" name="txtRom" placeholder="eg. 64 GB, MicroSD up to 256 GB" value="<?php if (isset($txtRom)){echo $txtRom;} ?>" required/>
		</td>
	</tr>	
	<tr>
		<td>OS :</td>
		<td>
			<select name="cboOS" required>
			<?php if (isset($cboOS))
			{
				echo"<option>".$cboOS. "</option>";
			}
			else
			{
				?>
			<option>SELECT OS</option>
			<?php
			} ?>
			<option>Android</option>
			<option>IOS</option>
			<option>Others</option>
			 ?>
			</select>
		</td>
	</tr>
	<tr>
		<td>Version :</td>
		<td>
			<input type="text" name="txtVersion" placeholder="eg. version 8.0" value="<?php if (isset($txtVersion)){echo $txtVersion;} ?>" required/>
		</td>
	</tr>	
	<tr>
		<td>Battery :</td>
		<td>
			<input type="text" name="txtBattery" placeholder="eg. 3300 mAh" value="<?php if (isset($txtBattery)){echo $txtBattery;} ?>" required/>
		</td>
	</tr>
	<tr>
		<td>Weight :</td>
		<td>
			<input type="text" name="txtWeight" placeholder="eg. 160 g" value="<?php if (isset($txtWeight)){echo $txtWeight;} ?>" required/>
		</td>
	</tr>	
	<tr>
<p></p>
	
				<?php

					if(isset($SpecificationID))
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
<legend>Specification Info Listing:</legend>
<?php  
$query="SELECT * FROM specification";
$result=mysqli_query($con,$query);
$count=mysqli_num_rows($result);

if($count<1) 
{
	echo "<p>No Specification Data Found.</p>";
	exit();
}
?>
<table id="datatableid" class="display">
<thead>
<tr align="left">
	<th>Specification ID</th>
	<th>Code</th>
	<th>Sim </th>
	<th>Network</th>
	<th>CPU</th>
	<th>Display Size</th>
	<th>Resolution</th>
	<th>Front Camera</th>
	<th>Rear Camera</th>
	<th>Ram</th>
	<th>Rom</th>
	<th>OS</th>
	<th>Version</th>
	<th>Battery</th>
	<th>Weight</th>

	<th>Action</th>
</tr>
</thead>
</body>
<?php  
for ($i=0;$i<$count;$i++) 
{ 
	$array=mysqli_fetch_array($result);

	$SpecificationID=$array['SpecificationID'];


	$SpecificationCode=$array['SpecificationCode'];
	$Sim=$array['Sim'];
	$Network=$array['Network'];
	$CPU=$array['CPU'];
	$Display=$array['DisplaySize'];
	$Resolution=$array['Resolution'];
	$Front=$array['Front_Camera'];
	$Rear=$array['Rear_Camera'];
	$Ram=$array['Ram'];	
	$Rom=$array['Rom'];	
	$OS=$array['OS'];	
	$Version=$array['Version'];	
	$Battery=$array['Battery'];	
	$Weight=$array['Weight'];	

	echo "<tr align='center'>";
		echo "<td>$SpecificationID</td>";
		echo "<td>$SpecificationCode</td>";
		echo "<td>$Sim</td>";
		echo "<td>$Network</td>";
		echo"<td>$CPU</td>";
		echo "<td>$Display</td>";
		echo"<td>$Resolution</td>";
		echo"<td>$Front</td>";
		echo"<td>$Rear</td>";
		echo "<td>$Ram</td>";
		echo"<td>$Rom</td>";
		echo"<td>$OS</td>";
		echo"<td>$Version</td>";
		echo"<td>$Battery</td>";
		echo"<td>$Weight</td>";
		
		
		echo "<td align='center'>
			  <a href='specification.php?mode=edit&SpecificationID=$SpecificationID'>Edit</a> <br/>
			  <a href='specification.php?mode=delete&SpecificationID=$SpecificationID'>Delete</a>
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