var api_url = "http://192.168.100.229:8008/api/";
function listaFilial() {
    $.getJSON(api_url + 'econectFilial', function (result) {
        for (i = 0; i < result.length; i++) {
            linha = montaFilial(result[i]);
            $("#filtro_loja").append(linha);
        }
    });
}
function montaFilial(obj) {
    html = '<div class="m-1 form-check"><input class="form-check-input" checked type="checkbox" id="' + obj.codfilial + '" name="' + obj.codfilial + '" value="' + obj.codfilial + '"><label class="form-check-label">' + obj.filialS + '</label></div>';
    return html;
}

