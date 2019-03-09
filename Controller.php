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


    // Material
    // gets all materials
    public function getMaterials(){
        $dataDB = $this->model->getMaterials();
        $dataArray = array();
        while($row = $dataDB->fetch_assoc()){
            $material = new Model_Material($row['SN'],$row['Type'],$row['DateStart'],$row['LastCheck'],$row['NextCheck'],$row['Available'],$row['Class'],$row['Space'],$row['ID']);
            array_push($dataArray,$material);
        }
        return $dataArray;
    }

    // adds a material based on Model_Material Object
    public function addMaterial($material){
        $this->model->addMaterial($material);
    }

    // updates materials available status
    public function updateAvailable($val, $id){
        $this->model->updateAvailable($val, $id);
    }

    // delete Material
    public function deleteMaterial($id){
        $this->model->deleteMaterial($id);
    }

    // gets all material Types
    public function getTypes(){
        $dataDB = $this->model->getTypes();
        $dataArray = array();
        while($row = $dataDB->fetch_assoc()){
            array_push($dataArray,$row['Type']);
        }
        return $dataArray;
    }


    //Route
    //gets all Routes
    public function getRoutes(){
        $dataDB = $this->model->getRoutes();
        $dataArray = array();
        while($row = $dataDB->fetch_assoc()){
            $route = new Model_RouteData($row['Name'], $row['ID']);
            array_push($dataArray,$route);
        }
        return $dataArray;
    }

    // deletes Route using ID
    public function deleteRoute($id){
        $this->model->deleteRoute($id);
    }


    //Station
    // gets all Stations
    public function getStations(){
        $dataDB = $this->model->getStations();
        $dataArray = array();
        while($row = $dataDB->fetch_assoc()){
            $station = new Model_Station($row['Name'],$row['Wait'],$row['ID']);
            array_push($dataArray,$station);
        }
        return $dataArray;
    }

    // deletes Station using ID
    public function deleteStation($id){
        $this->model->deleteStation($id);
    }

    // adds Station using Model_Station Object
    public function addStation($station){
        $this->model->addStation($station);
    }
}