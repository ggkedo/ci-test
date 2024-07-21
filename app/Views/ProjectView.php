<?php
namespace App\Views;
use \App\Views\StdView;

class ProjectView
{
    public static function NewButton()
    {
        $url = base_url('projects/new');

        return '<a class="btn btn-primary mb-2" href="'
			. $url . '">'
			. '<i class="fa-solid fa-circle-plus"></i> Add new project' 
			. '</a>';
    }

    public static function List($projects)
    {
        return view('templates/projects-list', ['projects' => $projects]);
    }

    public static function CreateForm($success = false, $error = null)
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

		
		$html .= form_open(base_url('projects/new'));
		
		$html .= StdView::FormInput('Project name', 'Name', 'text', '');
		$html .= StdView::FormInput('Company', 'Company', 'text', 'ACME');
		$html .= StdView::FormInput('Manager', 'ManagerEmail', 'email', 'manager@mail.com');
		$html .= StdView::FormInput('Group email', 'GroupEmail', 'email', 'group@mail.com');
        $html .= StdView::FormInput('Send notification emails by default', 'SendEmailByDefault', 'bool', true);
		$html .= StdView::FormButton('Create', 'plus');
		$html .= form_close();

		return $html;
	}

    public static function EditForm($project, $success = false, $error = null)
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

		
		$html .= form_open(base_url('projects/' . $project->ID));
		
		$html .= StdView::FormInput('Project name', 'Name', 'text', '', (string) $project->Name);
		$html .= StdView::FormInput('Company', 'Company', 'text', '', (string) $project->Company);
		$html .= StdView::FormInput('Manager', 'ManagerEmail', 'email', '', (string) $project->ManagerEmail);
		$html .= StdView::FormInput('Group email', 'GroupEmail', 'email', '', (string) $project->GroupEmail);
        $html .= StdView::FormInput('Send notification emails by default', 'SendEmailByDefault', 'bool', (bool) $project->SendEmailByDefault);
		$html .= StdView::FormButton('Update', 'check');
		$html .= form_close();

		return $html;
	}
}