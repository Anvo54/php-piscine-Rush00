<?php
if (session_status() == PHP_SESSION_NONE) {
	session_start();
}
if (isset($_GET['action']) && $_GET['action'] == 'rm' && array_key_exists($_GET['id'],$_SESSION['cart'])) {
	unset($_SESSION['cart'][$_GET['id']]);
}
?>
<link rel="stylesheet" type="text/css" href="style/cart.css">
<link rel="stylesheet" type="text/css" href="style/style.css">
<link href="https://fonts.googleapis.com/css?family=Quicksand:300,500" rel="stylesheet">
<html>
	<body class="main_container">
		<?php include 'navigation.php'?>
		<div class="user">
		<h2>Your shopping cart</h2>
		<?php
		if (!isset($_SESSION['cart']) || count($_SESSION['cart']) === 0) {
			echo 'Cart is empty!';
			echo '</body></html>';
			die;
		}
		?>
		<table class="cart">
		<tr>
			<th style='width: 30%'>Items</th>
			<th style='width: 15%'>Quantity</th>
			<th style='width: 20%'>Unit Price</th>
			<th style='width: 20%'>Subtotal</th>
			<th style='width: 15%'>Remove</th>
		</tr>
		<?php
		$total = 0;
		foreach($_SESSION['cart'] as $id => $quantity) {
			require('db_management/connect.php');
			$id = mysqli_real_escape_string($conn, $id);
			$stmt = mysqli_stmt_init($conn);
			if (mysqli_stmt_prepare($stmt, "SELECT * FROM PRODUCTS WHERE id=?")) {
				mysqli_stmt_bind_param($stmt, "i", $id);
				mysqli_stmt_execute($stmt);
			}
			$result = mysqli_stmt_get_result($stmt);
			mysqli_stmt_close($stmt);
			$row = mysqli_fetch_assoc($result);
			$subtotal = $quantity * $row['price'];
			$total += $subtotal;
			echo '<tr>';
			echo '<td>'.$row['name'].'</td>';
			echo '<td>'.$quantity.'</td>';
			echo '<td>$'.$row['price'] .'</td>';
			echo '<td>$'.$subtotal.'</td>';
			echo '<td><a href="cart.php?action=rm&id='.$id.'">X</a></td>';
			echo '</tr>';
		}
		?>
		</table>
		<br>
		<table class="total">
		<tr class="total">
			<th class="total"></th>
			<th class="total"></th>
			<th class="total"></th>
			<th style='width: 20%'>Total</th>
		</tr>
		<tr class="total">
			<td class="total"></td>
			<td class="total"></td>
			<td class="total"></td>
			<td style='width: 20%'><?php echo '<b>$'.$total.'</>'; ?></td>
		</tr>
		</table>
		<form action="order_page.php" method="POST">
			<input type="submit" name="submit" value="Checkout" />
		</form>
		</div>
	</body>
</html>
