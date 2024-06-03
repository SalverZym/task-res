<?php

use controllers\ControllerBase;
use models\Notebook;

class Write extends ControllerBase
{
    private $notebooks;
    private $notebook;

    public function __construct()
    {
        $this->notebooks=new Notebook();
    }

    public function show($id)
    {

        $notebook=$this->notebooks->findOne($id);

        $this->render('notebook', compact('notebook'));
    }

    public function add($id)
    {
        $this->notebooks->change($id);

        header("Location: http://task-res/write/92c5ef32");
    }

    public function remove($id)
    {
        $this->notebooks->delete($id);

        header("Location: http://task-res/write/92c5ef32");
    }
}