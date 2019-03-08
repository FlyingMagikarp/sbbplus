<?php

class Model_Connection
{
    public $id;
    public $routeID;
    public $routePos;
    public $fromStation;
    public $toStation;
    public $travelTime;

    public function __construct($routeID,$routePos,$fromStation,$toStation,$travelTime,$id=0){
        $this->id = $id;
        $this->routeID = $routeID;
        $this->routePos = $routePos;
        $this->fromStation = $fromStation;
        $this->toStation = $toStation;
        $this->travelTime = $travelTime;
    }
}