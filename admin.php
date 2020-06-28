<?php
session_start();
if ($_SESSION["login_user"] != 'admin')
	die('FORBIDDEN AREA');
?>
<html>
<link rel="stylesheet" type="text/css" href="style/style.css">
<link href="https://fonts.googleapis.com/css?family=Quicksand:300,500" rel="stylesheet">
	<body class="main_container">
		<?php include 'navigation.php'?>
		<h2>Admin area</h2>
		<ul>
			<li><a href="create_prod.php">Manage products</a></li>
			<li><a href="manage_categories.php">Manage categories</a></li>
			<li><a href="remove_users.php">Manage users</a></li>
			<li><a href="#">View all orders</a></li>
		</ul>
	</body>
</html>
