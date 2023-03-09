<?php 

session_start();

$server = '192.168.100.230';
$user = 'econect';
$password = 'Nai$Z5ae';
$database = 'concentrador';

$conn = mysqli_connect($server, $user, $password, $database);
$conn->set_charset("utf8mb4");


$server_asterisk = '172.16.203.6';
$user_asterisk = 'ville.prod';
$password_asterisk = 'v1woUs';
$database_asterisk = 'asterisk';

$conn_asterisk = mysqli_connect($server_asterisk, $user_asterisk, $password_asterisk, $database_asterisk);
$conn_asterisk->set_charset("utf8mb4");

$server_discador = '172.16.203.6';
$user_discador = 'ville.prod';
$password_discador = 'v1woUs';
$database_discador = 'discador';

$conn_discador = mysqli_connect($server_discador, $user_discador, $password_discador, $database_discador);
$conn_discador->set_charset("utf8mb4");


?>


