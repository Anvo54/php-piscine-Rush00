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
$stmt = mysqli_stmt_init($conn);
if (mysqli_stmt_prepare($stmt, "DELETE FROM USERS WHERE user=?")) {
	mysqli_stmt_bind_param($stmt, "s", $user);
	mysqli_stmt_execute($stmt);
}
$_SESSION['msg'] = "User deleted successfully!";
$_SESSION["login_user"] = "";
header("Location:../login.php");
