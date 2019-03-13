<?php

class Model_RouteData
{
    public $id;
    public $name;
    public $config;

    public function __construct($name, $id = 0, $config=[[0],[0],[0]]){
        $this->id = $id;
        $this->name = $name;
        $this->config = $config;
    }
}