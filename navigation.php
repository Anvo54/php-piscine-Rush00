<?php
session_start();
$accounttext = ($_SESSION["loggued_on_user"]) ? $_SESSION["loggued_on_user"] : "Account";
?>

<link rel="stylesheet" type="text/css" href="style/menu.css">
<nav>
	<ul class="navigation">
	<a href="index.php"><h1 class="header">The webshop!</h1></a>
		<li><a href="product_page.php">Products</a></li>
		<li><a href="#">Categories</a>
			<ul>
				<li><a href="#">Categories</a></li>
				<li><a href="#">Categories</a></li>
				<li><a href="#">Categories</a></li>
			</ul>
		</li>
		<li><a href="#"><?php echo $accounttext?></a>
			<ul>
				<?php
				if ($_SESSION["loggued_on_user"]) {
					echo '<li><a href="access_management/logout.php">Logout</a></li>';
					echo '<li><a href="change_password.php">Change password</a></li>';
					echo '<li><a href="remove_user.php">Delete account</a></li>';
				}
				else
					echo '<li><a href="login.php">Login/Register</a></li>';
				?>
			</ul>
		<li><a href="cart.php">My cart</a></li>
		</li>
	</ul>
</nav>
