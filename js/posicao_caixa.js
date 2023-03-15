
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
            requisitarPagina('../Controller/posicao_caixa.php')
            $('#filtro_loja1').load('../Controller/loja.php')
            $('#ocultar').load('../Assets/filtro_pessoas/filtro_pessoa_posicao_caixa.php')
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

            myStopFunction()
            valCod_loja = valCod_loja.substring(0, valCod_loja.length - 1);
            $('#filtro_loja1').load('../Controller/loja.php?Cod_loja=' + valCod_loja)
            requisitarPagina('../Controller/posicao_caixa.php?situacao=' + valsituacao +  '&Nomes=' + nome + '&Cod_loja=' + valCod_loja + '&Cod_pdv=' + valCod_pdv + '&Data_mov=' + valData)
            $('#ocultar').load('../Assets/filtro_pessoas/filtro_pessoa_posicao_caixa.php?Cod_loja=' + valCod_loja + '&Cod_pdv=' + valCod_pdv  + '&Data_mov=' + valData  + '&Nomes=' + nome)
         
        }
        tempo()

    }

    function myStopFunction() {
        clearInterval(tempo2);
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

