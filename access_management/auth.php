<?php
function auth($login, $passwd)
{
	session_start();
	require('../db_management/connect.php');

	$stmt = mysqli_stmt_init($conn);
	if (mysqli_stmt_prepare($stmt, "SELECT * FROM USERS WHERE user=?")) {
		mysqli_stmt_bind_param($stmt, "s", $login);
		mysqli_stmt_execute($stmt);
	}
	$result = mysqli_stmt_get_result($stmt);
	mysqli_stmt_close($stmt);
	if(mysqli_num_rows($result) == 0) {
		$_SESSION['error'] = "user does not exist!";
		return (FALSE);
	}
	$row = mysqli_fetch_assoc($result);
	if (!password_verify($passwd , $row['password'])) {
		$_SESSION['error'] = "incorrect password!";
		return (FALSE);
	}
	return (TRUE);
}
?>
