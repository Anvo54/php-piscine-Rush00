<?php
	function view_all_products()
	{
		$unserfile = unserialize(file_get_contents("data/products"));
		$products = $unserfile;
		echo "<h1>All products</h1>";
		foreach ($products as $product) {
			echo "<h1>".$product["product_name"]."</h1>";
			echo "<img src=".$product["product_image"].">";
			echo "<p>".$product["product_description"]."</p>";
			echo "<p>".$product["product_price"]." $</p>";
			echo "<button>Add to cart</button>";
			echo "<hr>";
		}
	}
	function view_product()
	{
		$unserfile = unserialize(file_get_contents("data/products"));
		$products = $unserfile;
		foreach ($products as $product) {
			if ($product["product_name"] == $_GET["product_name"])
			{
				echo "<h1>".$product["product_name"]."</h1>";
				echo "<img src=".$product["product_image"].">";
				echo "<p>".$product["product_description"]."</p>";
				echo "<p>".$product["product_price"]."</p>";
				echo "<button>Add to cart</button>";
			}
		}
	}
	$title = ($_GET["product_name"]) ? $_GET["product_name"] : "Products";

	if (!file_exists("data/products"))
	{
		include 'navigation.php';
		echo "Product catalog is empty please <a href=".'create_product.html'.">add some products</a>";
		exit;
	}
?>
<html>
	<body>
		<title><?php echo $title?></title>
		<?php include 'navigation.php'?>
		<?php ($product = $_GET["product_name"]) ? view_product() : view_all_products()?>
	</body>
</html>