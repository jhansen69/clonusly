<?php

use Core\App;
use Core\Authenticator;
use Core\Validator;
$user = [];
$errors = [];
$firstName = $_POST['first'];
$lastName = $_POST['last'];
$email = $_POST['email'];
$password = $_POST['password'];


if (!Validator::string($firstName, 1, 255)) {
    $errors['first'] = 'Please provide a first name of at least one character.';
}if (!Validator::string($lastName, 1, 255)) {
    $errors['last'] = 'Please provide a last name of at least one character.';
}
if (!Validator::email($email)) {
   $errors['email'] = 'Please provide a valid email address.';
}
if (!Validator::string($password, 7, 255)) {
    $errors['password'] = 'Please provide a password of at least seven characters.';
}
if (!empty($errors)) {
    return view('registration/create.view.php', [
        'errors' => $errors
    ]);
}
$user = DB::query('SELECT * FROM users where email = %s',$email);
if ($user) {
    header('location: /');
    exit();
} else {
    $user = [
        'first_name'=>$firstName,
        'last_name'=>$lastName,
        'email'=>$email,
        'password'=>password_hash($password, PASSWORD_BCRYPT)
    ];
    try {
        DB::insert('users', [
            'first_name' => $user['first_name'],
            'last_name' => $user['last_name'],
            'email' => $user['email'],
            'is_admin' => 0,
            'password' => $user['password']
          ]);
        $user['id'] = DB::insertId();
    } catch (MeekroDBException $e) {
        $errors['database']="There was a problem saving the account. ".$e->getMessage();
        return view('registration/create.view.php', [
            'errors' => $errors
        ]);
    }
    
   
    (new Authenticator)->login($user);

    header('location: /');
    exit();
}