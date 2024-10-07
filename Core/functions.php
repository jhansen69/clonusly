<?php

use Core\Response;

// Import the SendGrid classes
use SendGrid\Mail\Mail; 

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