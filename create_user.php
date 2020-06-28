<?php
session_start();
?>
<html>
	<body>
		<?php include 'navigation.php' ?>
		<form action="db_management/add_user.php" name="create_user" method="POST">
			<h2>Create account</h2>
			<table>
				<tr>
					<td>Username: </td>
					<td><input type="textfield" name="login" value=""/></td>
				</tr>
				<tr>
					<td>Password: </td>
					<td><input type="password" name="passwd" value=""/></td>
				</tr>
			</table>
			<input type="submit" name="submit" value="OK" />
			<?php
			if (isset($_SESSION['error'])) {
				echo $_SESSION['error'];
				unset($_SESSION['error']);
			}
			?>
		</form>
	</body>
</html>
