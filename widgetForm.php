<?php

class widgetForm
{
    public static function input($model, $attribute)
    {
        $error_text=empty($model->errors) ? '' :$model->errors["{$attribute}"] ;

        return <<<HTML
                <div>
                 <br/><label for="{$attribute}">{$attribute}</label>
                <input type="{$attribute}" id="{$attribute}" name="{$attribute}">
                <div class="help-block">{$error_text}</div>
                </div> 
                HTML;
    }

    public static function file($model, $attribute){
        $error_text=empty($model->errors) ? '' :$model->errors["{$attribute}"] ;

        return <<<HTML
                <div>
                 <br/><label for="{$attribute}">{$attribute}</label>
                <input type="file" id="{$attribute}" name="foto">
                <div class="help-block">{$error_text}</div>
                </div> 
                HTML;
    }
}