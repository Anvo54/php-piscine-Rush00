<?php
require('connect.php');
if ($_POST['submit'] == 'Delete') {
	foreach ($_POST['category_name'] as $name) {
		$stmt = mysqli_stmt_init($conn);
		if (mysqli_stmt_prepare($stmt, "DELETE FROM CATEGORIES WHERE name=?")) {
			mysqli_stmt_bind_param($stmt, "s", $name);
			mysqli_stmt_execute($stmt);
		}
	}
	header("Location:../manage_categories.php");
	exit();
}
