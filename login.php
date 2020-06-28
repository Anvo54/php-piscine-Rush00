<?php
session_start();
?>
<html>
<link rel="stylesheet" type="text/css" href="style/style.css">
	<body class="main_container">
		<?php include 'navigation.php'?>
		<form action="access_management/login.php" name="login.php" method="POST">
			<h2>Login</h2>
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
			<a href="create_user.php">register</a>
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
