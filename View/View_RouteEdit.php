<?php

require '../Controller.php';
include '../res/head.php';
include 'Nav.php';

class View_RouteEdit
{
    public $controller;
    public $routeId;
    public $routeName;
    public $totalTravelTimeWithStops;

    public function __construct($routeId){
        $this->controller = new Controller();
        $this->routeId = $routeId;
        $this->routeName = $this->controller->getRouteName($routeId);
        $this->totalTravelTimeWithStops = $this->calcTotalTravelTime();
    }

    public function getConnectionsFromRouteId(){
        return $this->controller->getConnections($this->routeId);
    }

    public function getStationName(){
        return $this->controller;
    }

    public function calcTotalTravelTime(){
        return $this->controller->calcTotalTravelTime($this->routeId);
    }

}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if(isset($_POST['edit'])) {
        $self = new View_RouteEdit($_POST['id']);
        $connectionList = $self->getConnectionsFromRouteId();
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
    <div class="col-md-12 col-sm-12">
        <br>
        <h2><?php echo $self->routeName ?></h2>
        <h3>Streckendauer: <?php echo $self->totalTravelTimeWithStops ?></h3>
        <br>
        <h2>Teilstrecken</h2>
        <table class="table">
            <thead>
            <tr>
                <th scope="col">Von</th>
                <th scope="col">Nach</th>
                <th scope="col">Reisezeit</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            <?php if(sizeof($connectionList) > 0): ?>
                <?php for($i=0;$i < sizeof($connectionList);$i++): ?>
                    <tr>
                        <td><?php echo $connectionList[$i]->fromStation->name; ?></td>
                        <td><?php echo $connectionList[$i]->toStation->name; ?></td>
                        <td><?php echo $connectionList[$i]->travelTime ?></td>
                        <td>
                            <form name="addPartStation" action="View_RouteAddPart.php" method="post">
                                <input name="connectionId" value="<?php echo $connectionList[$i]->id ?>" hidden><input name="addPartStation" value="true" hidden><input name="routeId" value="<?php echo $self->routeId ?>" hidden><button type="submit" class="btn btn-sm btn-dark">Zwischenstation hinzufügen</button>
                            </form>
                        </td>
                    </tr>
                <?php endfor; ?>
            <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
<?php include '../res/js.php'; ?>
</body>
</html>