<?php
	session_start();
	$_SESSION["Username"] = null;
	echo "<script>window.open('index.php','_self',null,true)</script>";
?>