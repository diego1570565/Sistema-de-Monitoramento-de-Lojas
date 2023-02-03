<?php

require 'conexao.php';
if (!isset($_SESSION['autenticado']) || $_SESSION['autenticado'] != 'sim') {
    $var1 = true;
    header('Location: ../index.php?msg=Nao_autenticado');}
$query = "SELECT count(c.dat_mov) as contagem
FROM ctr_abr_pdv_loj c, movimento_entrada_operador m, usuario_security u
Where c.dat_mov = m.data_movimento
and c.cod_loj = m.numero_loja
and c.num_pdv = m.numero_pdv
and m.codigo_operador  = u.login
and fch = '0'
and sequencia_operador not in (select sequencia_operador from movimento_saida_operador where codigo_operador = m.codigo_operador and data_movimento = m.data_movimento and numero_pdv=m.numero_pdv)
";
if (!empty($_GET['Data_mov'])) {
    $query = $query . ' AND dat_mov =' . "'" . $_GET['Data_mov'] . "'";
} else {
    $query = $query . ' AND dat_mov=current_date';
}
if (!empty($_GET['Cod_loja'])) {
    $query = $query . ' AND cod_loj IN(' . $_GET['Cod_loja'] . ')';
}
if (!empty($_GET['Cod_pdv'])) {
    $query = $query . ' AND num_pdv =' . $_GET['Cod_pdv'];
}
if ($result = $conn->query($query)) {
    while ($row = $result->fetch_assoc()) {
        $contagem = $row['contagem'];
    }
}

?>
<style>
    th{
        font-size:13px;
    }
</style>
<div class='text-center mb-3'>
    <nav>
        <strong>Total de registros: </strong><?php echo '<strong class="text-danger">' . $contagem . '</strong>' ?>
    </nav>
</div>
<table class="table table-striped table-sm" id="table_pdv">
    <thead style='z-index: 0; position: sticky; top: 66px;' class=" letra thead-dark ">
        <tr>
            <th scope="col" style ='width:15%' >Loja</th>
            <th scope="col" style ='width:15%'>PDV</th>
            <th scope="col" style ='width:15%'>Data Mov.</th>
            <th scope="col" style ='width:15%'>Situação</th>
            <th scope="col">Operador</th>
        </tr>
    </thead>
    <tbody >
<?php

function convertDate($date)
{
    $aux = explode('-', $date);
    $dia = $aux[2];
    $mes = $aux[1];
    $ano = $aux[0];
    return $dia . '/' . $mes . '/' . $ano;
}

$query = "SELECT c.dat_mov AS DATA, c.cod_loj AS FILIAL, c.num_pdv AS PDV, c.fch AS POSICAO, u.nome as OPERADOR
FROM ctr_abr_pdv_loj c, movimento_entrada_operador m, usuario_security u
Where c.dat_mov = m.data_movimento
and c.cod_loj = m.numero_loja
and c.num_pdv = m.numero_pdv
and m.codigo_operador  = u.login
and fch = '0'
and sequencia_operador not in (select sequencia_operador from movimento_saida_operador where codigo_operador = m.codigo_operador and data_movimento = m.data_movimento and numero_pdv=m.numero_pdv)
";
if (!empty($_GET['Data_mov'])) {
    $query = $query . ' AND dat_mov =' . "'" . $_GET['Data_mov'] . "'";
} else {
    $query = $query . ' AND dat_mov=current_date';}
if (!empty($_GET['Cod_loja'])) {
    $query = $query . ' AND cod_loj IN(' . $_GET['Cod_loja'] . ')';}
if (!empty($_GET['Cod_pdv'])) {
    $query = $query . ' AND num_pdv =' . $_GET['Cod_pdv'];
}
$query = $query . ' order by cod_loj, num_pdv';
if ($result = $conn->query($query)) {
    while ($row = $result->fetch_assoc()) {
        $codigo_loja = $row['FILIAL'];
        $codigo_pvd = $row['PDV'];
        $data_movimento = $row['DATA'];
        $situacao = $row['POSICAO'];
        $operador = $row['OPERADOR'];
        echo '<tr id = "' . $codigo_loja . $codigo_pvd . '"onclick ="marcarID(this.id)">';
        echo '<th class = "loja_' . $codigo_loja . '">' . $codigo_loja . '</th>';
        echo '<th>' . $codigo_pvd . '</th>';
        echo '<th>' . convertDate($data_movimento) . '</th>';
        if ($situacao == '0') {
            echo '<th style="color:red">' . 'Aberto' . '</th>';
        } else {
            echo '<th style="color:green">' . 'Fechado' . '</th>';
        }
        echo '<th>' . $operador . '</th>';
        echo '</tr>';
    }
}
?>
</tbody>
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

