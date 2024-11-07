<?php
const API_URL = 'https://crm.belmar.pro/api/v1';
const API_TOKEN = 'ba67df6a-a17c-476f-8e95-bcdb75ed3958';
function makeApiRequest($endpoint, $method = 'GET', $data = null) {
$curl = curl_init();
$url = API_URL . '/' . $endpoint;

$headers = [
'token: ' . API_TOKEN,
'Content-Type: application/json'
];

$options = [
CURLOPT_URL => $url,
CURLOPT_RETURNTRANSFER => true,
CURLOPT_HTTPHEADER => $headers,
CURLOPT_CUSTOMREQUEST => $method
];

if ($data && $method === 'POST') {
$options[CURLOPT_POSTFIELDS] = json_encode($data);
}

curl_setopt_array($curl, $options);
$response = curl_exec($curl);
curl_close($curl);

return json_decode($response, true);
}