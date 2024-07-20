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
       return redirect()->to(base_url('requests/edit/1'));
    }
}