<!DOCTYPE html>
<html lang="en">

    <?php

    session_start();
    if (!isset($_SESSION['autenticado']) || $_SESSION['autenticado'] != 'sim') {
        $var1 = true;
        header('Location:../index.php?msg=Nao_autenticado');}
    ?>
    
    

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cupom Cancelado</title>
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

<body onload="pesquisar()">
    <div class="container-fluid">
        <div class="row sticky-top">
            <nav class="mb-4 w-100 navbar navbar-expand-md navbar-dark bg-dark">
                <a href="" class="navbar-brand text-light">Filtros</a>
                <div style='font-size:12px' class="collapse navbar-collapse" id="navegacao2">
                    <div class="container-fluid">
                        <div class="row ">
                            <div id='filtro_loja1' class="m-2" style='height:43px; width:15%; z-index: 1;'></div>
                            <input type="number" style='width:15%' placeholder="PDV" id="Cod_pdv" name='Cod_pdv'
                                class="m-2 form-control" style ='width:15%' >
                            </input>
                            <div style = "width:2px; height:60px;" class="bg-light"></div>
                            <input type="date" style='width:15%' placeholder="Data da Venda" id="Data_inicio"
                                name='Data_Mov' class="m-2  form-control">
                            </input>
                            <span class='text-light mt-3' >ATÉ</span>
                            <input type="date" style='width:15%' placeholder="Data da Venda" id="Data_fim"
                                name='Data_Mov' class="m-2  form-control">
                            </input>
                            <div style = "width:2px; height:60px;" class="bg-light"></div>
                            <div onclick="get_dados_html(), pesquisar()" class="mt-2 ml-2">
                                <button style="width:200px" class="btn p-2 btn-success">Pesquisar</button>
                            </div>
                            <div onclick="Excel()" class="mt-2 ml-2">
                                <button style="width:200px" class="btn p-2 btn-primary">Gerar Excel</button>
                            </div>
                        </div>
                    </div>
                </div>
            </nav>
        </div>
        <div class="row">
            <div class="col-12" id="dados">
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
        location.assign('../Uploads/Cupom_Cancelado/Cupom_Cancelado.csv')
    }


    function pesquisar() {
        if (Cod_loja1 == false && Data_movimentacaoInicio == false && Data_movimentacaoFim == false && Cod_pdv1 == false) {
            $('#filtro_loja1').load('../PHP/loja.php')
            $('#dados').load('../PHP/cupom_cancelado.php')
        }
        else {
            valCod_loja = '';
            $(':checkbox:checked').each(function () {
                if (valCod_loja != '') {
                    valCod_loja = valCod_loja + (this.value) + ',';
                }
                else {
                    valCod_loja = (this.value) + ','
                }
              
            });

            if (Data_movimentacaoInicio == true && Data_movimentacaoFim == false || Data_movimentacaoInicio == false && Data_movimentacaoFim == true) {
            alert('Favor Preencher Todos od campos de Data')
        }
            valCod_loja = valCod_loja.substring(0, valCod_loja.length - 1);
            $('#filtro_loja1').load('../PHP/loja.php?Cod_loja=' + valCod_loja)
            $('#dados').load('../PHP/cupom_cancelado.php?Cod_loja=' + valCod_loja + '&Cod_pdv=' + valCod_pdv + '&Data_Inicio=' + valDataInicio  + '&Data_Fim=' + valDataFim)
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
    

</script>

</html>