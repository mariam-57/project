<?php

namespace Project\Mvc\controllers;

use Project\Mvc\core\controller;
use Project\Mvc\core\validation;



class home extends controller{
    public function index(){
        return $this->view("index", ["title"=>"index"]);
    }
    public function store(){
        // print_r($_POST);die;
        $validation = new validation();
        
        $validation->input("username")->required()->email();
        // $validation->input("www");
        
        print_r($validation->showError());
    }
}