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
            $config = explode('::',$row['Configuration']);
            $route = new Model_RouteData($row['Name'], $row['ID'], $config);
            array_push($dataArray,$route);
        }
        return $dataArray;
    }

    // gets Route name using ID
    public function getRouteName($routeId){
        $dataDB = $this->model->getRouteName($routeId);
        $data = "";
        while($row = $dataDB->fetch_assoc()){
            $data = $row['Name'];
        }
        return $data;
    }

    // deletes Route using ID
    public function deleteRoute($id){
        $this->model->deleteRoute($id);
    }

    // adds Route and creates initial Connection
    public function addRouteWithStation($routeName, $fromStationID, $toStationID, $travelTime, $config){
        $routeId = $this->addRoute($routeName, $config);

        //create connection
        $connection = new Model_Connection($routeId,1,$fromStationID,$toStationID,$travelTime);
        $this->model->addConnection($connection);
    }

    // adds Route and return RouteID
    public function addRoute($name,$config){
        $dataDB = $this->model->addRoute($name,$config);
        $routeId = 0;
        while($row = $dataDB->fetch_assoc()){
            $routeId = $row['ID'];
        }
        return $routeId;
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

    // gets station using ID
    public function getStationById($id){
        $dataDB = $this->model->getStationById($id);
        $station = 0;
        while($row = $dataDB->fetch_assoc()){
            $station = new Model_Station($row['Name'],$row['Wait'],$row['ID']);
        }
        return $station;
    }


    //Connection
    // gets all Connections using Route ID
    public function getConnections($routeID){
        $dataDB = $this->model->getConnections($routeID);
        $dataArray = array();
        while($row = $dataDB->fetch_assoc()){
            $fromStation = $this->getStationById($row['FromStation']);
            $toStation = $this->getStationById($row['ToStation']);
            $connection = new Model_Connection($row['RouteID'],$row['RoutePOS'],$fromStation,$toStation,$row['TravelTime'],$row['ID']);
            array_push($dataArray,$connection);
        }
        return $dataArray;
    }

    public function addConnection($connection){
        $this->model->addConnection($connection);
    }

    public function deleteConnection($connectionId){
        $this->model->deleteConnection($connectionId);
    }

    // gets a connection using ID
    public function getConnectionById($connectionId){
        $dataDB = $this->model->getConnectionById($connectionId);
        $connection = 0;
        while($row = $dataDB->fetch_assoc()){
            $connection = new Model_Connection($row['RouteID'],$row['RoutePOS'],$row['FromStation'],$row['ToStation'],$row['TravelTime'],$row['ID']);
        }
        return $connection;
    }

    // increases all ConnectionsPOS by 1
    public function increaseConnectionPos($pos,$routeId){
        $connectionArr = $this->getConnectionBiggerThanPos($pos,$routeId);
        for($i=0;$i<sizeof($connectionArr);$i++){
            $this->model->updateConnection($connectionArr[$i]);
        }
    }

    //gets all connections bigger than pos and increases POS by 1
    public function getConnectionBiggerThanPos($pos,$routeId){
        $dataDB = $this->model->getConnectionBiggerThanPos($pos,$routeId);
        $dataArray = array();
        while($row = $dataDB->fetch_assoc()){
            $newPos = (int)$row['RoutePOS'] + 1;
            $connection = new Model_Connection($row['RouteID'],$newPos,$row['FromStation'],$row['ToStation'],$row['TravelTime'],$row['ID']);
            array_push($dataArray,$connection);
        }
        return $dataArray;
    }


    // calcs total travel time
    public function calcTotalTravelTime($routeId){
        $connectionsArr = $this->getConnections($routeId);
        $travelTime = 0;
        for($i=0;$i<sizeof($connectionsArr);$i++){
            $travelTime += (int)$connectionsArr[$i]->travelTime;
            $travelTime += (int)$connectionsArr[$i]->toStation->wait;
        }
        $travelTime -= (int)$connectionsArr[$i-1]->toStation->wait;
        return $travelTime;
    }


    public function getAmtLoksAvailable(){
        $dataDB = $this->model->getAmtLoksAvailable();
        $data=mysqli_fetch_assoc($dataDB);
        return $data['total'];
    }


    public function getAmtWag1Available(){
        $dataDB = $this->model->getAmtWag1Available();
        $data=mysqli_fetch_assoc($dataDB);
        return $data['total'];
    }


    public function getAmtWag2Available(){
        $dataDB = $this->model->getAmtWag2Available();
        $data=mysqli_fetch_assoc($dataDB);
        return $data['total'];
    }


    public function getDriverAvailable(){
        $dataDB = $this->model->getDriverAvailable();
        $data=mysqli_fetch_assoc($dataDB);
        return $data['total'];
    }


    public function getCheckAvailable(){
        $dataDB = $this->model->getCheckAvailable();
        $data=mysqli_fetch_assoc($dataDB);
        return $data['total'];
    }
}