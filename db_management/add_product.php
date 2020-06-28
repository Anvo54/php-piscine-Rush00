<?php
session_start();
require('connect.php');

$name = $_POST["product_name"];
$price = $_POST["product_price"];
$stock = $_POST["product_stock"];
$product_image = $_POST["product_image"];
$desc = mysqli_real_escape_string($conn, $_POST["product_description"]);

$sql = "INSERT INTO PRODUCTS (name, price, stock, imgpath, description) VALUES ('$name', $price, $stock, '$product_image', '$desc')";
if (mysqli_query($conn, $sql)) {
	echo nl2br("New product created successfully\n");
} else {
	echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}
mysqli_close($conn);
$_SESSION['msg'] = "Product created successfully!";
header("Location:../create_prod.php");
