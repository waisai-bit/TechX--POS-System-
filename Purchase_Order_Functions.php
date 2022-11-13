<?php  
function AddPurchase($ProductID,$PurchaseQty,$PurchasePrice)
{
	include('connect.php');
	$con=mysqli_connect($host,$user,$pass,$database);

	$query="SELECT * FROM product p,model m where m.ModelID=p.ModelID and p.ProductID='$ProductID'";
	$result=mysqli_query($con,$query);
	$count=mysqli_num_rows($result);

	if($count < 1) 
	{
		echo "<div class='text-center'><img src='images/Shoppingcart_empty.png' width='100px' height='100px'/></div>";
		echo "<p class='text-center'>No Product Information found.</p>";
		exit();
	}

	$rows=mysqli_fetch_array($result);
	$ModelName=$rows['ModelName'];
	$FrontImage=$rows['FrontImage'];

	if($PurchaseQty < 1)
	{
		echo "<script>window.alert('Purchase Quantity cannot be Zero (0).')</script>";
		echo "<script>window.location='Purchase_Order.php'</script>";
		exit();
	}
	
	if($PurchasePrice < 1)
	{
		echo "<script>window.alert('Purchase Price cannot be Zero (0).')</script>";
		echo "<script>window.location='Purchase_Order.php'</script>";
		exit();
	}
//Session_Array
	if(isset($_SESSION['Purchase_Function'])) 
	{
		$index=IndexOf($ProductID);

		if($index == -1) 
		{
			$size=count($_SESSION['Purchase_Function']);
			
			$_SESSION['Purchase_Function'][$size]['ProductID']=$ProductID;
			$_SESSION['Purchase_Function'][$size]['ModelName']=$ModelName;
			$_SESSION['Purchase_Function'][$size]['PurchasePrice']=$PurchasePrice;
			$_SESSION['Purchase_Function'][$size]['PurchaseQty']=$PurchaseQty;
			$_SESSION['Purchase_Function'][$size]['FrontImage']=$FrontImage;	
		}
		else
		{
			$_SESSION['Purchase_Function'][$index]['PurchaseQty']+=$PurchaseQty;
		}
	}
	else
	{
		$_SESSION['Purchase_Function']=array();

		$_SESSION['Purchase_Function'][0]['ProductID']=$ProductID;
		$_SESSION['Purchase_Function'][0]['ModelName']=$ModelName;
		$_SESSION['Purchase_Function'][0]['PurchasePrice']=$PurchasePrice;
		$_SESSION['Purchase_Function'][0]['PurchaseQty']=$PurchaseQty;
		$_SESSION['Purchase_Function'][0]['FrontImage']=$FrontImage;
	}
	echo "<script>window.location='Purchase_Order.php'</script>";
}

function IndexOf($ProductID)
{
	if(!isset($_SESSION['Purchase_Function'])) 
	{
		return -1;
	}

	$count=count($_SESSION['Purchase_Function']);

	if ($count < 1) 
	{
		return -1;
	}

	for ($i=0;$i<$count;$i++) 
	{ 
		if($_SESSION['Purchase_Function'][$i]['ProductID'] == $ProductID) 
		{
			return $i;
		}
	}
	return -1;
}

function CalculateTotalAmount()
{
	$TotalAmount=0;

	$count=count($_SESSION['Purchase_Function']);

	for($i=0;$i<$count;$i++) 
	{ 
		$Price=$_SESSION['Purchase_Function'][$i]['PurchasePrice'];
		$Quantity=$_SESSION['Purchase_Function'][$i]['PurchaseQty'];

		$TotalAmount=$TotalAmount+($Price * $Quantity);
	}

	return $TotalAmount;
}
function CalculateTotalQty()
{
	$TotalAmount=0;

	$count=count($_SESSION['Purchase_Function']);

	for($j=0;$j<$count;$j++) 
	{ 
		
		$Quantity=$_SESSION['Purchase_Function'][$j]['PurchaseQty'];

		$TotalAmount=$TotalAmount+($Quantity);
	}

	return $TotalAmount;
}


function ClearAll()
{
	unset($_SESSION['Purchase_Function']);
	echo "<script>window.location='Purchase_Order.php'</script>";
}

function Remove($ProductID)
{
	$rowid=IndexOf($ProductID); // product covert to 0/1/2
	if($rowid>-1)
	{
			unset($_SESSION['Purchase_Function'][$rowid]);
			$_SESSION['Purchase_Function']=array_values($_SESSION['Purchase_Function']);
			echo "<script>window.location='Purchase_Order.php'</script>";
	}
}
?>