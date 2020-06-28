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
name VARCHAR(30) NOT NULL,
password VARCHAR(255) NOT NULL,
reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
)";

$prod = "CREATE TABLE PRODUCTS (
	id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
	name VARCHAR(30) NOT NULL,
	price DECIMAL(7,2) NOT NULL,
	stock INT(4) NOT NULL,
	imgpath VARCHAR(30) NOT NULL,
	description VARCHAR(30) NOT NULL
	)";

if (mysqli_query($conn, $users)) {
	echo nl2br("Table USERS created successfully\n");
} else {
	echo "Error creating tables: " . mysqli_error($conn);
}

if (mysqli_query($conn, $prod)) {
	echo nl2br("Tables PRODUCTS created successfully\n");
} else {
	echo "Error creating tables: " . mysqli_error($conn);
}

$sql = "INSERT INTO USERS (name, password) VALUES ('admin', '$admin_pass')";
if (mysqli_query($conn, $sql)) {
	echo nl2br("Admin user created successfully\n");
} else {
	echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}
mysqli_close($conn);
?>
