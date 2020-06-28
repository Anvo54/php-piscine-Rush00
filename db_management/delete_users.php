<?php
require('connect.php');
foreach ($_POST['user'] as $user) {
	$stmt = mysqli_stmt_init($conn);
	if (mysqli_stmt_prepare($stmt, "DELETE FROM USERS WHERE user=?")) {
		mysqli_stmt_bind_param($stmt, "s", $user);
		mysqli_stmt_execute($stmt);
	}
}
header("Location:../remove_users.php");
