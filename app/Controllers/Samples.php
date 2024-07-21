<?php

namespace App\Controllers;
use \App\Views\StdView;
use \App\Views\SampleView;
use \App\Views\MeasurementView;

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
        $alert = '';
        $sampleUpdateSuccessful = false;

        if($post)
        {
            if(isset($post['del']))
            {
                //Delete measurement
                $MeasurementId = $post['del'];
                $result = $model->DeleteRecord('Measurements', $MeasurementId);
                $alert .= StdView::AlertMessage('success', 'Measurement deleted', 'Measurement no. ' . $MeasurementId . ' has been succesfully deleted', true);
            }
            else
            {
                //Update sample details
                $data = json_encode($post);
                $result = $model->UpdateRecord('Samples', $id, $data);
                //TODO: update validation
                //if($result->status == 200){}
                $sampleUpdateSuccessful = true;
            }
            
        }
        
        $sample = $model->GetRecord('Samples', $id)->body->data[0];
        $filter = json_encode(['SampleId' => $id]);
        $measurements = $model->GetTable('Measurements', $filter)->body->data;

        $view = StdView::Begin('Edit sample details for ' . $sample->Name);
        $view .= $alert;
        $view .= SampleView::EditForm($sample, $sampleUpdateSuccessful);
        $view .= MeasurementView::NewPostButton($id);
        $view .= MeasurementView::List($id, $measurements);
        $view .= StdView::End();

        return $view;
        //return redirect()->to(base_url('requests/edit/1')); 
    }
}