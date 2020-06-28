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
<form action="db_management/delete_users.php" method="post">
	<h2>Delete users</h2>
		<table>
			<?php
			require('db_management/connect.php');
			$sql = "SELECT * FROM USERS";
			$result = mysqli_query($conn, $sql);
			while ($row = $result->fetch_assoc()) {
				if ($row['user'] == 'admin')
					continue;
				echo '<tr>';
				echo '<td>'.$row['user'].'</td>';
				echo '<td><input type="checkbox" name="user[]" value="'.$row['user'].'"></td>';
				echo '</tr>';
			}
			mysqli_close($conn);
			?>
		</table>
		<?php
			if (mysqli_num_rows ($result))
				echo '<input type="submit" name="submit" value="DELETE" />';
			?>
</form>
</body>
</html>
