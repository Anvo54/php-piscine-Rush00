<html>
	<body>
		<title>Create product</title>
		<?php include 'navigation.php'?>
		<form name="create_product" action="create_product.php" method="POST">
			<table>
				<tr>
					<td>Product name:</td>
					<td><input type="textfield" name="product_name" value="" required/></td>
				</tr>
				<tr>
					<td>Product price:</td>
					<td><input type="textfield" name="product_price" value="" required/></td>
				</tr>
				<tr>
					<td>Product Description:</td>
					<td><input type="textarea" rows="5" name="product_description" value=""/ required></td>
				</tr>
				<tr>
					<td>Product image path:</td>
					<td><input type="textfield" name="product_image" value=""/ required></td>
				</tr>
			</table>
			<input type="submit" name="submit" value="OK" />
		</form>
	</body>
</html>