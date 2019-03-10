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


}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if(isset($_POST['connectionId'])){
        $routeId = $_POST['routeId'];
        $connectionId = $_POST['connectionId'];

        $self = new View_RouteAddPart($connectionId,$routeId);
        echo '<pre>' , var_dump($self) , '</pre>'; die();

        /*
         * from here
         * add new connection from old start to new
         * add new connection from new to old end
         *
         * figure out how to change ROUTE POS
         *
         * delete old connection
         *
         * */
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
        <form>
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
                    <td><input name="fromStationName" value="<?php echo "fromStation" ?>" readonly></td>
                    <td><input name="fromToNewTime"></td>
                    <td>
                        <select class="form-control" id="newStation" name="newStation">
                            <?php for($i=0;$i<5;$i++): ?>
                                <option value="<?php echo $i ?>"><?php echo $i ?></option>
                            <?php endfor; ?>
                        </select>
                    </td>
                    <td><input name="NewToEndTime"></td>
                    <td><input name="toStation" value="<?php echo "toStation" ?>" readonly></td>
                </tr>
            </tbody>
        </table>
        <button type="submit" class="btn btn-sm btn-dark">Speichern</button>
        </form>
    </div>
</div>
<?php include '../res/js.php'; ?>
</body>
</html>