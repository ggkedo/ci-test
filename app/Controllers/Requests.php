<?php

namespace App\Controllers;
use \App\Views\StdView;
use \App\Views\RequestView;

class Requests extends BaseController
{
    public function List()
    {
        $view = StdView::Begin('Requests');
        $view .= RequestView::NewButton();

        $model = model(\App\Models\API::class);
        $requests = $model->GetTable('Requests');

        $view .= RequestView::List($requests->body->data);
        return $view;
    }

    public function Create()
    {
        $model = model(\App\Models\API::class);

        $post = $this->request->getPost();
        if($post)
        {
            $model = model(\App\Models\API::class);
            $data = json_encode($post);
            var_dump($data);
            $inserted = $model->SaveRecord("Requests", $data);
            var_dump($inserted);

            //return $view;
        }

        $projectList = $model->GetProjectListAsArray();

        $view = StdView::Begin('New request');
        $view .= RequestView::CreateForm($projectList);

        return $view;
    }

    public function GetRequestById($id)
    {
        $api = new \App\Models\API;
        var_dump($api->CallAPI("POST", "localhost:3000/list-table", "table=Requests"));
    }
}
