<?php
session_start();
?>
<html>
	<body>
		<?php include 'navigation.php'?>
		<h2>Your shopping cart</h2>
		<?php
		if (!$_SESSION['cart'])
			echo 'Cart is empty!';
		?>
	</body>
</html>
