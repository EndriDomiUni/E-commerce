<?php

class SellerController implements CurrentUser
{

    public function login()
    {
    }

    public function signup()
    {
    }

    public function logout()
    {
        session_start();
        session_destroy();

        header("Location: index.php");
    }
}
