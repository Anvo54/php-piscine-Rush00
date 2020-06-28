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

$sql = "SELECT * FROM USERDETAILS WHERE user='$user'";
$result = mysqli_query($conn, $sql);
if(mysqli_num_rows($result) > 0) {
	$sql = "UPDATE USERDETAILS SET firstname='$firstname', lastname='$lastname', address='$address', zipcode='$zipcode', city='$city', country='$country' WHERE user='$user'";
	mysqli_query($conn, $sql);
	header('Location:../user_info.php');
	exit();
}

$sql = "INSERT INTO USERDETAILS (user, firstname, lastname, address, zipcode, city, country) VALUES ('$user', '$firstname', '$lastname', '$address', '$zipcode', '$city', '$country')";
mysqli_query($conn, $sql);
header('Location:../user_info.php');
?>
