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

$sql = "INSERT INTO CATEGORIES (name) VALUES ('$name')";
if (mysqli_query($conn, $sql)) {
	echo nl2br("New category created successfully\n");
} else {
	echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}
mysqli_close($conn);
$_SESSION['msg'] = "Category created successfully!";
header("Location:../manage_categories.php");
