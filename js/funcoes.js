editar = false;
novo = false;

function Nova_insercao() {
    $("input[type='text'], textarea ,select , input[type='date'], input[type='datetime-local'], input[type='number']").val("");
    sessionStorage.clear();
    editar = false;
    enableAllInputs('nao')
    $('*').removeClass('vazio')
    $('#editar').attr('disabled', true)
    $('#label_csv').addClass('pointer');
    $('#label_csv').removeClass('transparente');
    $('#arquivo_csv').attr('disabled', false);
    $('#observacao').attr('disabled', false);
    $('#arquivo_csv').addClass('pointer');
    $('#arquivo_csv_btn').attr('disabled', true)
    $('#data_repasse_prevencao').attr('disabled' , true);
    $('#descritivo_retorno_prevencao').attr('disabled' , true);
    $('#minuta').attr('disabled' , true);
}

function verifica_editar() {


    if (editar == true) {

        if ($("#perda_ganho").val() == 'G' &&  $("#valor_unidade").val() > 0){
            valor = $("#valor_unidade").val() * -1;
            $("#valor_unidade").val(valor);
        }
  
        if (sessionStorage.getItem('gerente') == 'true') {
            
            event.preventDefault();

            if ($('#descritivo_retorno_loja').val() == 2 || typeof $('#imagem')[0].files[0] != "undefined" ){
                
                $.ajax({
                type: "POST",
                url: "Controller/Update.php",
                data: {
                    numcontrole: (fluxoAuditoria.NUMCONTROLE),
                    filial_id: $("#filial_id").val(),
                    minuta: $("#minuta").val(),
                    numero_nota: $("#numero_nota").val(),
                    perda_ganho: $("#perda_ganho").val(),
                    data_repassado: $("#data_repassado").val(),
                    data_retorno_loja: $("#data_retorno_loja").val(),
                    descritivo_retorno_loja: $("#descritivo_retorno_loja").val(),
                    data_repasse_prevencao: $("#data_repasse_prevencao").val(),
                    descritivo_retorno_prevencao: $("#descritivo_retorno_prevencao").val(),
                    evidencia: $("#evidencia").val(),
                    pdv: $("#pdv").val(),
                    data_hora: $("#data_hora").val(),
                    regra: $("#regra").val(),
                    classificacao: $("#classificacao").val(),
                    parecer: $("#parecer").val(),
                    observacao: $("#observacao").val(),
                    operacao: $("#operacao").val(),
                    cupom: $("#cupom").val(),
                    codigo: $("#codigo").val(),
                    origem: $("#origem").val(),
                    quantidade: $("#quantidade").val(),
                    valor_unidade: $("#valor_unidade").val(),
                    codigo_operador: $("#codigo_operador").val(),
                    dataalteracao: true
                },
                success: function (response) {
                    disableAllInputs()
                    console.log(response)

                    $.ajax({
                        type: "GET",
                        url: "Controller/montar.php",
                        data: {
                            id: (fluxoAuditoria.NUMCONTROLE)
                        },
                        success: function (response) {
                        }
                    });
                    Swal.fire(
                        'Atenção',
                        'Dados Atualizados com Sucesso!',
                        'success'
                    )
                    $('#label_imagem').addClass('transparente');
                    $('#editar').attr('disabled', false)
                    $('#cancelar').attr('disabled', false)
                    $('#emitir').attr('disabled', false)
                    if (sessionStorage.getItem('gerente') == 'true') {
                        $('#emitir').attr('disabled', true)
                    }

                    $('*').removeClass('vazio')

                    var form_data = new FormData();
                    form_data.append('imagem', $('#imagem')[0].files[0]);
                    form_data.append('ID', fluxoAuditoria.NUMCONTROLE);
                    $.ajax({
                        type: "POST",
                        url: "Controller/Update_img.php",
                        data: form_data,
                        contentType: false,
                        processData: false,
                        success: function (response) {
                            console.log(response)
                            sessionStorage.removeItem("Fluxo_Auditoria")
                        }
                    });
                }
            });
    }else{
        event.preventDefault();
        Swal.fire({
        icon: 'info',
        title: 'Inserção não realizada!',
        text: 'Há dados não preenchidos, verifique e solicite novamente'
    })
    }
        }else if ((sessionStorage.getItem('prevencao') == 'true' && $("#minuta").val() != '' && $("#descritivo_retorno_prevencao").val() != '') == true 
        ||  (sessionStorage.getItem('prevencao') != 'true' && $("#numero_nota").val() !=''  && $("#evidencia").val() != '' && $("#perda_ganho").val() != '' && $("#data_repassado").val() != ''&& $("#quantidade").val() != '' && $("#valor_unidade").val() != '') == true){
            event.preventDefault();
            $.ajax({
            type: "POST",
            url: "Controller/Update.php",
            data: {
                numcontrole: (fluxoAuditoria.NUMCONTROLE),
                filial_id: $("#filial_id").val(),
                minuta: $("#minuta").val(),
                numero_nota: $("#numero_nota").val(),
                perda_ganho: $("#perda_ganho").val(),
                data_repassado: $("#data_repassado").val(),
                data_retorno_loja: $("#data_retorno_loja").val(),
                descritivo_retorno_loja: $("#descritivo_retorno_loja").val(),
                data_repasse_prevencao: $("#data_repasse_prevencao").val(),
                descritivo_retorno_prevencao: $("#descritivo_retorno_prevencao").val(),
                evidencia: $("#evidencia").val(),
                pdv: $("#pdv").val(),
                data_hora: $("#data_hora").val(),
                regra: $("#regra").val(),
                classificacao: $("#classificacao").val(),
                parecer: $("#parecer").val(),
                observacao: $("#observacao").val(),
                operacao: $("#operacao").val(),
                cupom: $("#cupom").val(),
                codigo: $("#codigo").val(),
                origem: $("#origem").val(),
                quantidade: $("#quantidade").val(),
                valor_unidade: $("#valor_unidade").val(),
                codigo_operador: $("#codigo_operador").val(),
                dataalteracao: false
            },
            success: function (response) {
                disableAllInputs()
                console.log(response)

                $.ajax({
                    type: "GET",
                    url: "Controller/montar.php",
                    data: {
                        id: (fluxoAuditoria.NUMCONTROLE)
                    },
                    success: function (response) {
                    }
                });
                Swal.fire(
                    'Atenção',
                    'Dados Atualizados com Sucesso!',
                    'success'
                )
                $('#label_imagem').addClass('transparente');
                $('#editar').attr('disabled', false)
                $('#cancelar').attr('disabled', false)
                $('#emitir').attr('disabled', false)
                if (sessionStorage.getItem('gerente') == 'true') {
                    $('#emitir').attr('disabled', true)
                }

                $('*').removeClass('vazio')

            }
        });

        }else{
            event.preventDefault();
            Swal.fire({
            icon: 'info',
            title: 'Inserção não realizada!',
            text: 'Há dados não preenchidos, verifique e solicite novamente'
        })
        }
    }
}


