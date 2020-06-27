<?php
	session_start();
	function view_all_products()
	{
		$unserfile = unserialize(file_get_contents("data/products"));
		$products = $unserfile;
		echo "<h1>All products</h1>";
		foreach ($products as $product) {
			echo "<a href="."?product_name=".$product["product_name"]."><h1>".$product["product_name"]."</h1></a>";
			echo "<img src=".$product["product_image"].">";
			echo "<p>".$product["product_description"]."</p>";
			echo "<p>".$product["product_price"]." $</p>";
			echo "<button>Add to cart</button>";
			echo "<hr>";
		}
	}
	function view_product()
	{
		$product_found = FALSE;
		$unserfile = unserialize(file_get_contents("data/products"));
		$products = $unserfile;
		foreach ($products as $product) {
			if ($product["product_name"] == $_GET["product_name"])
			{
				$product_found = TRUE;
				echo "<h1>".$product["product_name"]."</h1>";
				echo "<img src=".$product["product_image"].">";
				echo "<p>".$product["product_description"]."</p>";
				echo "<p>".$product["product_price"]." $</p>";
				echo "<button>Add to cart</button>";
			}
		}
		if (!$product_found)
		{
			echo "Product not found!";
		}
	}
	$title = ($_GET["product_name"]) ? $_GET["product_name"] : "Products";

	if (!file_exists("data/products"))
	{
		include 'navigation.php';
		echo "Product catalog is empty please <a href=".'create_prod.php'.">add some products</a>";
		exit;
	}
?>
<html>
	<body>
		<title><?php echo $title?></title>
		<?php include 'navigation.php'?>
		<?php ($_GET["product_name"]) ? view_product() : view_all_products()?>
	</body>
</html>