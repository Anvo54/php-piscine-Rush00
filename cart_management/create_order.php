<?php
session_start();
require('../db_management/connect.php');

$user = $_SESSION['loggued_on_user'];
$cart = serialize($_SESSION['cart']);
$order_details = $_POST;
unset($order_details['submit']);
$cart = serialize($cart);

$sql = "INSERT INTO ORDERS (user, cart, details) VALUES ('$user', $cart, $order_details')";
if (mysqli_query($conn, $sql)) {
	echo nl2br("New product created successfully\n");
} else {
	echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}
mysqli_close($conn);
?>
