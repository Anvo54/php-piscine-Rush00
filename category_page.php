<?php
	session_start();
	function view_category()
	{
		$category = $_GET['cat'];
		require('db_management/connect.php');
		$sql = "SELECT * FROM PRODUCTS WHERE categories LIKE '%$category%'";
		$result = mysqli_query($conn, $sql);
		echo "<h1>$category products</h1>";
		while ($row = $result->fetch_assoc()) {
			echo "<a href="."?product_name=".$row["name"]."><h1>".$row["name"]."</h1></a>";
			echo "<img src=".$row["imgpath"].">";
			echo "<p>".$row['description']."</p>";
			echo "<p>$".$row["price"]." / ".$row['stock']." in stock</p>";
			echo "<form action='cart_management/add_to_cart.php' method='get'><input type='hidden' name='product' value='".$row["name"]."'><button type='submit' name='submit' value='add_to_cart'>Add to cart</button></form>";
			echo "<hr>";
		}
	}

?>
<html>
	<body>
		<title><?php echo $title?></title>
		<?php include 'navigation.php'?>
		<?php view_category()?>
	</body>
</html>
