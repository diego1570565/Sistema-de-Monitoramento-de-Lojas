<?php

require 'conexao.php';

$query = "select number from ramais_sip";
$number='';
if ($result = $conn_asterisk->query($query)) {
    while ($row = $result->fetch_assoc()) {
        $number = $number .  '"' . $row['number'] . '"' . ',';
    }
}
$number = substr($number,0,-1);



$data_inicio = $_POST['data_inicio'];
$data_fim = $_POST['data_fim'];

$data_inicio = date('Y-m-d', strtotime($data_inicio));
$data_fim = date('Y-m-d', strtotime($data_fim));

//gerando arquivo de chamadas
if (isset($_POST['Chamadas'])) {
    $nome1 = '../Uploads/Call_center/chamadas.csv';
    $arquivo = fopen($nome1, 'w');

    $texto = 'bilheteunico;';
    fwrite($arquivo, $texto);
    $texto = 'calldate;';
    fwrite($arquivo, $texto);
    $texto = 'hora;';
    fwrite($arquivo, $texto);
    $texto = 'tipo;';
    fwrite($arquivo, $texto);
    $texto = 'app;';
    fwrite($arquivo, $texto);
    $texto = 'origem;';
    fwrite($arquivo, $texto);
    $texto = 'destino;';
    fwrite($arquivo, $texto);
    $texto = 'duracao;';
    fwrite($arquivo, $texto);
    $texto = 'billsec;';
    fwrite($arquivo, $texto);
    $texto = 'duracaototal;';
    fwrite($arquivo, $texto);

    $texto = PHP_EOL;
    fwrite($arquivo, $texto);

    $query = "select bilheteunico, DATE_FORMAT (calldate, '%d/%m/%Y') as calldate,
    (select DATE_FORMAT(min(cdraux.calldate),'%H:%i:%s')from cdr cdraux where cdraux.bilheteunico = cdr.bilheteunico ) as hora,
    tipo, app, origem, destino,
    sum(duracao) as duracao, sum(billsec) as billsec, (sum(duracao) + sum(billsec)) duracaototal
    from cdr
    where calldate >= '" . $data_inicio . " 00:00:00' and calldate <= '" . $data_fim . " 23:59:59'
    and status <> 'CHAMANDO'
    group by bilheteunico, DATE_FORMAT (calldate, '%d/%m/%Y'), tipo, app, origem, destino
    order by calldate, bilheteunico";

    if ($result = $conn_asterisk->query($query)) {
        while ($row = $result->fetch_assoc()) {
            $bilheteunico = $row['bilheteunico'];
            $calldate = $row['calldate'];
            $tipo = $row['tipo'];
            $app = $row['app'];
            $origem = $row['origem'];
            $destino = $row['destino'];
            $duracao = $row['duracao'];
            $billsec = $row['billsec'];
            $duracaototal = $row['duracaototal'];
            $hora = $row['hora'];

            $texto = $bilheteunico . ';';
            fwrite($arquivo, $texto);
            $texto = $calldate . ';';
            fwrite($arquivo, $texto);
            $texto = $hora . ';';
            fwrite($arquivo, $texto);
            $texto = $tipo . ';';
            fwrite($arquivo, $texto);
            $texto = $app . ';';
            fwrite($arquivo, $texto);
            $texto = $origem . ';';
            fwrite($arquivo, $texto);
            $texto = $destino . ';';

            fwrite($arquivo, $texto);
            $texto = $duracao . ';';
            fwrite($arquivo, $texto);
            $texto = $billsec . ';';
            fwrite($arquivo, $texto);
            $texto = $duracaototal . ';';
            fwrite($arquivo, $texto);
            $texto = PHP_EOL;
            fwrite($arquivo, $texto);
        }
    }

    header('location:' . $nome1);
}

