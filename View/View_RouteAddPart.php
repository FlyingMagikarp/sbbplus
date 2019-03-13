<?php

require '../Controller.php';
include '../res/head.php';
include 'Nav.php';

class View_RouteAddPart
{
    public $controller;
    public $connectionId;
    public $routeId;
    public $routeName;
    public $originalConnection;
    public $originalStartStation;
    public $originalEndStation;

    public function __construct($connectionID, $routeID){
        $this->controller = new Controller();
        $this->connectionId = $connectionID;
        $this->routeId = $routeID;
        $this->routeName = $this->controller->getRouteName($routeID);

        $this->originalConnection = $this->getConnectionObj($connectionID);
        $this->originalStartStation = $this->getStationById($this->originalConnection->fromStation);
        $this->originalEndStation = $this->getStationById($this->originalConnection->toStation);
    }

    public function getConnectionObj($connectionId){
        return $this->controller->getConnectionById($connectionId);
    }

    public function getStationById($stationId){
        return $this->controller->getStationById($stationId);
    }

    public function getAllStations(){
        return $this->controller->getStations();
    }

    public function increaseConnectionPos($pos){
        $this->controller->increaseConnectionPos($pos,$this->routeId);
    }

    public function addConnection($connection){
        $this->controller->addConnection($connection);
    }

    public function deleteConnection($connId){
        $this->controller->deleteConnection($connId);
    }


}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if(isset($_POST['connectionId'])){
        $routeId = $_POST['routeId'];
        $connectionId = $_POST['connectionId'];

        $self = new View_RouteAddPart($connectionId,$routeId);
    }

    if(isset($_POST['submitIn'])){
        $routeId = $_POST['routeId'];
        $oldConnectionId = $_POST['connectionId'];
        $newStationId = $_POST['newStation'];
        $fromToNewTime = $_POST['fromToNewTime'];
        $newToEndTime = $_POST['newToEndTime'];
        $newPos = (int)$self->originalConnection->routePos + 1;


        $self = new View_RouteAddPart($oldConnectionId,$routeId);
        //echo '<pre>' , var_dump($self) , '</pre>'; die();
        $self->increaseConnectionPos($self->originalConnection->routePos);
        $firstNewConn = new Model_Connection($self->routeId,$self->originalConnection->routePos,$self->originalStartStation->id,$newStationId,$fromToNewTime);
        $secondNewConn = new Model_Connection($self->routeId,$newPos,$newStationId,$self->originalEndStation->id,$newToEndTime);
        $self->addConnection($firstNewConn);
        $self->addConnection($secondNewConn);
        $self->deleteConnection($oldConnectionId);

        header("Location: View_RouteOverview.php");
        exit();

    }
}
?>
<html>
<head>
    <title>SBB Plus</title>
</head>
<body>
<div>
    <?php echo getNavbar(); ?>
</div>
<div class="container-fluid">
    <div class="col-md-8 col-sm-12">
        <br>
        <h2><?php echo $self->routeName ?></h2>
        <form name="addPart" action=<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?> method="post">
        <table class="table">
            <thead>
            <tr>
                <th scope="col">Von</th>
                <th scope="col">Zeit</th>
                <th scope="col">Neue Station</th>
                <th scope="col">Zeit</th>
                <th scope="col">Bis</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
                <tr>
                    <td><input name="fromStationName" value="<?php echo $self->originalStartStation->name ?>" readonly></td>
                    <td><input name="fromToNewTime"></td>
                    <td>
                        <select id="newStation" name="newStation">
                            <?php $allStations = $self->getAllStations(); ?>
                            <?php for($i=0;$i<sizeof($allStations);$i++): ?>
                                <option value="<?php echo $allStations[$i]->id ?>"><?php echo $allStations[$i]->name ?></option>
                            <?php endfor; ?>
                        </select>
                    </td>
                    <td><input name="newToEndTime"></td>
                    <td><input name="toStation" value="<?php echo $self->originalEndStation->name ?>" readonly></td>
                </tr>
            </tbody>
        </table>
            <input name="connectionId" value="<?php echo $self->connectionId; ?>" hidden>
            <input name="routeId" value="<?php echo $self->routeId; ?>" hidden>
            <input name="submitIn" value="true" hidden>
        <button type="submit" class="btn btn-sm btn-dark">Speichern</button>
        </form>
    </div>
</div>
<?php include '../res/js.php'; ?>
</body>
</html>