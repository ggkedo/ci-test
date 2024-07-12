<?php

namespace App\Controllers;

class Requests extends BaseController
{
    public function index(): string
    {
        return view('HelloWorld');
    }

    public function GetRequestById($id)
    {
        $api = new \App\Models\API;
        var_dump($api->CallAPI("POST", "localhost:3000/list-table", "table=Requests"));
    }
}
