<?php
session_start();
if (!isset($_SESSION['cart']))
	$_SESSION['cart'] = array();

if (!array_key_exists($_GET['product'], $_SESSION['cart'] ))
	$_SESSION['cart'][$_GET['product']] = 1;
else
	$_SESSION['cart'][$_GET['product']]++;
header('Location:../cart.php');
?>
