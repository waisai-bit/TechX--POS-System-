<?php  
session_start(); 
include('connect.php'); 
include('function.php');
include('headerstaff.php');

$con=mysqli_connect($host,$user,$pass,$database);

if(isset($_POST['btnSearch'])) 
{
	$Type=$_POST['rdoSearhType'];

	if($Type==1) 
	{
		$OrderID=$_POST['cboOrderID'];

		 $query="
		 			Select * 
			from orders o,customer c
			where o.CustomerID=c.CustomerID
			and o.OrderID='$OrderID'
				";
		$ret=mysqli_query($con,$query);
	}
	elseif($Type==2) 
	{
		$From=date('Y-m-d',strtotime($_POST['txtFrom']));
		$To=date('Y-m-d',strtotime($_POST['txtTo']));

		$query="
				Select * 
				from orders o,customer c
				where o.CustomerID=c.CustomerID
				and o.Order_Date BETWEEN '$From' AND '$To'
				";
		$ret=mysqli_query($con,$query);
	}
}

else
{
	$TodayDate=date("Y-m-d");

	$query="
			Select * 
				from orders o,customer c
				where o.CustomerID=c.CustomerID
			";
	$ret=mysqli_query($con,$query);
}
?>
<html>
<head>
<title>Order Search & Report</title>

<link rel="stylesheet" type="text/css" href="js/DatePicker/datepicker.css"/>
<script type="text/javascript" src="js/DatePicker/datepicker.js"></script>

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

<form action="OrderSearch.php" method="post">
<fieldset>
<legend>Search Option :</legend>
<table cellpadding="4px">
<tr>
	<td>
		<input type="radio" name="rdoSearhType" value="1" checked/>Search by ID <br/>
		OrderID
		<select name="cboOrderID">
		<option>Choose Order ID</option>
		<?php  
			$query="SELECT * FROM orders";
			$result=mysqli_query($con,$query);
			$count=mysqli_num_rows($result);

			for($i=0;$i<$count;$i++) 
			{ 
				$array=mysqli_fetch_array($result);
				$OrderID=$array['OrderID'];
				echo "<option value='$OrderID'>$OrderID</option>";
			}

		?>
		</select>
	</td>
	<td>
		<input type="radio" name="rdoSearhType" value="2"/>Search by Date <br/>
		From : <input type="text" name="txtFrom"  onFocus="showCalender(calender,this)"/>
		To   : <input type="text" name="txtTo"   onFocus="showCalender(calender,this)"/>
	</td>
</tr>
<tr>
	<td colspan="2">
		<br/>
		<input type="submit" name="btnSearch" class="btn_4" value="Search"/>
		<input type="submit" name="btnShowAll" class="btn_4" value="Show All"/>
<?php 
if(isset($_POST['btnShowAll'])) 
{
	$query="
			Select * 
			from orders o,customer c
			where o.CustomerID=c.CustomerID
			";
	$ret=mysqli_query($con,$query);
	echo"<input type='submit' name='btnRemoveAll' class='btn_4' value='RemoveAll'/>";
}
?>
		
	</td>
</tr>
</table>
</fieldset>
<!--smallheader end-->
	</div>
	</div>
	</div>
	</div>
	</div>

<fieldset>
<legend>Order Search Details:</legend>
<?php  
if(isset($_POST['btnRemoveAll'])) 
{
	echo "<div class='text-center'><img src='images/Shoppingcart_empty.png' width='100px' height='100px'/></div>";
	echo "<p class='text-center'>No Order Record Found.</p>";
	exit();

}
$count=mysqli_num_rows($ret);

if($count < 1) 
{
	echo "<div class='text-center'><img src='images/Shoppingcart_empty.png' width='100px' height='100px'/></div>";
	echo "<p class='text-center'>No Order Record Found.</p>";
	exit();
}
?>

<table id="datatableid"  class="display">
<tr align="center">
	<th>Order</th>
	<th>Order Date</th>
	<th>Customer Name</th>
	<th>TotalQuantity</th>
	<th>TotalAmount</th>
	<th>Status</th>
	<th>Action</th>
</tr>
<?php  
for ($i=0;$i<$count;$i++) 
{ 
	$array=mysqli_fetch_array($ret);

	$OrderID=$array['OrderID'];

	echo "<tr align='center'>";
	echo "<td>$OrderID</td>";
	echo "<td>" . $array['Order_Date'] . "</td>";
	echo "<td>" . $array['Surname'] ." ".   $array['Forename']. "</td>";
	echo "<td>" . $array['Total_Quantity'] . "</td>";
	echo "<td>" . $array['Total_Amount'] . "</td>";
	echo "<td>" . $array['Status'] . "</td>";
	echo "<td><a href='OrderDetail.php?OrderID=$OrderID' class='btn_3'>View Detail</a></td>";
	echo "</tr>";
}
?>
</table>
</fieldset>
</form>
</body>
</html>
