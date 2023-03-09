<?php

require 'conexao.php';

$data_inicio = date('Y-m-d', strtotime($_POST['data_inicio']));
$data_fim = date('Y-m-d', strtotime($_POST['data_fim']));

$nome1 = '../Uploads/Cancelamento_item/Cancelamento_item.csv';
$arquivo = fopen($nome1, 'w');
$texto = 'Loja;PDV;Data Mov.;Cupom;Sequencia;Codigo;Descricao;Qtde;Preco;Desconto;Total;Cancelado por;Motivo Cancelamento;' . PHP_EOL;
fwrite($arquivo, $texto);

$query = "
    select detalhe_cupom_venda.data_venda, detalhe_cupom_venda.numero_loja,
    detalhe_cupom_venda.numero_pdv, detalhe_cupom_venda.numero_cupom,
    detalhe_cupom_venda.sequencia, detalhe_cupom_venda.situacao_detalhe,
    detalhe_cupom_venda.codigo_produto,
    detalhe_cupom_venda.descricao, detalhe_cupom_venda.quantidade, detalhe_cupom_venda.preco, detalhe_cupom_venda.desconto,
    detalhe_cupom_venda.total, detalhe_cupom_venda.usuario_cancelou, detalhe_cupom_venda.motivo_cancelamento,
    motivo.descricao as motivocanc,
    usuario_security.nome
    from detalhe_cupom_venda, motivo , usuario_security
    where situacao_detalhe in (2)
    and detalhe_cupom_venda.motivo_cancelamento  = motivo.codigo_motivo
    and motivo.codigo_tipo_motivo = 4
    and usuario_security.login = detalhe_cupom_venda.usuario_cancelou
    AND data_venda >= ' $data_inicio ' AND data_venda <= ' $data_fim 'order by data_venda, numero_loja, numero_pdv, sequencia ";

 if ($result = $conn->query($query)) {
     while ($row = $result->fetch_assoc()) {
        $texto = $row['numero_loja'] . ';' . 
        $row['numero_pdv'] . ';' . 
        $row['data_venda'] . ';' . 
        $row['numero_cupom'] . ';' . 
        $row['sequencia'] . ';' .
        $row['codigo_produto'] . ';' . 
        $row['descricao'] . ';' .
        $row['quantidade'] . ';' . 
        $row['preco'] . ';' . 
        $row['desconto'] . ';' . 
        $row['total'] . ';' .
        $row['nome'] . ';' . 
        $row['motivocanc'] . ';' . PHP_EOL;
        fwrite($arquivo, $texto);
     }
}

header('location:../Uploads/Cancelamento_item/Cancelamento_item.csv')

?>

<script>
    //  fetch('../Uploads/Cancelamento_item/Cancelamento_item.csv')
    //     .then(response => response.text())
    //     .then(text => {
    //         var array = text.split("\n");

    //         itens = JSON.parse(localStorage.getItem('itens'))
    //         tudo = ''
    //         for (var i = 0; i < array.length; i++) {

    //             var modificado = array[i].split(";")
    //             for(var g = 1; g < itens.length; g++){
    //                 if (modificado[0] == itens[g]['codfilial']){
    //                     modificado[0] = itens[g]['nome'];
    //                 }

    //             }
    //             total = modificado.toString()
    //             total = total.replace(/,/g, ";") + "\r\n"
    //             console.log(total)
    //             var tudo = tudo + total
    //         }

    //         download(tudo, 'Cancelamento_item.csv')
    //         location.assign('../View/cancelamento_item_excel.php')
    //     })


    //     function download(content, filename, contentType){

    //             if(!contentType){
    //             contentType = 'application/octet-stream';
    //         }
    //         var a = document.createElement('a');
    //         var blob = new Blob([content], {'type':contentType});
    //         a.href = window.URL.createObjectURL(blob);
    //         a.download = filename;
    //         a.click();
    //      }
</script>