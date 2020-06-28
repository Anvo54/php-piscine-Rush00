<?php
session_start();
?>
<link rel="stylesheet" type="text/css" href="style/cart.css">
<link rel="stylesheet" type="text/css" href="style/style.css">
<link href="https://fonts.googleapis.com/css?family=Quicksand:300,500" rel="stylesheet">
<html>
	<body class="main_container">
		<?php include 'navigation.php'?>
		<h2>Your Orders</h2>
	<?php
		require('db_management/connect.php');
		$user = $_SESSION["login_user"];
		$sql = "SELECT * FROM ORDERS WHERE user='$user'";
		$result = mysqli_query($conn, $sql);
		if(mysqli_num_rows($result) === 0)
			echo "No orders found!";
		else {
			include 'get_products.php';
			while($row = $result->fetch_assoc()) {
				echo '<h3>Order '.$row['reg_date'].'</h3>';
				$items = explode(',',$row['cart']);
				foreach($items as $item) {
					$parts = explode(':', $item);
					$id = $parts[0];
					$quantity = $parts[1];
					$product = get_products($id);
					?>
					<?php
					$total = 0;
					$subtotal = $quantity * $row['price'];
					$total += $subtotal;
					echo '<tr>';
					echo '<td>'.$row['name'].'</td>';
					echo '<td>'.$quantity.'</td>';
					echo '<td>$'.$row['price'] .'</td>';
					echo '<td>$'.$subtotal.'</td>';
					echo '</tr>';
		}
		?>
		</table>
				}
				echo $row['firstname'].' '.$row['lastname'].'<br>';
				echo $row['address'].'<br>';
				echo $row['zipcode'].'<br>';
				echo $row['city'].'<br>';
				echo $row['country'].'<br>';
			}
		}
	?>
	</body>
</html>
