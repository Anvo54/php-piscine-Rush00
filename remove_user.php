<?php
session_start();
?>
<html>
	<body>
		<?php include 'navigation.php' ?>
		<form action="db_management/delete_user.php" name="remove_user" method="POST">
			<table>
				<tr>
					<td>Delete user account?</td>
				</tr>
			</table>
			<input type="submit" name="submit" value="Yes" />
			<input type="submit" name="submit" value="Cancel" />
		</form>
	</body>
</html>
