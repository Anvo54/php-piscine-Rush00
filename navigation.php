<?php
	$accounttext = ($_SESSION["loggued_on_user"]) ? $_SESSION["loggued_on_user"] : "Account";
?>

<link rel="stylesheet" type="text/css" href="style/menu.css">
<nav>
	<ul class="navigation">
	<a href="index.php"><h1 class="header">The webshop!</h1></a>
		<li>
			<a href="product_page.php">Products</a></li>
		</li>
		<li><a href="#"><?php echo $accounttext?></a>
			<ul>
				<li><a href="login.php">Login/Register</a></li>
				<li><a href="access_management/logout.php">Logout</a></li>
				<li><a href="#">My cart</a></li>
			</ul>
		</li>

	</ul>
</nav>