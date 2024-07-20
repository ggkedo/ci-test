<?php
namespace App\Views;
use \App\Views\StdView;

class SampleView
{
    public static function NewButton()
    {
        $url = base_url('samples/new');

        return '<a class="btn btn-primary mb-2" href="'
			. $url . '">'
			. '<i class="fa-solid fa-circle-plus"></i> Add new sample' 
			. '</a>';
    }

    public static function NewPostButton($id)
    {
        helper('form');
     
        $html =  form_open(base_url('samples/new'));
        $html .= form_hidden('RequestId', $id);
        $html .= StdView::FormButton('Add Sample', 'check');
        $html .= form_close();

        return $html;
    }

    public static function List($requestId, $samples)
    {
        return view('templates/samples-list', ['id' => $requestId, 'samples' => $samples]);
    }

    public static function CreateForm($requestId, $success = false, $error = null)
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

		
		$html .= form_open(base_url('samples/new'));
		
        $html .= form_hidden('RequestId', $requestId);
		$html .= StdView::FormInput('Sample name', 'Name', 'text', '');
		$html .= StdView::FormInput('Sampling date', 'SampleDate', 'date', '');
        $html .= StdView::FormInput('Sample location', 'SampleLocation', 'text', '', '');
        $html .= StdView::FormInput('Sample sublocation', 'SampleSubLocation', 'text', '', '');
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