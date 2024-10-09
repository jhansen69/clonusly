<?php

use Core\Response;

// Import the SendGrid classes
use SendGrid\Mail\Mail; 


function generateUUID($data = null) {
    // Generate 16 bytes (128 bits) of random data or use the data passed into the function.
    $data = $data ?? random_bytes(16);
    assert(strlen($data) == 16);

    // Set version to 0100
    $data[6] = chr(ord($data[6]) & 0x0f | 0x40);
    // Set bits 6-7 to 10
    $data[8] = chr(ord($data[8]) & 0x3f | 0x80);

    // Output the 36 character UUID.
    return vsprintf('%s%s-%s-%s-%s-%s%s%s', str_split(bin2hex($data), 4));
}

/*
* Posting to slack
*/
function postToSlackChannel($channel, $message) {
    $token = $_ENV['SLACK_BOT_TOKEN'];
    $url = 'https://slack.com/api/chat.postMessage';
    
    $data = [
        'channel' => $channel,
        'text' => $message
    ];
    
    $headers = [
        'Content-Type: application/json; charset=utf-8',
        'Authorization: Bearer ' . $token
    ];
    
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    
    $response = curl_exec($ch);
    curl_close($ch);
    
    return json_decode($response);

    // Usage
$userName = $_SESSION['user']['first_name'] ?? "Guest";
//$response = postToSlackChannel('#social', "Hello, Slack! This is a test message from Clonusly and $userName.");
}

function dd($value)
{
    echo "<pre>";
    var_dump($value);
    echo "</pre>";

    die();
}

function urlIs($value)
{
    return $_SERVER['REQUEST_URI'] === $value;
}

function abort($code = 404)
{
    http_response_code($code);

    require base_path("views/{$code}.php");

    die();
}

function findOrFail($query, ...$params) {
    $result = DB::queryFirstRow($query, ...$params);
    
    if (!$result) {
        abort(); // Calls the abort function to show an error page
    }
    
    return $result;
}

function authorize($condition, $status = Response::FORBIDDEN)
{
    if (! $condition) {
        abort($status);
    }

    return true;
}

function base_path($path)
{
    return BASE_PATH . $path;
}

function view($path, $attributes = [])
{
    extract($attributes);

    require base_path('views/' . $path);
}

function redirect($path)
{
    header("location: {$path}");
    exit();
}

function old($key, $default = '')
{
    return Core\Session::get('old')[$key] ?? $default;
}

function sendEmail($toEmail, $toName, $subject, $htmlContent) {
    $email = new Mail(); // Create a new Mail object
    $email->setFrom("no-reply@rongolianlabs.com", "Rongolian Labs"); // Set the sender's email and name
    $email->setSubject($subject); // Set the email subject
    $email->addTo($toEmail, $toName); // Add the recipient's email and name
    $email->addContent("text/html", $htmlContent); // Add the HTML content of the email
    $email->addContent("text/plain", strip_tags($htmlContent)); // Optional: add plain text content

    $sendgrid = new \SendGrid($_ENV['SENDGRID_API_KEY']); // Replace with your SendGrid API key

    try {
        $response = $sendgrid->send($email);
        echo 'Email sent! Status code: ' . $response->statusCode();
    } catch (Exception $e) {
        echo 'Caught exception: '. $e->getMessage() ."\n";
    }
}