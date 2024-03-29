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
    <title>Monitoramento - Auditoria</title>
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
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<style>
    a {
        color: azure;
    }
    *{
        font-family: Didot;
        font-size: 18px;
    }

    .btn {
        margin: 5px;
    }

    body {
        background: lightgrey;
        overflow-x:hidden;
    }
    .btn-lg{
        border:1px solid black;
        width:300px;
        font-family :FreeMono;
        font-size: 18px;
    }
    *{
        cursor: default;
    }
</style>

<body style="overflow-y:hidden">

    <div class="mb-2 w-100 bg-success">
     

        <div class="text-light text-center container-fluid">   
            <div class="row py-2">
                <div class="col-3 d-flex pt-3">
                    <h6 class="mt-1" style="letter-spacing: .2rem;">
                        <?php
                            echo strtoupper($_SESSION['nome']);
                        ?>
                    </h6>
                </div>
        
            <h6 class="col-6" style="letter-spacing: .2rem;">
 
                <a  href="https://www.villefort.com.br/" target="_blank">
                    <img src="../img/ville_lg.png" style="width:30px" alt="">
                </a>

                <div class="mt-2">
                    <span>MONITORAMENTO - AUDITORIA</span>
                </div>
                
            </h6>
        <div class="col-3 pt-2">
            <a  href="home.php">
                <img style="cursor:pointer;" src="../img/voltar.png" width='45px' height="45px" alt="">
            </a>
            </div>
            </div>

        </div>
    </div>

    
        <div class="row mt-5 justify-content-center ">
            <div style="border:10px ;border-top-style:groove;border-left-style:ridge ;border-right-style:groove; border-bottom-style:ridge; background-color:#fff "  class="card mb-5">
                <div class="card-body h-100 mt-5 mx-5">
                    <div class="container pb-5">

<!-------------------------------------------------------------------------- NOVA LINHA ------------------------------------------------------------------>

                        <div  class="justify-content-center row">

        
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

                            </div>

<!-------------------------------------------------------------------------- NOVA LINHA ------------------------------------------------------------------>

                            <div class="justify-content-center row">

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

                            <?php if ($_SESSION['central'] == true || $_SESSION['gerente'] == true || $_SESSION['prevencao'] == true || $_SESSION['desenvolvedor'] == true) {?>
                                      <a href="Fluxo Auditoria/index.php"  target="_blank">
                                <?php }?>
                                    <div class="btn m-2 p-4 btn-lg
                                    <?php if ($_SESSION['central'] == true || $_SESSION['gerente'] == true || $_SESSION['prevencao'] == true || $_SESSION['desenvolvedor'] == true) {?>
                                    btn-outline-success">
                                <?php } else {?>
                                    btn-secondary" style=" opacity :0.5; border:none; cursor: not-allowed;" >
                                <?php }?>
                                    Fluxo Auditoria
                                    </div>
                                    <?php if ($_SESSION['central'] == true || $_SESSION['gerente'] == true || $_SESSION['prevencao'] == true || $_SESSION['desenvolvedor'] == true) {?>
                                    </a>
                                <?php }?>
                            </div>

<!-------------------------------------------------------------------------- NOVA LINHA ------------------------------------------------------------------>


<!-------------------------------------------------------------------------- NOVA LINHA ------------------------------------------------------------------>

                        </div>
                    </div>
                </div>
            </div>
        </div>
   

    <footer class="fixed-bottom py-2 bg-success text-light d-flex align-items-center">
        <div class="container-fluid">
            <div class="row">
                <span class='text-left col-3'>Copyright &copy; 2023  - Monitoramento Villefort</span>
                <div  class="col-6 text-center sticky-bottom rounded bg-success text-light w-25"></div>
                <span class="d-inline-block col-3 text-right"></span>
            </div>
        </div>
    </footer>

</body>
<?php

if (!empty($_GET['msg']) && $_GET['msg'] != '') {

    echo "<script> Swal.fire({
        icon: 'error',
        title: 'Oops...',
        text: 'Você não possui permissão para acessar essa página',
    }) </script>";
}

if (isset($_GET['email']) && $_GET['email'] != '') {
    echo "<script>
    Swal.fire({
        icon: 'error',
        title: 'Oops...',
        text: 'Não foi encrontrado nenhum email que corresponda a sua matricula, favor atualizar seu email no WinThor!',
    })
</script>";

}

?>

</html>