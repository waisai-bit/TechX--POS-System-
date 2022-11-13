<?php  
	session_start();
	include('connect.php');
	include('function.php');
	include('header.php');

$con=mysqli_connect($host,$user,$pass,$database);

if(isset($_POST['btnreg']))
{
	$cid=AutoID('customer','CustomerID','C-',4);
	$surname=$_POST['txtsurname'];
   	$forename=$_POST['txtforename'];
	$dateofbirth=$_POST['txtdob'];
	$address=$_POST['txtaddress'];
 	$phone=$_POST['txtphone'];
 	$gender=$_POST['rdogender'];
 	$account=$_POST['txtaccount'];
 	$password=$_POST['txtpassword'];
 	$checkemail="SELECT * FROM customer
				 WHERE AccountName='$account'";
	$result=mysqli_query($con,$checkemail);
	$count=mysqli_num_rows($result); 

	if($count!=0) 
	{
		echo "<script>window.alert('Customer Account $account Name is Already Taken.')</script>";
		echo "<script>window.location='Customer_Register.php'</script>";
		exit();
	}

	

	$Insert="INSERT INTO customer(CustomerID,Surname,Forename,Gender,DateofBirth,Address,Phoneno,AccountName,Password)
	 		VALUES('$cid','$surname','$forename','$gender','$dateofbirth','$address','$phone','$account','$password')";
	$ret=mysqli_query($con,$Insert);

	if($ret)
	{
		echo "<script>window.alert('Registration is Completed')</script>";
		echo "<script>window.location='Login.php'</script>";
	}
	else
	{
		echo "<script>window.alert('Customer Register is failed')</script>";
		echo "<script>window.location='Customer_Register.php'</script>";
	}
}


?>

<html>
<head>
<title>Customer Register Page</title>
<link rel="stylesheet" type="text/css" href="js/DatePicker/datepicker.css"/>
<script type="text/javascript" src="js/DatePicker/datepicker.js"></script>


</head>
<body>

<form action="Customer_Register.php" method="post">
<fieldset>
<legend><h3 align="center">Customer Registration</h3></legend>
	<table  align="center" cellspacing="50">
	<tr>
		<br><br><td class="text">Surname  :</td>
		<td><input type="text" name="txtsurname" placeholder="Please Enter Surname" required></td>
		<td>Forename :   <input type="text" name="txtforename" placeholder="Please Enter Forename" required></td>
	</tr>
	<tr>
		<td class="text">Date of Birth  :</td>
		<td><input type="text" name="txtdob" placeholder="yyyy-mm-d"  onFocus="showCalender(calender,this)" required></td>
	</tr>

	<tr>
		<td class="text">Address  :</td>
		<td>
			<textarea name="txtaddress" placeholder="Please Enter Address"required></textarea>
		</td>
	</tr>
	<tr>
		<td class="text">Phone  :</td>
		<td><input type="text" name="txtphone" placeholder="Please Enter Phone"required ></td>
	</tr>
	<tr>
		<td>
			Gender :
		<td>
			<select name="rdogender">
					<?php if ($Gender=='Male')
				{
					echo "<option>".$Gender."</option>";
					echo "<option>Female</option>";
				}
				elseif ($Gender=='Female')
				{
					echo "<option>".$Gender."</option>";
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
		</td>
	</tr>
	<tr>
		<td class="text">Account Name  :</td>
		<td><input type="Email" name="txtaccount" placeholder="eg. xxxx@gmail.com" required></td>
	</tr>
	<tr>
		<td class="text">Password</td>
		<td><input type="Password" name="txtpassword" placeholder="Please Enter New Password"required>
		</td>
	</tr>
	
	<tr>
		<td></td>
		<td>
			<br><input type="submit" name="btnreg" class="btn_4" value="Register">
			<input type="reset" class="btn_4" value="Cancel">
		</td>
	</tr>
<tr  align="right">
<td colspan="2">
<p> Do you want to go Customer Login Page? </td>
<tr>

	<td colspan="2"  align="right"><div class="forg">
			<a href="Login.php" class="btn_3"> <b>Click Here- 'Customer Login'</b> </a>
			<div class="clearfix"></div>
		</div>
</td>

</tr>
	</table>
</fieldset>
 
</form>
</body>
</html>
