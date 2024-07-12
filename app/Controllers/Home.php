<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index(): string
    {
        $api = new \App\Models\API;
        var_dump($api->testConnection());
        return view('HelloWorld');
    }
}
