<?php
if (session_status() == PHP_SESSION_NONE) {
	session_start();
}
$accounttext = ($_SESSION["login_user"]) ? $_SESSION["login_user"] : "Account";
?>

<link rel="stylesheet" type="text/css" href="style/menu.css">
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Quicksand:300,500" rel="stylesheet">
<nav>
	<ul class="navigation">
	<a href="index.php"><h1 class="header">The webshop!</h1></a>
	<li><a href="product_page.php"><i class="material-icons md-24">shop</i>Products</a></li>
		<li><a href="#"><i class="material-icons md-24">category</i>Categories</a>
			<ul>
			<?php
			require('db_management/connect.php');
			$sql = "SELECT * FROM CATEGORIES";
			$result = mysqli_query($conn, $sql);
			while ($cats = $result->fetch_assoc()) {
				echo "<li><a href=category_page.php?cat=".$cats['name'].">".$cats['name']."</a></li>";
			}
			?>
			</ul>
		</li>
		<li><a href="#"><i class="material-icons md-24">account_circle</i><?php echo $accounttext?></a>
			<ul>
				<?php
				if ($_SESSION["login_user"]) {
					echo '<li><a href="user_orders.php">My orders</a></li>';

					echo '<li><a href="user_info.php">My details</a></li>';
					echo '<li><a href="manage_account.php">Manage account</a></li>';
					echo '<li><a href="access_management/logout.php">Logout</a></li>';
				}
				else
					echo '<li><a href="login.php">Login/Register</a></li>';
				?>
			</ul>
		<li><a href="cart.php"><i class="material-icons md-24">shopping_cart</i>My cart</a></li>
		<?php
		if ($_SESSION["login_user"] == 'admin')
			echo '<li><a href="#"><i class="material-icons md-24">admin_panel_settings</i>Admin</a>';
		?>
			<ul>
				<li><a href="create_prod.php">Manage products</a></li>
				<li><a href="manage_categories.php">Manage categories</a></li>
				<li><a href="remove_users.php">Manage users</a></li>
				<li><a href="#">View all orders</a></li>
			</ul>
			</li>
		</li>
	</ul>
</nav>
