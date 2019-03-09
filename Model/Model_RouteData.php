<?php

class Model_RouteData
{
    public $id;
    public $name;

    public function __construct($name, $id = 0){
        $this->id = $id;
        $this->name = $name;
    }
}