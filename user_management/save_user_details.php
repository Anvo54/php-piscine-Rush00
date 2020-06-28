<?php
session_start();
require('../db_management/connect.php');

$user = $_SESSION['login_user'];
$firstname = $_POST['firstname'];
$lastname = $_POST['lastname'];
$address = $_POST['address'];
$zipcode = $_POST['zipcode'];
$city = $_POST['city'];
$country = $_POST['country'];

$stmt = mysqli_stmt_init($conn);
if (mysqli_stmt_prepare($stmt, "SELECT * FROM USERDETAILS WHERE user=?")) {
	mysqli_stmt_bind_param($stmt, "s", $user);
	mysqli_stmt_execute($stmt);
}
$result = mysqli_stmt_get_result($stmt);
if(mysqli_num_rows($result) > 0) {
	if (mysqli_stmt_prepare($stmt, "UPDATE USERDETAILS SET firstname=?, lastname=?, address=?, zipcode=?, city=?, country=? WHERE user=?")) {
		mysqli_stmt_bind_param($stmt, "sssssss", $firstname, $lastname, $address, $zipcode, $city, $country, $user);
		mysqli_stmt_execute($stmt);
	}
	header('Location:../user_info.php');
	exit();
}

$stmt = mysqli_stmt_init($conn);
if (mysqli_stmt_prepare($stmt, "INSERT INTO USERDETAILS (user, firstname, lastname, address, zipcode, city, country) VALUES ((?), (?), (?), (?), (?), (?), (?))")) {
	mysqli_stmt_bind_param($stmt, "sssssss", $user, $firstname, $lastname, $address, $zipcode, $city, $country);
	mysqli_stmt_execute($stmt);
}
mysqli_stmt_close($stmt);
header('Location:../user_info.php');
?>
