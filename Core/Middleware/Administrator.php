<?php

namespace Core\Middleware;

class Administrator
{
    public function handle()
    {
        if (! $_SESSION['user'] ?? false) {
            abort(403);
        }
        //ok, now get the user id and look them up
        $user = \DB::queryFirstRow('SELECT * FROM users where email = %s',$_SESSION['user']['email']);
        if ($user) {
            if($user['is_admin']==0)
            {
                abort(403);
            } 
        } else { 
            abort(403);
        }
    }
}