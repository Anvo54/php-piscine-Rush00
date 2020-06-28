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

$stmt = mysqli_stmt_init($conn);
if (mysqli_stmt_prepare($stmt, "INSERT INTO ORDERS (user, cart, firstname, lastname, address, zipcode, city, country, shipping, payment) VALUES ('$user', '$cart', '$firstname', '$lastname', '$address', '$zipcode', '$city','$country', '$shipping', '$payment')")) {
	mysqli_stmt_bind_param($stmt, "ssssssssss", $user, $cart, $firstname, $lastname, $address, $zipcode, $city ,$country, $shipping, $payment);
	mysqli_stmt_execute($stmt);
}
mysqli_stmt_close($stmt);
unset($_SESSION['cart']);
header('Location:../user_orders.php')
?>
