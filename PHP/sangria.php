
<style>
    th{
        font-size:13px;
    }
</style>

<table class="table table-striped  table-sm">
<thead style='z-index: 0; position: sticky; top: 64px;' class=" letra thead-dark ">
        <tr>
            <th scope="col">Loja</th>
            <th scope="col">Data</th>
            <th scope="col">Caixa</th>
            <th scope="col">Num. Envelope</th>
            <th scope="col">Operador</th>
            <th scope="col">Hora da Sangria</th>
            <th scope="col">Valor no Sistema</th>
            <th scope="col">Valor da Sangria</th>
            <th scope="col">Nome Autorizou</th>
        </tr>
    </thead>
    <tbody>
<?php



$nome1 = '../Uploads/Sangria/Sangria.csv';
$arquivo = fopen($nome1, 'w');
$texto = 'Loja;';
fwrite($arquivo, $texto);
$texto = 'Data;';
fwrite($arquivo, $texto);
$texto = 'Caixa;';
fwrite($arquivo, $texto);
$texto = 'Num.Envelope;';
fwrite($arquivo, $texto);
$texto = 'Operador;';
fwrite($arquivo, $texto);
$texto = 'Hora da Sangria;';
fwrite($arquivo, $texto);
$texto = 'Valor no Sistema;';
fwrite($arquivo, $texto);
$texto = 'Valor da sangria;';
fwrite($arquivo, $texto);
$texto = 'Nome Autorizou;';
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
select
movimento_sangria.data_movimento as DATA,
movimento_sangria.numero_loja AS FILIAL,
movimento_sangria.numero_pdv AS CAIXA,
movimento_sangria.numero_envelope AS NUMENVELOPE,
movimento_sangria.codigo_operador AS OPERADOR,
movimento_sangria.hora_sangria AS HORA_SANGRIA,
movimento_sangria.valor_sistema AS "VALOR SISTEMA",
movimento_sangria.valor_sangria AS "VALOR SANGRIA",
movimento_sangria.usuario_autorizou AS "MAT AUTORIZOU",
usuario_security.nome AS "NOME AUTORIZOU"
from movimento_sangria,usuario_security
where movimento_sangria.usuario_autorizou = usuario_security.login

';

if (!empty($_GET['Data_Inicio'])  &&  !empty($_GET['Data_Fim'])) {
    $query = $query . ' AND data_movimento >=' . "'" . $_GET['Data_Inicio'] . "'" . 'AND data_movimento <=' . "'" . $_GET['Data_Fim'] . "'";
} else {
    $query = $query . ' AND data_movimento = current_date';
}

if (!empty($_GET['Cod_loja'])) {
    $query = $query . ' AND numero_loja IN(' . $_GET['Cod_loja'] . ')';
}

if (!empty($_GET['Cod_pdv'])) {
    $query = $query . ' AND numero_pdv =' . $_GET['Cod_pdv'];
}

$query = $query . ' ORDER BY data_movimento, FILIAL ASC , HORA_SANGRIA DESC;';

if ($result = $conn->query($query)) {

    while ($row = $result->fetch_assoc()) {
        $data = $row['DATA'];
        $codigo_loja = $row['FILIAL'];
        $caixa = $row['CAIXA'];
        $numeroenvelope = $row['NUMENVELOPE'];
        $operador = $row['OPERADOR'];
        $horasangria = $row['HORA_SANGRIA'];
        $valorsistema = $row['VALOR SISTEMA'];
        $valorsangria = $row['VALOR SANGRIA'];
        $nome = $row['NOME AUTORIZOU'];
        
        $texto = $codigo_loja . ';';
        fwrite($arquivo, $texto);
        $texto = $data . ';';
        fwrite($arquivo, $texto);
        $texto = $caixa . ';';
        fwrite($arquivo, $texto);
        $texto = $numeroenvelope . ';';
        fwrite($arquivo, $texto);
        $texto = $operador . ';';
        fwrite($arquivo, $texto);
        $texto = $horasangria . ';';
        fwrite($arquivo, $texto);
        $texto = $valorsistema . ';';
        fwrite($arquivo, $texto);
        $texto = $valorsangria . ';';
        fwrite($arquivo, $texto);
        $texto = $nome . ';';
        fwrite($arquivo, $texto);
        $texto = PHP_EOL;
        fwrite($arquivo, $texto);

        echo '<tr id = "1" onclick = "marcarID(this.id)">';
        echo '<th class = "loja_' . $codigo_loja . '">' . $codigo_loja . '</th>';
        echo '<th>' . convertDate($data) . '</th>';
        echo '<th>' . $caixa . '</th>';
        echo '<th>' . $numeroenvelope . '</th>';
        echo '<th>' . $operador . '</th>';
        echo '<th>' . convertDate($horasangria) . '</th>';
        echo '<th>' . 'R$ ' . number_format($valorsistema, 2, ',', '.') . '</th>';
        echo '<th>' . 'R$ ' . number_format($valorsangria, 2, ',', '.') . '</th>';
        echo '<th>' . $nome . '</th>';
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