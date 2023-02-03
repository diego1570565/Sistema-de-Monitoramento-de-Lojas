<style>
    th{
        font-size:13px;
        z-index: 1 ;
    }
</style>
<script src="../js/dados.js"></script>
<table class="table table-striped table-sm">
<thead style='z-index: 0; position: sticky; top: 74px;' class="letra thead-dark ">
        <tr>
            <th scope="col" style="width: 150px;">Loja</th>
            <th scope="col">PDV</th>
            <th scope="col">Data Mov.</th>
            <th scope="col">Cupom</th>
            <th scope="col">Sequencia</th>
            <th scope="col">Codigo</th>
            <th scope="col">Descrição</th>
            <th scope="col" style="width: 70px;">Qtde</th>
            <th scope="col">Preço</th>
            <th scope="col">Desconto</th>
            <th scope="col">Total</th>
            <th scope="col">Cancelado por</th>
            <th scope="col">Motivo Cancelamento</th>
        </tr>
    </thead>
    <tbody>
<?php

$nome1 = '../Uploads/Cancelamento_item/Cancelamento_item.csv';
$arquivo = fopen($nome1, 'w');
$texto = 'Loja;PDV;Data Mov.;Cupom;Sequencia;Codigo;Descricao;Qtde;Preco;Desconto;Total;Cancelado por;Motivo Cancelamento;';
fwrite($arquivo, $texto);
$texto = PHP_EOL;
fwrite($arquivo, $texto);

require 'conexao.php';
if (!isset($_SESSION['autenticado']) || $_SESSION['autenticado'] != 'sim') {
    $var1 = true;
    header('Location: ../index.php?msg=Nao_autenticado');}
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
";

if (!empty($_GET['Data_Inicio']) && !empty($_GET['Data_Fim'])) {
    $query = $query . '  AND data_venda >=' . "'" . $_GET['Data_Inicio'] . "'" . 'AND data_venda <=' . "'" . $_GET['Data_Fim'] . "'";
} else {
    $query = $query . ' AND data_venda=current_date';
}

if (!empty($_GET['Cod_loja'])) {
    $query = $query . ' AND numero_loja IN(' . $_GET['Cod_loja'] . ')';
}

if (!empty($_GET['Nomes'])) {
    $query = $query . ' AND usuario_cancelou NOT IN(' . $_GET['Nomes'] . ')';
}

if (!empty($_GET['Cod_pdv'])) {
    $query = $query . ' AND numero_pdv =' . $_GET['Cod_pdv'];
}
$query = $query . ' order by data_venda, numero_loja, numero_pdv, sequencia';

if ($result = $conn->query($query)) {

    while ($row = $result->fetch_assoc()) {
        $codigo_loja = $row['numero_loja'];
        $codigo_pvd = $row['numero_pdv'];
        $data_movimento = $row['data_venda'];
        $numero_cupom = $row['numero_cupom'];
        $sequencia = $row['sequencia'];
        $codigo_produto = $row['codigo_produto'];
        $descricao = $row['descricao'];
        $quantidade = $row['quantidade'];
        $preco = $row['preco'];
        $desconto = $row['desconto'];
        $total = $row['total'];
        $usuario_cancelou = $row['nome'];
        $motivo_cancelamento = $row['motivocanc'];

        $texto = $codigo_loja . ';' . $codigo_pvd . ';' . $data_movimento . ';' . $numero_cupom . ';' . $sequencia . ';' .
            $codigo_produto . ';' . $descricao . ';' . $quantidade . ';' . $preco . ';' . $desconto . ';' . $total . ';' .
            $usuario_cancelou . ';' . $motivo_cancelamento . ';';
        fwrite($arquivo, $texto);
        $texto = PHP_EOL;
        fwrite($arquivo, $texto);

        echo '<tr id = "' . $numero_cupom . $sequencia . '"onclick ="marcarID(this.id)">';
        
        if ($codigo_loja != 27 && $codigo_loja != 29) {
            echo '<th class = "loja_' . $codigo_loja . '">' . $codigo_loja . '</th>';
        }else{
            echo '<th style="font-size:12px" class = "loja_' . $codigo_loja . '">' . $codigo_loja . '</th>';
        }
        echo '<th>' . $codigo_pvd . '</th>';
        echo '<th>' . convertDate($data_movimento) . '</th>';
        echo '<th>' . $numero_cupom . '</th>';
        echo '<th>' . $sequencia . '</th>';
        echo '<th>' . $codigo_produto . '</th>';
        echo '<th style="width:200px">' . $descricao . '</th>';
        echo '<th>' . $quantidade . '</th>';
        echo '<th style="width:80px">' . 'R$ ' . number_format($preco, 2, ',', '.') . '</th>';
        echo '<th>' . 'R$ ' . number_format($desconto, 2, ',', '.') . '</th>';
        echo '<th>' . 'R$ ' . number_format($total, 2, ',', '.') . '</th>';
        echo '<th style="width:300px">' . $usuario_cancelou . '</th>';
        echo '<th>' . $motivo_cancelamento . '</th>';
        echo '</tr>';
    }
    echo '</tbody>';

}

function convertDate($date)
{
    $aux = explode('-', $date);
    $dia = $aux[2];
    $mes = $aux[1];
    $ano = $aux[0];
    return $dia . '/' . $mes . '/' . $ano;
}

if (!empty($_GET['situacao'])) {
    if ($_GET['situacao'] == 'todos') {
        $_GET['situacao'] = 0;
    }}

?>

<script>

trocar_nome_filial()

</script>

</table>