<?php
session_start();
if (!isset($_SESSION['autenticado']) || $_SESSION['autenticado'] != 'sim') {
    $var1 = true;
        header('Location: ../index.php?msg=Nao_autenticado');}
    else{
        header('Location:../View/home.php');
    }
?>

