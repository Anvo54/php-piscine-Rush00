<?php
session_start();
if ($_SESSION["loggued_on_user"] != 'admin')
	die('FORBIDDEN AREA');
?>
<html>
	<body>
		<?php include 'navigation.php'?>
		<h2>Admin area</h2>
		<ul>
			<li><a href="create_prod.php">Create product</a></li>
			<li><a href="remove_product.php">Remove products<s/a></li>
			<li><a href="#">Modify products</a></li>
			<li><a href="remove_users.php">View/remove users</a></li>
			<li><a href="#">View orders</a></li>
		</ul>
	</body>
</html>
