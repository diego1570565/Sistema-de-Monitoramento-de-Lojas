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

$query = 'SELECT
distinct(COD_SUP) AS "COD SUPERVISOR",
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


if (!empty($_GET['Nomes'])) {

    $nomes = explode(',' , $_GET['Nomes']);
    
    if ($result = $conn->query($query)) {

        while ($row = $result->fetch_assoc()) {

            $pessoa = $row['NOME SUPERVISOR'];
            $cod = $row['COD SUPERVISOR'];
        
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
            $pessoa = $row['NOME SUPERVISOR'];
            $cod = $row['COD SUPERVISOR'];

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