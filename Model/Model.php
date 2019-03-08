<?php

// requires

class Model
{

public function __construct(){ }


// Connection Stuff
public function dbConnection(){
    $servername = 'localhost';
    $username = 'root';
    $password = '';
    $dbname = 'sbbplus';

    $conn = new mysqli($servername,$username,$password,$dbname);
    $conn->set_charset('utf8');
    return $conn;
}


// Worker


// Material


// Routes


// Stations



}