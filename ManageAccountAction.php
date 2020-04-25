<?php
	require 'Connection.php';
	$orderID = $_GET["oID"];
	
	$sql = "DELETE FROM `tbl_orders` WHERE OrderID = " . $orderID;
	$res = mysqli_query($Conn,$sql);
	if($res)
	{
		echo '<script>window.open("ManageAccount.php","_self",null,true)</script>';
	}

?>