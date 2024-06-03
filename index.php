<?php

error_reporting(E_ALL);
ini_set('display_errors', 0);
ini_set('log_errors', 'on');
ini_set('error_log', __DIR__ . '/errors.log');



$request = $_SERVER['REQUEST_URI'];
$request=explode("/", $request);
spl_autoload_register(function ($class){

    $class=str_replace('\\', DIRECTORY_SEPARATOR, $class);


    $path=__DIR__."\\{$class}.php";

    if(is_readable($path)){
        require $path;
    }else{
        echo "{$path}";
    }

});


if(file_exists(__DIR__."/controllers/$request[1].php")){

    require_once __DIR__."/controllers/$request[1].php";
    $cont=new $request[1]();

    if($_SERVER["REQUEST_METHOD"]=="GET"){
        $cont->show($request[2]);
    }elseif ($_SERVER["REQUEST_METHOD"]=="POST"){
        $cont->add($request[2]);
    }elseif ($_SERVER["REQUEST_METHOD"]=="DELETE"){
        $cont->remove($request[2]);
    }

}else{
    echo 'error';
}
