<?php  
include('connect.php');
include('function.php');
include('headerstaff.php');

$con=mysqli_connect($host,$user,$pass,$database);

if(isset($_REQUEST['mode']))
{
	$mode=$_REQUEST['mode'];
	$SupplierID=$_REQUEST['SupplierID'];

	if($mode=="edit")
	{
		$Select="SELECT * FROM supplier where SupplierID='$SupplierID'";
		$Selret=mysqli_query($con,$Select);
		$selrow=mysqli_fetch_array($Selret);
		$SuID=$selrow['SupplierID'];
		$SuName=$selrow['SupplierName'];
		$SuPhoneno=$selrow['PhoneNo'];
		$SuEmail=$selrow['Email'];
		$SuAddress=$selrow['Address'];
	}


	else if ($mode== "delete") 
	{
		$del="DELETE FROM supplier WHERE SupplierID='$SupplierID' ";
		$delquery=mysqli_query($con,$del);
	}

}

if(isset($_POST['btnUpdate']))
{

	$suid=$_POST['txtsuid'];
	$Suppliername=$_POST['txtsuname'];
	$Phoneno=$_POST['txtphoneno'];
	$E_mail=$_POST['txtemail'];
	$Address=$_POST['txtaddress'];

	$update="UPDATE supplier
		 SET SupplierName='$Suppliername',
		 	 PhoneNo='$Phoneno',
		 	 Email='$E_mail',
		 	 Address='$Address'
		 	 WHERE SupplierID='$suid'"; 

$retupdate=mysqli_query($con,$update);

if($retupdate)
{
	echo"<script>window.alert('Succesfully $Suppliername Supplier Info is Updated')</script>";
	echo"<script>window.location='Supplier.php'</script>";
}
else
{
	echo"<script>window.alert('Sorry, Update is Unsuccessful')</script>";
	echo"<script>window.location='Supplier.php'</script>";
}
}




if(isset($_POST['btnsave'])) 
{
	$supplierid=AutoID('supplier','SupplierID','Sp-',4);
	$txtsname=$_POST['txtsuname'];
	$txtphoneno=$_POST['txtphoneno'];
	$txtemail=$_POST['txtemail'];
	$txtaddress=$_POST['txtaddress'];
	$checkemail="SELECT * FROM Supplier
				 WHERE Email='$txtemail'";
	$result=mysqli_query($con,$checkemail);
	$count=mysqli_num_rows($result); 

	if($count!=0) 
	{
		echo "<script>window.alert('Supplier Email $txtemail Already Exist.')</script>";
		echo "<script>window.location='Supplier.php'</script>";
		exit();
	}
	//Insert User Data
	$insert="INSERT INTO `supplier`(`SupplierID`,`SupplierName`, `PhoneNo`, `Email`, `Address`)
	        VALUES ('$supplierid','$txtsname','$txtphoneno','$txtemail','$txtaddress')";
	$result=mysqli_query($con,$insert);

	//-----------------------------------------------------

	if($result) //True 
	{
		echo "<script>window.alert('Supplier $txtsname is Saved.')</script>";
		echo "<script>window.location='Supplier.php'</script>";
	}
	else
	{
		echo "<p>Something wrong in Supplier Register " . mysqli_error() . "</p>";
		echo "<script>window.location='Supplier.php'</script>";
	}
}
?>

<html>
<head>

<script type="text/javascript" src="js/jquery-3.1.1.slim.min.js"></script>
<link rel="stylesheet" type="text/css" href="DataTables/datatables.min.css"/>
<script type="text/javascript" src="DataTables/datatables.min.js"></script>

<title>Supplier Register Page</title>

</head>

<body>

<script>
$(document).ready( function () 
{
	$('#datatableid').DataTable();
} );
</script>
<h3 align="center">Supplier Registration</h3>

<form action="Supplier.php" method="post">

	<table cellpadding="4" align="center">
		<input type="hidden" name="txtsuid" value="<?php if (isset($SuID)){echo $SuID;} ?>">	
		<tr>
			<td><i class="fa fa-user" aria-hidden="true">Suppplier Name :</td>
		</tr>
		<tr>
			<td>
			<input type="text" name="txtsuname" placeholder="Enter Your Name" value="<?php if (isset($SuName)){echo $SuName;} ?>"required></td>
		</tr>
	
	<tr>
		<td><i class="glyphicon glyphicon-earphone" aria-hidden="true">Phone Number :</td>
	</tr>	
	<tr>
		<td>
			<input type="text" name="txtphoneno" placeholder="Enter Your Phone Number" value="<?php if (isset($SuPhoneno)){echo $SuPhoneno;} ?>"required>
		</td>
	</tr>

	<tr>
		<td>E-mail :</td>
	</tr>

	<tr>
		<td>
			<input type="Email" name="txtemail" placeholder="Enter Your E-mail"  value="<?php if (isset($SuEmail)){echo $SuEmail;} ?>"required>
		</td>
	</tr>

	<tr>
		<td>Address :</td>
	</tr>
	<tr>
		<td>
			<textarea name="txtaddress" placeholder="Enter Your Address" cols="20" rows="4" required><?php if (isset($SuAddress)){echo $SuAddress;} ?></textarea>
		</td>
	</tr>	
	<tr>
	
				<?php

					if(isset($SuName))
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


<fieldset>
<legend>Supplier Info Listing:</legend>
<?php  
$query="SELECT * FROM supplier";
$result=mysqli_query($con,$query);
$count=mysqli_num_rows($result);

if($count<1) 
{
	echo "<p>No Suppplier Data Found.</p>";
	exit();
}
?>
<table id="datatableid" class="display">
<thead>
<tr align="left">
	<th>Supplier ID</th>
	<th>Supplier Name</th>
	<th>Phone Number</th>
	<th>E-mail</th>
	<th>Address</th>
	<th>Action</th>
</tr>
</thead>
<tbody>
<?php  
for ($i=0;$i<$count;$i++) 
{ 
	$array=mysqli_fetch_array($result);

	$SupplierID=$array[0];
	$Suppliername=$array['SupplierName'];
	$phoneno=$array['PhoneNo'];
	$E_mail=$array['Email'];
	$Address=$array['Address'];
	echo "<tr>";
		echo "<td>$SupplierID</td>";
		echo "<td>$Suppliername</td>";
		echo "<td>$phoneno</td>";
		echo"<td>$E_mail</td>";
		echo"<td>$Address</td>";
		echo "<td>
			  <a href='Supplier.php?mode=edit&SupplierID=$SupplierID'>Edit</a> |
			  <a href='Supplier.php?mode=delete&SupplierID=$SupplierID'>Delete</a>
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