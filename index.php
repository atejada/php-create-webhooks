<?php
// Import your dependencies
require_once('vendor/autoload.php');

// Load env variables
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

// Define the headers
$headr = array();
$headr[] = 'Accept: application/json';
$headr[] = 'Content-type: application/json';
$headr[] = 'Authorization: Bearer ' . $_ENV['V3_TOKEN'];

// Array with information needed to create the webhook
$data = array(
            'description' => "My PHP Webhook",
            'trigger_types' => array("message.created"),
            'webhook_url' => "https://yourserver.koyeb.app/webhook",
            'notification_email_addresses' => array($_ENV['EMAIL'])
        );

// Call the webhooks endpoint
$ch = curl_init( "https://api.us.nylas.com/v3/webhooks" );
// Encode the data as JSON
$payload = json_encode( $data );
// Submit the Email information
curl_setopt( $ch, CURLOPT_POSTFIELDS, $payload );
// Submit the Headers
curl_setopt( $ch, CURLOPT_HTTPHEADER, $headr);
// We're doing a POST
curl_setopt($ch, CURLOPT_POST, true);
// Return response instead of printing.
curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
// Send request.
$result = curl_exec($ch);
echo $result;
// Close request
curl_close($ch);
?>
