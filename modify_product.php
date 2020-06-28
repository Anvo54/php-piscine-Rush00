<?php
session_start();
require('db_management/connect.php');
$product = $_GET['product'];

$sql = "SELECT * FROM PRODUCTS WHERE name='$product'";
if (!$result = mysqli_query($conn, $sql))
	die('ERROR');
$row = $result->fetch_assoc();
?>
<html>
	<body>
		<?php include 'navigation.php'?>
		<h2>Modify product</h2>
		<form action="db_management/modif_product.php?" method="POST">
			<table>
				<tr>
					<td>Name:</td>
					<td><input type="textfield" name="product_name" value="<?= $row['name']?>" required/></td>
				</tr>
				<tr>
					<td>Price:</td>
					<td><input type="textfield" name="product_price" value="<?= $row['price']?>" required/></td>
				</tr>
				<tr>
					<td>In stock:</td>
					<td><input type="textfield" name="product_stock" value="<?= $row['stock']?>" required/></td>
				</tr>
				<tr>
					<td>Image path:</td>
					<td><input type="textfield" name="product_image" value="<?= $row['imgpath']?>"/ required></td>
				</tr>
				<tr>
					<td>Description:</td>
					<td><input type="textarea" rows="5" name="product_description" value="<?= $row['description']?>"/ required></td>
					<input type="hidden" name="id" value="<?= $row['id']?>"/>
				</tr>
			</table>
			<table>
		<h3>Select categories</h3>
			<?php
			require('db_management/connect.php');
			$sql = "SELECT * FROM CATEGORIES";
			$result = mysqli_query($conn, $sql);
			while ($row = $result->fetch_assoc()) {
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
