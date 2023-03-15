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
require '../../Controller/conexao.php';

$query = 'select
distinct(usuario_security.nome) AS "NOME AUTORIZOU",
movimento_sangria.usuario_autorizou AS "MAT AUTORIZOU"
from movimento_sangria,usuario_security
where movimento_sangria.usuario_autorizou = usuario_security.login
';

if (!empty($_GET['Data_Inicio'])  &&  !empty($_GET['Data_Fim'])) {
    $query = $query . ' AND data_movimento >=' . "'" . $_GET['Data_Inicio'] . "'" . 'AND data_movimento <=' . "'" . $_GET['Data_Fim'] . "'";
} else {
    $query = $query . ' AND data_movimento = current_date';
}

if (!empty($_GET['Cod_loja'])) {
    $query = $query . ' AND movimento_sangria.numero_loja IN(' . $_GET['Cod_loja'] . ')';
}

if (!empty($_GET['Cod_pdv'])) {
    $query = $query . ' AND movimento_sangria.numero_pdv =' . $_GET['Cod_pdv'];
}
$query = $query . ' order by nome';



if (!empty($_GET['Nomes'])) {

    $nomes = explode(',' , $_GET['Nomes']);
    
    if ($result = $conn->query($query)) {

        while ($row = $result->fetch_assoc()) {

            $pessoa = $row['NOME AUTORIZOU'];
            $cod = $row['MAT AUTORIZOU'];
        
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
            $pessoa = $row['NOME AUTORIZOU'];
            $cod = $row['MAT AUTORIZOU'];

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