<?php

ini_set("soap.wsdl_cache_enabled", 0);

$context = stream_context_create([
    'ssl' => [
        'verify_peer' => false,
        'verify_peer_name' => false,
        'allow_self_signed' => true],
]);

$client = new SoapClient('https://192.168.200.187/aplicativos/webservice/wsuscall.php? wsdl',

    ['stream_context' => $context]);

$result = $client->startCall('$1$hE0J.IJN$J3MplTzvNXSKSBwcPGWTM1','clicktocall', '1139952800', '2800', '1');

var_dump($result);

phpinfo();