novo = false;
function parseDate(data) {
    const inputData = data;
    const dataArray = inputData.split("-");
    const day = dataArray[0];
    const month = dataArray[1];
    const year = "20" + dataArray[2];
    const monthNames = ["JAN", "FEB", "MAR", "APR", "MAY", "JUN",
        "JUL", "AUG", "SEP", "OCT", "NOV", "DEC"];
    const monthIndex = monthNames.indexOf(month);
    const date = new Date(year, monthIndex, day);
    const formattedDate = date.toLocaleDateString();
    DataFinal = formattedDate.split("/");
    const day1 = DataFinal[0];
    const month1 = DataFinal[1];
    const year1 = DataFinal[2];
    DataTotal = year1 + '-' + month1 + '-' + day1;
    return DataTotal;
}

function formatDateForInput(dateString) {
    const dateArray = dateString.split(" ");
    const datePart = dateArray[0].split("/");
    const timePart = dateArray[1].split(":");
    const day = datePart[0];
    const month = datePart[1];
    const year = datePart[2];
    const hour = timePart[0];
    const minute = timePart[1];
    return `${year}-${month}-${day}T${hour}:${minute}:00`;

}

if (sessionStorage.getItem("Fluxo_Auditoria")) {

    var fluxoAuditoria = JSON.parse(sessionStorage.getItem("Fluxo_Auditoria"));

    if (sessionStorage.getItem("Fluxo_Auditoria")) {

        var fluxoAuditoria = JSON.parse(sessionStorage.getItem("Fluxo_Auditoria"));

        if (fluxoAuditoria.CODFILIAL) {
            $("#filial_id").val(fluxoAuditoria.CODFILIAL);
        } else {

            if (sessionStorage.getItem('gerente') == 'false') {
                $("#filial_id").addClass('vazio')
            }
        }
        if (fluxoAuditoria.PERDAGANHO) {
            $("#perda_ganho").val(fluxoAuditoria.PERDAGANHO);
        } else {
            if (sessionStorage.getItem('gerente') == 'false') {
                $("#perda_ganho").addClass('vazio')
            }
        }

        console.log(fluxoAuditoria)
       
        if (fluxoAuditoria.NUMERONOTAGERADO) {
            $("#numero_nota").val(fluxoAuditoria.NUMERONOTAGERADO);
      
        } else {
            if (sessionStorage.getItem('gerente') == 'false') {
                $("#numero_nota").addClass('vazio')
            }
        }


        if (fluxoAuditoria.MINUTAPREENCHIDA) {
            $("#minuta").val(fluxoAuditoria.MINUTAPREENCHIDA);
        } else {
            if (sessionStorage.getItem('prevencao') == 'true') {
                $("#minuta").addClass('vazio')
            }
        }

        if (fluxoAuditoria.DATAREPASSEGERENTE) {
            $("#data_repassado").val(parseDate(fluxoAuditoria.DATAREPASSEGERENTE));
        } else {
            if (sessionStorage.getItem('gerente') == 'false') {
                $("#data_repassado").addClass('vazio')
            }
        }
        if (fluxoAuditoria.DATARETORNOLOJA) {
            $("#data_retorno_loja").val(parseDate(fluxoAuditoria.DATARETORNOLOJA));
        } else {
            if (sessionStorage.getItem('gerente') == 'true') {
                $("#data_retorno_loja").addClass('vazio')
            }
        }
        if (fluxoAuditoria.CODDESCLOJA) {
            $("#descritivo_retorno_loja").val(fluxoAuditoria.CODDESCLOJA);
        } else {
            if (sessionStorage.getItem('gerente') == 'true') {
                $("#descritivo_retorno_loja").addClass('vazio')
            }
        }
        
        if (fluxoAuditoria.DATAREPASSEPREVENCAO) {
            $("#data_repasse_prevencao").val(parseDate(fluxoAuditoria.DATAREPASSEPREVENCAO));
        } else {
            if (sessionStorage.getItem('prevencao') == 'true') {
                $("#data_repasse_prevencao").addClass('vazio')
            }
        }

        if (fluxoAuditoria.DESCRITIVORETORNOPREVENCAO) {
            $("#descritivo_retorno_prevencao").val(fluxoAuditoria.DESCRITIVORETORNOPREVENCAO);
        } else {
            if (sessionStorage.getItem('prevencao') == 'true') {
                $("#descritivo_retorno_prevencao").addClass('vazio')
            }
        }

        if (fluxoAuditoria.EVIDENCIA) {
            $("#evidencia").val(fluxoAuditoria.EVIDENCIA);
        } else {
            if (sessionStorage.getItem('gerente') == 'false') {
                $("#evidencia").addClass('vazio')
            }
        }
        if (fluxoAuditoria.PDV) {
            $("#pdv").val(fluxoAuditoria.PDV);
           
        } else {
            if (sessionStorage.getItem('gerente') == 'false') {
                $("#pdv").addClass('vazio')
            }
        }
        if (fluxoAuditoria.DATAHORA) {
            $("#data_hora").val(formatDateForInput(fluxoAuditoria.DATAHORA));
           
        } else {
            if (sessionStorage.getItem('gerente') == 'false') {
                $("#data_hora").addClass('vazio')
            }
        }
        if (fluxoAuditoria.REGRA) {
            $("#regra").val(fluxoAuditoria.REGRA);
        
        } else {
            if (sessionStorage.getItem('gerente') == 'false') {
                $("#regra").addClass('vazio')
            }
        }
        if (fluxoAuditoria.CLASSIFICACAO) {
            $("#classificacao").val(fluxoAuditoria.CLASSIFICACAO);
        } else {
            if (sessionStorage.getItem('gerente') == 'false') {
                $("#classificacao").addClass('vazio')
            }
        }
        if (fluxoAuditoria.PARECER) {
            $("#parecer").val(fluxoAuditoria.PARECER);
        } else {
            if (sessionStorage.getItem('gerente') == 'false') {
                $("#parecer").addClass('vazio')
            }
        }
        if (fluxoAuditoria.OBSERVACAO) {
            $("#observacao").val(fluxoAuditoria.OBSERVACAO);
        } else {
            if (sessionStorage.getItem('gerente') == 'false') {
                $("#observacao").addClass('vazio')
            }
        }
        if (fluxoAuditoria.OPERACAO) {
            $("#operacao").val(fluxoAuditoria.OPERACAO);
        } else {
            if (sessionStorage.getItem('gerente') == 'false') {
                $("#operacao").addClass('vazio')
            }
        }
        if (fluxoAuditoria.ORIGEM) {
            $("#origem").val(fluxoAuditoria.ORIGEM);
        } else {
            if (sessionStorage.getItem('gerente') == 'false') {
                $("#origem").addClass('vazio')
            }
        }
        if (fluxoAuditoria.CUPOM) {
            $("#cupom").val(fluxoAuditoria.CUPOM);
        } else {
            if (sessionStorage.getItem('gerente') == 'false') {
                $("#cupom").addClass('vazio')
            }
        }
        if (fluxoAuditoria.CODPROD) {
            $("#codigo").val(fluxoAuditoria.CODPROD);
        } else {
            if (sessionStorage.getItem('gerente') == 'false') {
                $("#codigo").addClass('vazio')
            }
        }
        if (fluxoAuditoria.QUANTIDADE) {
            $("#quantidade").val(fluxoAuditoria.QUANTIDADE);
           
        } else {
            if (sessionStorage.getItem('gerente') == 'false') {
                $("#quantidade").addClass('vazio')
            }
        }
        if (fluxoAuditoria.VALORUNIDADE) {
            $("#valor_unidade").val(fluxoAuditoria.VALORUNIDADE);
        } else {
            if (sessionStorage.getItem('gerente') == 'false') {
                $("#valor_unidade").addClass('vazio')
            }
        }
        if (fluxoAuditoria.CODIGOOPERADOR) {
            $("#codigo_operador").val(fluxoAuditoria.CODIGOOPERADOR);
          
        } else {
            if (sessionStorage.getItem('gerente') == 'false') {
                $("#codigo_operador").addClass('vazio')
            }
        }

        $('#cancelar').attr('disabled', false);
        $('#imagem').attr('disabled', true);

        $('#label_imagem').addClass('transparente');
    }
}

