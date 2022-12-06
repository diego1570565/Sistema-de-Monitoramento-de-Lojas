<?php 
session_start();
$server = *******;
$user = '*******';
$password = '*******';
$database = '*******';

$conn = mysqli_connect($server, $user, $password, $database);
$conn->set_charset("utf8mb4");


$server_asterisk = '*******';
$user_asterisk = '*******.*******';
$password_asterisk = '*******';
$database_asterisk = '*******';

$conn_asterisk = mysqli_connect($server_asterisk, $user_asterisk, $password_asterisk, $database_asterisk);
$conn_asterisk->set_charset("utf8mb4");

$server_discador = '*******';
$user_discador = '*******.*******';
$password_discador = '*******';
$database_discador = '*******';

$conn_discador = mysqli_connect($server_discador, $user_discador, $password_discador, $database_discador);
$conn_discador->set_charset("utf8mb4");


?>


