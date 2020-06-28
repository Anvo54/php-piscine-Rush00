<?php
function auth($login, $passwd)
{
	session_start();
	require('../db_management/connect.php');
	$sql = "SELECT * FROM USERS WHERE name='$login'";
	$result = mysqli_query($conn, $sql);
	if(mysqli_num_rows($result) == 0) {
		$_SESSION['error'] = "user does not exist!";
		return (FALSE);
	}
	$row = $result->fetch_assoc();
	if (!password_verify($passwd , $row['password'])) {
		$_SESSION['error'] = "incorrect password!";
		return (FALSE);
	}
	return (TRUE);
}
?>
