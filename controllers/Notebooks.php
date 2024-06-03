<?php

use controllers\ControllerBase;
use models\Notebook;

class Notebooks extends ControllerBase
{
    public function show(){

        $notebooks_model= new Notebook();

        $this->render('show', compact('notebooks_model'));
    }

    public function add(){

        $notebooks_model= new Notebook();

        if($notebooks_model->validate()) {
            $notebooks_model->load();
        }

        $this->render('show', compact('notebooks_model'));

    }
}