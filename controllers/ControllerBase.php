<?php

namespace controllers;

class ControllerBase
{
    public function render($view, $parametrs=[]){

        extract($parametrs);

        require_once "{$_SERVER['DOCUMENT_ROOT']}/views/{$view}.php";

    }
}