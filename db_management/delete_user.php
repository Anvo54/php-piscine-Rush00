<?php
session_start();
if ($_POST['submit'] == 'Cancel') {
	header("Location:../index.php");
	die;
}


if (!$_SESSION["loggued_on_user"]) {
	$_SESSION['error'] = "Login first!";
	header("Location:../login.php");
	die;
}
require('connect.php');
$user = $_SESSION["loggued_on_user"];

$sql = "DELETE FROM USERS WHERE name='$user'";
mysqli_query($conn, $sql);
mysqli_close($conn);
$_SESSION['msg'] = "User deleted successfully!";
$_SESSION["loggued_on_user"] = "";
header("Location:../login.php");
