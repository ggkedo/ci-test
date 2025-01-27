<?php

namespace App\Views;

class StdView 
{
	public static function Begin($title)
	{
		return view('templates/begin', ['title' => $title]);
	}
	
	public static function End()
	{
		return view('templates/end');
	}
	
	public static function SectionDivider()
	{
		$html = '</section><section class="p-4 bg-white border shadow mb-4">';
		return $html;
	}

	public static function ErrorMessage($title, $text)
	{
		$html = '<p class="alert alert-danger"><strong>'.$title.'</strong> '. $text .'</p>';
		return $html;
	}
	
	public static function SuccessMessage($title, $text)
	{
		$html = '<p class="alert alert-success"><strong>'.$title.'</strong> '. $text .'</p>';
		return $html;
	}

	public static function AlertMessage($type, $title, $text, $dismissible=false)
	{
		if($dismissible)
		{
			$html = '<div class="alert alert-' . $type . ' alert-dismissible fade show" role="alert">
						<strong>' . $title . '</strong> ' . $text . '
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>';
		}
		else
		{
			$html = '<p class="alert alert-' . $type . '"><strong>'.$title.'</strong> '. $text .'</p>';
		}
		
		return $html;
	}
	
	public static function FormInput($label, $name, $type='text', $placeholder='', $value='')
	{
		$html = '<div class="form-group mb-3">';
		$html .= form_label($label, $name) .
				form_input($name, self::SetValue($name, $value), ['id' => $name, 'class' => 'form-control', 'placeholder' => $placeholder], $type);
		$html .= '</div>';
		return $html;
	}
	
	public static function FormSelect($label, $name, $options, $value=0)
	{
		$html = '<div class="form-group mb-3">';
		$html .= form_label($label, $name) .
				form_dropdown($name, $options, self::SetValue($name, $value), ['id' => $name, 'class' => 'form-control']);		
		$html .= '</div>';
		return $html;
	}
	
	public static function FormButton($label, $icon='')
	{
		if($icon)
		{
			$label = '<i class="fa-solid fa-' . $icon . '"></i> ' . $label;
		}
		
		return form_button(['type' => 'submit', 'class' => 'btn btn-primary'], $label);
	}

	private static function SetValue($name, $value)
	{
		if(self::$formAutoValues)
		{
			return set_value($name, $value);
		}
		else
		{
			return $value;
		}
	}
	
	public static $formAutoValues = true;
}