function trocar_nome_filial() {
    itens = JSON.parse(localStorage.getItem('itens'))
    for (i = 0; i < itens.length; i++) {
        $('.loja_' + itens[i]['codfilial']).text(itens[i]['nome']);
    }
}

trocar_nome_filial()

function marcarID(id) {
    $('#' + id).toggleClass('text-white bg-dark')
}

