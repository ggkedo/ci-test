<?php

namespace App\Views;

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

    public static function List($samples)
    {
        return view('templates/samples-list', ['samples' => $samples]);
    }
}