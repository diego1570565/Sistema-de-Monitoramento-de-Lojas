<style>
    th{
        font-size:13px;
    }
</style>

<table class="table table-striped  table-sm">
<thead style='z-index: 0; position: sticky; top: 64px;' class=" letra thead-dark ">
        <tr>
            <th scope="col">Filial</th>
            <th scope="col">Data Transação</th>
            <th scope="col">PDV</th>
            <th scope="col">Cupom</th>
            <th scope="col">Valor</th>
            <th scope="col">Cod. Operador</th>
            <th scope="col">Nome Operador</th>
            <th scope="col">Cod. Supervisor</th>
            <th scope="col">Nome Supervisor</th>
        </tr>
    </thead>
    <tbody>
<?php

$nome1 = '../Uploads/Cancelamento_TEF/Cancelamento_TEF.csv';
$arquivo = fopen('../Uploads/Cancelamento_TEF/Cancelamento_TEF.csv', 'w');

$texto = 'Filial;';
fwrite($arquivo, $texto);
$texto = 'Data Transacao;';
fwrite($arquivo, $texto);
$texto = 'PDV;';
fwrite($arquivo, $texto);
$texto = 'Cupom;';
fwrite($arquivo, $texto);
$texto = 'Valor;';
fwrite($arquivo, $texto);
$texto = 'Cod. Operador;';
fwrite($arquivo, $texto);
$texto = 'Nome Operador;';
fwrite($arquivo, $texto);
$texto = 'Cod. Supervisor;';
fwrite($arquivo, $texto);
$texto = 'Nome Supervisor;';
fwrite($arquivo, $texto);
$texto = PHP_EOL;
fwrite($arquivo, $texto);

require 'conexao.php';
if (!isset($_SESSION['autenticado']) || $_SESSION['autenticado'] != 'sim') {
    $var1 = true;
    header('Location: ../index.php?msg=Nao_autenticado');}
function convertDate($date)
{

    if (strlen($date) > 10) {
        $data = date('H:i:s', strtotime($date));
    } else {
        $data = date('d/m/Y', strtotime($date));
    }

    return $data;

}
if (!empty($_GET['situacao'])) {
    if ($_GET['situacao'] == 'todos') {
        $_GET['situacao'] = 0;
    }}

$query = '
SELECT
DAT_TRN AS "DATA TRANSACAO",
COD_LOJ AS FILIAL,
COD_PDV AS PDV,
NUM_CUP AS CUPOM,
VLR_CAN AS "VALOR",
COD_OPE AS "COD. OPERADOR",
NOM_OPE AS "NOME OPERADOR",
COD_SUP AS "COD SUPERVISOR",
NOM_SUP AS "NOME SUPERVISOR"
FROM mov_can_tef';

$anterior = false;
if (!empty($_GET['Data_Inicio']) && !empty($_GET['Data_Fim'])) {
    $query = $query . ' WHERE DAT_TRN >=' . "'" . $_GET['Data_Inicio'] . "'" . 'AND DAT_TRN <=' . "'" . $_GET['Data_Fim'] . "'";
    $anterior = true;
} else {
    $query = $query . ' WHERE DAT_TRN = current_date';
}

if (!empty($_GET['Cod_loja'])) {
    if ($anterior == true) {
        $query = $query . ' AND COD_LOJ IN(' . $_GET['Cod_loja'] . ')';
    }else{
        $query = $query . ' WHERE COD_LOJ IN(' . $_GET['Cod_loja'] . ')';
        $anterior = true;
    }
}

if (!empty($_GET['Cod_pdv'])) {
    if ($anterior == true) {
        $query = $query . ' AND COD_PDV =' . $_GET['Cod_pdv'];
    }else{
        $query = $query . ' WHERE COD_PDV =' . $_GET['Cod_pdv'];
    }  
}

$query = $query . ' ORDER BY DAT_TRN, FILIAL ASC;';

if ($result = $conn->query($query)) {

    while ($row = $result->fetch_assoc()) {
        $data = $row['DATA TRANSACAO'];
        $codigo_loja = $row['FILIAL'];
        $caixa = $row['PDV'];
        $cupom = $row['CUPOM'];
        $valor = $row['VALOR'];
        $codigo_operador = $row['COD. OPERADOR'];
        $nome_operador = $row['NOME OPERADOR'];
        $codigo_supervisor = $row['COD SUPERVISOR'];
        $nome_supervisor = $row['NOME SUPERVISOR'];

        $texto = $codigo_loja . ';';
        fwrite($arquivo, $texto);
        $texto = $data . ';';
        fwrite($arquivo, $texto);
        $texto = $caixa . ';';
        fwrite($arquivo, $texto);
        $texto = $cupom . ';';
        fwrite($arquivo, $texto);
        $texto = $valor . ';';
        fwrite($arquivo, $texto);
        $texto = $codigo_operador . ';';
        fwrite($arquivo, $texto);
        $texto = $nome_operador . ';';
        fwrite($arquivo, $texto);
        $texto = $codigo_supervisor . ';';
        fwrite($arquivo, $texto);
        $texto = $nome_supervisor . ';';
        fwrite($arquivo, $texto);
        $texto = PHP_EOL;
        fwrite($arquivo, $texto);

        echo '<tr id = "' . $cupom . $valor . '">';
        echo '<th class = "loja_' . $codigo_loja . '">' . $codigo_loja . '</th>';
        echo '<th>' . convertDate($data) . '</th>';
        echo '<th>' . $caixa . '</th>';
        echo '<th>' . $cupom . '</th>';
        echo '<th>' . 'R$ ' . number_format($valor, 2, ',', '.') . '</th>';
        echo '<th>' . $codigo_operador . '</th>';
        echo '<th>' . $nome_operador. '</th>';
        echo '<th>' . $codigo_supervisor . '</th>';
        echo '<th>' . $nome_supervisor. '</th>';
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