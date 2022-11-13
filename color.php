<?php 
include('connect.php');
include('function.php');
include('headerstaff.php');

$con=mysqli_connect($host,$user,$pass,$database);
//edit & delete date segment of request mode value
if(isset($_REQUEST['mode']))
{
	$mode=$_REQUEST['mode'];
	$txtColorID=$_REQUEST['ColorID'];

	if($mode=="edit")
	{
		$Select="SELECT * FROM color where ColorID='$txtColorID'";
		$Selret=mysqli_query($con,$Select);
		$selrow=mysqli_fetch_array($Selret);
		$txtColorID=$selrow['ColorID'];
		$txtColorName=$selrow['ColorName'];
	}


	else if ($mode== "delete") 
	{
		$del="DELETE FROM color WHERE ColorID='$txtColorID' ";
		$delquery=mysqli_query($con,$del);
	}

}

if(isset($_POST['btnUpdate']))
{

	$txtColorID=$_POST['txtColorID'];
	$txtColorName=$_POST['txtColorName'];
	

$update="UPDATE color
		 SET ColorName='$txtColorName'
		 	 WHERE ColorID='$txtColorID'"; 

$retupdate=mysqli_query($con,$update);

if($retupdate)
{
	echo"<script>window.alert('Succesfully $txtColorName Color is Updated')</script>";
	echo"<script>window.location='color.php'</script>";
}
else
{
	echo"<script>window.alert('Sorry, Update is Unsuccessful')" .mysqli_error(). "</script>";
	echo"<script>window.location='color.php'</script>";
}
}


//insert data segment
if(isset($_POST['btnsave'])) 
{
	$txtColorID=AutoID('color','ColorID','Col-',4);
	$txtColorName=$_POST['txtColorName'];
	
	$checkcolorname="SELECT * FROM color
				 WHERE ColorName='$txtColorName'";
	$result=mysqli_query($con,$checkcolorname);
	$count=mysqli_num_rows($result); 

	if($count!=0) 
	{
		echo "<script>window.alert('This Color Name $txtColorName is Already Exist.')</script>";
		echo "<script>window.location='color.php'</script>";
		exit();
	}
	//Insert User Data
	$insert="INSERT INTO `color`(`ColorID`,`ColorName`)
	        VALUES ('$txtColorID','$txtColorName')";
	$result=mysqli_query($con,$insert);

	//-----------------------------------------------------

	if($result) //True 
	{
		echo "<script>window.alert('Adding $txtColorName Color is Successful.')</script>";
		echo "<script>window.location='color.php'</script>";
	}
	else
	{
		echo "<script>!!!Something wrong in Color Form " . mysqli_error() . "</script>";
		echo "<script>window.location='color.php'</script>";
	}
}
?>
<html>
<head>
	<title>Color Page</title>

<script type="text/javascript" src="js/jquery-3.1.1.slim.min.js"></script>
<link rel="stylesheet" type="text/css" href="DataTables/datatables.min.css"/>
<script type="text/javascript" src="DataTables/datatables.min.js"></script>

</head>
<body>
<script>
$(document).ready( function () 
{
	$('#datatableid').DataTable();
} );
</script>
</head>
<body>
<form action="color.php" method="post">


<div>
	<h3 align="center">Color</h3>
</div>	
 
<fieldset>

<table cellpadding="12" align="center">
	<input type="hidden" name="txtColorID" value="<?php if (isset($txtColorID)){echo $txtColorID;} ?>"> 
<tr>
    <td>Color Name :
    </td>
    <td>
      <input type="name" name="txtColorName" placeholder="Eg. Red" value="<?php if(isset($txtColorName)) {echo $txtColorName;} ?>" required/>
    </td>
</tr> 
<tr>
	<?php

					if(isset($txtColorName))
						{
							echo "<td colspan='2' align='right'><input type='submit' name='btnUpdate' class='btn_4' value='Update'></td>";
						}

					else
					{

						echo "<td  align='right'><input type='submit' name='btnsave' class='btn_4' value='Save'></td>";
						echo "<td><input type='reset' class='btn_4' value='Clear'></td>";
					}
					?>
</tr>
</table>
</fieldset>



<fieldset>
<legend>Category Info Listing:</legend>
<?php  
$query="SELECT * FROM color";
$result=mysqli_query($con,$query);
$count=mysqli_num_rows($result);

if($count<1) 
{
	echo "<p>No Category Data Found.'".mysqli_error()."'</p>";
	exit();
}
?>
<table id="datatableid" class="display">
<thead>
<tr align="center">
	<th>Color ID</th>
	<th>Color Name</th>
	
	<th>Action</th>
</tr>
</thead>
<tbody>
<?php  
for ($i=0;$i<$count;$i++) 
{ 
	$array=mysqli_fetch_array($result);

	$ColorID=$array['ColorID'];
	$ColorName=$array['ColorName'];
	

	echo "<tr align='center'>";
		echo "<td>$ColorID</td>";
		echo "<td>$ColorName</td>";
		
		echo "<td>
			  <a href='color.php?mode=edit&ColorID=$ColorID' class='btn_3'>Edit</a> |
			  <a href='color.php?mode=delete&ColorID=$ColorID' class='btn_3'>Delete</a>
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