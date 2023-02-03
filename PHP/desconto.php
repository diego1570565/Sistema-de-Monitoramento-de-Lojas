<style>
    th{
        font-size:13px;
    }
</style>
<meta http-equiv=”Content-Type” content=”text/html; charset=utf-8″>
<table class="table table-striped table-sm">
<thead style='z-index: 0; position: sticky; top: 64px;' class=" letra thead-dark ">
        <tr>
            <th scope="col">Loja</th>
            <th scope="col">PDV</th>
            <th scope="col">Data Mov.</th>
            <th scope="col">Cupom</th>
            <th scope="col">Produto</th>
            <th scope="col">Valor do Desconto</th>
            <th scope="col">Autorizou</th>
            <th scope="col">Sequencia</th>
            <th scope="col">Motivo</th>
        </tr>
    </thead>
    <tbody>
<?php

$nome1 = '../Uploads/Desconto/desconto.csv';
$arquivo = fopen($nome1, 'w');
$texto = 'Loja;';
fwrite($arquivo, $texto);
$texto = 'PDV;';
fwrite($arquivo, $texto);
$texto = 'Data Mov.;';
fwrite($arquivo, $texto);
$texto = 'Cupom;';
fwrite($arquivo, $texto);
$texto = 'Produto;';
fwrite($arquivo, $texto);
$texto = 'Valor do Desconto;';
fwrite($arquivo, $texto);
$texto = 'Autorizou;';
fwrite($arquivo, $texto);
$texto = 'Sequiencia;';
fwrite($arquivo, $texto);
$texto = 'Motivo;';
fwrite($arquivo, $texto);
$texto = PHP_EOL;
fwrite($arquivo, $texto);

require 'conexao.php';
if (!isset($_SESSION['autenticado']) || $_SESSION['autenticado'] != 'sim') {
    $var1 = true;
    header('Location: ../index.php?msg=Nao_autenticado');}
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

$query = "
select  distinct
d.data_venda as DATA,
d.numero_loja AS FILIAL,
d.numero_pdv AS PDV,
d.numero_cupom AS CUPOM,
d.descricao AS PRODUTO,
d.desconto as 'VALOR DESCONTO',
u.nome as AUTORIZOU,
d.sequencia AS SEQUENCIA,
m.descricao as MOTIVO
from detalhe_cupom_venda d, movimento_desconto dd, usuario_security u, motivo m
where d.data_venda = dd.data_movimento
and d.numero_cupom = dd.numero_cupom
and d.numero_pdv = dd.numero_pdv
and d.numero_loja = dd.numero_loja
and dd.usu_dsc = u.login
and d.motivo_desconto = m.codigo_motivo
and m.codigo_tipo_motivo=1
and d.tipo_desconto=3
";

if (!empty($_GET['Data_Inicio'])  &&  !empty($_GET['Data_Fim'])) {
    $query = $query . ' AND data_venda >=' . "'" . $_GET['Data_Inicio'] . "'" . 'AND data_venda <=' . "'" . $_GET['Data_Fim'] . "'";
} else {
    $query = $query . ' AND data_venda =current_date';
}

if (!empty($_GET['Cod_loja'])) {
    $query = $query . ' AND d.numero_loja IN(' . $_GET['Cod_loja'] . ')';
}

if (!empty($_GET['Cod_pdv'])) {
    $query = $query . ' AND d.numero_pdv =' . $_GET['Cod_pdv'];
}

$query = $query . ' order by data_venda, d.numero_loja, d.numero_pdv';

if ($result = $conn->query($query)) {

    while ($row = $result->fetch_assoc()) {
        $codigo_loja = $row['FILIAL'];
        $codigo_pvd = $row['PDV'];
        $data_movimento = $row['DATA'];
        $cupom = $row['CUPOM'];
        $produto = $row['PRODUTO'];
        $valor_desconto = $row['VALOR DESCONTO'];
        $autorizou = $row['AUTORIZOU'];
        $sequencia = $row['SEQUENCIA'];
        $motivo = $row['MOTIVO'];

        $texto = $codigo_loja . ';';
        fwrite($arquivo, $texto);
        $texto = $codigo_pvd . ';';
        fwrite($arquivo, $texto);
        $texto = $data_movimento . ';';
        fwrite($arquivo, $texto);
        $texto = $cupom . ';';
        fwrite($arquivo, $texto);
        $texto = $produto . ';';
        fwrite($arquivo, $texto);
        $texto = $valor_desconto . ';';
        fwrite($arquivo, $texto);
        $texto = $autorizou . ';';
        fwrite($arquivo, $texto);
        $texto = $sequencia . ';';
        fwrite($arquivo, $texto);
        $texto = $motivo . ';';
        fwrite($arquivo, $texto);
        $texto = PHP_EOL;
        fwrite($arquivo, $texto);


        echo '<tr id = "' . $cupom . $sequencia . '"onclick ="marcarID(this.id)">';
        echo '<th class = "loja_' . $codigo_loja . '">' . $codigo_loja . '</th>';
        echo '<th>' . $codigo_pvd . '</th>';
        echo '<th>' . convertDate($data_movimento) . '</th>';
        echo '<th>' . $cupom . '</th>';
        echo '<th>' . $produto . '</th>';
        echo '<th>' . 'R$ ' . number_format($valor_desconto, 2, ',', '.') . '</th>';
        echo '<th>' . $autorizou . '</th>';
        echo '<th>' . $sequencia . '</th>';
        echo '<th>' . str_replace('Ç', 'C', $motivo) . '</th>';
        echo '</tr>';
    }

    echo '</tbody>';

}

?>

<script>
   function marcarID(id){
    $('#' + id).toggleClass('text-white bg-dark')
}

function trocar_nome_filial(){
    const itens = JSON.parse(localStorage.getItem('itens'))
    for (i = 0; i < itens.length; i++) {
    
    $('.loja_' + itens[i]['codfilial']).text(itens[i]['nome']);
}
}


trocar_nome_filial()



</script>


</table>