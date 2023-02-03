<?php
session_start();
if (!isset($_SESSION['autenticado']) || $_SESSION['autenticado'] != 'sim') {
    $var1 = true;
    header('Location: ../index.php?msg=Nao_autenticado');}
?>

<!DOCTYPE html>
<html lang="en">


<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Monitoramento</title>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>
    <link rel="icon" type="image/x-icon" href="../img/ville_lg.png">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"
        integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49"
        crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"
        integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49"
        crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"
        integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy"
        crossorigin="anonymous"></script>
    <script src="js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>
<style>
    a {
        color: azure;
    }

    .btn {
        margin: 5px;
    }

    body {
        background: lightgrey;
    }
    .btn-lg{
        border:1px solid black;
        width:300px;
    }
</style>

<body>

    <nav class="mb-4 w-100 navbar navbar-expand-md navbar-dark bg-dark">
        <div class="text-light text-center  container-fluid">
            <h5 class="mt-1" style="letter-spacing: .2rem;">
            <?php echo strtoupper($_SESSION['nome']); ?>
            </h5>

            <h6 class="mt-1" style="letter-spacing: .2rem;">
            <div class="mb-1">
                <img src="../img/ville_lg.png" style="width:30px" alt="">
            </div>
             
            <div>
                <span>MONITORAMENTO</span>             
            </div>
            </h6>

            <a href="../PHP/Logoff.php">
                <img class="mr-5" src="../img/porta.png" width='80px' alt="">
            </a>
        </div>
    </nav>

    <div class="mt-5 container-fluid">
        <div class="row justify-content-center ">
            <div style="border:10px ;border-top-style:groove;border-left-style:ridge ;border-right-style:groove; border-bottom-style:ridge; background-color:#fff "  class="card">
                <div class="card-body h-100 mt-5 mx-5">
                    <div class="container">

<!-------------------------------------------------------------------------- NOVA LINHA ------------------------------------------------------------------>
                            <div class="justify-content-between row">

                            <!--  POSICAO CAIXA -->

                                <?php if ($_SESSION['posicao_caixa'] == true) {?>
                                    <a href="posicao_caixa.php" target="_blank">
                                <?php }?>
                                    <div class="btn m-2 p-4 btn-lg
                                <?php if ($_SESSION['posicao_caixa'] == true) {?>
                                    btn-outline-primary">
                                <?php } else {?>
                                    btn-secondary" style=" opacity :0.5; border:none; cursor: not-allowed;" >
                                <?php }?>
                                    Posição de Caixa
                                    </div>
                                <?php if ($_SESSION['posicao_caixa'] == true) {?>
                                    </a>
                                <?php }?>

                            <!-- FIM POSICAO CAIXA -->

                            <!--  CANCELAMENTO ITEM -->

                                <?php if ($_SESSION['cancelamento_item'] == true) {?>
                                    <a href="cancelamento_item.php" target="_blank">
                                <?php }?>
                                    <div class="btn m-2 p-4 btn-lg
                                <?php if ($_SESSION['cancelamento_item'] == true) {?>
                                    btn-outline-primary">
                                <?php } else {?>
                                    btn-secondary" style=" opacity :0.5; border:none; cursor: not-allowed;" >
                                <?php }?>
                                    Cancelamento de Item
                                    </div>
                                <?php if ($_SESSION['cancelamento_item'] == true) {?>
                                    </a>
                                <?php }?>

                            <!-- FIM CANCELAMENTO ITEM -->

                            <!--  SANGRIA -->

                                <?php if ($_SESSION['sangria'] == true) {?>
                                    <a href="sangria.php" target="_blank">
                                <?php }?>
                                    <div class="btn m-2 p-4 btn-lg
                                <?php if ($_SESSION['sangria'] == true) {?>
                                    btn-outline-primary">
                                <?php } else {?>
                                    btn-secondary" style=" opacity :0.5; border:none; cursor: not-allowed;" >
                                <?php }?>
                                    Sangria
                                    </div>
                                <?php if ($_SESSION['sangria'] == true) {?>
                                    </a>
                                <?php }?>

                            <!-- FIM SANGRIA -->

                            </div>

