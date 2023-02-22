<?php
session_start();
$mensageHTML = 'Aguardando...';
$acesso = false;
$tipoUser = 'null';
$permissoes = array();
$LDAPUserDomain = "@villefort";
$SearchFor = "";
$SearchField = "samaccountname";
$LDAPHost = "192.168.100.210";
$dn = "DC=villefort,DC=local";
$LDAPUser = $_POST['user_login'];

$_SESSION['nome'] = $_POST['user_login'];

$LDAPUserPassword = $_POST['pass_login'];
$LDAPFieldsToFind = array("*");
$cnx = ldap_connect($LDAPHost) or die($mensageHTML = "Não foi possivel iniciar a conexão.");
ldap_set_option($cnx, LDAP_OPT_PROTOCOL_VERSION, 3);
ldap_set_option($cnx, LDAP_OPT_REFERRALS, 0);
if($LDAPUserPassword == ''){
header('location:../index.php?msg=Senha_vazia');}
@ldap_bind($cnx, $LDAPUser . $LDAPUserDomain, $LDAPUserPassword) or die("<script>window.location.replace('../index.php?msg=Usuario_ou_Senha_Incorretos');</script>");
error_reporting(E_ALL ^ E_NOTICE);
$filter = "(samaccountname=" . $LDAPUser . ")";
$sr = ldap_search($cnx, $dn, $filter, $LDAPFieldsToFind);
$info = ldap_get_entries($cnx, $sr);

