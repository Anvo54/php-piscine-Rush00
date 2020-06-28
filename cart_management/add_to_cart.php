<?php
session_start();
if (!isset($_SESSION['cart']))
	$_SESSION['cart'] = array();

if (!array_key_exists($_GET['id'], $_SESSION['cart'] ))
	$_SESSION['cart'][$_GET['id']] = 1;
else
	$_SESSION['cart'][$_GET['id']]++;
header('Location:../cart.php');
?>
