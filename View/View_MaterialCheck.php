<?php

require '../Controller.php';
include '../res/head.php';
include 'Nav.php';

class View_MaterialCheck
{
    public $controller;
    public $routes;
    public $totalLoksNeeded;
    public $totalWag1Needed;
    public $totalWag2Needed;
    public $totalDriverNeeded;
    public $totalCheckNeeded;
    public $totalLoksAv;
    public $totalWag1Av;
    public $totalWag2Av;
    public $totalDriverAv;
    public $totalCheckAv;

    public function __construct(){
        $this->controller = new Controller();
        $this->routes = $this->getAllRoutes();
        $this->setAvailableMaterial();
        $this->setAvailableWorker();
    }

    public function getAllRoutes(){
        return $this->controller->getRoutes();
    }

    public function getTotalTravelTime($routeId){
        return $this->controller->calcTotalTravelTime($routeId);
    }

    public function setAvailableMaterial(){
        $this->totalLoksAv = $this->controller->getAmtLoksAvailable();
        $this->totalWag1Av = $this->controller->getAmtWag1Available();
        $this->totalWag2Av = $this->controller->getAmtWag2Available();
    }

    public function setAvailableWorker(){
        $this->totalDriverAv = $this->controller->getDriverAvailable();
        $this->totalCheckAv = $this->controller->getCheckAvailable();
    }

    public function checkErrors(){
        return true;
    }


    public function stringToMin($string){
        $splitted = explode(':',$string);
        $hour = $splitted[0];
        $min = $splitted[1];

        $hour = (int)$hour*60;
        $min = (int)$min;
        $time = (int)$hour+(int)$min;
        return $time;
    }

    public function minToString($min){
        $rest = (int)$min%60;
        $temp = (int)$min - $rest;
        $quot = (int)$temp/60;
        if($quot >= 24){
            $quot -= 24;
        }
        if($rest < 10){
            $rest = "0".$rest;
        }
        $string = $quot.":".$rest;
        return $string;
    }

}
$self = new View_MaterialCheck();
$timeWeekdayArr = [
    '5:30',
    '6:00',
    '6:30',
    '6:45',
    '7:00',
    '7:15',
    '7:30',
    '7:45',
    '8:00',
    '8:15',
    '8:30',
    '9:00',
    '9:30',
    '10:00',
    '10:30',
    '11:00',
    '11:30',
    '11:45',
    '12:00',
    '12:15',
    '12:30',
    '12:45',
    '13:00',
    '13:15',
    '13:30',
    '14:00',
    '14:30',
    '15:00',
    '15:30',
    '16:00',
    '16:15',
    '16:30',
    '16:45',
    '17:00',
    '17:15',
    '17:30',
    '17:45',
    '18:00',
    '18:15',
    '18:30',
    '18:45',
    '19:00',
    '19:30',
    '20:00',
    '20:30',
    '21:00',
    '21:30',
    '22:00',
    '22:30',
    '23:00',
    '23:30',
];


