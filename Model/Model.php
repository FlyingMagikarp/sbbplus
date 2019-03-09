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
// gets all workers
public function getWorkers(){
    $conn = $this->dbConnection();

    $sql  = "SELECT * FROM Worker;";
    $results = $conn->query($sql);

    return $results;
}

// adds worker
public function addWorker($worker){
    $conn = $this->dbConnection();
    $workerNr = $worker->workerID;
    $firstname = $worker->firstname;
    $lastname = $worker->lastname;
    $role = $worker->role;
    $absent = $worker->absent;

    $sql = "INSERT INTO Worker (WorkerNr, Firstname, Lastname, Role, Absent) VALUES ('".$workerNr."','".$firstname."','".$lastname."','".$role."','".$absent."')";
    $conn->query($sql);

    $conn->close();
}

// updates worker's absent status
public function updateAbsent($val, $id){
    $conn = $this->dbConnection();

    $sql = "UPDATE Worker SET Absent = '".$val."' WHERE ID = '".$id."'";
    $conn->query($sql);

    $conn->close();
}

// deletes worker
public function deleteWorker($id){
    $conn = $this->dbConnection();

    $sql = "DELETE FROM Worker WHERE ID = '".$id."';";
    $conn->query($sql);
}

// gets all roles
public function getRoles(){
    $conn = $this->dbConnection();

    $sql = "SELECT * FROM Role";
    $results = $conn->query($sql);

    return $results;
}


// Material
// gets all Materials
public function getMaterials(){
    $conn = $this->dbConnection();

    $sql  = "SELECT * FROM Material;";
    $results = $conn->query($sql);

    return $results;
}

// adds a material
public function addMaterial($material){
    $conn = $this->dbConnection();
    $sn = $material->sn;
    $type = $material->type;
    $dateStart = $material->dateStart;
    $lastCheck = $material->lastCheck;
    $nextCheck = $material->nextCheck;
    $class = $material->class;
    $space = $material->space;
    $available = $material->available;

    $sql = "INSERT INTO Material (SN, Type, DateStart, LastCheck, NextCheck, Class, Space, Available) VALUES ('".$sn."','".$type."','".$dateStart."','".$lastCheck."','".$nextCheck."','".$class."','".$space."','".$available."')";
    $conn->query($sql);

    $conn->close();
}

// updates materials available status
public function updateAvailable($val, $id){
    $conn = $this->dbConnection();

    $sql = "UPDATE Material SET Available = '".$val."' WHERE ID = '".$id."'";
    $conn->query($sql);

    $conn->close();
}

// deletes Material using ID
public function deleteMaterial($id){
    $conn = $this->dbConnection();

    $sql = "DELETE FROM Material WHERE ID = '".$id."';";
    $conn->query($sql);
}

// gets all types of material
public function getTypes(){
    $conn = $this->dbConnection();

    $sql = "SELECT * FROM Materialtype";
    $results = $conn->query($sql);

    return $results;
}

// Routes
// gets all Routes
public function getRoutes(){
    $conn = $this->dbConnection();

    $sql = "SELECT * FROM Route";
    $results = $conn->query($sql);

    return $results;
}

// deletes Route using ID
// todo expand to cascade delete in Connection table
public function deleteRoute($id){
    $conn = $this->dbConnection();

    $sql = "DELETE FROM Route WHERE ID ='".$id."'";
    $conn->query($sql);
}

// Stations
// gets all Stations
public function getStations(){
    $conn = $this->dbConnection();

    $sql  = "SELECT * FROM Station;";
    $results = $conn->query($sql);

    return $results;
}

// deletes Station using ID
public function deleteStation($id){
    $conn = $this->dbConnection();

    $sql = "DELETE FROM Station WHERE ID = '".$id."';";
    $conn->query($sql);
}

// adds a station
public function addStation($station){
    $conn = $this->dbConnection();
    $name = $station->name;
    $wait = $station->wait;

    $sql = "INSERT INTO Station (Name, Wait) VALUES ('".$name."','".$wait."')";
    $conn->query($sql);

    $conn->close();
}


}