<?php
session_start();
require('connect.php');

$target_dir = "../data/img/";
$target_file = $target_dir . basename($_FILES["product_image"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

if(isset($_POST["submit"])) {
  $check = getimagesize($_FILES["product_image"]["tmp_name"]);
  if($check !== false) {
    echo "File is an image - " . $check["mime"] . ".";
    $uploadOk = 1;
  } else {
    echo "File is not an image.";
    $uploadOk = 0;
  }
}

if (file_exists($target_file)) {
  echo "Sorry, file already exists.";
  $uploadOk = 0;
}

if ($_FILES["product_image"]["size"] > 500000) {
  echo "Sorry, your file is too large.";
  $uploadOk = 0;
}

if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
  echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
  $uploadOk = 0;
}

if ($uploadOk == 0) {
  echo "Sorry, your file was not uploaded.";

} else {
  if (move_uploaded_file($_FILES["product_image"]["tmp_name"], $target_file)) {
    echo "The file ". basename( $_FILES["product_image"]["name"]). " has been uploaded.";
  } else {
    echo "Sorry, there was an error uploading your file.";
  }
}

$name = $_POST["product_name"];
$price = doubleval($_POST["product_price"]);
$stock = intval($_POST["product_stock"]);
$product_image = mysqli_real_escape_string($conn, "data/img/".basename($_FILES["product_image"]["name"]));
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

?>