$dataRoutesArr = array();
for($i = 0;$i<sizeof($self->routes);$i++){
    $tmpArr = array();
    $traveltime = $self->getTotalTravelTime($self->routes[$i]->id);
    $endTime = $self->stringToMin($timeWeekdayArr[0]) + $traveltime;
    $amountTrains=0;
    $timeSet = false;
    for($j=0;$j<sizeof($timeWeekdayArr);$j++){
        $tmpTime = $self->stringToMin($timeWeekdayArr[$j]);
        if (!$timeSet && $endTime<=$tmpTime){
            $timeSet = true;
            $amountTrains = $j+2;
            $amountTrains *= 2;
        }
    }
    array_push($tmpArr, $self->routes[$i]->id);
    array_push($tmpArr, $self->routes[$i]->name);
    array_push($tmpArr, $amountTrains);

    $amtLoks = $amountTrains * $self->routes[$i]->config[0];
    $amtWag1 = $amountTrains * $self->routes[$i]->config[1];
    $amtWag2 = $amountTrains * $self->routes[$i]->config[2];

    array_push($tmpArr, $amtLoks);
    array_push($tmpArr, $amtWag1);
    array_push($tmpArr, $amtWag2);

    array_push($dataRoutesArr,$tmpArr);
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
            <?php for($i = 0;$i<sizeof($dataRoutesArr);$i++): ?>
                <br>
                <div>
                        <?php echo $dataRoutesArr[$i][1]; ?>
                </div>
            <table class="table">
            <tbody>
                <tr>
                    <td>Anzahl Züge</td>
                    <td><?php echo $dataRoutesArr[$i][2]; ?></td>
                </tr>
                <tr>
                    <td>Anzahl Lokomotiven</td>
                    <td><?php echo $dataRoutesArr[$i][3]; ?></td>
                </tr>
                <tr>
                    <td>Anzahl Wagons 1. Klasse</td>
                    <td><?php echo $dataRoutesArr[$i][4]; ?></td>
                </tr>
                <tr>
                    <td>Anzahl Wagons 2. Klasse</td>
                    <td><?php echo $dataRoutesArr[$i][5]; ?></td>
                </tr>
                <tr>
                    <td>Anzahl Kontrolleure</td>
                    <td><?php echo $dataRoutesArr[$i][2]; ?></td>
                </tr>
                <tr>
                    <td>Anzahl Lokführer</td>
                    <td><?php echo $dataRoutesArr[$i][2]; ?></td>
                </tr>
            </tbody>
            </table>
            <?php
                //add to global total
                $self->totalLoksNeeded += $dataRoutesArr[$i][3];
                $self->totalWag1Needed += $dataRoutesArr[$i][4];
                $self->totalWag2Needed += $dataRoutesArr[$i][5];
                $self->totalDriverNeeded += $dataRoutesArr[$i][2];
                $self->totalCheckNeeded += $dataRoutesArr[$i][2];
            ?>
            <?php endfor; ?>
            <div>
                <br>
                <div>
                    <h2>Total benötigt</h2>
                </div>
                <table class="table">
                    <tbody>
                    <tr>
                        <td>Anzahl Lokomotiven</td>
                        <td><?php echo $self->totalLoksNeeded ?></td>
                    </tr>
                    <tr>
                        <td>Anzahl Wagons 1. Klasse</td>
                        <td><?php echo $self->totalWag1Needed; ?></td>
                    </tr>
                    <tr>
                        <td>Anzahl Wagons 2. Klasse</td>
                        <td><?php echo $self->totalWag2Needed; ?></td>
                    </tr>
                    <tr>
                        <td>Anzahl Kontrolleure</td>
                        <td><?php echo $self->totalDriverNeeded ?></td>
                    </tr>
                    <tr>
                        <td>Anzahl Lokführer</td>
                        <td><?php echo $self->totalCheckNeeded; ?></td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <div>
                <br>
                <div>
                    <h2>Total verfügbar</h2>
                </div>
                <table class="table">
                    <tbody>
                    <tr>
                        <td>Anzahl Lokomotiven</td>
                        <?php if($self->totalLoksAv >= $self->totalLoksNeeded): ?>
                        <td><div class="alert alert-success" role="alert">
                                <?php echo $self->totalLoksAv ?>
                        </div></td>
                        <?php else: ?>
                            <td>
                            <div class="alert alert-danger" role="alert">
                                <?php echo $self->totalLoksAv ?>
                            </div>
                            </td>
                        <?php $diff = $self->totalLoksNeeded - $self->totalLoksAv ?>
                            <td><div class="alert"><?php echo "Fehlt: ".$diff ?></div></td>
                        <?php endif; ?>
                    </tr>
                    <tr>
                        <td>Anzahl Wagons 1. Klasse</td>
                        <?php if($self->totalWag1Av >= $self->totalWag1Needed): ?>
                            <td><div class="alert alert-success" role="alert">
                                    <?php echo $self->totalWag1Av ?>
                                </div></td>
                        <?php else: ?>
                            <td>
                                <div class="alert alert-danger" role="alert">
                                    <?php echo $self->totalWag1Av ?>
                                </div>
                            </td>
                            <?php $diff = $self->totalWag1Needed - $self->totalWag1Av ?>
                            <td><div class="alert"><?php echo "Fehlt: ".$diff ?></div></td>
                        <?php endif; ?>
                    </tr>
                    <tr>
                        <td>Anzahl Wagons 2. Klasse</td>
                        <?php if($self->totalWag2Av >= $self->totalWag2Needed): ?>
                            <td><div class="alert alert-success" role="alert">
                                    <?php echo $self->totalWag2Av ?>
                                </div></td>
                        <?php else: ?>
                            <td>
                                <div class="alert alert-danger" role="alert">
                                    <?php echo $self->totalWag2Av ?>
                                </div>
                            </td>
                            <?php $diff = $self->totalWag2Needed - $self->totalWag2Av ?>
                            <td><div class="alert"><?php echo "Fehlt: ".$diff ?></div></td>
                        <?php endif; ?>
                    </tr>
                    <tr>
                        <td>Anzahl Kontrolleure</td>
                        <?php if($self->totalCheckAv >= $self->totalCheckNeeded): ?>
                            <td><div class="alert alert-success" role="alert">
                                    <?php echo $self->totalCheckAv ?>
                                </div></td>
                        <?php else: ?>
                            <td>
                                <div class="alert alert-danger" role="alert">
                                    <?php echo $self->totalCheckAv ?>
                                </div>
                            </td>
                            <?php $diff = $self->totalCheckNeeded - $self->totalCheckAv ?>
                            <td><div class="alert"><?php echo "Fehlt: ".$diff ?></div></td>
                        <?php endif; ?>
                    </tr>
                    <tr>
                        <td>Anzahl Lokführer</td>
                        <?php if($self->totalDriverAv >= $self->totalDriverNeeded): ?>
                            <td><div class="alert alert-success" role="alert">
                                    <?php echo $self->totalDriverAv ?>
                                </div></td>
                        <?php else: ?>
                            <td>
                                <div class="alert alert-danger" role="alert">
                                    <?php echo $self->totalDriverAv ?>
                                </div>
                            </td>
                            <?php $diff = $self->totalDriverNeeded - $self->totalDriverAv ?>
                            <td><div class="alert"><?php echo "Fehlt: ".$diff ?></div></td>
                        <?php endif; ?>
                    </tr>
                    </tbody>
                </table>
            </div>
            <div>
                <?php
                    $error = $self->checkErrors();

                ?>
            </div>
        </div>
    </div>
</div>
<?php include '../res/js.php'; ?>
</body>
</html>
