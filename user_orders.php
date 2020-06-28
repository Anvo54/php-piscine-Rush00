<?php
session_start();
?>
<link rel="stylesheet" type="text/css" href="style/cart.css">
<link rel="stylesheet" type="text/css" href="style/style.css">
<link href="https://fonts.googleapis.com/css?family=Quicksand:300,500" rel="stylesheet">
<html>
	<body class="main_container">
		<?php include 'navigation.php'?>
		<div class="user">
		<h2>Your Orders</h2>
	<?php
		require('db_management/connect.php');
		$user = $_SESSION["login_user"];

		if ($user == 'admin' && isset($_GET['admin'])) {
			$stmt = mysqli_stmt_init($conn);
			if (mysqli_stmt_prepare($stmt, "SELECT * FROM ORDERS")) {
				mysqli_stmt_execute($stmt);
			}
		} else {
			$stmt = mysqli_stmt_init($conn);
			if (mysqli_stmt_prepare($stmt, "SELECT * FROM ORDERS WHERE USER =?")) {
				mysqli_stmt_bind_param($stmt, "s", $user);
				mysqli_stmt_execute($stmt);
			}
		}
		$result = mysqli_stmt_get_result($stmt);
		mysqli_stmt_close($stmt);
		if(mysqli_num_rows($result) === 0)
			echo "No orders found!";
		else {
			include 'get_products.php';
			while($row = mysqli_fetch_assoc($result)) {
				echo '<h3>Order '.$row['reg_date'].'</h3>';
				?>
			<table class="cart">
			<tr>
				<th style='width: 40%'>Items</th>
				<th style='width: 20%'>Quantity</th>
				<th style='width: 20%'>Unit Price</th>
				<th style='width: 20%'>Subtotal</th>
			</tr>
			<?php
				$items = explode(',',$row['cart']);
				$total = 0;
				foreach($items as $item) {
					$parts = explode(':', $item);
					$id = $parts[0];
					$quantity = $parts[1];
					$product = get_products($id);
					$subtotal = $quantity * $product['price'];
					$total += $subtotal;
					echo '<tr>';
					echo '<td>'.$product['name'].'</td>';
					echo '<td>'.$quantity.'</td>';
					echo '<td>$'.$product['price'] .'</td>';
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
			</table>
				<br>
				<?php
				echo 'Address:<br>';
				echo $row['firstname'].' '.$row['lastname'].'<br>';
				echo $row['address'].'<br>';
				echo $row['zipcode'].'<br>';
				echo $row['city'].'<br>';
				echo $row['country'].'<br><br>';
				echo 'Shipping: '.$row['shipping'].'<br>';
				echo 'Payment: '.$row['payment'].'<br>';
			}
		}
	?>
	</div>
	</body>
</html>
