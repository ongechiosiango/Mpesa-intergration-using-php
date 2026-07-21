
<?php
require_once 'config.php';
require_once 'generate_token.php';

function initiateStkPush($phone, $amount, $reference = 'TestPay', $description = 'Payment') {
    $token = generateMpesaToken();
    if (!$token) {
        return ["error" => "Failed to generate access token."];
    }

    $url = BASE_URL . '/mpesa/stkpush/v1/processrequest';
    $timestamp = date('YmdHis');
    
    // Password generation formula: base64(ShortCode + PassKey + Timestamp)
    $password = base64_encode(SHORTCODE . PASSKEY . $timestamp);

    // Format phone number to international standard (2547XXXXXXXX)
    $phone = preg_replace('/^(07|01)/', '254$1', $phone);
    $phone = str_replace('07', '7', $phone);
    $phone = str_replace('01', '1', $phone);

    $curl_post_data = [
        'BusinessShortCode' => SHORTCODE,
        'Password'          => $password,
        'Timestamp'         => $timestamp,
        'TransactionType'   => 'CustomerPayBillOnline', // Use CustomerBuyGoodsOnline for Till numbers
        'Amount'            => $amount,
        'PartyA'            => $phone, // Phone sending money
        'PartyB'            => SHORTCODE, // Shortcode receiving money
        'PhoneNumber'       => $phone,
        'CallBackURL'       => CALLBACK_URL,
        'AccountReference'  => $reference,
        'TransactionDesc'   => $description
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

// Direct testing example (Change the phone number)
if (basename(__FILE__) == basename($_SERVER['SCRIPT_FILENAME'])) {
    header('Content-Type: application/json');
    $testResponse = initiateStkPush('254712345678', 1); // 1 Kes test payment
    echo json_encode($testResponse);
}
