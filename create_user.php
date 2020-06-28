<?php
session_start();
?>
<html>
<link href="https://fonts.googleapis.com/css?family=Quicksand:300,500" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="style/style.css">
	<body class="main_container">
		<?php include 'navigation.php' ?>
		<div class="admin">
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
		</div>
	</body>
</html>
