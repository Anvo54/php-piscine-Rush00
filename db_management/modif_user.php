<?php
session_start();

if (!$_SESSION["login_user"]) {
	$_SESSION['error'] = "Login first!";
	header("Location:../login.php");
	die;
}
require('connect.php');
$user = $_SESSION["login_user"];
$oldpw = $_POST['oldpw'];
$newpw = $_POST['newpw'];

$stmt = mysqli_stmt_init($conn);
if (mysqli_stmt_prepare($stmt, "SELECT * FROM USERS WHERE user=?")) {
	mysqli_stmt_bind_param($stmt, "s", $user);
	mysqli_stmt_execute($stmt);
}
$result = mysqli_stmt_get_result($stmt);
$row = mysqli_fetch_assoc($result);
if (!password_verify($oldpw, $row['password'])) {
	$_SESSION['error'] = "incorrect password!";
	header('Location:../manage_account.php');
	die;
}
$newpw = password_hash($newpw, PASSWORD_DEFAULT);
if (mysqli_stmt_prepare($stmt, "UPDATE USERS SET password=? WHERE user=?")) {
	mysqli_stmt_bind_param($stmt, "ss", $newpw, $user);
	mysqli_stmt_execute($stmt);
}
$_SESSION['msg'] = "Password changed successfully!";
header('Location:../manage_account.php');
