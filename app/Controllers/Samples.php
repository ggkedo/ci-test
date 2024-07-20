<?php

namespace App\Controllers;
use \App\Views\StdView;
use \App\Views\SampleView;

class Samples extends BaseController
{
    public function Create()
    {
        $post = $this->request->getPost();
        $requestId = $post['RequestId'];
        
        if(isset($post['Name'])) //TODO: use better validation
        {
            //Register sample
            $data = json_encode($post);
            $model = model(\App\Models\API::class);            
            $result = $model->SaveRecord('Samples', $data);
            if(!$result->error)
            {
                return redirect()->to(base_url('requests/' . $requestId));
            }
        }
        else
        {
            //Show sample registration form
            $view = StdView::Begin('Add sample');
            $view .= SampleView::CreateForm($requestId);
        }      

        return $view;
    }

    public function Edit($id)
    {
        $model = model(\App\Models\API::class);
        $post = $this->request->getPost();

        if($post)
        {
            //Update
            $data = json_encode($post);
            $result = $model->UpdateRecord('Samples', $id, $data);
            //TODO: update validation
            //if($result->status == 200){}
            var_dump('Updated');
            $sample = $model->GetRecord('Samples', $id)->body->data[0];
            $form = SampleView::EditForm($sample, true);
        }
        else
        {
            $sample = $model->GetRecord('Samples', $id)->body->data[0];
            $form = SampleView::EditForm($sample);
        }        
            
        $view = StdView::Begin('Edit sample details for ' . $sample->Name);
        $view .= $form;
        $view .= StdView::End();

        return $view;
        //return redirect()->to(base_url('requests/edit/1')); 
    }
}