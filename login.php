<html>
	<body>
		<?php include 'navigation.php'?>
		<form action="access_management/login.php" name="access_management/login.php" method="POST">
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