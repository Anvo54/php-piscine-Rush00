<?php
	session_start();
	function view_all_products()
	{
		require('db_management/connect.php');
		$sql = "SELECT * FROM PRODUCTS";
		$result = mysqli_query($conn, $sql);
		echo "<h1>All products</h1>";
		while ($row = $result->fetch_assoc()) {
			echo "<a href="."?product_name=".$row["name"]."><h1>".$row["name"]."</h1></a>";
			echo "<img src=".$row["imgpath"].">";
			echo "<p>".$row['description']."</p>";
			echo "<p>$".$row["price"]." / ".$row['stock']." in stock</p>";
			echo "<button>Add to cart</button>";
			echo "<hr>";
		}
	}
	function view_product()
	{
		require('db_management/connect.php');
		$product = $_GET["product_name"];
		$sql = "SELECT * FROM PRODUCTS WHERE name='$product'";
		$result = mysqli_query($conn, $sql);
		if(mysqli_num_rows($result) === 0)
			echo "Product not found!";
		else {
			$row = $result->fetch_assoc();
			echo "<h1>".$row["name"]."</h1>";
			echo "<img src=".$row["imgpath"].">";
			echo "<p>".$row["description"]."</p>";
			echo "<p>$".$row["price"]." / ".$row['stock']." in stock</p>";
			echo "<button>Add to cart</button>";
		}
	}
	$title = ($_GET["product_name"]) ? $_GET["product_name"] : "Products";

?>
<html>
	<body>
		<title><?php echo $title?></title>
		<?php include 'navigation.php'?>
		<?php ($_GET["product_name"]) ? view_product() : view_all_products()?>
	</body>
</html>
