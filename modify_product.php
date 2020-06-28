<?php
session_start();
require('db_management/connect.php');
$product = $_GET['product'];

$sql = "SELECT * FROM PRODUCTS WHERE name='$product'";
if (!$result = mysqli_query($conn, $sql))
	die('ERROR');
$usr = mysqli_fetch_assoc($result);
?>
<html>
	<body class="main_container">
	<link href="https://fonts.googleapis.com/css?family=Quicksand:300,500" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="style/style.css">
		<?php include 'navigation.php'?>
		<div class="admin">
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
			$sql = "SELECT * FROM CATEGORIES";
			$result = mysqli_query($conn, $sql);
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
		</div>
	</body>
</html>
