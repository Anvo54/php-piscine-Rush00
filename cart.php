<?php
session_start();
?>
<link rel="stylesheet" type="text/css" href="style/cart.css">
<html>
	<body>
		<?php include 'navigation.php'?>
		<h2>Your shopping cart</h2>
		<?php
		if (!$_SESSION['cart']) {
			echo 'Cart is empty!';
			echo '</body></html>';
			die;
		}
		?>
		<table class="cart">
		<tr>
			<th style='width: 40%'>Items</th>
			<th style='width: 20%'>Quantity</th>
			<th style='width: 20%'>Unit Price</th>
			<th style='width: 20%'>Subtotal</th>
		</tr>
		<?php
		$total = 0;
		foreach($_SESSION['cart'] as $product => $quantity) {
			require('db_management/connect.php');
			$sql = "SELECT * FROM PRODUCTS WHERE name='$product'";
			$result = mysqli_query($conn, $sql);
			$row = $result->fetch_assoc();
			mysqli_close($conn);
			$subtotal = $quantity * $row['price'];
			$total += $subtotal;
			echo '<tr>';
			echo '<td>'.$product.'</td>';
			echo '<td>'.$quantity.'</td>';
			echo '<td>$'.$row['price'] .'</td>';
			echo '<td>$'.$subtotal.'</td>';
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
	</body>
</html>
