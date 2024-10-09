<?php

use Core\Authenticator;
use Core\Validator;
use Core\ValidationException;

$errors = [];
$email = $_POST['email'] ?? "";
$password = $_POST['password'] ?? "";

if (!Validator::email($email)) {
   $errors['email'] = 'Please provide a valid email address.';
}

if (!Validator::string($password)) {
    $errors['password'] = 'Please provide a valid password.';
}

$signedIn = (new Authenticator)->attempt($email, $password);

if (!$signedIn) {
    $errors['login']='No matching account found for that email address and password.';
    ValidationException::throw($errors, ['email'=>$email,'password'=>$password]);
}

redirect('/');