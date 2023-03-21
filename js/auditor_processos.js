
if (sessionStorage.getItem("Fluxo_Auditoria_Processos")) {

    var fluxoAuditoria = JSON.parse(sessionStorage.getItem("Fluxo_Auditoria_Processos"));

    if (fluxoAuditoria.CODFILIAL) {
        $("#filial_id_processos").val(fluxoAuditoria.CODFILIAL);
    } else {

        if (sessionStorage.getItem('gerente') == 'false') {
            $("#filial_id_processos").addClass('vazio')
        }
    }

    if (fluxoAuditoria.PERDAGANHO) {
        $("#perda_ganho_processos").val(fluxoAuditoria.PERDAGANHO);
    }

    if (fluxoAuditoria.DATAREPASSEGERENTE) {
        $("#data_repassado_processos").val(parseDate(fluxoAuditoria.DATAREPASSEGERENTE));
    } else {
        if (sessionStorage.getItem('gerente') == 'false') {
            $("#data_repassado_processos").addClass('vazio')
        }
    }

    if (fluxoAuditoria.CODDESCLOJA) {
        $("#descritivo_retorno_loja_processos").val(fluxoAuditoria.CODDESCLOJA);
    } else {
        if (sessionStorage.getItem('gerente') == 'true') {
            $("#descritivo_retorno_loja_processos").addClass('vazio')
        }
    }

    if (fluxoAuditoria.EVIDENCIA) {
        $("#evidencia_processos").val(fluxoAuditoria.EVIDENCIA);
    } else {
        if (sessionStorage.getItem('gerente') == 'false') {
            $("#evidencia_processos").addClass('vazio')
        }
    }


    if (fluxoAuditoria.DATAHORA) {
        $("#data_hora_processos").val(formatDateForInput(fluxoAuditoria.DATAHORA));

    } else {
        if (sessionStorage.getItem('gerente') == 'false') {
            $("#data_hora_processos").addClass('vazio')
        }
    }

    if (fluxoAuditoria.OBSERVACAO) {
        $("#observacao_processos").val(fluxoAuditoria.OBSERVACAO);
    } else {
        if (sessionStorage.getItem('gerente') == 'false') {
            $("#observacao_processos").addClass('vazio')
        }
    }
    if (fluxoAuditoria.SETOR) {
        $("#setor_processos").val(fluxoAuditoria.SETOR);
    } else {
        if (sessionStorage.getItem('gerente') == 'false') {
            $("#setor_processos").addClass('vazio')
        }
    }
    if (fluxoAuditoria.PROCESSOAUDITADO) {
        $("#processo_auditado_processos").val(fluxoAuditoria.PROCESSOAUDITADO);
    } else {
        if (sessionStorage.getItem('gerente') == 'false') {
            $("#processo_auditado_processos").addClass('vazio')
        }
    }

    $('#cancelar_processos').attr('disabled', false);
    $('#imagem_processos').attr('disabled', true);
    $('#editar_processos').attr('disabled', false);

    $('#label_imagem_processos').addClass('transparente');

}

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
