<?php
session_start();
if ($_SESSION["login_user"] != 'admin')
	die('FORBIDDEN AREA');

require('db_management/connect.php');
$product = $_GET['product'];

$stmt = mysqli_stmt_init($conn);
if (mysqli_stmt_prepare($stmt, "SELECT * FROM PRODUCTS WHERE name=?")){
	mysqli_stmt_bind_param($stmt, "s", $product);
	mysqli_stmt_execute($stmt);
}
$result = mysqli_stmt_get_result($stmt);
$usr = mysqli_fetch_assoc($result);
mysqli_stmt_close($stmt);

?>
<html>
	<body>
	<link href="https://fonts.googleapis.com/css?family=Quicksand:300,500" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="style/style.css">
		<?php include 'navigation.php'?>
		<h2>Modify product</h2>
		<form action="db_management/modif_product.php?" method="POST">
			<table>
				<tr>
					<td>Name:</td>
					<td><input type="textfield" name="product_name" value="<?= $usr['name'] ?? '' ?>" required/></td>
				</tr>
				<tr>
					<td>Price:</td>
					<td><input type="textfield" name="product_price" value="<?= $usr['price'] ?? '' ?>" required/></td>
				</tr>
				<tr>
					<td>In stock:</td>
					<td><input type="textfield" name="product_stock" value="<?= $usr['stock'] ?? '' ?>" required/></td>
				</tr>
				<tr>
					<td>Image path:</td>
					<td><input type="textfield" name="product_image" value="<?= $usr['imgpath']?? '' ?>"/ required></td>
				</tr>
				<tr>
					<td>Description:</td>
					<td><input type="textarea" rows="5" name="product_description" value="<?= $usr['description'] ?? '' ?>"/ required></td>
					<input type="hidden" name="id" value="<?= $usr['id'] ?? '' ?>"/>
				</tr>
			</table>
			<table>
		<h3>Select categories</h3>
			<?php
			require('db_management/connect.php');


			$stmt = mysqli_stmt_init($conn);
			if (mysqli_stmt_prepare($stmt, "SELECT * FROM CATEGORIES"))
				mysqli_stmt_execute($stmt);
			$result = mysqli_stmt_get_result($stmt);
			mysqli_stmt_close($stmt);
			while ($row = mysqli_fetch_assoc($result)) {
				echo '<tr>';
				echo '<td>'.$row['name'].'</td>';
				echo '<td><input type="checkbox" name="category_name[]" value="'.$row['name'].'"></td>';
				echo '</tr>';
			}
			?>
		</table>
		<br>
		<input type="submit" name="submit" value="Update"/>
			<?php
			if (isset($_SESSION['msg'])) {
				echo $_SESSION['msg'];
				unset($_SESSION['msg']);
			}
			?>
		</form>
	</body>
</html>