function consultar() {
    location.assign('View/consultar.php')
}

function disableAllInputs() {
    const inputs = document.querySelectorAll('input');
    inputs.forEach(input => {
        input.setAttribute('disabled', 'true');
    });
    $('textarea').attr('disabled', true)
    $('select').attr('disabled', true)
}

function Buscar() {
    if ($('#buscar').html() == '') {
        $('#buscar').load('../Controller/buscar.php')
    } else {
        $('#buscar').html('')
    }

}

function input_file_img() {

    const myFileInput = document.getElementById('imagem');

    myFileInput.addEventListener('change', () => {

        var fileName = myFileInput.files[0].name;

        if (fileName) {
            $('#conteudo2').addClass('borda_inferior')
            $('#conteudo2').html(fileName)
        }
    });
}

function input_file_csv() {
    const myFileInput = document.getElementById('arquivo_csv');


       myFileInput.addEventListener('change', () => {

           var fileName = myFileInput.files[0].name;

           if (fileName) {

               $('#arquivo_csv_btn').attr('disabled', false)

               $('#conteudo').addClass('borda_inferior')

               $('#conteudo').html('Arquivo(s) Carregados!!!')

           }

       });

   }

function enableAllInputs(atr) {
    const inputs = document.querySelectorAll('input');
    inputs.forEach(input => {
        input.removeAttribute('disabled');
        $('select').attr('disabled', false)
    });

    if (atr == 'sim') {
        $('#imagem').attr('disabled', false);
        $('#label_imagem').removeClass('transparente');
        $('#editar').attr('disabled', true)
        $('#cancelar').attr('disabled', true)
        $('#cancelar').attr('disabled', false);
        $('#arquivo_csv').attr('disabled', true);
        $('#label_csv').addClass('transparente');
        $('#label_csv').removeClass('pointer');
        $('#observacao').attr('disabled', false);
        $('#arquivo_csv_btn').attr('disabled', true);
        editar = true

        if (sessionStorage.getItem('prevencao') == 'true') {
            disableAllInputs();
            $('#cancelar').attr('disabled', false);
            $('#consultar').attr('disabled', false);
            $('#salvar').attr('disabled', false);
            $('#emitir').attr('disabled', true);
            $('#data_repasse_prevencao').attr('disabled' , false);
            $('#descritivo_retorno_prevencao').attr('disabled' , false);
            $('#minuta').attr('disabled' , false);
        }else{
            $('#data_repasse_prevencao').attr('disabled' , true);
            $('#descritivo_retorno_prevencao').attr('disabled' , true);
            $('#minuta').attr('disabled' , true);
        }
        
    } else {
        $('#data_retorno_loja').attr('disabled', true);
        $('#descritivo_retorno_loja').attr('disabled', true);
        $('#label_imagem').addClass('transparente');
        $('#imagem').attr('disabled', true);
        $('#editar').attr('disabled', false)
        $('#cancelar').attr('disabled', false)
        $('#cancelar').attr('disabled', false);
        editar = false
    }

    if (sessionStorage.getItem('gerente') == 'true') {
        disableAllInputs();
        editar = true;
        $('#data_retorno_loja').attr('disabled', false);
        $('#descritivo_retorno_loja').attr('disabled', false);
        $('#imagem').attr('disabled', false);
        $('#label_imagem').removeClass('transparente');
        $('#editar').attr('disabled', true);
        $('#cancelar').attr('disabled', false);
        $('#salvar').attr('disabled', false);
        $('#emitir').attr('disabled', true);
    } else {
        $('#emitir').attr('disabled', false);
        $('#data_retorno_loja').attr('disabled', true);
        $('#descritivo_retorno_loja').attr('disabled', true);
        $('#imagem').attr('disabled', true);
        $('#label_imagem').addClass('transparente');
    }


}
if (novo == false) {
    disableAllInputs()
}



