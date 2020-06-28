<?php
session_start();
if ($user = $_SESSION['login_user'] != '') {
	require('db_management/connect.php');
	$sql = "SELECT * FROM USERDETAILS WHERE user='$user'";
	$result = mysqli_query($conn, $sql);
	$usr = $result->fetch_assoc();
	mysqli_close($conn);
} else {
	$_SESSION['error'] = 'Log in before making an order';
	header('Location:login.php');
	die();
}
?>
<html>
	<body>
	<link rel="stylesheet" type="text/css" href="style/style.css">
	<link href="https://fonts.googleapis.com/css?family=Quicksand:300,500" rel="stylesheet">
	<?php include 'cart.php'?>
	<h2>Delivery Address</h2>
	<form action="cart_management/create_order.php" name="login.php" method="POST">
		<table>
				<tr>
					<td>First name: </td>
					<td><input type="text" name="firstname" value="<?= $usr['firstname'] ?? '' ?>" required/></td>
				</tr>
				<tr>
					<td>Last name: </td>
					<td><input type="text" name="lastname" value="<?= $usr['lastname'] ?? '' ?>" required/></td>
				</tr>
				<tr>
					<td>Address: </td>
					<td><input type="text" name="address" value="<?= $usr['address'] ?? '' ?>" required/></td>
				</tr>
				<tr>
					<td>Zip code: </td>
					<td><input type="text" name="zipcode" value="<?= $usr['zipcode'] ?? '' ?>" required/></td>
				</tr>
				<tr>
					<td>City: </td>
					<td><input type="text" name="city" value="<?= $usr['city'] ?? '' ?>" required/></td>
				</tr>
				<tr>
					<td>Country: </td>
					<td><input type="text" name="country" value="<?= $usr['country'] ?? '' ?>" required/></td>
				</tr>
		</table>
		<h3>Choose shipping</h3>
		<input type="radio" id="Express mail" name="shipping" value="express">
		<label for="express">Express (4-7 working days) - $24.99</label><br>
		<input type="radio" id="priority" name="shipping" value="priority">
		<label for="priority">Priority (8-14 days) - $9.99</label><br>
		<input type="radio" id="standard" name="shipping" value="standard">
		<label for="standard">Standard (15-21 days) - FREE</label><br><br>
		<h3>Choose payment method</h3>
		<input type="radio" id="creditcard" name="payment" value="creditcard">
		<label for="creditcard">Credit card</label><br>
		<input type="radio" id="bank" name="payment" value="bank">
		<label for="priority">Bank transfer</label><br>
		<input type="radio" id="bitcoin" name="payment" value="bitcoin">
		<label for="bitcoin">Bitcoin</label><br><br>
		<input type="submit" name="submit" value="Order" />
	</form>
	</body>
</html>
