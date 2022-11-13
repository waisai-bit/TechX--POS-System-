<?php  
include('connect.php');
include('function.php');
include('headerstaff.php');

$con=mysqli_connect($host,$user,$pass,$database);

if(isset($_REQUEST['mode']))
{
	$mode=$_REQUEST['mode'];
	$StaffID=$_REQUEST['StaffID'];

	if($mode=="edit")
	{
		$Select="SELECT * FROM staff where StaffID='$StaffID'";
		$Selret=mysqli_query($con,$Select);
		$selrow=mysqli_fetch_array($Selret);

		$StaffID=$selrow['StaffID'];
		$SPosition=$selrow['Position'];
		$SName=$selrow['StaffName'];
		$SPhoneno=$selrow['PhoneNo'];
		
		$SAddress=$selrow['Address'];
		$SGender=$selrow['Gender'];	
		$SEmail=$selrow['Email'];
		$SPassword=$selrow['Password'];
		
	}
	else if ($mode== "delete") 
	{
		$del="DELETE FROM staff WHERE StaffID='$StaffID' ";
		$delquery=mysqli_query($con,$del);
		if($delquery)
		{
			echo"<script>window.location='Staff.php'</script>";
		}
	}

}

if(isset($_POST['btnUpdate']))
{
	$sid=$_POST['txtsid'];
	$name=$_POST['txtsname'];
	$positon=$_POST['txtposition'];
	$phoneno=$_POST['txtphoneno'];
	$email=$_POST['txtemail'];
	$password=$_POST['txtpassword'];
	$address=$_POST['txtaddress'];
	$gender=$_POST['rdogender'];
	


$update="UPDATE staff
		 SET StaffName='$name',
		 	 Position='$positon',
		 	 Email='$email',
		 	 Password='$password',
		 	 PhoneNo='$phoneno',
		 	 Address='$address',
		 	 Gender='$gender'
		 	 WHERE StaffID='$sid'";

$retupdate=mysqli_query($con,$update);

if($retupdate)
{
	echo"<script>window.alert('Succesfully $name Staff Info is Updated')</script>";
	echo"<script>window.location='Staff.php'</script>";
}
else
{
	echo"<script>window.alert('Sorry, Update is Unsuccessful')".mysqli_error()."</script>";
	echo"<script>window.location='Staff.php'</script>";
}
}




if(isset($_POST['btnsave'])) 
{
	$supplierid=AutoID('staff','StaffID','S-',4);
	$name=$_POST['txtsname'];
	$positon=$_POST['txtposition'];
	$phoneno=$_POST['txtphoneno'];
	$email=$_POST['txtemail'];
	$password=$_POST['txtpassword'];
	$address=$_POST['txtaddress'];
	$gender=$_POST['rdogender'];
	$checkemail="SELECT * FROM staff
				 WHERE Email='$email'";
	$result=mysqli_query($con,$checkemail);
	$count=mysqli_num_rows($result); 

	if($count!=0) 
	{
		echo "<script>window.alert('Staff Email $email is Already Taken.')</script>";
		echo "<script>window.location='Staff.php'</script>";
		exit();
	}


	//Insert User Data
	$insert="INSERT INTO `staff`(`StaffID`, `StaffName`, `Position`, `Email`, `Password`, `PhoneNo`, `Address`, `Gender`)  
			 VALUES('$supplierid','$name','$positon','$email','$password','$phoneno','$address','$gender')";
	$result=mysqli_query($con,$insert);

	//-----------------------------------------------------

	if($result) //True 
	{
		echo "<script>window.alert('Staff Proccess Complete.')</script>";
		echo "<script>window.location='Staff.php'</script>";
	}
	else
	{
		echo "<p>Something wrong in Supplier Register " . mysqli_error() . "</p>";
		echo "<script>window.location='Staff.php'</script>";
	}
}
?>

<html>
<head>

<script type="text/javascript" src="js/jquery-3.1.1.slim.min.js"></script>
<link rel="stylesheet" type="text/css" href="DataTables/datatables.min.css"/>
<script type="text/javascript" src="DataTables/datatables.min.js"></script>

<title>Staff Register Page</title>

</head>

<body>

