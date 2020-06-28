<?php
session_start();
require('connect.php');
$user = $_POST['login'];
$passwd = password_hash($_POST['passwd'], PASSWORD_DEFAULT);

$sql = "SELECT name FROM USERS WHERE user='$user'";
$result = mysqli_query($conn, $sql);
if(mysqli_num_rows($result) > 0) {
	$_SESSION['error'] = "ERROR: user already exists!";
	header("Location:../create_user.php");
	die;
}

$stmt = mysqli_stmt_init($conn);
if (mysqli_stmt_prepare($stmt, "INSERT INTO USERS (user, password) VALUES ((?), (?))")) {
	mysqli_stmt_bind_param($stmt, "ss", $user, $passwd);
	mysqli_stmt_execute($stmt);
}
mysqli_stmt_close($stmt);

$_SESSION['msg'] = "User created successfully!";
header("Location:../login.php");
