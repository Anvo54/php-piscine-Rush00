<?php
$servername = "localhost";
$username = "root";
$password = "password";
$dbname = "webshop";
$admin_pass = password_hash($password, PASSWORD_DEFAULT);

$conn = mysqli_connect($servername, $username, $password);
if (!$conn) {
	die("Connection failed: " . mysqli_connect_error());
}

$sql = "CREATE DATABASE $dbname";
if (mysqli_query($conn, $sql)) {
	echo nl2br("Database created successfully\n");
} else {
	die("Error creating database: " . mysqli_error($conn));
}

mysqli_close($conn);
$conn = mysqli_connect($servername, $username, $password, $dbname);
if (!$conn) {
	die("Connection failed: " . mysqli_connect_error());
}

$users = "CREATE TABLE USERS (
id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
user VARCHAR(30) NOT NULL,
password VARCHAR(255) NOT NULL,
reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
)";

$products = "CREATE TABLE PRODUCTS (
	id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
	name VARCHAR(30) NOT NULL,
	categories VARCHAR(500),
	price DECIMAL(7,2) NOT NULL,
	stock INT(4) NOT NULL,
	imgpath VARCHAR(30) NOT NULL,
	description VARCHAR(30) NOT NULL
	)";

$orders = "CREATE TABLE ORDERS (
	id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
	user VARCHAR(30) NOT NULL,
	cart TEXT(1000) NOT NULL,
	details TEXT(1000) NOT NULL,
	reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
	)";

$userdetails = "CREATE TABLE USERDETAILS (
	id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
	user VARCHAR(30) NOT NULL,
	firstname VARCHAR(30) NOT NULL,
	lastname VARCHAR(30) NOT NULL,
	address VARCHAR(30) NOT NULL,
	zipcode VARCHAR(10) NOT NULL,
	city VARCHAR(30) NOT NULL,
	country VARCHAR(30) NOT NULL
	)";

$categories = "CREATE TABLE CATEGORIES (
	id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
	name VARCHAR(30) NOT NULL,
	products VARCHAR(1000)
	)";


if (mysqli_multi_query($conn, $users.';'.$products.';'.$orders.';'.$userdetails.';'.$categories))
	echo nl2br("Tables created successfully\n");
else
	echo "Error: " . $sql . "<br>" . mysqli_error($conn);

while (mysqli_next_result($conn))
	if (!mysqli_more_results($conn)) break;

$sql = "INSERT INTO USERS (user, password) VALUES ('admin', '$admin_pass')";
if (mysqli_query($conn, $sql)) {
	echo nl2br("Admin user created successfully\n");
} else {
	echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}
mysqli_close($conn);
?>
