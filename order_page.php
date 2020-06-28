<?php
session_start();
if (($_SESSION['login_user']) != '') {
	require('db_management/connect.php');
	$user = mysqli_real_escape_string($conn, $_SESSION['login_user']);
	$stmt = mysqli_stmt_init($conn);
		if (mysqli_stmt_prepare($stmt, "SELECT * FROM USERDETAILS WHERE user=?")) {
			mysqli_stmt_bind_param($stmt, "s", $user);
			mysqli_stmt_execute($stmt);
		}
	$result = mysqli_stmt_get_result($stmt);
	$usr = mysqli_fetch_assoc($result);
	mysqli_stmt_close($stmt);
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
	<div class="user">
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
		<input type="radio" id="Express mail" name="shipping" value="Express">
		<label for="express">Express (4-7 working days) - $24.99</label><br>
		<input type="radio" id="priority" name="shipping" value="Priority">
		<label for="priority">Priority (8-14 days) - $9.99</label><br>
		<input type="radio" id="standard" name="shipping" value="Standard">
		<label for="standard">Standard (15-21 days) - FREE</label><br><br>
		<h3>Choose payment method</h3>
		<input type="radio" id="creditcard" name="payment" value="Credit Card">
		<label for="creditcard">Credit card</label><br>
		<input type="radio" id="bank" name="payment" value="Bank">
		<label for="priority">Bank transfer</label><br>
		<input type="radio" id="bitcoin" name="payment" value="Bitcoin">
		<label for="bitcoin">Bitcoin</label><br><br>
		<input type="submit" name="submit" value="Order" />
	</form>
	</div>
	</body>
</html>
