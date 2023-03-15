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
        $('#filtro_loja1').load('../Controller/loja.php')
        requisitarPagina('../Controller/cancelamento_tef.php')
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
        $('#filtro_loja1').load('../Controller/loja.php?Cod_loja=' + valCod_loja)
        requisitarPagina('../Controller/cancelamento_tef.php?Cod_loja=' + valCod_loja + '&Nomes=' + nome + '&Cod_pdv=' + valCod_pdv + '&Data_Inicio=' + valDataInicio  + '&Data_Fim=' + valDataFim)
        
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