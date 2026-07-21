<?php
// Simple environment variable helper for beginners
function getEnvVar($key, $default = null) {
    // If using a library like vlucas/phpdotenv later, it integrates cleanly here
    return $_ENV[$key] ?? getenv($key) ?? $default;
}

// Hardcode variables here manually if not using a system environment manager
define('MPESA_ENV', 'sandbox'); 
define('CONSUMER_KEY', 'YOUR_ACTUAL_CONSUMER_KEY');
define('CONSUMER_SECRET', 'YOUR_ACTUAL_CONSUMER_SECRET');
define('SHORTCODE', '174379');
define('PASSKEY', 'bfb279f9aa9bdbcf158e97dd71a467cd2e0c893059b10f78e6b72ada1ed2c919');
define('CALLBACK_URL', 'https://ngrok-free.app');

// API Base URLs
define('BASE_URL', MPESA_ENV === 'sandbox' 
    ? 'https://safaricom.co.ke' 
    : 'https://safaricom.co.ke'
);

