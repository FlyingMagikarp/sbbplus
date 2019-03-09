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


// Routes


// Stations



}