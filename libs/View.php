<?php

/**
* View
*/

class View
{

	function __construct()
	{

	}

	public function render($name, $noInclude = false)
	{
		require 'app/'.$name.'.php';
	}

    public function getStatus($status)
    {
        if ($status == 1) {
            return '<span class="label label-primary">Ativo</span>';
        }else{
            return '<span class="label label-danger">Inativo</span>';
        }
    }
}