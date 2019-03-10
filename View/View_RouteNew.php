<?php

require '../Controller.php';
include '../res/head.php';
include 'Nav.php';

class View_RouteNew
{
    public $controller;

    public function __construct(){
        $this->controller = new Controller();
    }

    public function  addRoute($name, $fromStation, $toStation, $travelTime){
        $this->controller->addRouteWithStation($name, $fromStation, $toStation, $travelTime);
    }

    public function getStations(){
        return $this->controller->getStations();
    }
}
$self = new View_RouteNew();
$stationData = $self->getStations();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $fromStation = $_POST['fromStation'];
    $toStation = $_POST['toStation'];
    $travelTime = $_POST['travelTime'];

    $self->addRoute($name, $fromStation, $toStation, $travelTime);

    header("Location: View_RouteOverview.php");
    exit();
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
    <div class="row">
        <div class="col-md-5 col-sm-12" >
            <br>
            <form name="newStation" action=<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?> method="post">
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" id="name" name="name" required>
                </div>
                <div class="form-group">
                    <label for="fromStation">Name</label>
                    <select class="form-control" id="fromStation" name="fromStation">
                        <?php for($i=0;$i<sizeof($stationData);$i++): ?>
                        <option value="<?php echo $stationData[$i]->id; ?>"><?php echo $stationData[$i]->name; ?></option>
                        <?php endfor; ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="travelTime">Reisedauer</label>
                    <input type="text" class="form-control" id="travelTime" name="travelTime" required>
                </div>
                <div class="form-group">
                    <label for="toStation">Name</label>
                    <select class="form-control" id="toStation" name="toStation">
                        <?php for($i=0;$i<sizeof($stationData);$i++): ?>
                            <option value="<?php echo $stationData[$i]->id; ?>"><?php echo $stationData[$i]->name; ?></option>
                        <?php endfor; ?>
                    </select>
                </div>
                <button type="submit" class="btn btn-dark">Submit</button>
            </form>
        </div>
    </div>
</div>
<?php include '../res/js.php'; ?>
</body>
</html>
