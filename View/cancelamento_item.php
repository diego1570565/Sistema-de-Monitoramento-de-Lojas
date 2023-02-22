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
    <title>Cancelamento Item</title>
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
    <script src="../js/dados.js"></script>
</head>
<style>
    body {
        background: lightgrey;
    }
    .meio{
        position: sticky;
        top:;
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
        <div style='height:90px;' class="row sticky-top">
            <nav class="mb-4 w-100 navbar navbar-expand-md navbar-dark bg-dark">

                <div style='font-size:12px' class="navbar-collapse" id="navegacao2">
                    <div class="container-fluid">
                        <div class="row">
                            <div id='filtro_loja1' class="m-2" style='height:43px; width:15%; z-index: 1;'></div>
                            <input type="number" style='height:43px' placeholder="PDV" id="Cod_pdv"
                                name='Cod_pdv' class="m-2 col form-control">
                            </input>
                         
                            <input type="date"  placeholder="Data da Venda" id="Data_inicio"
                                name='Data_Mov' class="m-2 col form-control">
                            </input>
                            <span class='text-light mt-3' >ATÉ</span>
                            <input type="date"  placeholder="Data da Venda" id="Data_fim"
                                name='Data_Mov' class="m-2 col form-control">
                            </input>
                          
                            <div id='ocultar' class="m-2 col" style='height:43px;  z-index: 1;'></div>
                            <div onclick="get_dados_html() , pesquisar() " class="mt-2 col ">
                            <button  class="btn w-100 p-2 btn-success">Pesquisar</button>
                            </div>
                            <div onclick="Excel()" class="mt-2 col ">
                                <button  class="btn w-100 p-2 btn-primary">Gerar Excel</button>
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
    </div>
</body>
<script>

    var Data_movimentacaoFim = false
    var Data_movimentacaoInicio = false
    var Cod_loja1 = false
    var Cod_pdv1 = false
    var nome = '';

    function get_dados_html() {
        valCod_loja = $('#filtro_loja').val()
        valCod_pdv = $('#Cod_pdv').val()
        valDataInicio = $('#Data_inicio').val()
        valDataFim = $('#Data_fim').val()

        if (valCod_loja != '') {
            Cod_loja1 = true
        } if (valCod_pdv != '') {
            Cod_pdv1 = true
        }  if (valDataInicio != '') {
            Data_movimentacaoInicio = true
        } if (valDataFim != '') {
            Data_movimentacaoFim = true
        }


    }
    function Excel(){

        location.assign('../Uploads/Cancelamento_item/Cancelamento_item.csv')
        
        // fetch('')
        // .then(response => response.text())
        // .then(text => {
        //     var array = text.split("\n");

        //     itens = JSON.parse(localStorage.getItem('itens'))
        //     tudo = ''
        //     for (var i = 0; i < array.length; i++) {

        //         var modificado = array[i].split(";")


        //         for(var g = 1; g < itens.length; g++){


        //             if (modificado[0] == itens[g]['codfilial']){

        //                 modificado[0] = itens[g]['nome'];

        //             }

        //         }
        //         total = modificado.toString()
        //         total = total.replace(/,/g, ";") + "\r\n"
        //         console.log(total)

        //         var tudo = tudo + total
        //     }


        //     download(tudo, 'Cancelamento_item.csv')

        // })


        function download(content, filename, contentType){

                if(!contentType){
                contentType = 'application/octet-stream';
            }
            var a = document.createElement('a');
            var blob = new Blob([content], {'type':contentType});
            a.href = window.URL.createObjectURL(blob);
            a.download = filename;
            a.click();
}


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
        if (Cod_loja1 == false && Data_movimentacaoInicio == false && Data_movimentacaoFim == false && Cod_pdv1 == false) {

            $('#ocultar :checkbox:checked').each(function () {
                nome = nome + (this.value) + ',';
            });
            requisitarPagina('../PHP/cancelamento_item.php?Nome=' + nome)
            $('#ocultar').load('../PHP/ocultar.php')
            $('#filtro_loja1').load('../PHP/loja.php')
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
            console.log(Data_movimentacaoInicio)
            console.log(Data_movimentacaoFim)
            console.log(Cod_pdv1)
            console.log(Cod_loja1)

            if (Data_movimentacaoInicio == true && Data_movimentacaoFim == false || Data_movimentacaoInicio == false && Data_movimentacaoFim == true) {
            alert('Favor Preencher Todos od campos de Data')
            }
            nome = nome.substring(0, nome.length - 1);

            valCod_loja = '';
            $('#filtro_loja1 :checkbox:checked').each(function () {
                if (valCod_loja != '') {
                    valCod_loja = valCod_loja + (this.value) + ',';
                }
                else {
                    valCod_loja = (this.value) + ','
                }

            });

            valCod_loja = valCod_loja.substring(0, valCod_loja.length - 1);

            console.log(valDataInicio)
            console.log(valDataFim)

            $('#filtro_loja1').load('../PHP/loja.php?Cod_loja=' + valCod_loja)
            requisitarPagina('../PHP/cancelamento_item.php?Cod_loja=' + 
            valCod_loja + '&Cod_pdv=' + valCod_pdv + '&Nomes=' + nome + 
            '&Data_Inicio=' + valDataInicio  + '&Data_Fim=' + valDataFim )
            $('#ocultar').load('../PHP/ocultar.php?Cod_loja=' + valCod_loja + 
            '&Cod_pdv=' + valCod_pdv  + '&Data_Inicio=' + valDataInicio  + 
            '&Data_Fim=' + valDataFim + '&Nomes=' + nome)
        }


    }
    setInterval(function () {
        pesquisar()
    }, 300000);

    document.body.addEventListener('keydown', function (event) {
    const key = event.key;
    const code = event.keyCode;


    if (key == 'Enter'){
        get_dados_html()
        pesquisar()
    }
    });

</script>


</html>