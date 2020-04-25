<?php
	require 'Connection.php';
	$ID = $_GET["id"];
	$sql = "Delete from tbl_orders where OrderID = $ID";
	$res = mysqli_query($Conn,$sql);
	if($res){
		echo '<script>window.open("Management_Orders.php","_self",null,true);</script>';
	}
	
?>