<?php
session_start();
require('connect.php');

$name = $_POST["product_name"];
$price = $_POST["product_price"];
$stock = $_POST["product_stock"];
$product_image = mysqli_real_escape_string($conn, $_POST["product_image"]);
$desc = mysqli_real_escape_string($conn, $_POST["product_description"]);
$categories = implode(',', $_POST["category_name"]);

$sql = "INSERT INTO PRODUCTS (name, categories, price, stock, imgpath, description) VALUES ('$name', '$categories', $price, $stock, '$product_image', '$desc')";
if (mysqli_query($conn, $sql)) {
	echo nl2br("New product created successfully\n");
} else {
	echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}
mysqli_close($conn);
$_SESSION['msg'] = "Product created successfully!";
header("Location:../create_prod.php");
