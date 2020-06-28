<?php
$servername = "localhost";
$username = "root";
$password = "password";
$dbname = "webshop";
$admin = 'admin';
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
	imgpath VARCHAR(300) NOT NULL,
	description TEXT(2000) NOT NULL
	)";

$orders = "CREATE TABLE ORDERS (
	id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
	user VARCHAR(30) NOT NULL,
	cart VARCHAR(100) NOT NULL,
	firstname VARCHAR(30) NOT NULL,
	lastname VARCHAR(30) NOT NULL,
	address VARCHAR(50) NOT NULL,
	zipcode VARCHAR(10) NOT NULL,
	city VARCHAR(30) NOT NULL,
	country VARCHAR(30) NOT NULL,
	shipping VARCHAR(30) NOT NULL,
	payment VARCHAR(30) NOT NULL,
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

$stmt = mysqli_stmt_init($conn);
if (mysqli_stmt_prepare($stmt, "INSERT INTO USERS (user, password) VALUES ('$admin', '$admin_pass')"))
{
	mysqli_stmt_execute($stmt);
}
mysqli_stmt_close($stmt);

$sql = "INSERT INTO CATEGORIES (name, products) VALUES ('bicycles',''),('Mouses',''),('Keyboards',''),('Disinfectants','') ";
if (mysqli_query($conn, $sql)) {
	echo nl2br("Sample categories created successfully\n");
} else {
	echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

$sql = "INSERT INTO PRODUCTS (name, categories, price, stock, imgpath, description) VALUES
('Helkama E-bike','bicycles','1590.50','5','data/img/e-bike.jpg','Lorem ipsum dolor sit amet. consectetur adipiscing elit. sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam. quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. '),
('Honda E-bike','bicycles','2590.50','7','data/img/ebike2.jpg','Lorem ipsum dolor sit amet. consectetur adipiscing elit. sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam. quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. '),
('Helkama Jopo ','bicycles','359.90','25','data/img/jopokoralli.jpg','Lorem ipsum dolor sit amet. consectetur adipiscing elit. sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam. quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. '),
('Helkama Fat-Jopo','bicycles','699.00','15','data/img/fat_jopo.jpg','Lorem ipsum dolor sit amet. consectetur adipiscing elit. sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam. quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. '),
('Strive 8.0','bicycles','3590.50','2','data/img/strive8.png','Lorem ipsum dolor sit amet. consectetur adipiscing elit. sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam. quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. '),
('Alfakem Disinfectant','Disinfectants','12.95','50','data/img/alfkem.jpg','Lorem ipsum dolor sit amet. consectetur adipiscing elit. sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam. quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. '),
('Ds6 / 3L','Disinfectants','19.50','5','data/img/ds6.png','Lorem ipsum dolor sit amet. consectetur adipiscing elit. sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam. quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. '),
('Erisan Disinfection','Disinfectants','9.50','98','data/img/erisankasdes.jpg','Lorem ipsum dolor sit amet. consectetur adipiscing elit. sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam. quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. '),
('Kyrö - käsidesi','Disinfectants','9.95','5','data/img/kyrokasidesi.jpg','Lorem ipsum dolor sit amet. consectetur adipiscing elit. sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam. quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. '),
('Pirkka - käsidesi','Disinfectants','3.95','5','data/img/6410405130426.jpeg','Lorem ipsum dolor sit amet. consectetur adipiscing elit. sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam. quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. '),
('Vortex pok3r - Keyboard','Keyboards','220.50','15','data/img/vortex_pok3r.png','Lorem ipsum dolor sit amet. consectetur adipiscing elit. sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam. quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. '),
('Akko 3108V2 - Keyboard','Keyboards','290.00','35','data/img/AHB0.jpg','Lorem ipsum dolor sit amet. consectetur adipiscing elit. sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam. quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. '),
('Editors Keys Backlit','Keyboards','129.50','13','data/img/11435141_800.jpg','Lorem ipsum dolor sit amet. consectetur adipiscing elit. sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam. quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. '),
('Logickeyboard Astra','Keyboards','149.50','5','data/img/12536827_800.jpg','Lorem ipsum dolor sit amet. consectetur adipiscing elit. sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam. quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. '),
('Ajazz AK510','Keyboards','79.00','67','data/img/ajazz.jpg','Lorem ipsum dolor sit amet. consectetur adipiscing elit. sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam. quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. '),
('Logitech','Mouses','10.00','50','data/img/b100.png','Lorem ipsum dolor sit amet. consectetur adipiscing elit. sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam. quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. '),
('Chester Moouse','Mouses','129.90','13','data/img/chestermouse.png','Lorem ipsum dolor sit amet. consectetur adipiscing elit. sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam. quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. '),
('Surface Mouse','Mouses','29.50','18','data/img/surfmouse.jpg','Lorem ipsum dolor sit amet. consectetur adipiscing elit. sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam. quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. '),
('Logitech M90','Mouses','22.50','58','data/img/m90.png','Lorem ipsum dolor sit amet. consectetur adipiscing elit. sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam. quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. '),
('Logitech Legendary','Mouses','49.50','5','data/img/232739-p936041.jpg','Lorem ipsum dolor sit amet. consectetur adipiscing elit. sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam. quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. ')
";
if (mysqli_query($conn, $sql)) {
	echo nl2br("Sample products created successfully\n");
} else {
	echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}
mysqli_close($conn);
?>
