<?php
echo print_r($_POST);
require('connect.php');
foreach ($_POST['user'] as $user) {
	$sql = "DELETE FROM USERS WHERE name='$user'";
	mysqli_query($conn, $sql);
}
mysqli_close($conn);
header("Location:../remove_users.php");