if (sessionStorage.getItem("Fluxo_Auditoria")) {
    $('#editar').attr('disabled', false)
    $('#imagem').attr('disabled', true);
    $('#label_imagem').addClass('transparente');
    $('#cancelar').attr('disabled', false)
}

if (sessionStorage.getItem('gerente') != 'true') {
    $("#data_retorno_loja").attr('disabled', true);
    $("#descritivo_retorno_loja").attr('disabled', true);
    $('#emitir').attr('disabled', false);
}

setInterval(() => {
    input_file_img();
    input_file_csv()

}, 10);

var elementoVazio = document.querySelector('.vazio');

if (elementoVazio) {
var posicaoElemento = elementoVazio.getBoundingClientRect().top - 60;
var posicaoAtual = window.pageYOffset;
var duracao = 1000; 
var inicio;

function animacao(tempoAtual) {

    if (inicio === undefined) inicio = tempoAtual;
    var tempoDecorrido = tempoAtual - inicio;
    var percentualConcluido = tempoDecorrido / duracao;


    percentualConcluido = Math.min(percentualConcluido, 1);

    var posicaoDestino = posicaoAtual + posicaoElemento * percentualConcluido;
    window.scrollTo(0, posicaoDestino);

    if (percentualConcluido < 1) {

    requestAnimationFrame(animacao);
    
    }
}

requestAnimationFrame(animacao);

}

document.body.addEventListener('keydown', function (event) {
const key = event.key;
const code = event.keyCode;

if (key == 'Enter'){
    event.preventDefault();
}
});
