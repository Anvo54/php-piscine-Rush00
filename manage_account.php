<?php
session_start();
?>
<html>
<link rel="stylesheet" type="text/css" href="style/style.css">
<link href="https://fonts.googleapis.com/css?family=Quicksand:300,500" rel="stylesheet">
	<body class="main_container">
		<?php include 'navigation.php'?>
		<div class="user">
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
		<form action="db_management/delete_user.php" name="remove_user" method="POST">
		<h2>Delete user account?</h2>
			<input type="submit" name="submit" value="Yes" />
			<input type="submit" name="submit" value="Cancel" />
		</form>
		</div>
	</body>
</html>
