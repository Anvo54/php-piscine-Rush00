<?php
function get_products($id) {
	require('db_management/connect.php');
	$sql = "SELECT * FROM PRODUCTS";
	$result = mysqli_query($conn, $sql);
	return mysqli_fetch_array($result);
}
?>
