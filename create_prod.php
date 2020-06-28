<?php
session_start();
?>
<html>
	<body>
		<title>Create product</title>
		<?php include 'navigation.php'?>
		<h2>Create product</h2>
		<form action="db_management/add_product.php" name="create_product" method="POST">
			<table>
				<tr>
					<td>Name:</td>
					<td><input type="textfield" name="product_name" value="" required/></td>
				</tr>
				<tr>
					<td>Price:</td>
					<td><input type="textfield" name="product_price" value="" required/></td>
				</tr>
				<tr>
					<td>In stock:</td>
					<td><input type="textfield" name="product_stock" value="" required/></td>
				</tr>
				<tr>
					<td>Image path:</td>
					<td><input type="textfield" name="product_image" value=""/ required></td>
				</tr>
				<tr>
					<td>Description:</td>
					<td><input type="textarea" rows="5" name="product_description" value=""/ required></td>
				</tr>
			</table>
			<input type="submit" name="submit" value="OK" />
			<?php
			if (isset($_SESSION['msg'])) {
				echo $_SESSION['msg'];
				unset($_SESSION['msg']);
			}
			?>
		</form>
	</body>
</html>
