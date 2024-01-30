<?php

namespace Project\Mvc\core;


class validation{
    // propaperty as array, take rules and use it in validation
    // rule: regular expression
    private $pattern = [
        
        'uri'           => '[A-Za-z0-9-\/_?&=]+',
        'url'           => '[A-Za-z0-9-:.\/_?&=#]+',
        'alpha'         => '[\p{L}]+',
        'words'         => '[\p{L}\s]+',
        'alphanum'      => '[\p{L}0-9]+',
        'int'           => '[0-9]+',
        'float'         => '[0-9\.,]+',
        'tel'           => '[0-9+\s()-]+',
        'text'          => '[\p{L}0-9\s-.,;:!"%&()?+\'°#\/@]+',
        'file'          => '[\p{L}\s0-9-_!%&()=\[\]#@,.;+]+\.[A-Za-z0-9]{2,4}',
        'folder'        => '[\p{L}\s0-9-_!%&()=\[\]#@,.;+]+',
        'address'       => '[\p{L}0-9\s.,()°-]+',
        'date_dmy'      => '[0-9]{1,2}\-[0-9]{1,2}\-[0-9]{4}',
        'date_ymd'      => '[0-9]{4}\-[0-9]{1,2}\-[0-9]{1,2}',
        'email'         => '[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})'
    
    ];
    // error array (property take all error)
    private $errors = []; 
    private $input;
    private $value;
    // take input that we want to check
    public function input($input)
    {  
        // check if input->exsit
        if(!isset($_REQUEST[$input])){
            $this->errors[] = "input : $input not esist";
        }
        else{
            // store key(input) in input proraperty
            $this->input = $input;
            $this->value();
        }
        return $this;
    }
    // take value of input, return it and pass value to other function
    public function value(){
        $this->value = $_REQUEST[$this->input];
        return $this;
           
    }
    public function integer(){
        $regex = '/^('.$this->pattern['int'].')$/u';
        
        if(!preg_match($regex, $this->value)){
            $this->errors[]= "input :$this->input must be integer";
        }
        return $this; 
    }
    
    // check if array error is empty retur n true
    
    public function max($max){
        if(strlen($this->value) >$max){
            $this->errors[]= "input :$this->input must be $max";
        }
        return $this;  
    }
    public function min($min){
        if(strlen($this->value) <$min){
            $this->errors[]= "input :$this->input must be $min";
        }
    }
    public function required(){
        if(!(strlen($this->value)  > 0 && !empty($this->value) && $this->value != '')){
            $this->errors[]= "input :$this->input must be rrquired ";
        }
        return $this;  
              
    } public function email(){
        $regex = '/^('.$this->pattern['email'].')$/u';
        // pattern matches 
        if(!preg_match($regex, $this->value)){
            $this->errors[]= "input :$this->input must be email";
        }
        return $this; 
    }
    public function float() {
        $regex = '/^('.$this->pattern['float'].')$/u';
        
        if(!preg_match($regex, $this->value)){
            $this->errors[]= "input :$this->input must be float";
        }
        return $this; 
    }
    public function string(){
        $regex = '/^('.$this->pattern['words'].')$/u';
        
        if(!preg_match($regex, $this->value)){
            $this->errors[]= "input :$this->input must be string";
        }
        return $this; 


        
    }
    public function showError(){
        if(!empty($this->errors)){
            echo "<ul>";
            foreach($this->errors as $error){
                echo "<li style = 'color:blue'>$error</li>";
            }
            echo "<u>l";
         }        
    }
    public function success(){
        return (empty($this->errors)) ? true : false;
    }
}
?>