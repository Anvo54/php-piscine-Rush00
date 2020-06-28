<?php
session_start();
?>
<html>
	<body>
		<?php include 'navigation.php'?>
		<form action="db_management/modif_user.php" name="change_pw" method="POST">
			<h2>Change password</h2>
			<table>
				<tr>
					<td>Old password: </td>
					<td><input type="password" name="oldpw" value=""/></td>
				</tr>
				<tr>
					<td>New password: </td>
					<td><input type="password" name="newpw" value=""/></td>
				</tr>
			</table>
			<input type="submit" name="submit" value="OK" />
			<?php
			if (isset($_SESSION['msg'])) {
				echo $_SESSION['msg'];
				unset($_SESSION['msg']);
			}
			if (isset($_SESSION['error'])) {
				echo $_SESSION['error'];
				unset($_SESSION['error']);
			}
			?>
		</form>
	</body>
</html>
