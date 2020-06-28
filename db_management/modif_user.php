<?php
session_start();

if (!$_SESSION["loggued_on_user"]) {
	$_SESSION['error'] = "Login first!";
	header("Location:../login.php");
	die;
}
require('connect.php');
$user = $_SESSION["loggued_on_user"];
$oldpw = $_POST['oldpw'];
$newpw = $_POST['newpw'];

$sql = "SELECT * FROM USERS WHERE name='$user'";
$result = mysqli_query($conn, $sql);
$row = $result->fetch_assoc();
if (!password_verify($oldpw, $row['password'])) {
	$_SESSION['error'] = "incorrect password!";
	header('Location:../change_password.php');
	die;
}
$newpw = password_hash($newpw, PASSWORD_DEFAULT);
$sql = "UPDATE USERS SET password='$newpw' WHERE name='$user'";
mysqli_query($conn, $sql);
$_SESSION['msg'] = "Password changed successfully!";
header('Location:../change_password.php');
