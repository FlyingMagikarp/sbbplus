<?php

class Model_Station
{
    public $id;
    public $name;
    public $wait;

    public function __construct($name,$wait,$id = 0){
        $this->id = $id;
        $this->name = $name;
        $this->wait = $wait;
    }
}