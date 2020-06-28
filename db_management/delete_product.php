<?php
if ($_POST['submit'] == 'Delete') {
	require('connect.php');
	foreach ($_POST['id'] as $id) {
		$stmt = mysqli_stmt_init($conn);
		if (mysqli_stmt_prepare($stmt, "DELETE FROM PRODUCTS WHERE id=?")) {
			mysqli_stmt_bind_param($stmt, "i", $id);
			mysqli_stmt_execute($stmt);
		}
	}
	header("Location:../create_prod.php");
}
