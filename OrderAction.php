<?php
	session_start();
	require 'Connection.php';
	$ProductID = $_GET['ProductID'];
	$CustomerID = $_GET['CustomerID'];
	$ProductSize = $_POST['ProductSize'];
	$ProductColor = $_POST['ProductColor'];
	$DateOrder = date("Y/m/d");
	
	if($_SESSION['Username'] == null || $_SESSION['Password'] == null)
	{
		echo "<script>window.open('Login.php?Role=User','_self',null,true); window.alert('Please Login to Process your order');</script>";
	}
	
	$sql2 = "INSERT INTO `tbl_orders`(`ProductID`, `CustomerID`,`Size`, `Color`, `DateOrdered`) ".
			"VALUES ('$ProductID','$CustomerID','$ProductSize','$ProductColor','$DateOrder')";
	$res2 = mysqli_query($Conn,$sql2);
	if($res2){
		echo "<script>window.alert('Success'); window.open('index.php','_self',null,true);</script>";
	}
?>