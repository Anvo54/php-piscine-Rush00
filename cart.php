<?php
session_start();
?>
<link rel="stylesheet" type="text/css" href="style/cart.css">
<link rel="stylesheet" type="text/css" href="style/style.css">
<link href="https://fonts.googleapis.com/css?family=Quicksand:300,500" rel="stylesheet">
<html>
	<body class="main_container">
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
		echo print_r($_SESSION);
		foreach($_SESSION['cart'] as $id => $quantity) {
			require('db_management/connect.php');
			$sql = "SELECT * FROM PRODUCTS WHERE id=$id";
			if ($result = mysqli_query($conn, $sql)) {
				echo nl2br("New order created successfully\n");
			} else {
				echo "Error: " . $sql . "<br>" . mysqli_error($conn);
			}
			$row = $result->fetch_assoc();
			mysqli_close($conn);
			$subtotal = $quantity * $row['price'];
			$total += $subtotal;
			echo '<tr>';
			echo '<td>'.$row['product'].'</td>';
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
