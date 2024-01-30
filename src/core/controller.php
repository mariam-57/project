<?php 
namespace Project\Mvc\core;

class controller{
// take a path that we redirct to
// data-->parameter and we take it's value and key
    public function view($path, $data){
        // fun==>take data of array and turn key to var(make it global).
        extract($data);
        
        include realpath(dirname(__DIR__)."/views/{$path}.php");
    }
} 