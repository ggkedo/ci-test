<?php
namespace App\Views;

class MeasurementView
{
    public static function NewButton()
    {
        $url = base_url('measurements/new');

        return '<a class="btn btn-primary mb-2" href="'
			. $url . '">'
			. '<i class="fa-solid fa-circle-plus"></i> Add new sample' 
			. '</a>';
    }

    public static function NewPostButton($id)
    {
        helper('form');
     
        $html =  form_open(base_url('measurements/new'));
        $html .= form_hidden('SampleId', $id);
        $html .= StdView::FormButton('Add Measurement', 'plus');
        $html .= form_close();

        return $html;
    }

    public static function List($sampleId, $measurements)
    {
        return view('templates/measurements-list', ['id' => $sampleId, 'measurements' => $measurements]);
    }

    public static function CreateForm($methods, $sampleId, $success = false, $error = null)
	{
		helper('form');
		$html = '';
		if($success) 
		{

			$html .= StdView::SuccessMessage('Sample successfully created', 'Your data has been saved.');
			StdView::$formAutoValues = false;
		}
		else if($error)
		{
			$html .= StdView::ErrorMessage('The form has been filled incorrectly!', $error);
		}

		
		$html .= form_open(base_url('measurements/new'));
		
        $html .= form_hidden('SampleId', $sampleId);
		$html .= StdView::FormSelect('Measurement type', 'MethodId', $methods, $methods[array_key_first($methods)]);
	    $html .= StdView::FormButton('Create', 'check');
		$html .= form_close();

		return $html;
	}

    public static function EditForm($sample, $success=false, $error=null)
	{
		helper('form');
        $html = '';

        if($success) 
		{

			$html .= StdView::SuccessMessage('Sample successfully updated', 'Your data has been saved.');
			StdView::$formAutoValues = false;
		}
		else if($error)
		{
			$html .= StdView::ErrorMessage('The form has been filled incorrectly!', $error);
		}

		$html .= form_open(base_url('samples/' . $sample->ID));		
        $html .= form_hidden('RequestId', (string) $sample->RequestId);
		$html .= StdView::FormInput('Sample name', 'Name', 'text', '', $sample->Name);
		$html .= StdView::FormInput('Sampling date', 'SampleDate', 'date', '', \App\Models\API::GetDateAsString($sample->SampleDate));
        $html .= StdView::FormInput('Sample location', 'SampleLocation', 'text', '', $sample->SampleLocation);
        $html .= StdView::FormInput('Sample sublocation', 'SampleSubLocation', 'text', '', $sample->SampleSubLocation);
		$html .= StdView::FormButton('Edit', 'check');
		$html .= form_close();

		return $html;
	}    
}