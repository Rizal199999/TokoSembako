<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function test(): string
    {
        return view('dashboard');
    }
}