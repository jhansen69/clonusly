<?php

namespace Core;

class Authenticator
{
    public function attempt($email, $password)
    {
        // Use MeekroDB to query the users table
        $user = DB::queryFirstRow('SELECT * FROM users WHERE email = %s', $email);

        if ($user) {
            if (password_verify($password, $user['password'])) {
                $this->login([
                    'email' => $user['email']
                ]);

                return true;
            }
        }

        return false;
    }

    public function login($user)
    {
        $_SESSION['user'] = [
            'first' => $user['first_name'],
            'email' => $user['email']
        ];

        session_regenerate_id(true);
    }

    public function logout()
    {
        Session::destroy();
    }
}
