<style>
    th{
        font-size:13px;
    }
</style>
<script src="../js/dados.js"></script>
<table class="table table-striped  table-sm" id="table_pdv">
<thead style='z-index: 0; position: sticky; top: 64px;' class=" letra thead-dark ">
        <tr>
            <th scope="col">Loja</th>
            <th scope="col">PDV</th>
            <th scope="col">Data Venda</th>
            <th scope="col">Cupom</th>
            <th scope="col">Hora Venda</th>
            <th scope="col">Valor</th>
            <th scope="col">Usuario Autorizou</th>
            <th scope="col">Motivo</th>
        </tr>
    </thead>
    <tbody>
<?php

$nome1 = '../Uploads/Cupom_Cancelado/Cupom_cancelado.csv';
$arquivo = fopen($nome1, 'w');
$texto = 'Loja;';
fwrite($arquivo, $texto);
$texto = 'PDV;';
fwrite($arquivo, $texto);
$texto = 'Data Venda;';
fwrite($arquivo, $texto);
$texto = 'Cupom;';
fwrite($arquivo, $texto);
$texto = 'Hora Venda;';
fwrite($arquivo, $texto);
$texto = 'Valor;';
fwrite($arquivo, $texto);
$texto = 'Usuario Autorizou;';
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
    if (strlen($date) > 10) {
        $data = date('H:i:s', strtotime($date));
    } else {
        $data = date('d/m/Y', strtotime($date));
    }
    return $data;
}
$query = "select
c.data_venda AS DATA,
c.numero_loja as FILIAL,
c.numero_pdv AS PDV,
c.numero_cupom AS CUPOM,
c.hora_venda AS 'HORA VENDA',
c.total_liquido AS VALOR,
u.nome AS 'USUARIO AUTORIZOU',
m.descricao AS MOTIVO
from capa_cupom_venda c, usuario_security u, motivo m
where c.usuario_cancelou = u.login
and c.motivo_cancelamento = m.codigo_motivo
and m.codigo_tipo_motivo = 4
and c.situacao_capa = 2 ";

if (!empty($_GET['Data_Inicio']) && !empty($_GET['Data_Fim'])) {
    $query = $query . ' AND c.data_venda >=' . "'" . $_GET['Data_Inicio'] . "'" . 'AND c.data_venda <=' . "'" . $_GET['Data_Fim'] . "'";
} else {
    $query = $query . ' AND c.data_venda=current_date';
}
if (!empty($_GET['Cod_loja'])) {
    $query = $query . ' AND c.numero_loja IN(' . $_GET['Cod_loja'] . ')';
}
if (!empty($_GET['Cod_pdv'])) {
    $query = $query . ' AND c.numero_pdv =' . $_GET['Cod_pdv'];
}
$query = $query . ' order by c.hora_venda, numero_loja, numero_pdv ,c.data_venda';
if ($result = $conn->query($query)) {
    while ($row = $result->fetch_assoc()) {
        $codigo_loja = $row['FILIAL'];
        $codigo_pvd = $row['PDV'];
        $data_movimento = $row['DATA'];
        $cupom = $row['CUPOM'];
        $hora_venda = $row['HORA VENDA'];
        $valor = $row['VALOR'];
        $usuAutorizou = $row['USUARIO AUTORIZOU'];
        $motivo = $row['MOTIVO'];

        $texto = $codigo_loja . ';';
        fwrite($arquivo, $texto);
        $texto = $codigo_pvd . ';';
        fwrite($arquivo, $texto);
        $texto = $data_movimento . ';';
        fwrite($arquivo, $texto);
        $texto = $cupom . ';';
        fwrite($arquivo, $texto);
        $texto = $hora_venda . ';';
        fwrite($arquivo, $texto);
        $texto = $valor . ';';
        fwrite($arquivo, $texto);
        $texto = $usuAutorizou . ';';
        fwrite($arquivo, $texto);
        $texto = $motivo . ';';
        fwrite($arquivo, $texto);
        $texto = PHP_EOL;
        fwrite($arquivo, $texto);

        echo '<tr id = "' . $cupom . '"onclick ="marcarID(this.id)">';
        echo '<th class = "loja_' . $codigo_loja . '">' . $codigo_loja . '</th>';
        echo '<th>' . $codigo_pvd . '</th>';
        echo '<th>' . convertDate($data_movimento) . '</th>';
        echo '<th>' . $cupom . '</th>';
        echo '<th>' . convertDate($hora_venda) . '</th>';
        echo '<th>' . 'R$ ' . number_format($valor, 2, ',', '.') . '</th>';
        echo '<th>' . $usuAutorizou . '</th>';
        echo '<th>' . $motivo . '</th>';
        echo '</tr>';
    }
    echo '</tbody>';
}
?>
<script>



</script>


</table>

