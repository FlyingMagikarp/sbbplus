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

public function getDriverAvailable(){
    $conn = $this->dbConnection();

    $sql = "SELECT COUNT(*) AS total FROM Worker WHERE Role = 'Lokomotivführer' AND Absent = 0";
    $results = $conn->query($sql);

    return $results;
}

public function getCheckAvailable(){
    $conn = $this->dbConnection();

    $sql = "SELECT COUNT(*) AS total FROM Worker WHERE Role = 'Kontrolleur' AND Absent = 0";
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

public function getAmtLoksAvailable(){
    $conn = $this->dbConnection();

    $sql = "SELECT COUNT(*) AS total FROM Material WHERE Type = 0 AND Available = 1";
    $results = $conn->query($sql);

    return $results;
}

public function getAmtWag1Available(){
    $conn = $this->dbConnection();

    $sql = "SELECT COUNT(*) AS total FROM Material WHERE Type = 1 AND Class = 1 AND Available = 1";
    $results = $conn->query($sql);

    return $results;
}

public function getAmtWag2Available(){
    $conn = $this->dbConnection();

    $sql = "SELECT COUNT(*) AS total FROM Material WHERE Type = 1 AND Class = 2 AND Available = 1";
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

// gets Route name using ID
public function getRouteName($routeId){
    $conn = $this->dbConnection();

    $sql = "SELECT Name FROM Route WHERE ID = '".$routeId."'";
    $results = $conn->query($sql);

    return $results;
}

// adds route using route Name and returns it's ID
public function addRoute($route,$configArr){
    $config = implode('::',$configArr);
    $conn = $this->dbConnection();

    $sql = "INSERT INTO Route(Name, Configuration) VALUES ('".$route."','".$config."')";

    $conn->query($sql);

    return $this->getLastRouteId();
}

// gets last inserted Route ID
public function getLastRouteId(){
    $conn = $this->dbConnection();

    $sql = "SELECT * FROM Route ORDER BY ID desc LIMIT 1";
    $result = $conn->query($sql);

    return $result;
}

// deletes Route using ID
public function deleteRoute($id){
    $conn = $this->dbConnection();

    $sql = "DELETE FROM Route WHERE ID ='".$id."'";
    $conn->query($sql);

    $this->deleteConnectionUsingRoute($id);
}


//Connection
// adds connection
public function addConnection($connection){
    $routeID = $connection->routeID;
    $routePOS = $connection->routePos;
    $fromStation = $connection->fromStation;
    $toStation = $connection->toStation;
    $travelTime = $connection->travelTime;

    $conn = $this->dbConnection();

    $sql = "INSERT INTO Connection(RouteID,RoutePOS,FromStation,ToStation,TravelTime) VALUES ('".$routeID."','".$routePOS."','".$fromStation."','".$toStation."','".$travelTime."')";
    $conn->query($sql);

    $conn->close();
}

// gets all connections using routeID
public function getConnections($routeID){
    $conn = $this->dbConnection();

    $sql  = "SELECT * FROM Connection WHERE RouteID = '".$routeID."' ORDER BY RoutePOS;";
    $results = $conn->query($sql);

    return $results;
}

// gets connection using ID
public function getConnectionById($connectionId){
    $conn = $this->dbConnection();

    $sql  = "SELECT * FROM Connection WHERE ID = '".$connectionId."'";
    $results = $conn->query($sql);

    return $results;
}

// gets all connection that are bigger than POS
public function getConnectionBiggerThanPos($pos,$routeId){
    $conn = $this->dbConnection();

    $sql  = "SELECT * FROM Connection WHERE RouteID = '".$routeId."' AND RoutePOS > '".$pos."' ORDER BY RoutePOS;";
    $results = $conn->query($sql);

    return $results;
}

// updates connection POS
public function updateConnection($connection){
    $id = $connection->id;
    $routeId = $connection->routeID;

    $conn = $this->dbConnection();
    $sql = "UPDATE Connection SET RoutePOS = '".$routeId."' WHERE ID = '".$id."'";
    $conn->query($sql);
}

// deletes Connection using ID
public function deleteConnection($connectionId){
    $conn = $this->dbConnection();

    $sql = "DELETE FROM Connection WHERE ID = '".$connectionId."';";
    $conn->query($sql);
}

// deletes Connection using RouteId
    public function deleteConnectionUsingRoute($routeId){
        $conn = $this->dbConnection();

        $sql = "DELETE FROM Connection WHERE RouteID = '".$routeId."';";
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

// gets Station by id
public function getStationById($id){
    $conn = $this->dbConnection();

    $sql  = "SELECT * FROM Station WHERE ID = '".$id."'";
    $results = $conn->query($sql);

    return $results;
}

}