<?php

namespace App\Controllers;
use \App\Views\StdView;
use \App\Views\RequestView;

class Requests extends BaseController
{
    public function List()
    {
        $view = StdView::Begin('Igénylések');
        $view .= RequestView::NewButton();

        $model = model(\App\Models\API::class);

        $requests = $model->testConnection();
        //var_dump($requests->body->data);
        $view .= RequestView::List($requests->body->data);
        return $view;
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
