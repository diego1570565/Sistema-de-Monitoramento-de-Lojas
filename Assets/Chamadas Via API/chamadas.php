<?php

ini_set("soap.wsdl_cache_enabled", 0);

$context = stream_context_create([
    'ssl' => [
        'verify_peer' => false,
        'verify_peer_name' => false,
        'allow_self_signed' => true],
]);

$client = new SoapClient('https://172.16.203.5/aplicativos/webservice/wsuscall.php? wsdl',

    ['stream_context' => $context]);

// chamadas sem ser qualificadas

$data_inicio = $_POST['data_inicio'];
$data_fim = $_POST['data_fim'];

$data_inicio = date('Y-m-d', strtotime($data_inicio));
$data_fim = date('Y-m-d', strtotime($data_fim));

//gerando arquivo de chamadas

if (isset($_POST['Chamadas'])) {

$result = $client->cdrSearch('$1$hE0J.IJN$J3MplTzvNXSKSBwcPGWTM1' , $data_inicio .' 00:00:00' , $data_fim .' 23:59:59');

$result = json_decode($result);



$result = $result->retorno;

$nome = 'chamadas_API.csv';

$arquivo = fopen($nome, 'w');

$texto = 'bilheteunico;calldate;hora;tipo;origem;destino;duracao;duracaototal';
fwrite($arquivo, $texto);
$texto = PHP_EOL;
fwrite($arquivo, $texto);

$quantidade_resultado = count($result) - 1;

for ($i = 0; $i <= $quantidade_resultado; $i++) {

    $data_hora = explode(' ', $result[$i]->datahora);

    $data = $data_hora[0];

    $hora = $data_hora[1];

    $texto = $result[$i]->bilheteunico . ';"' .

    $data . '";"' .
    $hora . '";' .
    $result[$i]->tipo . ';' .
    //$result[$i]->app . ';' .
    $result[$i]->origem . ';' .
    $result[$i]->destino . ';' .
    $result[$i]->duracao . ';' .
    //$result[$i]->billsec . ';' .
    $result[$i]->duracao . ';' .
        PHP_EOL;
    fwrite($arquivo, $texto);

}

header('location:' . $nome);

// $texto = 'hora;';
// fwrite($arquivo, $texto);
// $texto = 'protocolo;';
// fwrite($arquivo, $texto);
// $texto = 'phone;';
// fwrite($arquivo, $texto);
}