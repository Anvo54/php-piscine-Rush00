<?php
session_start();
require('db_management/connect.php');
$user = $_SESSION['login_user'];
$sql = "SELECT * FROM USERDETAILS WHERE user='$user'";
$result = mysqli_query($conn, $sql);
$row = $result->fetch_assoc();
mysqli_close($conn);
?>
<html>
	<body>
	<?php include 'navigation.php' ?>
	<h2>User details</h2>
	<form action="user_management/save_user_details.php" method="POST">
		<table>
				<tr>
					<td>First name: </td>
					<td><input type="text" name="firstname" value="<?= $row['firstname']?>"/></td>
				</tr>
				<tr>
					<td>Last name: </td>
					<td><input type="text" name="lastname" value="<?= $row['lastname']?>"/></td>
				</tr>
				<tr>
					<td>Address: </td>
					<td><input type="text" name="address" value="<?= $row['address']?>" /></td>
				</tr>
				<tr>
					<td>Zip code: </td>
					<td><input type="text" name="zipcode" value="<?= $row['zipcode']?>" /></td>
				</tr>
				<tr>
					<td>City: </td>
					<td><input type="text" name="city" value="<?= $row['city']?>" /></td>
				</tr>
				<tr>
					<td>Country: </td>
					<td><input type="text" name="country" value="<?= $row['country']?>"/></td>
				</tr>
		</table>
		<br>
		<input type="submit" name="submit" value="Save" />
	</form>
	</body>
</html>
