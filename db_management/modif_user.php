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

$sql = "SELECT * FROM USERS WHERE user='$user'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
if (!password_verify($oldpw, $row['password'])) {
	$_SESSION['error'] = "incorrect password!";
	header('Location:../manage_account.php');
	die;
}
$newpw = password_hash($newpw, PASSWORD_DEFAULT);
$sql = "UPDATE USERS SET password='$newpw' WHERE user='$user'";
mysqli_query($conn, $sql);
$_SESSION['msg'] = "Password changed successfully!";
header('Location:../manage_account.php');
