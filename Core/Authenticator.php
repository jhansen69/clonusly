<?php

namespace Core;

class Authenticator
{
    public function attempt($email, $password)
    {
        // Use MeekroDB to query the users table
        $user = \DB::queryFirstRow('SELECT * FROM users WHERE email = %s', $email);

        if ($user) {
            if (password_verify($password, $user['password'])) {
                
                //ok, we have a valid user, lets see if they have $_POST['remember'] selected.
                if($_POST['remember']==1)
                {
                    //lets generate and store a remember token on the user
                    $rememberToken = generateUUID();
                    \DB::update('users', ['remember_token' => $rememberToken ],['email'=>$email]);
                    setcookie('Clonusly-Remember', $rememberToken, time() + (3600*24*365), "/");
                }
                
                $this->login($user);

                return true;
            }
        }

        return false;
    }

    public function login($user)
    {
        $_SESSION['user'] = ['id'=>$user['id'],'first_name' => $user['first_name'],'email' => $user['email'],'admin'=>$user['is_admin']];

        session_regenerate_id(true);
    }

    public function logout()
    {
        Session::destroy();
    }
}