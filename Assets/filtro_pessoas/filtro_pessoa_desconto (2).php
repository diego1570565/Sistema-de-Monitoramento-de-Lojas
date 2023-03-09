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

<div id="collapseTwo" aria-expanded="true" class="collapse in">
    <div style='width:299px; max-height: 400px;  overflow-y :scroll;' class="bg-light mt-2 rounded position-absolute">
        <div class='my-3'>

       
<?php
require '../../PHP/conexao.php';

$query = 'select  distinct(codigo_identificacao) , nome
from detalhe_cupom_venda d, movimento_desconto dd, usuario_security u, motivo m
where d.data_venda = dd.data_movimento
and d.numero_cupom = dd.numero_cupom
and d.numero_pdv = dd.numero_pdv
and d.numero_loja = dd.numero_loja
and dd.usu_dsc = u.login
and d.motivo_desconto = m.codigo_motivo
and m.codigo_tipo_motivo=1
and d.tipo_desconto=3';

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




if (!empty($_GET['Nomes'])) {

    $nomes = explode(',' , $_GET['Nomes']);
    
    if ($result = $conn->query($query)) {

        while ($row = $result->fetch_assoc()) {

            $pessoa = $row['nome'];
            $cod = $row['codigo_identificacao'];
        
            $num = $cod;
            $verificacao = false;

            foreach ($nomes as $chave => $valor) {
                if ($num == $valor) {
                    $verificacao = true;
                }
            }

     

            if ($verificacao == true) {
                echo'<div class="m-1 my-2 mx-4 form-check">
                        <input class="form-check-input" checked type="checkbox" id="' . $cod . '" name="' . $cod . '" value="' . $cod . '">
                        <label class="form-check-label">' . $pessoa . '</label>
                    </div>';
            } else {
                echo '<div class="m-1 my-2 mx-4 form-check">
                        <input class="form-check-input" type="checkbox" id="' . $cod . '" name="' . $cod . '" value="' . $cod . '">
                        <label class="form-check-label">' . $pessoa . '</label>
                    </div>';
                }
        }
    }
} else {
    if ($result = $conn->query($query)) {
        while ($row = $result->fetch_assoc()) {
            $pessoa = $row['nome'];
            $cod = $row['codigo_identificacao'];

            echo '<div class="m-1 my-2 mx-4 form-check">
                                    <input class="form-check-input" type="checkbox" id="' . $cod . '" name="' . $cod . '" value="' . $cod . '">
                                    <label class="form-check-label">' . $pessoa . '</label>
                                </div>';
                                }
                            }
                        }
                    ?>
        </div>
    </div>
</div>