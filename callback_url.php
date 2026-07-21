
<?php
// Safaricom delivers data asynchronously via POST raw JSON payload.
// Standard $_POST will be empty! We must read the raw input stream.

header("Content-Type: application/json");

// Read the raw JSON input data stream
$callbackData = file_get_contents('php://input');

// Log the response to a file locally so beginners can inspect the payload structure
$logFile = "MpesaResponse.json";
$log = fopen($logFile, "a");
fwrite($log, $callbackData . PHP_EOL);
fclose($log);

// Decode data to process into a local database system
$data = json_decode($callbackData, true);

if (isset($data['Body']['stkCallback'])) {
    $resultCode = $data['Body']['stkCallback']['ResultCode'];
    $resultDesc = $data['Body']['stkCallback']['ResultDesc'];
    $merchantRequestID = $data['Body']['stkCallback']['MerchantRequestID'];
    $checkoutRequestID = $data['Body']['stkCallback']['CheckoutRequestID'];

    if ($resultCode == 0) {
        // Transaction Successful! Extract metadata parameters
        $callbackMetadata = $data['Body']['stkCallback']['CallbackMetadata']['Item'];
        
        $amount = null;
        $mpesaReceiptNumber = null;
        $transactionDate = null;
        $phoneNumber = null;

        foreach ($callbackMetadata as $item) {
            if ($item['Name'] === 'Amount') $amount = $item['Value'];
            if ($item['Name'] === 'MpesaReceiptNumber') $mpesaReceiptNumber = $item['Value'];
            if ($item['Name'] === 'TransactionDate') $transactionDate = $item['Value'];
            if ($item['Name'] === 'PhoneNumber') $phoneNumber = $item['Value'];
        }

        // TODO: Run your SQL DB update query here using $mpesaReceiptNumber to clear invoices.
    }
}

// Acknowledge receipt back to Safaricom servers
echo json_encode(["ResultCode" => 0, "ResultDesc" => "Accepted"]);
