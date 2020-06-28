<?php
function get_products($id) {
	require('db_management/connect.php');
	$sql = "SELECT * FROM PRODUCTS WHERE id=$id";
	if (!$result = mysqli_query($conn, $sql))
		die("Error: " . $sql . "<br>" . mysqli_error($conn));
	return mysqli_fetch_array($result);
}
?>