<!-------------------------------------------------------------------------- NOVA LINHA ------------------------------------------------------------------>

                            <div class="justify-content-between row">

                            <!-- DESCONTO -->

                                <?php if ($_SESSION['desconto'] == true) {?>
                                    <a href="desconto.php" target="_blank">
                                <?php }?>
                                    <div class="btn m-2 p-4 btn-lg
                                <?php if ($_SESSION['desconto'] == true) {?>
                                    btn-outline-primary">
                                <?php } else {?>
                                    btn-secondary" style="opacity : 0.5; border:none; cursor: not-allowed;" >
                                <?php }?>
                                    Desconto
                                    </div>
                                <?php if ($_SESSION['desconto'] == true) {?>
                                    </a>
                                <?php }?>

                            <!-- FIM DESCONTO -->

                            <!-- CUPOM CANCELADO -->

                                <?php if ($_SESSION['cupom_cancelado'] == true) {?>
                                    <a href="cupom_cancelado.php" target="_blank">
                                <?php }?>
                                    <div class="btn m-2 p-4 btn-lg
                                <?php if ($_SESSION['cupom_cancelado'] == true) {?>
                                    btn-outline-primary">
                                <?php } else {?>
                                    btn-secondary" style=" opacity :0.5; border:none; cursor: not-allowed;" >
                                <?php }?>
                                       Cupom Cancelado
                                    </div>
                                <?php if ($_SESSION['cupom_cancelado'] == true) {?>
                                    </a>
                                <?php }?>

                            <!-- FIM CUPOM CANCELADO -->

                            <!-- CANCELAMENTO TEF -->

                                <?php if ($_SESSION['cancelamento_tef'] == true) {?>
                                    <a href="cancelamento_tef.php" target="_blank">
                                <?php }?>
                                    <div class="btn m-2 p-4 btn-lg
                                <?php if ($_SESSION['cancelamento_tef'] == true) {?>
                                    btn-outline-primary">
                                <?php } else {?>
                                    btn-secondary" style=" opacity :0.5; border:none; cursor: not-allowed;" >
                                <?php }?>
                                    Cancelamento de TEF
                                    </div>
                                <?php if ($_SESSION['cancelamento_tef'] == true) {?>
                                    </a>
                                <?php }?>

                            <!-- FIM CANCELAMENTO TEF -->

                            </div>

<!-------------------------------------------------------------------------- NOVA LINHA ------------------------------------------------------------------>

                            <div class="justify-content-between row mb-5">

                            <!-- STATUS VNC -->

                                <?php if ($_SESSION['status_vnc'] == true) {?>
                                    <a href="http://192.168.101.16/devProj/index.php?app=vnc" target="_blank">
                                <?php }?>
                                    <div class="btn m-2 p-4 btn-lg
                                <?php if ($_SESSION['status_vnc'] == true) {?>
                                    btn-outline-warning">
                                <?php } else {?>
                                    btn-secondary" style=" opacity :0.5; border:none; cursor: not-allowed;" >
                                <?php }?>
                                    Status VNC
                                    </div>
                                <?php if ($_SESSION['status_vnc'] == true) {?>
                                    </a>
                                <?php }?>

                            <!-- FIM STATUS VNC-->

                            <!--  CALL CENTER -->

                                <?php if ($_SESSION['call_center'] == true) {?>
                                    <a href="call_center.php" target="_blank">
                                <?php }?>
                                    <div class="btn m-2 p-4 btn-lg
                                <?php if ($_SESSION['call_center'] == true) {?>
                                    btn-outline-success">
                                <?php } else {?>
                                    btn-secondary" style=" opacity :0.5; border:none; cursor: not-allowed;" >
                                <?php }?>
                                    Ligações - Call Center
                                    </div>
                                <?php if ($_SESSION['call_center'] == true) {?>
                                    </a>
                                <?php }?>

                            <!-- FIM CALL CENTER-->

                            <!--  CANCELAMENTO ITEM EXCEL -->

                                <?php if ($_SESSION['cancelamento_item'] == true) {?>
                                    <a href="cancelamento_item_excel.php" target="_blank">
                                <?php }?>
                                    <div class="btn m-2 p-4 btn-lg
                                <?php if ($_SESSION['cancelamento_item'] == true) {?>
                                    btn-outline-success">
                                <?php } else {?>
                                    btn-secondary" style=" opacity :0.5; border:none; cursor: not-allowed;" >
                                <?php }?>
                                    Cancelamento Item - Excel
                                    </div>
                                <?php if ($_SESSION['cancelamento_item'] == true) {?>
                                    </a>
                                <?php }?>

                            <!-- FIM CANCELAMENTO ITEM EXCEL-->

                            </div>

<!-------------------------------------------------------------------------- NOVA LINHA ------------------------------------------------------------------>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
    require('../Assets/rodapé.html');
    ?>
    <!-- <div class="container text-center mb-2 mt-2 sticky-bottom rounded bg-dark text-light mt-5 w-25 shadow">Developed by <span id="footer" style="cursor: default;"><b>Diego de Oliveira</b></span></div> -->

</body>
<?php

if (!empty($_GET['msg']) && $_GET['msg'] != '') {
    echo '<script> alert("Você não possui permissão para acessar essa página") </script>';
}

?>
<script>

    function listaFilial2() {
        var filiais = [];
        var filial = []
        var api_url = "http://192.168.100.229:8008/api/";
        $.getJSON(api_url + 'econectFilial', function (result) {
            for (i = 0; i < result.length; i++) {
                variavel = result[i]
                varcodfilial = variavel.codfilial
                varfilialS = variavel.filialS
                filial.push({ codfilial: varcodfilial, nome: varfilialS })
            }
            console.log(filial)
            localStorage.setItem('itens', JSON.stringify(filial));
        });
    }
    listaFilial2();
</script>

</html>