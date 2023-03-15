<input
    type="button"
    disable
    data-toggle="collapse"
    aria-controls="collapseTwo"
    aria-expanded="true"
    placeholder="Pessoas"
    id="Pessoas"
    name='Pessoas'
    style='height:43px;'
    data-target="#collapseOne"
    value='Lojas  ↓'
    class='form-control'>
</input>

<div id="collapseOne" aria-expanded="true" class="collapse in">
    <div style='border-radius:30px ;width:230px; height: 400px; overflow-x :hidden; overflow-y :scroll;' class="bg-light mt-2 rounded position-absolute">
        <div class='my-3'>
            <?php
                require 'conexao.php';
                if (!isset($_SESSION['autenticado']) || $_SESSION['autenticado'] != 'sim') {
                    $var1 = true;
                    header('Location: ../index.php?msg=Nao_autenticado');}
                $query = 'select codigo_loja from loja where codigo_loja <> "999"';
                if (!empty($_GET['Cod_loja'])) {
                    $nomes = explode(',', $_GET['Cod_loja']);
                    if ($result = $conn->query($query)) {
                        while ($row = $result->fetch_assoc()) {
                            $loja = $row['codigo_loja'];
                            $nomes = explode(',', $_GET['Cod_loja']);
                            $verificacao = false;
                            foreach ($nomes as $chave => $valor) {
                                if ($loja == $valor) {
                                    $verificacao = true;
                                }
                            }
                            if ($verificacao == true) {
                                echo '
                                <div  style="width:200px" class="m-1 my-2 mx-4 form-check">
                                    <input class="form-check-input" type="checkbox" checked id="' . $loja . '" class="' . $loja . '" value="' . $loja . '">
                                    <label class="loja_' . $loja . ' form-check-label">' . $loja . '</label>
                                </div>';
                            } else {
                                echo '
                                <div  style="width:200px" class="m-1 my-2 mx-4 form-check">
                                    <input class="form-check-input" type="checkbox" id="' . $loja . '" class="' . $loja . '" value="' . $loja . '">
                                    <label class="loja_' . $loja . ' form-check-label">' . $loja . '</label>
                                </div>';
                            }
                        }
                    }
                } else {
                    if ($result = $conn->query($query)) {
                        while ($row = $result->fetch_assoc()) {
                            $loja = $row['codigo_loja'];
                                echo '
                                <div  style="width:200px" class="m-1 my-2 mx-4 form-check">
                                    <input class="form-check-input" type="checkbox" id="' . $loja . '" class="' . $loja . '" value="' . $loja . '">
                                    <label class="loja_' . $loja . ' form-check-label">' . $loja . '</label>
                                </div>';
                        }
                    }
                }
            ?>
        </div>
    </div>
</div>
<script>
function trocar_nome_filial(){
    const itens = JSON.parse(localStorage.getItem('itens'))
    for (i = 0; i < itens.length; i++) {
    $('.loja_' + itens[i]['codfilial']).html(itens[i]['nome']);
}
}
trocar_nome_filial()
</script>



