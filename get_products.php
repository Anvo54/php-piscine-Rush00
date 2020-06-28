<?php
function get_products($id) {
	require('db_management/connect.php');

	$stmt = mysqli_stmt_init($conn);
	if (mysqli_stmt_prepare($stmt, "SELECT * FROM PRODUCTS WHERE id=?")) {
		mysqli_stmt_bind_param($stmt, "i", $id);
		mysqli_stmt_execute($stmt);
	}
	$result = mysqli_stmt_get_result($stmt);
	mysqli_stmt_close($stmt);
	return mysqli_fetch_array($result);
}
?>
