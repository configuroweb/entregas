<?php

	require 'Connection.php';
	$CustomerID = $_GET["ID"];
	
	$sql = "DELETE FROM `tbl_customers` WHERE CustomerID = " . $CustomerID;
	$res = mysqli_query($Conn,$sql);
	if($res)
	{
		echo '<script>window.open("Management_Customers.php","_self",null,true)</script>';
	}

?>