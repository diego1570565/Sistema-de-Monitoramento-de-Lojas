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
</style>
<body>

<nav class="mb-4 w-100 navbar navbar-expand-md navbar-dark bg-dark">
    <div class="text-light text-center p-2 container-fluid">
        <h5 class="" style="letter-spacing: .2rem;">
            <?php
echo strtoupper($_SESSION['nome']);
?>
        </h5>
        <h3 class="" style="letter-spacing: .2rem;"> MONITORAMENTO</h3>

        <a href="../PHP/Logoff.php">
            <img class="mr-5" src="../img/porta.png" width='100px' alt="">
        </a>
    </div>
</nav>

    <div class="mt-5 container-fluid">
        <div class="row justify-content-center ">
            <div class="card">
                <div class="card-body mt-5">
                    <div class="container">
                        <div class="row justify-content-center">
                            <a href="posicao_caixa.php" target="_blank">
                                <div style="width:250px ;" class="btn m-2 p-4 btn-lg btn-success text-light">
                                    Posição do Caixa
                                </div>
                            </a>
                            <a href="cancelamento_item.php" target="_blank">
                                <div style="width:250px ;" class="btn m-2 p-4 btn-lg btn-success text-light">
                                    Cancelamento de Item
                                </div>
                            </a>
                            <a href="sangria.php" target="_blank">
                                <div style="width:250px ;" class="btn m-2 p-4 btn-lg btn-success text-light">
                                    Sangria
                                </div>
                            </a>

                        <div class="row m-5">
                            <a href="desconto.php" target="_blank">
                                <div style="width:250px ;" class="btn m-2 p-4 btn-lg btn-success text-light">
                                    Desconto
                                </div>
                            </a>
                            <a href="cupom_cancelado.php" target="_blank">
                                <div style="width:250px ;" class="btn m-2 p-4 btn-lg btn-success text-light">
                                    Cupom Cancelado
                                </div>
                            </a>
                            <a href="call_center.php" target="_blank">
                                <div style="width:250px ;" class="btn m-2 p-4 btn-lg btn-warning text-dark">
                                    Ligações Call Center
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
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
