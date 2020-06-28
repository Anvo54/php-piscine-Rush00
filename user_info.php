<?php
session_start();
require('db_management/connect.php');
$user = $_SESSION['login_user'];
$stmt = mysqli_stmt_init($conn);
if (mysqli_stmt_prepare($stmt, "SELECT * FROM USERDETAILS WHERE user=?")) {
	mysqli_stmt_bind_param($stmt, "s", $user);
	mysqli_stmt_execute($stmt);
}
$result = mysqli_stmt_get_result($stmt);
$usr = mysqli_fetch_assoc($result);
mysqli_stmt_close($stmt);
?>
<html>
<link rel="stylesheet" type="text/css" href="style/style.css">
<link href="https://fonts.googleapis.com/css?family=Quicksand:300,500" rel="stylesheet">
	<body class="main_container">
	<?php include 'navigation.php' ?>
	<div class="user">
	<h2>User details</h2>
	<form action="user_management/save_user_details.php" method="POST">
		<table>
				<tr>
					<td>First name: </td>
					<td><input type="text" name="firstname" value="<?= $usr['firstname'] ?? '' ?>"/></td>
				</tr>
				<tr>
					<td>Last name: </td>
					<td><input type="text" name="lastname" value="<?= $usr['lastname'] ?? '' ?>"/></td>
				</tr>
				<tr>
					<td>Address: </td>
					<td><input type="text" name="address" value="<?= $usr['address'] ?? '' ?>" /></td>
				</tr>
				<tr>
					<td>Zip code: </td>
					<td><input type="text" name="zipcode" value="<?= $usr['zipcode'] ?? '' ?>" /></td>
				</tr>
				<tr>
					<td>City: </td>
					<td><input type="text" name="city" value="<?= $usr['city'] ?? '' ?>" /></td>
				</tr>
				<tr>
					<td>Country: </td>
					<td><input type="text" name="country" value="<?= $usr['country'] ?? '' ?>"/></td>
				</tr>
		</table>
		<br>
		<input type="submit" name="submit" value="Save" />
	</form>
	</div>
	</body>
</html>