for ($x = 0; $x < $info["count"]; $x++) {
    if ($info[$x]['memberof']['count'] != 0):
        echo '<pre>';
        foreach ($info[$x]['memberof'] as $key):
            $key = explode("," , $key);
            $key = str_replace('CN=', '', $key[0]);
            $permissoes[] = $key;
        endforeach;
        $usuario = array_search('Monitor - Usuarios', $permissoes);
        $ti = array_search('TI', $permissoes);
        if ($usuario == true):
            $tipoUser = 'usuario';
            $acesso = true;
        endif;
    else:
        $tipoUser = 'null';
        $acesso = false;
    endif;
}
//=========================================================================
for ($x = 0; $x < $info["count"]; $x++) {
    if ($info[$x]['memberof']['count'] != 0):
        echo '<pre>';
        foreach ($info[$x]['memberof'] as $key):
            $key = explode("," , $key);
            $key = str_replace('CN=', '', $key[0]);
            $permissoes[] = $key;
        endforeach;
        $usuario = array_search('Monitor - Status VNC', $permissoes);
        $ti = array_search('TI', $permissoes);
        if ($usuario == true):
            $tipoUser = 'usuario';
            $_SESSION['status_vnc'] = true;
        endif;
    else:
        $tipoUser = 'null';
        $acesso = false;
    endif;
}
//=========================================================================
for ($x = 0; $x < $info["count"]; $x++) {
    if ($info[$x]['memberof']['count'] != 0):
        echo '<pre>';
        foreach ($info[$x]['memberof'] as $key):
            $key = explode("," , $key);
            $key = str_replace('CN=', '', $key[0]);
            $permissoes[] = $key;
        endforeach;
        $usuario = array_search('Monitor - Cancelamento de Item', $permissoes);
        $ti = array_search('TI', $permissoes);
        if ($usuario == true):
            $tipoUser = 'usuario';
            $_SESSION['cancelamento_item'] = true;
        endif;
    else:
        $tipoUser = 'null';
        $acesso = false;
    endif;
}
//=========================================================================
for ($x = 0; $x < $info["count"]; $x++) {
    if ($info[$x]['memberof']['count'] != 0):
        echo '<pre>';
        foreach ($info[$x]['memberof'] as $key):
            $key = explode("," , $key);
            $key = str_replace('CN=', '', $key[0]);
            $permissoes[] = $key;
        endforeach;
        $usuario = array_search('Monitor - Ligacoes Call Center', $permissoes);
        $ti = array_search('TI', $permissoes);
        if ($usuario == true):
            $tipoUser = 'usuario';
            $_SESSION['call_center'] = true;
        endif;
    else:
        $tipoUser = 'null';
        $acesso = false;
    endif;
}
//=========================================================================
for ($x = 0; $x < $info["count"]; $x++) {
    if ($info[$x]['memberof']['count'] != 0):
        echo '<pre>';
        foreach ($info[$x]['memberof'] as $key):
            $key = explode("," , $key);
            $key = str_replace('CN=', '', $key[0]);
            $permissoes[] = $key;
        endforeach;
        $usuario = array_search('Monitor - Cupom Cancelado', $permissoes);
        $ti = array_search('TI', $permissoes);
        if ($usuario == true):
            $tipoUser = 'usuario';
            $_SESSION['cupom_cancelado'] = true;
        endif;
    else:
        $tipoUser = 'null';
        $acesso = false;
    endif;
}
//=========================================================================
for ($x = 0; $x < $info["count"]; $x++) {
    if ($info[$x]['memberof']['count'] != 0):
        echo '<pre>';
        foreach ($info[$x]['memberof'] as $key):
            $key = explode("," , $key);
            $key = str_replace('CN=', '', $key[0]);
            $permissoes[] = $key;
        endforeach;
        $usuario = array_search('Monitor - Desconto', $permissoes);
        $ti = array_search('TI', $permissoes);
        if ($usuario == true):
            $tipoUser = 'usuario';
            $_SESSION['desconto'] = true;
        endif;
    else:
        $tipoUser = 'null';
        $acesso = false;
    endif;
}
//=========================================================================
for ($x = 0; $x < $info["count"]; $x++) {
    if ($info[$x]['memberof']['count'] != 0):
        echo '<pre>';
        foreach ($info[$x]['memberof'] as $key):
            $key = explode("," , $key);
            $key = str_replace('CN=', '', $key[0]);
            $permissoes[] = $key;
        endforeach;
        $usuario = array_search('Monitor - Sangria', $permissoes);
        $ti = array_search('TI', $permissoes);
        if ($usuario == true):
            $tipoUser = 'usuario';
            $_SESSION['sangria'] = true;
        endif;
    else:
        $tipoUser = 'null';
        $acesso = false;
    endif;
}
//=========================================================================
for ($x = 0; $x < $info["count"]; $x++) {
    if ($info[$x]['memberof']['count'] != 0):
        echo '<pre>';
        foreach ($info[$x]['memberof'] as $key):
            $key = explode("," , $key);
            $key = str_replace('CN=', '', $key[0]);
            $permissoes[] = $key;
        endforeach;
        $usuario = array_search('Monitor - Posicao do Caixa', $permissoes);
        $ti = array_search('TI', $permissoes);
        if ($usuario == true):
            $tipoUser = 'usuario';
            $_SESSION['posicao_caixa'] = true;
        endif;
    else:
        $tipoUser = 'null';
        $acesso = false;
    endif;
}
//=========================================================================
for ($x = 0; $x < $info["count"]; $x++) {
    if ($info[$x]['memberof']['count'] != 0):
        echo '<pre>';
        foreach ($info[$x]['memberof'] as $key):
            $key = explode("," , $key);
            $key = str_replace('CN=', '', $key[0]);
            $permissoes[] = $key;
        endforeach;
        $usuario = array_search('Monitor - Cancelamento TEF', $permissoes);
        $ti = array_search('TI', $permissoes);
        if ($usuario == true):
            $tipoUser = 'usuario';
            $_SESSION['cancelamento_tef'] = true;
        endif;
    else:
        $tipoUser = 'null';
        $acesso = false;
    endif;
}
//=========================================================================
if ($x == 0):
    $mensageHTML = "Você não possui permissão para este acesso.";
endif;
if ($acesso === true):
    //-------------------------------------
    // $_SESSION['status_vnc'] = true;
    // $_SESSION['cancelamento_item'] = true;
    // $_SESSION['call_center'] = true;
    // $_SESSION['cupom_cancelado'] = true;
    // $_SESSION['desconto'] = true;
    // $_SESSION['sangria'] = true;
    // $_SESSION['posicao_caixa'] = true;
    // $_SESSION['cancelamento_tef'] = true;
    //--------------------------------------

    $_SESSION['autenticado'] = 'sim';
    header('location:../View/home.php');

else:
    header('location:../index.php?msg=Usuario_ou_Senha_Incorretos');
endif;
?>

