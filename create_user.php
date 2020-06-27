<html>
	<body>
		<?php include 'navigation.php' ?>
		<form action="access_management/create.php" name="create.php" method="POST">
			<h2>Create account</h2>
			<table>
				<tr>
					<td>Login: </td>
					<td><input type="textfield" name="login" value=""/></td>
				</tr>
				<tr>
					<td>Password: </td>
					<td><input type="password" name="passwd" value=""/></td>
				</tr>
			</table>
			<input type="submit" name="submit" value="OK" />
		</form>
	</body>
</html>