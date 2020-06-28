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

$sql = "INSERT INTO USERS (user, password) VALUES ('$user', '$passwd')";
if (mysqli_query($conn, $sql)) {
	echo nl2br("New record created successfully\n");
} else {
	echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}
mysqli_close($conn);
$_SESSION['msg'] = "User created successfully!";
header("Location:../login.php");
