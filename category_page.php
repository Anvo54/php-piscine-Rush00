<?php
	session_start();
	function view_category()
	{
		$category = $_GET['cat'];
		require('db_management/connect.php');
		$sql = "SELECT * FROM PRODUCTS WHERE categories LIKE '%".$category."%'";
		if (!$result = mysqli_query($conn, $sql))
			echo "Error: " . $sql . "<br>" . mysqli_error($conn);
		echo "<h1>$category products</h1>";
		echo '<div class="product_content">';
		while ($row = mysqli_fetch_assoc($result)) {
			echo "<div class='product_box'>";
			echo "<a href="."?product_name=".str_replace(' ', '%20', $row["name"])."><h1>".$row["name"]."</h1></a>";
			echo "<img src=".$row["imgpath"].">";
			echo "<p>".$row['description']."</p>";
			echo "<p>$".$row["price"]." / ".$row['stock']." in stock</p>";
			echo "<form action='cart_management/add_to_cart.php' method='get'><input type='hidden' name='product' value='".$row["id"]."'><button type='submit' name='submit' value='add_to_cart'>Add to cart</button></form>";
			echo "</div>";
		}
		echo "</div>";
	}

?>
<html>
<link href="https://fonts.googleapis.com/css?family=Quicksand:300,500" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="style/style.css">
	<body class="main_container">
		<title><?php echo $title?></title>
		<?php include 'navigation.php'?>
		<?php view_category()?>
	</body>
</html>
