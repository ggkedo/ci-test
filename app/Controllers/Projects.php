<?php
namespace App\Controllers;
use \App\Views\StdView;
use \App\Views\ProjectView;
use \App\Models\API;

class Projects extends BaseController
{
    public function List()
    {
        $model = model(API::class);
        $post = $this->request->getPost();
        if($post)
        {
            if(isset($post['del']))
            {
                //Delete project
                $model->DeleteRecord('Projects', $post['del']);
            }
        }

        $projects = $model->GetTable('Projects')->body->data;

        $view = StdView::Begin('Projects list');
        $view .= ProjectView::NewButton();
        $view .= ProjectView::List($projects);
        $view .= StdView::End();

        return $view;
    }

    public function Create()
    {
        $model = model(API::class);
        $post = $this->request->getPost();

        $success = false;
        $error = false;
        if($post)
        {
            $data = json_encode($post);
            $result = $model->SaveRecord('Projects', $data);
            if(!$result->error)
            {
                return redirect()->to(base_url('projects'));
            }
            else
            {
                $success = false;
                $error = 'Error';
            }
        }

        $view = StdView::Begin('Add new project');
        $view .= ProjectView::CreateForm($success, $error);
        $view .= StdView::End();
        
        return $view;
    }

    public function Edit($id)
    {
        $model = model(API::class);
        $post = $this->request->getPost();
        $success = false;
        $error = '';

        if($post)
        {
            //Update record
            $data = json_encode($post);
            $result = $model->UpdateRecord('Projects', $id, $data);
            if(!$result->error)
            {
                return redirect()->to(base_url('projects'));
            }
            else
            {
                $success = false;
                $error = 'Error: ' . $result->error;
            }
        }

        $project = $model->GetRecord('Projects', $id)->body->data[0];
        $view = StdView::Begin('Update project details');
        $view .= ProjectView::EditForm($project, $success, $error);
        $view .= StdView::End();

        return $view;
    }
}