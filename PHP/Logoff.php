<?php
session_start();
$_SESSION['autenticado'] = 'nao';
header('Location:../index.php');
?>
