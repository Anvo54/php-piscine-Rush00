<?php
if ($_POST['submit'] == 'Delete') {
	require('connect.php');
	foreach ($_POST['id'] as $id) {
		$sql = "DELETE FROM PRODUCTS WHERE id=$id";
		mysqli_query($conn, $sql);
	}
	header("Location:../create_prod.php");
}
