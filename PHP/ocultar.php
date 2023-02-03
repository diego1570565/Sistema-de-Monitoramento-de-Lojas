<input
    type="button"
    disable data-toggle="collapse"
    aria-controls="collapseTwo"
    aria-expanded="true"
    placeholder="Pessoas"
    id="Pessoas"
    name='Pessoas'
    style='height:43px;'
    data-target="#collapseTwo"
    value='Ocultar Pessoas   ↓'
    class='mb-2 form-control'>
</input>

<div id="collapseTwo"   aria-expanded="true" class="collapse in">
    <div style='width:299px; max-height: 400px;  overflow-y :scroll;' class="bg-light mt-2 rounded position-absolute">
        <div class='my-3'>

            <?php
require 'conexao.php';
$query = 'select distinct(usuario_security.nome),usuario_cancelou from detalhe_cupom_venda, motivo , 
usuario_security where situacao_detalhe in (2)
and detalhe_cupom_venda.motivo_cancelamento = motivo.codigo_motivo and motivo.codigo_tipo_motivo = 4
and usuario_security.login = detalhe_cupom_venda.usuario_cancelou ';

if (!empty($_GET['Data_Inicio']) && !empty($_GET['Data_Fim'])) {
    $query = $query . ' AND data_venda >=' . "'" . $_GET['Data_Inicio'] . "'" . 'AND data_venda <=' . "'" . $_GET['Data_Fim'] . "'";
} else {
    $query = $query . ' AND data_venda=current_date';
}
if (!empty($_GET['Cod_loja'])) {
    $query = $query . ' AND numero_loja IN(' . $_GET['Cod_loja'] . ')';
}
if (!empty($_GET['Cod_pdv'])) {
    $query = $query . ' AND numero_pdv =' . $_GET['Cod_pdv'];
}
$query = $query . ' order by nome';
if (!empty($_GET['Nomes'])) {
    $nomes = explode(',', $_GET['Nomes']);
    if ($result = $conn->query($query)) {
        while ($row = $result->fetch_assoc()) {
            $pessoa = $row['nome'];
            $num = $row['usuario_cancelou'];
            $nomes = explode(',', $_GET['Nomes']);
            $verificacao = false;
            foreach ($nomes as $chave => $valor) {
                if ($num == $valor) {
                    $verificacao = true;
                }
            }
            if ($verificacao == true) {
                echo'<div class="m-1 my-2 mx-4 form-check">
                        <input class="form-check-input" checked type="checkbox" id="' . $num . '" name="' . $num . '" value="' . $num . '">
                        <label class="form-check-label">' . $pessoa . '</label>
                    </div>';
            } else {
                echo '<div class="m-1 my-2 mx-4 form-check">
                        <input class="form-check-input" type="checkbox" id="' . $num . '" name="' . $num . '" value="' . $num . '">
                        <label class="form-check-label">' . $pessoa . '</label>
                    </div>';}
        }
    }
} else {
    if ($result = $conn->query($query)) {
        while ($row = $result->fetch_assoc()) {
            $pessoa = $row['nome'];
            $num = $row['usuario_cancelou'];
            echo '<div class="m-1 my-2 mx-4 form-check">
                                    <input class="form-check-input" type="checkbox" id="' . $num . '" name="' . $num . '" value="' . $num . '">
                                    <label class="form-check-label">' . $pessoa . '</label>
                                </div>';
                                }
                            }
                        }
                    ?>
        </div>
    </div>
</div>




