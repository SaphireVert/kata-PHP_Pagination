<?php
/* Database credentials. Assuming you are running MySQL
server with default setting (user 'root' with no password) */
define('DB_SERVER', 'mariaDB');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '654321');
define('DB_NAME', 'test');

/* Attempt to connect to MySQL database */
$connexion = new PDO("mysql:host=" . DB_SERVER . ";dbname=" . DB_NAME . ";port=3306", DB_USERNAME, DB_PASSWORD);
$connexion->exec("set names utf8mb4");

?>
