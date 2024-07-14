<?php

namespace App\Views;

class RequestView
{
    public static function NewButton()
    {
        $url = base_url('requests/new');

        return '<a class="btn btn-primary mb-2" href="'
			. $url . '">'
			. '<i class="fa-solid fa-circle-plus"></i> Új igénylés létrehozása' 
			. '</a>';
    }

    public static function CreateForm($success = false, $error = null)
	{
		helper('form');
		$html = '';
		if($success) 
		{

			$html .= StdView::SuccessMessage('Igénylés sikeresen létrehozva!', 'Az adatok rögzítésre kerültek');
			StdView::$formAutoValues = false;
		}
		else if($error)
		{
			$html .= StdView::ErrorMessage('Hibásan kitöltve!', $error);
			//foreach($error as $e) { $html .= StdView::ErrorMessage('Hibásan kitöltve!', $e);}
		}

		
		$html .= form_open(base_url('requests/new'));
		
		$html .= StdView::FormInput('Igénylő', 'contact', 'text', 'Például: betabela@email.com');
		$html .= StdView::FormSelect('Projekt', 'status', ['Projekt 1'. 'Projekt 2'], 0);
        $html .= StdView::FormInput('Értesítési email', 'name', 'text', 'Például: alfaaladar@email.com; betabela@email.com', '');
		$html .= StdView::FormButton('Létrehozás', 'check');
		$html .= form_close();

		return $html;
	}

    public static function List($requests)
    {
        return view('templates/request-list', ['requests' => $requests]);
    }
}