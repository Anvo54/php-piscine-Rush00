<?php
session_start();
if ($_SESSION["login_user"] != 'admin')
	die('FORBIDDEN AREA');
?>
<html>
<link href="https://fonts.googleapis.com/css?family=Quicksand:300,500" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="style/style.css">
	<body class="main_container">
		<title>Create product</title>
		<?php include 'navigation.php'?>
		<div class="admin">
		<h2>Add product</h2>
		<h3>Product details</h3>
		<form action="db_management/add_product.php" name="create_product" method="POST" enctype="multipart/form-data">
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
					<td><input type="file" name="product_image" value=""/ required id="product_image"></td>
				</tr>
				<tr>
					<td>Description:</td>
					<td><input type="textarea" rows="5" name="product_description" value=""/ required></td>
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
			mysqli_close($conn);
			?>
		</table>
		<br>
		<input type="submit" name="submit" value="Create" />
			<?php
			if (isset($_SESSION['msg'])) {
				echo $_SESSION['msg'];
				unset($_SESSION['msg']);
			}
			?>
		</form>
		<form action="db_management/delete_product.php" method="post">
	<h2>Product list</h2>
		<table>
			<?php
			require('db_management/connect.php');
			$sql = "SELECT * FROM PRODUCTS";
			$result = mysqli_query($conn, $sql);
			while ($row = mysqli_fetch_assoc($result)) {
				echo '<tr>';
				echo '<td>'.$row['id'].'</td>';
				echo '<td><a href="modify_product.php?product='.$row['name'].'">'.$row['name'].'</a></td>';
				echo '<td>'.$row['categories'].'</td>';
				echo '<td><input type="checkbox" name="id[]" value="'.$row['id'].'"></td>';
				echo '</tr>';
			}
			mysqli_close($conn);
			?>
		</table>
		<br>
		<?php
			if (mysqli_num_rows ($result))
				echo '<input type="submit" name="submit" value="Delete" />';
			?>
</form>
</div>
	</body>
</html>
