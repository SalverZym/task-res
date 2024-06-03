<?php

namespace models;

class ModelBase
{
    public $data_base;
    public $errors=[];
    public $rules;
    protected $table;

    public function __construct()
    {
        $this->data_base=new \mysqli('localhost', 'root', '', 'notebooks');

    }

    public function validate(){
        foreach ($this->rules as $k=>$v){
            if(is_array($v[0])){
                foreach ($v[0] as $key=>$val){
                    $this->checkValidate($v, $this->table, $val);
                }
            }else{
                $this->checkValidate($v, $this->table, $v[0]);
            }
        }
        if(empty($this->errors)){
            return true;
        }else{
            return false;

        }
    }

    private function checkValidate($v, $table, $val){
        if(count($v)>2){
            $this->{$v[1]}($table, $val, array_slice($v, 2));
        }else {
            $this->{$v[1]}($table, $val);
        }
    }

    private function str($table, $val, $params=null){

        if(!is_string($val)){
            $this->errors["{$val}"]="Должна быть строкой";
            return null;
        }

        if($params){
            if(array_key_exists('min', $params)){
                if(strlen($_POST["{$val}"])< $params['min']){
                    $this->errors["{$val}"]="Минимум {$params['min']} символов";
                    return null;
                }
            }elseif(array_key_exists('max', $params)){
                if(strlen($_POST["{$val}"])>$params['min']){
                    $this->errors["{$val}"]="Максимум {$params['min']} символов";
                    return null;
                }
            }
        }
    }

    public function load(){

        $query="INSERT INTO {$this->table}";

        $rows=" (";
        $values=" (";

        foreach ($_POST as $k=> $v){
            $rows.=" {$k},";
            $values.=" '".$v."',";
        }

        if(isset($_FILES['foto'])){

            $uploaddir = "{{$_SERVER['DOCUMENT_ROOT']}/files";
            $uploadfile = $uploaddir . basename($_FILES['foto']['name']);

            if (move_uploaded_file($_FILES['foto']['tmp_name'], $uploadfile)) {
                echo "Файл корректен и был успешно загружен.\n";

                $rows.=" foto,";
                $values.=" '".$_FILES['foto']['tmp_name']."',";
            } else {
                echo "Возможная атака с помощью файловой загрузки!\n";
            }

        }

        $rows.=" id) ";
        $values.=" '".substr(md5(uniqid(rand(), true)), 0, 8)."') ";

        $this->data_base->query($query.$rows."VALUES".$values);

    }

    private function email($table, $val){
        if(!(filter_var($_POST["{$val}"], FILTER_VALIDATE_EMAIL) && preg_match('/@.+\./', $_POST["{$val}"]))){
            $this->errors["{$val}"]="Некорректный email";
        }
    }

    private function required($table, $val){
        if(!isset($_POST["{$val}"])){
            $this->errors["{$val}"]="Обязательно к заполнению";
        }
    }

    private function telefon($table, $val){
        if (!preg_match('/^[+]7|8[0-9()-]{10}$\\s/', $_POST["{$val}"])) {
            $this->errors["{$val}"]="Некорректный номер телефона";
        }

    }

    public function findOne($id){
        $result=$this->data_base->query("SELECT * FROM {$this->table} WHERE id='".$id."' ");

        return mysqli_fetch_array($result, MYSQLI_ASSOC);
    }

    public function findAll(){
        $result=$this->data_base->query("SELECT * FROM {$this->table}");

        return mysqli_fetch_array($result, MYSQLI_ASSOC);
    }

    public function change($id)
    {
        $query="UPDATE {$this->table} SET ";

        foreach ($_POST as $k => $v){
            $query.="{$k} = '".$v."' ,";
        }
        $query=substr($query, 0, -1);
        $query.=" WHERE id='".$id."'";

        $this->data_base->query($query);
    }

    public function delete($id)
    {
        $query=" DELETE FROM {$this->table} WHERE id='".$id."'";

        $this->data_base->query($query);
    }
}