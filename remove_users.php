<?php
session_start();
if ($_SESSION["login_user"] != 'admin')
	die('FORBIDDEN AREA');
?>
<html>
<link rel="stylesheet" type="text/css" href="style/style.css">
<link href="https://fonts.googleapis.com/css?family=Quicksand:300,500" rel="stylesheet">
<body class="main_container">
<?php include 'navigation.php' ?>
<div class="admin">
<form action="db_management/delete_users.php" method="post">
	<h2>Delete users</h2>
		<table>
			<?php
			require('db_management/connect.php');
			$stmt = mysqli_stmt_init($conn);
			if (mysqli_stmt_prepare($stmt, "SELECT * FROM USERS"))
				mysqli_stmt_execute($stmt);
			$result = mysqli_stmt_get_result($stmt);
			while ($row = mysqli_fetch_assoc($result)) {
				if ($row['user'] == 'admin')
					continue;
				echo '<tr>';
				echo '<td>'.$row['user'].'</td>';
				echo '<td><input type="checkbox" name="user[]" value="'.$row['user'].'"></td>';
				echo '</tr>';
			}
			mysqli_stmt_close($stmt);
			?>
		</table>
		<?php
			if (mysqli_num_rows ($result))
				echo '<input type="submit" name="submit" value="DELETE" />';
			?>
</form>
</div>
</body>
</html>
