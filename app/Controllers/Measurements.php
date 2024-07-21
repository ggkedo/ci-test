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
        $model = model(\App\Models\API::class);
        $post = $this->request->getPost();
        $alert = '';
        if($post)
        {
            //Update measurement details
            $data = json_encode($post);
            $result = $model->UpdateRecord('Measurements', $id, $data);

            if(!$result->error)
            {
                return redirect()->to(base_url('samples/' . $post['SampleId']));
            }
            else
            {
                $alert = StdView::AlertMessage('danger', 'Update failed', 'Measurement details were not updated', true);
            }            
        }

        $measurement = $model->GetRecord('Measurements', $id)->body->data[0];
        $methodList = $model->GetMethodListAsArray();


        $view = StdView::Begin('Edit measurement details');
        $view .= $alert;
        $view .= MeasurementView::EditForm($measurement, $methodList);
        $view .= StdView::End();

        return $view;
    }
}