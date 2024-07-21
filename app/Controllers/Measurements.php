<?php
namespace App\Controllers;
use \App\Views\StdView;
use \App\Views\RequestView;
use \App\Views\SampleView;
use \App\Views\MeasurementView;

class Measurements extends BaseController
{
    public function Create()
    {
        $model = model(\App\Models\API::class);
        $post = $this->request->getPost();
        
        if(isset($post['SampleId']))
        {
            $sampleId = $post['SampleId'];
            if(isset($post['MethodId']))
            {
                //$methodId = $post['MethodId'];
                //Register measurement
                $data = json_encode($post);
                $model = model(\App\Models\API::class);            
                $result = $model->SaveRecord('Measurements', $data);
                if(!$result->error)
                {
                    return redirect()->to(base_url('samples/' . $sampleId));
                }
            }
            else
            {
                //Show measurement registration form
                $methodList = $model->GetMethodListAsArray();
                $view = StdView::Begin('Add measurement');
                $view .= MeasurementView::CreateForm($methodList, $post['SampleId']);
                $view .= StdView::End();

                return $view;
            }
        }
        else
        {
            //TODO: error handling (?) - shouldn't happen programatically though
        }
    }

    public function Edit($id)
    {

    }
}