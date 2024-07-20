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

        $model = model(\App\Models\API::class);

        $post = $this->request->getPost();
        if(isset($post['del']))
        {
            $id = $post['del'];
            $result = $model->DeleteRecord('Requests', $id);
            $view .= StdView::AlertMessage('success', 'Request deleted', 'Request no. ' . $id . ' has been succesfully deleted', true);
            //var_dump($result);
        }
        $requests = $model->GetTable('Requests');

        $view .= RequestView::NewButton();
        $view .= RequestView::List($requests->body->data);
        return $view;
    }

    public function Create()
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
                return redirect()->to(base_url('requests/' . $id));
            }
            else
            {
                //error inserting record
            }
        }
        else
        {
            $projectList = $model->GetProjectListAsArray();
            $view = StdView::Begin('New request');
            $view .= RequestView::CreateForm($projectList);

            return $view;   
        }    
        
    }

    public function Edit($id)
    {
        $model = model(\App\Models\API::class);

        $filter = json_encode(['RequestID' => $id]);
        $samples = $model->GetTable('Samples', $filter)->body->data;
        $request = $model->GetRecord('Requests', $id)->body->data[0];
        
        $view = StdView::Begin('Edit request #' . $id);
        var_dump('Edit form...');
        //$view .= RequestView::ShowDetails($request);
        //$view .= SampleView::NewPostButton($id);
        //$view .= SampleView::List($id, $samples);

        return $view;
    }

    public function GetRequestById($id)
    {
        $model = model(\App\Models\API::class);
        $post = $this->request->getPost();
        if(isset($post['del']))
        {
            //Sample deletion request
            $model->deleteRecord('Samples', $post['del']);
        }

        $filter = json_encode(['RequestId' => $id]);
        $samples = $model->GetTable('Samples', $filter)->body->data;
        $request = $model->GetRecord('Requests', $id)->body->data[0];
        
        $view = StdView::Begin('Request #' . $id . ' details');
        $view .= RequestView::ShowDetails($request);
        $view .= SampleView::NewPostButton($id);
        $view .= SampleView::List($id, $samples);
        
        return $view;
    }
}
