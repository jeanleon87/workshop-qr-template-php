<?php

$user_id = '581910860';
$external_id = 'CAJA0004';
$access_token = 'APP_USR-3877150961712175-060915-018ba42fa9fd584bcb54871ce13534cd-581910860';

$url = 'https://api.mercadopago.com/mpmobile/instore/qr/' . $user_id . '/' . $external_id . '?access_token=' . $access_token;

$body = array(
    'external_reference' => 'Factura-0001',
    'notification_url' => 'www.yourserver.com',
    'items' => array($_POST['item']),
    'sponsor_id' => '446566691'
);

$curl = curl_init();

curl_setopt_array(
    $curl,
    array(
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS => json_encode($body),
        CURLOPT_HTTPHEADER => array(
            "Content-Type: application/json"
        ),
    )
);

$response = curl_exec($curl);

curl_close($curl);
echo $response;
