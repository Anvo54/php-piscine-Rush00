<?php
	session_start();
	$_SESSION["login_user"] = "";
	unset($_SESSION['cart']);
	header('Location:../index.php')
?>
