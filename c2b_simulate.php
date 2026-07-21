<?php
require_once 'config.php';
require_once 'generate_token.php';

// Note: C2B Sandbox requires shortcode URLs to be registered first before simulation will succeed!
function simulateC2BTransaction($amount, $msisdn, $billRefNumber) {
    $token = generateMpesaToken();
    if (!$token) {
        return ["error" => "Failed to generate access token."];
    }

    $url = BASE_URL . '/mpesa/c2b/v1/simulate';

    $curl_post_data = [
        'ShortCode'     => SHORTCODE,
        'CommandID'     => 'CustomerPayBillOnline', // or CustomerBuyGoodsOnline
        'Amount'        => $amount,
        'Msisdn'        => $msisdn, // Tester phone number
        'BillRefNumber' => $billRefNumber // Account number for Paybills
    ];

    $curl = curl_init();
    curl_setopt_array($curl, [
        CURLOPT_URL => $url,
        CURLOPT_HTTPHEADER => [
            "Authorization: Bearer " . $token,
            "Content-Type: application/json"
        ],
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_POST => true,
        CURLOPT_POSTFIELDS => json_encode($curl_post_data),
        CURLOPT_SSL_VERIFYPEER => false
    ]);

    $response = curl_exec($curl);
    curl_close($curl);

    return json_decode($response, true);
}

// Direct testing example
if (basename(__FILE__) == basename($_SERVER['SCRIPT_FILENAME'])) {
    header('Content-Type: application/json');
    $simulation = simulateC2BTransaction(10, '254712345678', 'INV001');
    echo json_encode($simulation);
}

