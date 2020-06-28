<?php
require('connect.php');
if ($_POST['submit'] == 'Delete') {
	foreach ($_POST['category_name'] as $name) {
		$sql = "DELETE FROM CATEGORIES WHERE name='$name'";
		mysqli_query($conn, $sql);
	}
	header("Location:../manage_categories.php");
	exit();
}
