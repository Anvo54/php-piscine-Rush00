<?php
	function create_product()
	{
		$product = array(
			"product_name" => $_POST["product_name"],
			"product_price" => $_POST["product_price"],
			"product_description" => $_POST["product_description"],
			"product_image" => $_POST["product_image"]
		);
		if (file_exists("data/products"))
		{
			$unserfile = unserialize(file_get_contents("data/products"));
			$products = $unserfile;
		}
		$products[] = $product;
		file_put_contents("data/products", serialize($products));
		// Go back to admin page
		echo "OK\n";
	}

	function product_exists()
	{
		if (!file_exists("data/products"))
		{
			return;
		}
		$unserfile = unserialize(file_get_contents("data/products"));
		foreach ($unserfile as $product)
		{
			if ($product["product_name"] === $_POST["product_name"])
				exit("Product exists!\n");
		}
	}

	if ($_POST["submit"] !== "OK" && (!$_POST["product_name"]) || !$_POST["product_price"] || !$_POST["product_description"])
	{
		echo "ERROR\n";
		exit ;
	}

	if (!file_exists("data/products"))
		mkdir("data", 0755, true);

	if (product_exists())
	{
		// modify here
		exit ;
	}
	else
	{
		create_product();
	}
?>