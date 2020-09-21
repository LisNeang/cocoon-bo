<?php

namespace App\Controllers;


class UserController extends CoreController
{
    public function login()
    {
        $this->show('user/login', []);
    }

}
