<?php

namespace App\Interface;

interface AuthInterface
{
    public function login(string $username, string $password);
    public function logout();
}