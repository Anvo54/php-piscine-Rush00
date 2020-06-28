<?php
session_start();
require('connect.php');

$id = $_POST["id"];
$name = $_POST["product_name"];
$price = $_POST["product_price"];
$stock = $_POST["product_stock"];
$product_image = $_POST["product_image"];
$desc = mysqli_real_escape_string($conn, $_POST["product_description"]);
$categories = implode(',', $_POST["category_name"]);

$sql = "UPDATE PRODUCTS SET name='$name', categories='$categories', price=$price, stock=$stock, imgpath='$product_image', description='$desc' WHERE id=$id";
if (mysqli_query($conn, $sql)) {
	echo nl2br("Product modifiedsuccessfully\n");
} else {
	echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}
mysqli_close($conn);
$_SESSION['msg'] = "Product modified successfully!";
header("Location:../create_prod.php");
