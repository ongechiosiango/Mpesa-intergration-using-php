<?php
require_once 'config.php';

function generateMpesaToken() {
    $url = BASE_URL . '/oauth/v1/generate?grant_type=client_credentials';
    
    // Credentials must be concatenated with a colon and base64 encoded
    $credentials = base64_encode(CONSUMER_KEY . ':' . CONSUMER_SECRET);

    $curl = curl_init();
    curl_setopt_array($curl, [
        CURLOPT_URL => $url,
        CURLOPT_HTTPHEADER => ["Authorization: Basic " . $credentials],
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_SSL_VERIFYPEER => false // Only for sandbox/local testing
    ]);

    $response = curl_exec($curl);
    $err = curl_error($curl);
    curl_close($curl);

    if ($err) {
        return ["error" => "cURL Error #:" . $err];
    }

    $result = json_decode($response, true);
    return $result['access_token'] ?? null;
}

// Echo token if file is run directly
if (basename(__FILE__) == basename($_SERVER['SCRIPT_FILENAME'])) {
    header('Content-Type: application/json');
    $token = generateMpesaToken();
    echo json_encode(["access_token" => $token]);
}

