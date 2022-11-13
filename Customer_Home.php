<?php  
session_start(); 
include('connect.php');
include('bannerheader.php');

?>
<html>
<head>
	<title>Customer Home</title>
</head>
<body>
<form>
<h3>Welcome Customer <b>|<?php if(isset($_SESSION['Surname'])) {echo"[" ; echo $_SESSION['Surname']; echo" " ; echo $_SESSION['Forename']; echo"]"; echo"|"; echo"<a href='logout.php' class='btn_1' width='100px' height='100px'> Logout  </a>";} else { echo 'Guest';}?>

<fieldset>
<h1 align="center">Product List</h1>
<table cellpadding="55"  align="center">
<?php  
$query1="SELECT * FROM product p, model m, color c, specification s where m.ModelID=p.ModelID and m.SpecificationID=s.SpecificationID and p.ColorID=c.ColorID";

	
$result1=mysqli_query($con,$query1);
$count1=mysqli_num_rows($result1);

for($a=0;$a<$count1;$a+=4) 
{ 
	$query2="SELECT * FROM product p, model m, color c, specification s where m.ModelID=p.ModelID and m.SpecificationID=s.SpecificationID  and p.ColorID=c.ColorID
			 LIMIT $a,4";
	$result2=mysqli_query($con,$query2);
	$count2=mysqli_num_rows($result2);

	echo "<tr>";
	for ($b=0;$b<$count2;$b++) 
	{ 
		$array=mysqli_fetch_array($result1);
		$ProductID=$array['ProductID'];
	?>
		<td align="center">
		<span><img src="<?php echo $array['FrontImage'] ?>" width="160" height="160"/><br/></span>

			<h4><a href="Single.php?ProductID=<?php echo $ProductID ?>" style="text-decoration:none; color:Black"><b> <?php echo $array['ModelName'] ?></b><br/></a></h4>
			<h5><?php echo $array['ColorName'] ?> | <?php echo $array['Rom'] ?><br/>
			<?php echo $array['Price'] ?> MMK<br/></h5>
			<a href="Single.php?ProductID=<?php echo $ProductID ?>" class="btn_3">View More</a>
		</td>
	<?php
	}
	echo "</tr>";
}
?>
</table>
</fieldset>

</form>
</body>
</html>

<?php include('footer.php'); ?>