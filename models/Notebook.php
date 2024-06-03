<?php

namespace models;

use models\ModelBase;

class Notebook extends ModelBase
{
    public $rules=[
        [['name', 'telefon', 'email'], 'required'],
        ['company', 'str', 'min'=>5],
        ['email', 'email'],
        ['telefon', 'telefon']
    ];
    protected $table='notebooks';

}