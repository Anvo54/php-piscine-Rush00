<?php
	include 'auth.php';
	session_start();
	if (($_POST["login"] || $_POST["passwd"]) && auth($_POST["login"], $_POST["passwd"]))
	{
		$_SESSION["login_user"] = $_POST["login"];
		echo("OK\n");
		header('Location: ../index.php');
	} else
	{
		$_SESSION["login_user"] = "";
		echo "ERROR\n";
		header('Location: ../login.php');
	}
?>
