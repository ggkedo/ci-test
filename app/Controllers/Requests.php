<?php

namespace App\Controllers;
use \App\Views\StdView;
use \App\Views\RequestView;

class Requests extends BaseController
{
    public function list()
    {
        $view = StdView::Begint('Igénylések');
        $view .= RequestView::NewButton();

        $model = model(\App\Models\API::class);

        $requests = $model->testConnection();
        $view .= RequestView::List($requests);
    }

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
