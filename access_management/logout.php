<?php
	session_start();
	$_SESSION["loggued_on_user"] = "";
	unset($_SESSION['cart']);
	header('Location:../index.php')
?>
