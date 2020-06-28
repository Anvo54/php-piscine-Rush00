<?php
echo print_r($_POST);
require('connect.php');
foreach ($_POST['product'] as $product) {
	$sql = "DELETE FROM PRODUCTS WHERE name='$product'";
	mysqli_query($conn, $sql);
}
mysqli_close($conn);
header("Location:../remove_product.php");
