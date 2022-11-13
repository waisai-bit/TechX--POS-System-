<?php 
include('connect.php');
include('function.php');
include('headerstaff.php');

$con=mysqli_connect($host,$user,$pass,$database);
//edit & delete date segment of request mode value
if(isset($_REQUEST['mode']))
{
	$mode=$_REQUEST['mode'];
	$txtCategoryID=$_REQUEST['CategoryID'];

	if($mode=="edit")
	{
		$Select="SELECT * FROM category where CategoryID='$txtCategoryID'";
		$Selret=mysqli_query($con,$Select);
		$selrow=mysqli_fetch_array($Selret);
		$txtCategoryID=$selrow['CategoryID'];
		$txtCategoryName=$selrow['CategoryName'];
	}


	else if ($mode== "delete") 
	{
		$del="DELETE FROM category WHERE CategoryID='$txtCategoryID' ";
		$delquery=mysqli_query($con,$del);
	}

}

if(isset($_POST['btnUpdate']))
{

	$txtCategoryID=$_POST['txtCategoryID'];
	$txtCategoryName=$_POST['txtCategoryName'];
	

$update="UPDATE category
		 SET CategoryName='$txtCategoryName'
		 	 WHERE CategoryID='$txtCategoryID'"; 

$retupdate=mysqli_query($con,$update);

if($retupdate)
{
	echo"<script>window.alert('Succesfully $txtCategoryName Category Info is Updated')</script>";
	echo"<script>window.location='category.php'</script>";
}
else
{
	echo"<script>window.alert('Sorry, Update is Unsuccessful')" .mysqli_error(). "</script>";
	echo"<script>window.location='category.php'</script>";
}
}


//insert data segment
if(isset($_POST['btnsave'])) 
{
	$txtCategoryID=AutoID('category','CategoryID','Cat-',4);
	$txtCategoryName=$_POST['txtCategoryName'];
	
	$checkcategoryname="SELECT * FROM category
				 WHERE CategoryName='$txtCategoryName'";
	$result=mysqli_query($con,$checkcategoryname);
	$count=mysqli_num_rows($result); 

	if($count!=0) 
	{
		echo "<script>window.alert('This CategoryName $txtCategoryName is Already Taken.')</script>";
		echo "<script>window.location='category.php'</script>";
		exit();
	}
	//Insert User Data
	$insert="INSERT INTO `category`(`CategoryID`,`CategoryName`)
	        VALUES ('$txtCategoryID','$txtCategoryName')";
	$result=mysqli_query($con,$insert);

	//-----------------------------------------------------

	if($result) //True 
	{
		echo "<script>window.alert('Adding $txtCategoryName Category is Successful.')</script>";
		echo "<script>window.location='category.php'</script>";
	}
	else
	{
		echo "<script>!!!Something wrong in Category Register " . mysqli_error() . "</script>";
		echo "<script>window.location='category.php'</script>";
	}
}
?>
<html>
<head>
	<title>Category</title>

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
<form action="category.php" method="post">


<div>
	<h2 align="center">Category</h2>
</div>	
 
<fieldset>

<table cellpadding="12" align="center">
	<input type="hidden" name="txtCategoryID" value="<?php if (isset($txtCategoryID)){echo $txtCategoryID;} ?>"> 
<tr>
    <td>Category Name :
    </td>
    <td>
      <input type="name" name="txtCategoryName" placeholder="Eg. tablet" value="<?php if(isset($txtCategoryName)) {echo $txtCategoryName;} ?>" required/>
    </td>
</tr> 
<tr>
	<?php

					if(isset($txtCategoryName))
						{
							echo "<td colspan='2' align='right'><input type='submit' name='btnUpdate' class='btn_4' value='Update'></td>";
						}

					else
					{

						echo "<td colspan='2' align='right'><input type='submit' name='btnsave' class='btn_4' value='Save'>    ";
						echo "<input type='reset' value='Clear' class='btn_4'></td>";
					}
					?>
</tr>
</table>
</fieldset>



<fieldset>
<legend>Category Info Listing:</legend>
<?php  
$query="SELECT * FROM category";
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
	<th>CategoryID</th>
	<th>CategoryName</th>
	
	<th>Action</th>
</tr>
</thead>
<tbody>
<?php  
for ($i=0;$i<$count;$i++) 
{ 
	$array=mysqli_fetch_array($result);

	$CategoryID=$array['CategoryID'];
	$CategoryName=$array['CategoryName'];
	

	echo "<tr align='center'>";
		echo "<td>$CategoryID</td>";
		echo "<td>$CategoryName</td>";
		
		echo "<td>
			  <a href='category.php?mode=edit&CategoryID=$CategoryID' class='btn_3'>Edit</a> |
			  <a href='category.php?mode=delete&CategoryID=$CategoryID' class='btn_3'>Delete</a>
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