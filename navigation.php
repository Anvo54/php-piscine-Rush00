<?php
session_start();
$accounttext = ($_SESSION["login_user"]) ? $_SESSION["login_user"] : "Account";
?>

<link rel="stylesheet" type="text/css" href="style/menu.css">
<nav>
	<ul class="navigation">
	<a href="index.php"><h1 class="header">The webshop!</h1></a>
		<li><a href="product_page.php">Products</a></li>
		<li><a href="#">Categories</a>
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
		<li><a href="#"><?php echo $accounttext?></a>
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
		<li><a href="cart.php">My cart</a></li>
		<?php
		if ($_SESSION["login_user"] == 'admin')
			echo '<li><a href="admin.php">Admin</a></li>';
		?>
		</li>
	</ul>
</nav>
