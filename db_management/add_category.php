<?php
session_start();
require('connect.php');

$name = $_POST["category_name"];

$sql = "SELECT name FROM CATEGORIES WHERE name='$name'";
$result = mysqli_query($conn, $sql);
if(mysqli_num_rows($result) > 0) {
	$_SESSION['error'] = "Category already exists!";
	header("Location:../manage_categories.php");
	die;
}

$stmt = mysqli_stmt_init($conn);
if (mysqli_stmt_prepare($stmt, "INSERT INTO CATEGORIES (name) VALUES (?)")) {
	mysqli_stmt_bind_param($stmt, "s", $name);
	mysqli_stmt_execute($stmt);
	echo nl2br("New category created successfully\n");
}
mysqli_stmt_close($stmt);
$_SESSION['msg'] = "Category created successfully!";
header("Location:../manage_categories.php");