//gerando arquivo de chamadas qualificadas
if (isset($_POST['ChamadasQualificadas'])) {

    $nome = '../Uploads/Call_center/chamadas_qualificadas.csv';
    $arquivo = fopen($nome, 'w');
    $texto = 'calldate;';
    fwrite($arquivo, $texto);
    $texto = 'hora;';
    fwrite($arquivo, $texto);
    $texto = 'protocolo;';
    fwrite($arquivo, $texto);
    $texto = 'phone;';
    fwrite($arquivo, $texto);
    $texto = 'agenteid;';
    fwrite($arquivo, $texto);
    $texto = 'nomeagente;';
    fwrite($arquivo, $texto);
    $texto = 'campanha;';
    fwrite($arquivo, $texto);
    $texto = 'id_qualificacao;';
    fwrite($arquivo, $texto);

    $texto = 'qualificacao;';
    fwrite($arquivo, $texto);
    $texto = 'duracao;';
    fwrite($arquivo, $texto);
    $texto = 'billsec;';
    fwrite($arquivo, $texto);
    $texto = 'duracaototal;';
    fwrite($arquivo, $texto);

    $texto = PHP_EOL;

    fwrite($arquivo, $texto);

    $query = "select DATE_FORMAT (calldate, '%d/%m/%Y') as calldate,
    (select DATE_FORMAT(min(cdraux.calldate),'%H:%i:%s')from cdr cdraux where cdraux.protocolo = cdr.protocolo ) as hora,
    protocolo, phone, agenteid, nomeagente, campanha,
    qualificacao as id_qualificacao,
    ifnull((select qualificacao from qualificacoes where id = cdr.qualificacao), 'Não Qualificada') as qualificacao,
    sum(duration) as duracao, sum(billsec) as billsec,  (sum(duration) + sum(billsec)) duracaototal
    from cdr
    where phone in(" . $number . ") and calldate >= '" . $data_inicio . " 00:00:00' and calldate <= '" . $data_fim . " 23:59:59'
    group by DATE_FORMAT (calldate, '%d/%m/%Y'), protocolo, phone, agenteid, nomeagente, campanha, qualificacao,
    ifnull((select qualificacao from qualificacoes where id = cdr.qualificacao), 'NAO QUALIFICADA')
    order by calldate, protocolo";

    if ($result = $conn_discador->query($query)) {
        while ($row = $result->fetch_assoc()) {
            $calldate = $row['calldate'];
            $protocolo = $row['protocolo'];
            $phone = $row['phone'];
            $agenteid = $row['agenteid'];
            $nomeagente = $row['nomeagente'];
            $campanha = $row['campanha'];
            $id_qualificacao = $row['id_qualificacao'];
            $qualificacao = $row['qualificacao'];
            $duracao = $row['duracao'];
            $billsec = $row['billsec'];
            $duracaototal = $row['duracaototal'];
            $hora = $row['hora'];
            if ($qualificacao == 'Ligação sem informação') {
                $qualificacao = 'Ligacao sem informacao';
            }
            if ($qualificacao == 'Reimpressão de comprovante') {
                $qualificacao = 'Reimpressao de comprovante';
            }
            if ($qualificacao == 'Recuperação de Venda') {
                $qualificacao = 'Recuperacao de comprovante';
            }
            $texto = $calldate . ';';
            fwrite($arquivo, $texto);
            $texto = $hora . ';';
            fwrite($arquivo, $texto);
            $texto = $protocolo . ';';
            fwrite($arquivo, $texto);
            $texto = $phone . ';';
            fwrite($arquivo, $texto);
            $texto = $agenteid . ';';
            fwrite($arquivo, $texto);
            $texto = $nomeagente . ';';
            fwrite($arquivo, $texto);
            $texto = $campanha . ';';
            fwrite($arquivo, $texto);
            $texto = $id_qualificacao . ';';
            fwrite($arquivo, $texto);
            $texto = $qualificacao . ';';
            fwrite($arquivo, $texto);
            $texto = $duracao . ';';
            fwrite($arquivo, $texto);
            $texto = $billsec . ';';
            fwrite($arquivo, $texto);
            $texto = $duracaototal . ';';
            fwrite($arquivo, $texto);
            $texto = PHP_EOL;
            fwrite($arquivo, $texto);
        }
    }

    header('location:' . $nome);

}
