<?php 

use Project\Mvc\core\IDbstandard;

//one method to try (library)
class db implements IDbstandard{
    public $connection, $sql;   //property 
public function __construct($data){
    $this->connection = mysqli_connect($data[0], $data[1], $data[2], $data[3], $data[4]);
}

public function select($table,$column){
    $this->sql = "SELECT $column FROM `$table`";
    return $this;
}
public function where($column, $operator, $value){
    $this->sql .=  "WHERE `$column` $operator '$value'";
    return $this;
}
public function andwhere($column, $operator, $value){
    $this->sql .=  "AND WHERE `$column` $operator '$value'";
    return $this;
}public function orwhere($column, $operator, $value){
    $this->sql .=  "OR WHERE `$column` $operator '$value'";
    return $this;
}
public function join($type, $table, $primary, $foreign){
    $this->sql .= "$type JOIN $table ON $primary = $foreign";
    return $this;
}
public function rows(){
    $query = mysqli_query($this->connection, $this->sql);
    if(is_object($query)){
        return mysqli_fetch_all($query, MYSQLI_ASSOC);
    }
    return $this->showerror();
    
}
public function firstrow(){
    $query = mysqli_query($this->connection, $this->sql);
    if(is_object($query)){  
        return mysqli_fetch_assoc($query);
    }
    return $this->showerror();
    }
public function delete($table){
    $this->sql = "DELETE FROM `$table`";
    return $this;
}
public function excute(){
    $query = mysqli_query($this->connection, $this->sql);
    if(is_object($query)){
        return mysqli_affected_rows($this->connection);
    }
    return $this->showerror(); 
    
}
public function insert($table,$data){
    $columns = '';
    $values = '';
    foreach ($data as $column => $value) {
        $columns .= " `$column` ,";
        $values .= " '$value' ,";
    }
    $columns = rtrim($columns, ',');
    $values = rtrim($values, ',');

    $this->sql = "INSERT ITO `$table`  ($columns)  VALUES   ($values)";
    return $this;
}
public function update($table, $data){
    $row = '';
    foreach ($data as $column => $value) {
        $row .= "`$column` =  '$value',";
}

$row = rtrim($row, ',');

$this->sql = "UPDATE `$table` SET $row";
return $this;
}
public function showerror (){
    $errors = mysqli_error_list($this->connection);
    foreach ($errors as $error){
        echo " <h2>Error</h2> : ".$error['error']. "<br><h3>Error Code : </h3>".$error['errno'];
    }
}
public function __destruct(){
    mysqli_close($this->connection);
}
}
function add($data, $data1, $data2, $data3,){
    $connect = mysqli_connect("localhost","root", "","project", 3308);
    // method that insert into DB
    mysqli_query($connect, "INSERT INTO `contact` (`firstname`, `lastname`, `email`, `message`)
    VALUES ('$data', '$data1', '$data2', '$data3')");
    return mysqli_affected_rows($connect);
    
} 