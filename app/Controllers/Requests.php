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
        $params = 
        [
            'table1' => 'Requests',
            'table2' => 'Projects',
            'key1' => 'ProjectId',
            'key2' => 'ID',
            'fields2' => 'Name' 
        ];
        $requests = $model->GetTablesJoined($params);

        $post = $this->request->getPost();
        if(isset($post['del']))
        {
            $id = $post['del'];
            $result = $model->DeleteRecord('Requests', $id);
            $view .= StdView::AlertMessage('success', 'Request deleted', 'Request no. ' . $id . ' has been succesfully deleted', true);
        }

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
        $post = $this->request->getPost();
        $alert = '';
        $success = false;
        $error = '';

        if($post)
        {
            //Update request details
            $data = json_encode($post);
            $result = $model->UpdateRecord('Requests', $id, $data);
            if(!$result->error)
            {
                return redirect()->to(base_url('requests/' . $id));    
            }
            else
            {
                $error = $result->error;
            }
        }

        $request = $model->GetRecord('Requests', $id)->body->data[0];
        $projectList = $model->GetProjectListAsArray();

        $view = StdView::Begin('Edit request #' . $id); 
        $view .= $alert;       
        $view .= RequestView::EditForm($request, $projectList, $success, $error);
        $view .= StdView::End();

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
        $view .= RequestView::EditButton($id);
        $view .= StdView::SectionDivider();
        $view .= SampleView::NewPostButton($id);
        $view .= SampleView::List($id, $samples);
        
        return $view;
    }
}
