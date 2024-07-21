<?php

namespace App\Views;

class RequestView
{
    public static function NewButton()
    {
        $url = base_url('requests/new');

        return '<a class="btn btn-primary mb-2" href="'
			. $url . '">'
			. '<i class="fa-solid fa-circle-plus"></i> Create new request' 
			. '</a>';
    }

	public static function EditButton($id)
    {
        $url = base_url('requests/edit/' . $id);

        return '<a class="btn btn-primary mb-2" href="'
			. $url . '">'
			. '<i class="fa-solid fa-pen"></i> Edit' 
			. '</a>';
    }

    public static function CreateForm($projects, $success = false, $error = null)
	{
		helper('form');
		$html = '';
		if($success) 
		{

			$html .= StdView::SuccessMessage('Request successfully created', 'Your data has been saved.');
			StdView::$formAutoValues = false;
		}
		else if($error)
		{
			$html .= StdView::ErrorMessage('The form has been filled incorrectly!', $error);
		}

		
		$html .= form_open(base_url('requests/new'));
		
		$html .= StdView::FormInput('Requestor', 'RequestorEmail', 'email', 'betabela@email.com');
		$html .= StdView::FormInput('Status', 'Status', 'text', 'New');
		$html .= StdView::FormSelect('Project', 'ProjectId', $projects, $projects[array_key_first($projects)]);
        $html .= StdView::FormInput('Notification emails', 'EmailNotify', 'text', 'Például: alfaaladar@email.com; betabela@email.com', '');
		$html .= StdView::FormInput('Created', 'Created', 'date', '');
		$html .= StdView::FormButton('Create', 'check');
		$html .= form_close();

		return $html;
	}

	public static function EditForm($request, $projects, $success = false, $error = null)
	{
		helper('form');
		$html = '';
		if($success) 
		{

			$html .= StdView::SuccessMessage('Request successfully created', 'Your data has been saved.');
			StdView::$formAutoValues = false;
		}
		else if($error)
		{
			$html .= StdView::ErrorMessage('The form has been filled incorrectly!', $error);
		}
		
		$html .= form_open(base_url('requests/' . $request->ID));
		
		$html .= StdView::FormInput('Requestor', 'RequestorEmail', 'email', 'betabela@email.com', $request->RequestorEmail);
		$html .= StdView::FormInput('Status', 'Status', 'text', 'New', $request->Status);
		$html .= StdView::FormSelect('Project', 'ProjectId', $projects, $request->ProjectId, $request->ProjectId);
        $html .= StdView::FormInput('Notification emails', 'EmailNotify', 'text', 'Például: alfaaladar@email.com; betabela@email.com', $request->EmailNotify);
		$html .= StdView::FormButton('Update', 'check');
		$html .= form_close();

		return $html;
	}

	public static function ShowDetails($request)
	{
		helper('form');
		
		$html = '';
		$html .= form_open(base_url('requests/edit'), 'inert');		
		$html .= StdView::FormInput('Requestor', 'RequestorEmail', 'email', '', $request->RequestorEmail);
		$html .= StdView::FormInput('Status', 'Status', 'text', '', $request->Status);
		$html .= StdView::FormInput('Project', 'ProjectId', 'text', '', $request->ProjectId);
        $html .= StdView::FormInput('Notification emails', 'EmailNotify', 'text', '', $request->EmailNotify);
		$html .= form_close();

		return $html;
	}

    public static function List($requests)
    {
        return view('templates/request-list', ['requests' => $requests]);
    }
}