<?php

class Model_Material
{
    public $id;
    public $sn;
    public $type;
    public $dateStart;
    public $lastCheck;
    public $nextCheck;
    public $class;
    public $space;
    public $available;

    public function __construct($sn,$type,$dateStart,$lastCheck,$nextCheck,$available,$class=1,$space=0,$id=0){
        $this->id = $id;
        $this->sn = $sn;
        $this->type = $type;
        $this->dateStart = $dateStart;
        $this->lastCheck = $lastCheck;
        $this->nextCheck = $nextCheck;
        $this->available = $available;
        $this->class = $class;
        $this->space = $space;

    }
}