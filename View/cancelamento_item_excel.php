<!DOCTYPE html>
<html lang="en">
<?php
session_start();

if (!isset($_SESSION['autenticado']) || $_SESSION['autenticado'] != 'sim') {
    $var1 = true;
    header('Location:../index.php?msg=Nao_autenticado');}

if ($_SESSION['cancelamento_item'] != true) {
    $var1 = true;
    header('Location:home.php?msg=Sem_permissao');}
?>


<head>
    <meta charset="UTF-8">
    <link rel="icon" type="image/x-icon" href="../img/ville_lg.png">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cancelamento de Item (Excel)</title>
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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</head>
<style>
    body {
        background: lightgrey;
    }

</style>
<div>
    <div class="container-fluid bg-dark text-light  p-3">
       <h1 class="ml-5 text-center" style="font-weight: lighter;">Cancelamento Item</h1>
    </div>
    <div style=" font-weight: lighter; text-transform: uppercase; letter-spacing: .2rem;" class="container-fluid text-center bg-dark text-light p-5  my-5">
        <h2 style=" font-weight: lighter;" class="mb-5">Período</h2>
        <div class="my-2">
            <form method="POST" action="../PHP/gerar_csv_cancelamento_item.php">
                <span style="font-size: 20px;" class="text-light p-2">Data Início</span>
                <input style="width: 250px" class="m-3 p-2" id="data_inicio" name="data_inicio" type="date">
                <span style="font-size: 20px;"  class="text-light p-2">Data Fim</span>
                <input style="width: 250px" class="m-3 mb-5 p-2" id = "data_fim" name="data_fim" type="date">
                <br>
                <input onclick="verificar(this.id)" type="submit" class="btn w-50 btn-primary my-4 p-3" value="Gerar Arquivo CSV" name="Chamadas" id="bt1">
             
            </form>
        </div>
    </div>
</div>
<?php
        require('../Assets/rodapé.html');
    ?>
</body>
<script>

    function verificar(id){
        // if ($('#data_inicio').val() == '' || ('#data_fim').val() == '')
        // {
        //     event.preventDefault();
        //     alert('Favor preencher os campos de data')
        // }
    }

    setInterval(() => {
        data = sessionStorage.getItem('chave');
        console.log(data)
    }, 200);

</script>
</html>