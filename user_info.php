<html>
	<body>
	<?php include 'navigation.php' ?>
	<h2>User details</h2>
	<form action="" name="user_details.php" method="POST">
		<table>
				<tr>
					<td>First name: </td>
					<td><input type="text" name="firstname" value=""/></td>
				</tr>
				<tr>
					<td>Last name: </td>
					<td><input type="text" name="lastname" value=""/></td>
				</tr>
				<tr>
					<td>Address: </td>
					<td><input type="text" name="address" value="" /></td>
				</tr>
				<tr>
					<td>Zip code: </td>
					<td><input type="text" name="zipcode" value="" /></td>
				</tr>
				<tr>
					<td>City: </td>
					<td><input type="text" name="zipcode" value="" /></td>
				</tr>
				<tr>
					<td>Country: </td>
					<td><input type="text" name="zipcode" value=""/></td>
				</tr>
		</table>
		<br>
		<input type="submit" name="submit" value="Save" />
	</form>
	</body>
</html>
