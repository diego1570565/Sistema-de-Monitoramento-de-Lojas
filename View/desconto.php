<!DOCTYPE html>
<html lang="en">
    <?php
session_start();

if (!isset($_SESSION['autenticado']) || $_SESSION['autenticado'] != 'sim') {
    $var1 = true;
    header('Location:../index.php?msg=Nao_autenticado');}

if ($_SESSION['desconto'] != true) {
    $var1 = true;
    header('Location:home.php?msg=Sem_permissao');}
?>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <link rel="icon" type="image/x-icon" href="../img/ville_lg.png">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Desconto</title>
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
    <script src="../js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="../css/style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <script src="../js/dados.js"></script>
</head>
<style>
    body {
        background: lightgrey;
    }
    .meio{
    position: sticky;
    top:0;
    bottom: 275px;
    left: 0;
    right: 0;
    margin-left: auto;
    width: 300px;
    opacity: 0.5;
}
</style>
<body onload="pesquisar()">
    <div class="container-fluid">
    <div  style='height:90px;' class="row sticky-top">
            <nav class="mb-4 w-100 navbar navbar-expand-md navbar-dark bg-dark">
                <div style='font-size:12px' class="collapse navbar-collapse" id="navegacao2">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col" id='filtro_loja1' style='height:43px; z-index: 1;'></div>
                            <input class="col form-control" style='height:43px' placeholder="PDV" id="Cod_pdv"
                                name='Cod_pdv'>
                            <div class="mx-1"></div>
                            <input type="date" class="col form-control" style='height:43px;' placeholder="Data Inicio"
                                id="Data_inicio" name='Data_Mov'>
                                <span class='text-light mx-1 mt-2' >ATÉ</span>
                            <input type="date" class="col form-control" style='height:43px;' placeholder="Data Fim"
                                id="Data_fim" name='Data_Mov'>
                            <div class="mx-1"></div>
                            <div id='ocultar' class="col" style='height:43px;  z-index: 1;'></div>
                            <button class="btn p-2 col btn-success"
                                onclick="get_dados_html() , pesquisar()">Pesquisar</button>
                            <div class="mx-1"></div>
                            <button class="btn col p-2 btn-primary" onclick="Excel()">Gerar Excel</button>
                        </div>
                    </div>
                </div>
            </nav>
        </div>
        <div class="row">
            <div class="col-12" id="dados">
            <div style="height: 700px;"></div>
            </div>
        </div>
    </div>
    </div>
    <script src="../js/desconto.js"></script>
</body>


</html>