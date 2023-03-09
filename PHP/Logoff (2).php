<?php
session_start();
$_SESSION['autenticado'] = 'nao';

$_SESSION['status_vnc'] = false;
$_SESSION['cancelamento_item'] = false;
$_SESSION['call_center'] = false;
$_SESSION['cupom_cancelado'] = false;
$_SESSION['desconto'] = false;
$_SESSION['sangria'] = false;
$_SESSION['posicao_caixa'] = false;
$_SESSION['cancelamento_tef'] = false;

header('Location:../index.php');
?>
