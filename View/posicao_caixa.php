<!DOCTYPE html>
<html lang="en">

<?php

session_start();

if (!isset($_SESSION['autenticado']) || $_SESSION['autenticado'] != 'sim') {
    $var1 = true;
    header('Location:../index.php?msg=Nao_autenticado');}

if ($_SESSION['posicao_caixa'] != true) {
    $var1 = true;
    header('Location:home.php?msg=Sem_permissao');}
?>



<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Posição de Caixa</title>
    <link rel="icon" type="image/x-icon" href="../img/ville_lg.png">
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
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <script src="../js/dados.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.5.3/jspdf.debug.js"
        integrity="sha384-NaWTHo/8YCBYJ59830LTz/P4aQZK1sS0SneOgAvhsIl3zBu8r9RevNg5lHCHAuQ/"
        crossorigin="anonymous"></script>

</head>
<style>
    body {
        background: lightgrey;
    }

    .d-flex {
        display: flex;
        align-items: center;
        justify-content: center;
    }
</style>

<body onload="pesquisar()">
    <div class="container-fluid ">
        <div style='height:75px;' class="row sticky-top">
            <nav  class="mb-2 w-100 navbar navbar-expand-md navbar-dark bg-dark">
                <div style='font-size:12px' class="collapse navbar-collapse" id="navegacao2">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col" id='filtro_loja1' style='height:43px; z-index: 1;'></div>
                            <input class="col mr-2 form-control" style='height:43px' placeholder="PDV" id="Cod_pdv" name='Cod_pdv'>
                            <input type="date" class="col form-control" style='height:43px;' placeholder="Data Mov." id="Data_Mov" name='Data_Mov'>
                            <div class="col">
                                <button style="width:100%" class="btn p-2 btn-success" onclick="get_dados_html() , pesquisar()">Pesquisar</button>
                            </div>
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
</body>
<script>

    var Data_movimentacao = false
    var Cod_loja1 = false
    var Cod_pdv1 = false
    var situacao1 = false

    function get_dados_html() {

        valCod_pdv = $('#Cod_pdv').val()
        valData = $('#Data_Mov').val()
        valsituacao = $('#situacao').val()

        if (valCod_pdv != '') {
            Cod_pdv1 = true
        } if (valData != '') {
            Data_movimentacao = true
        } if (valsituacao != 'Todos') {
            situacao1 = true
        }
        console.log(Data_movimentacao)
        console.log(situacao1)
        console.log(Cod_pdv1)
        console.log(Cod_loja1)
    }


    function requisitarPagina(url) {

        if (!document.getElementById('loading')) {
            let imgLoading = document.createElement('img')
            imgLoading.id = 'loading'
            imgLoading.src = '../img/loading.gif'
            imgLoading.className = 'meio rounded mx-auto d-block w-25'
            document.getElementById('dados').appendChild(imgLoading)
        }

        let ajax = new XMLHttpRequest();
        ajax.open('GET', url)
        ajax.onreadystatechange = () => {
            if (ajax.readyState == 4) {
                document.getElementById('loading').remove()
                document.getElementById('dados').innerHTML = ajax.responseText
                trocar_nome_filial()
            }
        }
        ajax.send()
        function trocar_nome_filial() {
            itens = JSON.parse(localStorage.getItem('itens'))
            for (i = 0; i < itens.length; i++) {
                $('.loja_' + itens[i]['codfilial']).text(itens[i]['nome']);
            }
        }

        function marcarID(id) {
            $('#' + id).toggleClass('text-white bg-dark')
        }
    }
    function pesquisar() {
        if (Cod_loja1 == false && Data_movimentacao == false && Cod_pdv1 == false && situacao1 == false) {
            console.log('tudo falso')
            requisitarPagina('../PHP/posicao_caixa.php')
            $('#filtro_loja1').load('../PHP/loja.php')
        }
        else {
            console.log('aqui')
            valCod_loja = '';
            $(':checkbox:checked').each(function () {
                if (valCod_loja != '') {
                    valCod_loja = valCod_loja + (this.value) + ',';
                }
                else {
                    valCod_loja = (this.value) + ','
                }
            });
            myStopFunction()
            valCod_loja = valCod_loja.substring(0, valCod_loja.length - 1);
            $('#filtro_loja1').load('../PHP/loja.php?Cod_loja=' + valCod_loja)
            requisitarPagina('../PHP/posicao_caixa.php?situacao=' + valsituacao + '&Cod_loja=' + valCod_loja + '&Cod_pdv=' + valCod_pdv + '&Data_mov=' + valData)
        }
        tempo()

    }

    function myStopFunction() {
        clearInterval(tempo2);
    }

    document.body.addEventListener('keyup', function (event) {
        get_dados_html()
        pesquisar()
    });

    setInterval(function () {
        pesquisar()
    }, 300000);


    function startTimer(duration, display) {
        var timer = duration, minutes, seconds;
        tempo2 = setInterval(function () {
            minutes = parseInt(timer / 60, 10)
            seconds = parseInt(timer % 60, 10);

            minutes = minutes < 10 ? "0" + minutes : minutes;
            seconds = seconds < 10 ? "0" + seconds : seconds;

            $('#time').html('Proxima atualização em: ' + minutes + ":" + seconds)

            console.log(minutes + ":" + seconds)

            if (--timer < 0) {
                timer = duration;
            }
        }, 1000);
    }

    function tempo() {
        var fiveMinutes = 60 * 5,
            display = $('#time');
        startTimer(fiveMinutes, display);
    };



</script>

</html>