<script>
$(document).ready( function () 
{
	$('#datatableid').DataTable();
} );
</script>

<form action="Staff.php" method="post" enctype="multipart/form-data">
<fieldset>
<legend><h3 align="center">Staff Registration</h3></legend>
	<table cellpadding="4" align="center">
		<input type="hidden" name="txtsid" value="<?php if (isset($StaffID)){echo $StaffID;} ?>">	
		<tr>
			<td>Staff Name :</td>
		</tr>
		<tr>
			<td>
			<input type="text" name="txtsname" placeholder="Enter Your Name" value="<?php if (isset($SName)){echo $SName;} ?>" required></td>
		</tr>
	<tr>
		<td>Position :</td>
	</tr>
	<tr>
		<td>
			<input type="text" name="txtposition" placeholder="Enter Your Position" value="<?php if (isset($SPosition)){echo $SPosition;} ?>"  required>
		</td>
	</tr>
	<tr>
		<td>Phone Number :</td>
	</tr>	
	<tr>
		<td>
			<input type="text" name="txtphoneno" placeholder="Enter Your Phone Number" value="<?php if (isset($SPhoneno)){echo $SPhoneno;} ?>"  required>
		</td>
	</tr>

	<tr>
		<td>E-mail :</td>
	</tr>

	<tr>
		<td>
			<input type="Email" name="txtemail" placeholder="Enter Your E-mail" value="<?php if (isset($SEmail)){echo $SEmail;} ?>" required>
		</td>
	</tr>
	<tr>
		<td>Password :</td>
	</tr>
	<tr>
		<td>
			<input type="Password" name="txtpassword" placeholder="Enter Your Password" value="" required/>

	<tr>
		<td><Address :</td>
	</tr>
	<tr>
		<td>
			<textarea name="txtaddress" placeholder="Enter Your Address" cols="20" rows="4" required><?php if (isset($SAddress)){echo $SAddress;} ?></textarea>
		</td>
	</tr>	
	<tr>
		<td>Gender :
			<select name="rdogender">
					<?php if ($SGender=='Male')
				{
					echo "<option>".$SGender."</option>";
					echo "<option>Female</option>";
				}
				elseif ($SGender=='Female')
				{
					echo "<option>".$SGender."</option>";
					echo "<option>Male</option>";
				}
				else
				{
					echo "<option>Male</option>";
					echo "<option>Female</option>";
				}
				?>
			</select>	
		</td>
	</tr>
<p></p>
	
				<?php

					if(isset($SName))
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
</fieldset>
</form>


<fieldset>
<legend>Staff Info Listing:</legend>
<?php  
$query="SELECT * FROM staff";
$result=mysqli_query($con,$query);
$count=mysqli_num_rows($result);

if($count<1) 
{
	echo "<p>No Staff Data Found.</p>";
	exit();
}
?>
<table id="datatableid" class="display">
<thead>
<tr align="left">
	<th>Staff ID</th>
	<th>Staff Name</th>
	<th>Position</th>
	<th>Gender</th>
	<th>E-mail</th>
	<th>Password</th>
	<th>Phone Number</th>
	<th>Address</th>
	<th>Action</th>
</tr>
</thead>
</body>
<?php  
for ($i=0;$i<$count;$i++) 
{ 
	$array=mysqli_fetch_array($result);

	$StaffID=$array['StaffID'];
	$SName=$array['StaffName'];
	
	$SPosition=$array['Position'];
	$SPhoneno=$array['PhoneNo'];
	$SEmail=$array['Email'];
	$SPassword=$array['Password'];
	$SAddress=$array['Address'];
	$SGender=$array['Gender'];	

	echo "<tr>";
		echo "<td>$StaffID</td>";
		echo "<td>$SName</td>";
		
		echo "<td>$SPosition</td>";
		echo"<td>$SGender</td>";
		echo"<td>$SEmail</td>";
		echo"<td>$SPassword</td>";
		echo "<td>$SPhoneno</td>";
		echo"<td>$SAddress</td>";
		
		
		echo "<td>
			  <a href='Staff.php?mode=edit&StaffID=$StaffID' class='btn_3'>Edit</a> |
			  <a href='Staff.php?mode=delete&StaffID=$StaffID' class='btn_3'>Delete</a>
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