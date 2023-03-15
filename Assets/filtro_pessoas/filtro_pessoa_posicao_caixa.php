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

$query = "SELECT  distinct(u.nome) as OPERADOR ,codigo_operador
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
    $query = $query . ' AND numero_loja IN(' . $_GET['Cod_loja'] . ')';
}

if (!empty($_GET['Cod_pdv'])) {
    $query = $query . ' AND numero_pdv =' . $_GET['Cod_pdv'];
}
$query = $query . ' order by nome';

if (!empty($_GET['Nomes'])) {

    $nomes = explode(',' , $_GET['Nomes']);
  
    if ($result = $conn->query($query)) {

        while ($row = $result->fetch_assoc()) {

            $pessoa = $row['OPERADOR'];
            $cod = $row['codigo_operador'];
        
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
            $pessoa = $row['OPERADOR'];
            $cod = $row['codigo_operador'];

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