<?php
function AutoID($tableName,$fieldName,$prefix,$noOfLeadingZeros)
{
	include('connect.php');
	$newID="";
	$sql="";
	$value=1;
	
	// $sql="SELECT `$fieldName` FROM  `$tableName` ORDER BY  $fieldName DESC";	
	$sql="SELECT " . $fieldName . " FROM " . $tableName . " ORDER BY " . $fieldName . " DESC";	
	
	$con=mysqli_connect($host,$user,$pass,$database);
	$result = mysqli_query($con,$sql);
	$noOfRow=mysqli_num_rows($result);
	$row=mysqli_fetch_array($result);

	
	if ($noOfRow<1)
	{		
		return $prefix . "0001";
	}
	else
	{
		$oldID=$row[$fieldName];	//Reading Last ID
		$oldID=str_replace($prefix,"",$oldID);	//Removing "Prefix"
		$value=(int)$oldID;	//Convert to Integer
		$value++;	//Increment		
		$newID=$prefix . NumberFormatter($value,$noOfLeadingZeros);			
		return $newID;		
	}
}

function AutoID_ByDate($tableName,$primaryKeyName,$dateFieldName
							,$month,$year,$noOfLeadingZeros)
{
	include('connect.php');
	$newID="";
	$sql="";
	$value=1;
	$month_String=NumberFormatter($month,2);		
	
	$sql="SELECT " . $primaryKeyName . " FROM `" . $tableName . "` " .
	"WHERE MONTH($dateFieldName)=$month " .
	"AND YEAR($dateFieldName)=$year " .
	" ORDER BY " . $primaryKeyName . " DESC";	
	
	//echo "$sql";
	$con=mysqli_connect($host,$user,$pass,$database);
	$result = mysqli_query($con,$sql);
	$noOfRow=mysqli_num_rows($result);
	$row = mysqli_fetch_array($result);		
	
	if ($noOfRow<1)
	{		
		return $month_String . $year . "0001";
	}
	else
	{
		$oldID=$row[$primaryKeyName];	//Reading Last ID		
		$oldID=substr($oldID,4,$noOfLeadingZeros);
		$value=(int)$oldID;	//Convert to Integer
		$value++;	//Increment		
		$newID=$month_String . $year . NumberFormatter($value,$noOfLeadingZeros);		
		return $newID;		
	}
}

function NumberFormatter($number,$n) 
{	
	return str_pad((int) $number,$n,"0",STR_PAD_LEFT);
}
?>
