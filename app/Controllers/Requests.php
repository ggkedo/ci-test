<?php

namespace App\Controllers;
use \App\Views\StdView;
use \App\Views\RequestView;
use \App\Views\SampleView;

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
        $projectList = $model->GetProjectListAsArray();

        $view = StdView::Begin('New request');
        $view .= RequestView::CreateForm($projectList);

        return $view;   
    }

    public function Edit($id=null)
    {
        $model = model(\App\Models\API::class);
        $post = $this->request->getPost();
        if($post)
        {
            $data = json_encode($post);
            $result = $model->SaveRecord("Requests", $data);
            if(!$result->error)
            {
                $id = $result->body->inserted;
            }
            else
            {
                //error inserting record
            }
        }

        $filter = json_encode(['RequestID' => $id]);
        $samples = $model->GetTable('Samples', $filter)->body->data;
        $request = $model->GetRecord('Requests', $id);
        //var_dump($samples);
        $view = StdView::Begin('Edit request #' . $id);
        $view .= RequestView::ShowDetails($request->body->data[0]);
        $view .= SampleView::List($samples);

        return $view;
    }

    public function GetRequestById($id)
    {
        $api = model(\App\Models\API::class);
    }
}
