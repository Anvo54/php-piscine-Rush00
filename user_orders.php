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
		if ($user == 'admin' && isset($_GET['admin']))
			$sql = "SELECT * FROM ORDERS";
		else
			$sql = "SELECT * FROM ORDERS WHERE user='$user'";
		$result = mysqli_query($conn, $sql);
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
				foreach($items as $item) {
					$total = 0;
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
