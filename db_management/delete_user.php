<?php
session_start();
if ($_POST['submit'] == 'Cancel') {
	header("Location:../index.php");
	die;
}


if (!$_SESSION["login_user"]) {
	$_SESSION['error'] = "Login first!";
	header("Location:../login.php");
	die;
}
require('connect.php');
$user = $_SESSION["login_user"];

$sql = "DELETE FROM USERS WHERE user='$user'";
mysqli_query($conn, $sql);
mysqli_close($conn);
$_SESSION['msg'] = "User deleted successfully!";
$_SESSION["login_user"] = "";
header("Location:../login.php");
