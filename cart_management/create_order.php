<?php
session_start();
function combine($item, $key) {
	$item = $key.':'.$item;
}

require('../db_management/connect.php');
$user = $_SESSION['login_user'];
$firstname = $_POST['firstname'];
$lastname = $_POST['lastname'];
$address = $_POST['address'];
$zipcode = $_POST['zipcode'];
$city = $_POST['city'];
$country = $_POST['country'];
$shipping = $_POST['shipping'];
$payment = $_POST['payment'];
$cart = array();
foreach ($_SESSION['cart'] as $k => $v)
	$cart[] = $k.':'.$v;
$cart = implode(',',$cart);

$sql = "INSERT INTO ORDERS (user, cart, firstname, lastname, address, zipcode, city, country, shipping, payment) VALUES ('$user', '$cart', '$firstname', '$lastname', '$address', '$zipcode', '$city','$country', '$shipping', '$payment')";
if (mysqli_query($conn, $sql)) {
	echo nl2br("New order created successfully\n");
} else {
	echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}
mysqli_close($conn);
?>
