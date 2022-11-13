<?php  
session_start(); 
include('connect.php'); 
include('function.php');
include('Purchase_Order_Functions.php');
include('headerstaff.php');

$con=mysqli_connect($host,$user,$pass,$database);

if(isset($_POST['btnSearch'])) 
{
	$Type=$_POST['rdoSearhType'];

	if($Type==1) 
	{
		$PurchaseID=$_POST['cboPurchaseID'];

		$query="SELECT p.*, s.* FROM purchase p, supplier s
				WHERE p.PurchaseID='$PurchaseID'
				AND p.SupplierID=s.SupplierID";
		$ret=mysqli_query($con,$query);
	}
	elseif($Type==2) 
	{
		$From=date('Y-m-d',strtotime($_POST['txtFrom']));
		$To=date('Y-m-d',strtotime($_POST['txtTo']));

		$query="SELECT p.*, s.* FROM purchase p, supplier s
				WHERE p.Date BETWEEN '$From' AND '$To'
				AND p.SupplierID=s.SupplierID";
		$ret=mysqli_query($con,$query);
	}
}

else
{
	$TodayDate=date("Y-m-d");

	$query="SELECT p.*, s.* FROM purchase p, supplier s
			WHERE p.Date='$TodayDate'
			AND p.SupplierID=s.SupplierID";
	$ret=mysqli_query($con,$query);
}
?>
<html>
<head>
<title>Purchase Search & Report</title>
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

<form action="PurchaseSearch.php" method="post">
<fieldset>
<legend>Daily & Monthly Purchase Search & Report :</legend>
<table cellpadding="4px">
<tr>
	<td>
		<input type="radio" name="rdoSearhType" value="1" checked/>Search by ID <br/>
		PurchaseID
		<select name="cboPurchaseID">
		<option>Choose PurchaseID</option>
		<?php  
			$query="SELECT * FROM purchase";
			$result=mysqli_query($con,$query);
			$count=mysqli_num_rows($result);

			for($i=0;$i<$count;$i++) 
			{ 
				$array=mysqli_fetch_array($result);
				$PurchaseID=$array['PurchaseID'];
				echo "<option value='$PurchaseID'>$PurchaseID</option>";
			}

		?>
		</select>
	</td>
	<td>
		<input type="radio" name="rdoSearhType" value="2"/>Search by Date <br/>
		From : <input type="text" name="txtFrom" onFocus="showCalender(calender,this)"/>
		To   : <input type="text" name="txtTo"  onFocus="showCalender(calender,this)"/>
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
	$query="SELECT p.*, s.* FROM purchase p, supplier s
				WHERE p.SupplierID=s.SupplierID";
	$ret=mysqli_query($con,$query);
	echo"<input type='submit' name='btnRemoveAll' class='btn_4' value='Remove All'/>";
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
<legend>Purchase Search Details:</legend>

<?php  
if(isset($_POST['btnRemoveAll'])) 
{
	echo "<div class='text-center'><img src='images/Shoppingcart_empty.png' width='100px' height='100px'/></div>";
	echo "<p class='text-center'>No Purchase Record Found.</p>";
	exit();

}
$count=mysqli_num_rows($ret);

if($count < 1) 
{
	echo "<div class='text-center'><img src='images/Shoppingcart_empty.png' width='100px' height='100px'/></div>";
	echo "<p class='text-center'>No Purchase Record Found.</p>";
	exit();
}
?>


<table id="datatableid"  class="display">
<tr align="center">
	<th>PurchaseID</th>
	<th>PurchaseDate</th>
	<th>SupplierName</th>
	<th>TotalQuantity</th>
	<th>NetAmount</th>
	<th>Status</th>
	<th>Action</th>
</tr>

<?php  
for ($i=0;$i<$count;$i++) 
{ 
	$array=mysqli_fetch_array($ret);

	$PurchaseID=$array['PurchaseID'];

	echo "<tr align='center'>";
	echo "<td>$PurchaseID</td>";
	echo "<td>" . $array['Date'] . "</td>";
	echo "<td>" . $array['SupplierName'] . "</td>";
	echo "<td>" . $array['TotalQuantity'] . "</td>";
	echo "<td>" . $array['NetAmount'] . "</td>";
	echo "<td>" . $array['Status'] . "</td>";
	echo "<td><a href='Purchase_Detail.php?PurchaseID=$PurchaseID' class='btn_3'>View Detail</a></td>";
	echo "</tr>";
}
?>
</thead>
</table>
</fieldset>
</form>
</body>
</html>
