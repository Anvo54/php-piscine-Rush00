<?php
session_start();
require('../db_management/connect.php');
$user = $_SESSION['login_user'];


$sql = "INSERT INTO ORDERS (user, cart, details) VALUES ('$user', $cart, $order_details')";
if (mysqli_query($conn, $sql)) {
	echo nl2br("New order created successfully\n");
} else {
	echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}
mysqli_close($conn);
?>
