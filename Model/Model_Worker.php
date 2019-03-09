<?php

class Model_Worker
{
    public $id;
    public $workerID;
    public $firstname;
    public $lastname;
    public $role;
    public $absent;

    public function __construct($workerID,$firstname,$lastname,$role,$absent=false,$id=0){
        $this->id = $id;
        $this->workerID = $workerID;
        $this->firstname = $firstname;
        $this->lastname = $lastname;
        $this->role = $role;
        $this->absent = $absent;
    }
}