<?php 
	$host="localhost";
	$user="root";
	$pass="";
	$database="techx_db";
	
//FOR Infinite Free Hosting
	// $host="sql107.epizy.com";
	// $user="epiz_32837493";
	// $pass="tzBzay88hj";
	// $database="epiz_32837493_techx_db";

	// mysql_connect($host,$user,$pass) or die("Cann't Connect to database");
	// mysql_select_db("techx_db");

	$con=mysqli_connect($host,$user,$pass,$database);

	if(!$con){
		die("Connection Failed:".mysqli_connect_error());
	}
 ?>