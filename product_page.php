<?php
if (session_status() == PHP_SESSION_NONE) {
	session_start();
}
	function view_all_products()
	{
		require('db_management/connect.php');


		$stmt = mysqli_stmt_init($conn);
		if (mysqli_stmt_prepare($stmt, "SELECT * FROM PRODUCTS"))
			mysqli_stmt_execute($stmt);
		$result = mysqli_stmt_get_result($stmt);
		mysqli_stmt_close($stmt);
		echo "<h1>All products</h1>";
		echo '<div class="product_content">';
		while ($row = mysqli_fetch_assoc($result)) {
			echo "<div class='product_box'>";
			echo "<a href=?id=".$row['id']."&product_name=".str_replace(' ', '%20', $row["name"])."><h1>".$row["name"]."</h1></a>";
			echo "<img src=".$row["imgpath"].">";
			echo "<p>".$row['description']."</p>";
			echo "<p>$".$row["price"]." / ".$row['stock']." in stock</p>";
			echo "<form action='cart_management/add_to_cart.php' method='get'><input type='hidden' name='product' value='".$row["id"]."'><button type='submit' name='submit' value='add_to_cart'>Add to cart</button></form>";
			echo "</div>";
		}
		echo "</div>";
	}
	function view_product()
	{
		require('db_management/connect.php');
		$id = mysqli_real_escape_string($conn, $_GET["id"]);
		$stmt = mysqli_stmt_init($conn);
		if (mysqli_stmt_prepare($stmt, "SELECT * FROM PRODUCTS WHERE id=?")) {
			mysqli_stmt_bind_param($stmt, "i", $id);
			mysqli_stmt_execute($stmt);
		}
		$result = mysqli_stmt_get_result($stmt);
		mysqli_stmt_close($stmt);
		if(mysqli_num_rows($result) === 0)
			echo "Product not found!";
		else {
			$row = mysqli_fetch_assoc($result);
			echo "<div class='single_product'>";
			echo "<h1>".$row["name"]."</h1>";
			echo "<img src=".$row["imgpath"].">";
			echo "<p>".$row["description"]."</p>";
			echo "<p>$".$row["price"]." / ".$row['stock']." in stock</p>";
			echo "<form action='cart_management/add_to_cart.php' method='get'><input type='hidden' name='product' value='".$row["id"]."'><button type='submit' name='submit' value='add_to_cart'>Add to cart</button></form>";
			echo "</div>";
		}
	}
	$title = ((isset($_GET["product_name"]))) ? $_GET["product_name"] : "Products";

?>
<html>
<link rel="stylesheet" type="text/css" href="style/style.css">
<link href="https://fonts.googleapis.com/css?family=Quicksand:300,500" rel="stylesheet">
	<body class="main_container">
		<title><?php echo $title?></title>
		<?php include 'navigation.php'?>
		<?php (isset($_GET["product_name"])) ? view_product() : view_all_products()?>
	</body>
</html>
