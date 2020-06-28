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

$stmt = mysqli_stmt_init($conn);
if (mysqli_stmt_prepare($stmt, "UPDATE PRODUCTS SET name=(?), categories=(?), price=(?), stock=(?), imgpath=(?), description=(?) WHERE id=(?)")) {
	mysqli_stmt_bind_param($stmt, "ssdissi", $name, $categories, $price, $stock, $product_image, $desc, $id);
	mysqli_stmt_execute($stmt);
	echo nl2br("Product modified successfully\n");
}
else {
	echo "Error: " . $sql . "<br>";
}
mysqli_stmt_close($stmt);
$_SESSION['msg'] = "Product modified successfully!";
header("Location:../create_prod.php");
