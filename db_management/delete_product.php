<?php
if ($_POST['submit'] == 'Delete') {
	require('connect.php');
	foreach ($_POST['product'] as $product) {
		$sql = "DELETE FROM PRODUCTS WHERE name='$product'";
		mysqli_query($conn, $sql);
		header("Location:../create_prod.php");
		die();
	}
}

if ($_POST['submit'] == 'Modify') {
	
}
