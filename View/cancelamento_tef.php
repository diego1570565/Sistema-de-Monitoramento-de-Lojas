<!DOCTYPE html>
<html lang="en">
    <?php
session_start();

if (!isset($_SESSION['autenticado']) || $_SESSION['autenticado'] != 'sim') {
    $var1 = true;
    header('Location:../index.php?msg=Nao_autenticado');}

if ($_SESSION['cancelamento_tef'] != true) {
    $var1 = true;
    header('Location:home.php?msg=Sem_permissao');}
?>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <link rel="icon" type="image/x-icon" href="../img/ville_lg.png">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cancelamento - TEF</title>
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
    <script src="../js/get_loja.js"></script>
</body>
<script>
    var Data_movimentacaoFim = false
    var Data_movimentacaoInicio = false
    var Cod_loja1 = false
    var Cod_pdv1 = false
    function get_dados_html() {
        valCod_loja = $('#filtro_loja').val()
        valCod_pdv = $('#Cod_pdv').val()
        valDataInicio = $('#Data_inicio').val()
        valDataFim = $('#Data_fim').val()
        if (valCod_loja != '') {
            Cod_loja1 = true
        } if (valCod_pdv != '') {
            Cod_pdv1 = true
        } if (valDataInicio != '') {
            Data_movimentacaoInicio = true
        } if (valDataFim != '') {
            Data_movimentacaoFim = true
        }
        console.log(Data_movimentacaoInicio)
        console.log(Data_movimentacaoFim)
        console.log(Cod_pdv1)
        console.log(Cod_loja1)
    }
    function Excel(){
        location.assign('../Uploads/Cancelamento_TEF/Cancelamento_TEF.csv')
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
    }
    function trocar_nome_filial() {
    itens = JSON.parse(localStorage.getItem('itens'))
    for (i = 0; i < itens.length; i++) {
        $('.loja_' + itens[i]['codfilial']).text(itens[i]['nome']);
        console.log($('.loja_' + itens[i]['codfilial']))}
    }
    function pesquisar() {
        if (Cod_loja1 == false && Data_movimentacaoInicio == false && Data_movimentacaoFim == false && Cod_pdv1 == false) {
            $('#filtro_loja1').load('../PHP/loja.php')
            requisitarPagina('../PHP/cancelamento_tef.php')
            $('#ocultar').load('../Assets/filtro_pessoas/filtro_pessoa_cancelamento_tef.php')
        }
        else {
            nome = '';
            $('#ocultar :checkbox:checked').each(function () {
                if (nome != '') {
                    nome = nome + (this.value) + ',';
                }
                else {
                    nome = (this.value) + ','
                }
            });
            
            valCod_loja = '';
            $('#filtro_loja1 :checkbox:checked').each(function () {
                if (valCod_loja != '') {
                    valCod_loja = valCod_loja + (this.value) + ',';
                }
                else {
                    valCod_loja = (this.value) + ','
                }
            });

            nome = nome.substring(0, nome.length - 1);

            if (Data_movimentacaoInicio == true && Data_movimentacaoFim == false || Data_movimentacaoInicio == false && Data_movimentacaoFim == true) {
            alert('Favor Preencher Todos od campos de Data')
        }
            valCod_loja = valCod_loja.substring(0, valCod_loja.length - 1);
            $('#filtro_loja1').load('../PHP/loja.php?Cod_loja=' + valCod_loja)
            requisitarPagina('../PHP/cancelamento_tef.php?Cod_loja=' + valCod_loja + '&Nomes=' + nome + '&Cod_pdv=' + valCod_pdv + '&Data_Inicio=' + valDataInicio  + '&Data_Fim=' + valDataFim)
            
            $('#ocultar').load('../Assets/filtro_pessoas/filtro_pessoa_cancelamento_tef.php?Cod_loja=' + valCod_loja + '&Nomes=' + nome + '&Cod_pdv=' + valCod_pdv  + '&Data_Inicio=' + valDataInicio + '&Data_Fim=' + valDataFim + '&Nomes=' + nome)
       
        }
        const itens = JSON.parse(localStorage.getItem('itens'))
        for (i = 0; i < itens.length; i++) {
            $('.loja_' + itens[i]['codfilial']).text(itens[i]['nome']);
        }
    }
    document.body.addEventListener('keydown', function (event) {
    const key = event.key;
    const code = event.keyCode;
    if (key == 'Enter'){
        get_dados_html()
        pesquisar()
    }
    });
    setInterval(function () {
        pesquisar()
    }, 300000);
    trocar_nome_filial()
</script>

</html>