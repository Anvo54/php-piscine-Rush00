<?php
session_start();
if ($_SESSION["login_user"] != 'admin')
	die('FORBIDDEN AREA');
?>
<html>
	<body class="main_container">
	<link href="https://fonts.googleapis.com/css?family=Quicksand:300,500" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="style/style.css">
		<?php include 'navigation.php'?>
		<div class="admin">
		<h2>Create Category</h2>
		<form action="db_management/add_category.php" method="POST">
			<table>
				<tr>
					<td>Category Name:</td>
					<td><input type="textfield" name="category_name" value="" required/></td>
				</tr>
			</table>
			<input type="submit" name="submit" value="OK" />
			<?php
			if (isset($_SESSION['error'])) {
				echo $_SESSION['error'];
				unset($_SESSION['error']);
			}
			if (isset($_SESSION['msg'])) {
				echo $_SESSION['msg'];
				unset($_SESSION['msg']);
			}
			?>
		</form>

		<form action="db_management/Manage_categories.php" method="post">
		<h2>Manage Categories</h2>
		<table>
			<?php
			require('db_management/connect.php');

			$stmt = mysqli_stmt_init($conn);
			if (mysqli_stmt_prepare($stmt, "SELECT * FROM CATEGORIES"))
				mysqli_stmt_execute($stmt);
			$result = mysqli_stmt_get_result($stmt);
			mysqli_stmt_close($stmt);
			while ($row = mysqli_fetch_assoc($result)) {
				echo '<tr>';
				echo '<td>'.$row['name'].'</td>';
				echo '<td><input type="checkbox" name="category_name[]" value="'.$row['name'].'"></td>';
				echo '</tr>';
			}
			mysqli_close($conn);
			?>
		</table>
		<br>
		<?php
			if (mysqli_num_rows ($result))
				echo '<input type="submit" name="submit" value="Delete" />';
			?>
</form>
</div>
	</body>
</html>
