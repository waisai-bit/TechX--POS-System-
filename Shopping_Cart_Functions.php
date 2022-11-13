<?php  
function AddShoppingCart($ProductID,$BuyQuantity)
{
	include('connect.php'); //gg pr kwr
	$con=mysqli_connect($host,$user,$pass,$database);

	$query="SELECT * FROM product p, model m, category ca, brand b , color c, specification s where m.ModelID=p.ModelID and m.SpecificationID=s.SpecificationID and ca.CategoryID=p.CategoryID and b.BrandID=p.BrandID and p.ColorID=c.ColorID and p.ProductID='$ProductID'";
	
	$result=mysqli_query($con,$query);
	$count=mysqli_num_rows($result);


	if($count < 1) 
	{
		echo "<p>No Product Infomation found.</p>";
		exit();
	}

	$rows=mysqli_fetch_array($result);

	$ModelName=$rows['ModelName'];
	$FrontImage=$rows['FrontImage'];
	$Price=$rows['Price'];
	$Quantity=$rows['Quantity'];
	$ColorName=$rows['ColorName'];
	$Rom=$rows['Rom'];
	
	
	


	if($BuyQuantity < 1)
	{
		echo "<script>window.alert('Buying Quantity cannot be Zero (0).')</script>";
		echo "<script>window.location='Customer_Home.php'</script>";
		exit();
	}
	
	if($BuyQuantity > $Quantity)
	{
		echo "<script>window.alert('Out of Stock Quantity !!!')</script>";
		echo "<script>window.location='Customer_Home.php'</script>";
		exit();
	}

	if(isset($_SESSION['ShoppingCart_Function'])) 
	{
		$index=IndexOf($ProductID);

		if($index == -1) 
		{
			$size=count($_SESSION['ShoppingCart_Function']);

			$_SESSION['ShoppingCart_Function'][$size]['ProductID']=$ProductID;
			$_SESSION['ShoppingCart_Function'][$size]['ModelName']=$ModelName;
			$_SESSION['ShoppingCart_Function'][$size]['Price']=$Price;
			$_SESSION['ShoppingCart_Function'][$size]['BuyQuantity']=$BuyQuantity;
			$_SESSION['ShoppingCart_Function'][$size]['FrontImage']=$FrontImage;	
			$_SESSION['ShoppingCart_Function'][$size]['ColorName']=$ColorName;	
			$_SESSION['ShoppingCart_Function'][$size]['Rom']=$Rom;
			

		}
		else
		{
			$CHeck=$_SESSION['ShoppingCart_Function'][$index]['BuyQuantity']+$BuyQuantity;
			if ($CHeck>$Quantity)
			{
				echo "<script>window.alert('Over Qty')</script>";				
				echo "<script>window.location='Shopping_Cart.php'</script>";
			}
			else
			{
				$_SESSION['ShoppingCart_Function'][$index]['BuyQuantity']+=$BuyQuantity;
			}
			
		}
	}
	else
	{
		$_SESSION['ShoppingCart_Function']=array();   //declare array session list>>>>>

		$_SESSION['ShoppingCart_Function'][0]['ProductID']=$ProductID;
		$_SESSION['ShoppingCart_Function'][0]['ModelName']=$ModelName;
		$_SESSION['ShoppingCart_Function'][0]['Price']=$Price;
		$_SESSION['ShoppingCart_Function'][0]['BuyQuantity']=$BuyQuantity;
		$_SESSION['ShoppingCart_Function'][0]['FrontImage']=$FrontImage;
		$_SESSION['ShoppingCart_Function'][0]['ColorName']=$ColorName;
		$_SESSION['ShoppingCart_Function'][0]['Rom']=$Rom;
		
	}
	echo "<script>window.location='Shopping_Cart.php'</script>";
}

function IndexOf($ProductID)
{
	if(!isset($_SESSION['ShoppingCart_Function'])) 
	{
		return -1;
	}

	$count=count($_SESSION['ShoppingCart_Function']);

	if ($count < 1) 
	{
		return -1;
	}

	for ($i=0;$i<$count;$i++) 
	{ 
		if($_SESSION['ShoppingCart_Function'][$i]['ProductID'] == $ProductID) 
		{
			return $i;
		}
	}
	return -1;
}

function CalculateTotalAmount()
{
	$TotalAmount=0;

	$count=count($_SESSION['ShoppingCart_Function']);

	for($i=0;$i<$count;$i++) 
	{ 
		$Price=$_SESSION['ShoppingCart_Function'][$i]['Price'];
		$Quantity=$_SESSION['ShoppingCart_Function'][$i]['BuyQuantity'];

		$TotalAmount=$TotalAmount+($Price * $Quantity);
	}

	return $TotalAmount;
}

function CalculateTotalQuantity()
{
	$TotalQuantity=0;

	$count=count($_SESSION['ShoppingCart_Function']);

	for($i=0;$i<$count;$i++) 
	{ 
		$Quantity=$_SESSION['ShoppingCart_Function'][$i]['BuyQuantity'];

		$TotalQuantity=$TotalQuantity+($Quantity);
	}

	return $TotalQuantity;
}

function ClearAll()
{	
	unset($_SESSION['ShoppingCart_Function']);
	echo "<script>window.location='Shopping_Cart.php'</script>";
}

function Remove($ProductID)
{
	$rowid=IndexOf($ProductID); // productid covert to 0/1/2
	if($rowid>-1) 
	{	
			unset($_SESSION['ShoppingCart_Function'][$rowid]);
			$_SESSION['ShoppingCart_Function']=array_values($_SESSION['ShoppingCart_Function']);
			echo "<script>window.location='Shopping_Cart.php'</script>";
	}		
}

?>