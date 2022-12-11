<?php

interface CurrentUser
{
    /**
     * Login
     */
    public function login();

    /**
     * Sign up
     */
    public function signup();

    /**
     * Logout
     */
    public function logout();
}
