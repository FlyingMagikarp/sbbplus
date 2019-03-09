<?php

require 'Model/Model.php';
require 'Model/Model_Material.php';
require 'Model/Model_Worker.php';
require 'Model/Model_Connection.php';
require 'Model/Model_RouteData.php';
require 'Model/Model_Station.php';

class Controller{

    public $model;

    public function __construct(){
        $this->model = new Model();
    }

    // Worker
    // gets all workers, generate objects and returns an array with all the objects
    public function getWorkers(){
        $dataDB = $this->model->getWorkers();
        $dataArray = array();
        while($row = $dataDB->fetch_assoc()){
            $worker = new Model_Worker($row['WorkerNr'],$row['Firstname'],$row['Lastname'],$row['Role'],$row['Absent'],$row['ID']);
            array_push($dataArray,$worker);
        }
        return $dataArray;
    }

    // add a worker based on Model_Worker Object
    public function addWorker($worker){
        $this->model->addWorker($worker);
    }

    // updates worker's Absent status
    public function updateAbsent($val, $id){
        $this->model->updateAbsent($val,$id);
    }

    // deletes worker using ID
    public function deleteWorker($id){
        $this->model->deleteWorker($id);
    }

    // returns an array with all possible roles
    public function getRoles(){
        $dataDB = $this->model->getRoles();
        $dataArray = array();
        while($row = $dataDB->fetch_assoc()){
            array_push($dataArray,$row['Role']);
        }
        return $dataArray;
    }

}