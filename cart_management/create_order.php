<?php
session_start();
require('../db_management/connect.php');

$user = $_SESSION['login_user'];
$cart = serialize($_SESSION['cart']);
$order_details = $_POST;
unset($order_details['submit']);
$cart = serialize($cart);

$sql = "INSERT INTO ORDERS (user, cart, details) VALUES ('$user', $cart, $order_details')";
if (mysqli_query($conn, $sql)) {
	echo nl2br("New order created successfully\n");
} else {
	echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}
mysqli_close($conn);
?>
