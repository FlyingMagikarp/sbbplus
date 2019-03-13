<?php

require '../Controller.php';
include '../res/head.php';
include 'Nav.php';

class View_Timetable
{
    public $controller;
    public $routes;

    public function __construct(){
        $this->controller = new Controller();
        $this->routes = $this->getAllRoutes();
    }

    public function getAllRoutes(){
        return $this->controller->getRoutes();
    }

    public function getConnections($routeId){
        return $this->controller->getConnections($routeId);
    }

    public function addToConfigTotal($travelArr,$timeMasterArr,$config){
        $trains = $this->checkAmountTrains($travelArr,$timeMasterArr);
        $this->configLok += $config[0]*$trains;
        $this->configWag1 += $config[0]*$trains;
        $this->configWag2 += $config[0]*$trains;
    }

    public function checkAmountTrains($travelArr,$timeMasterArr){
        $trains = 0;
        for($i=0;$i<sizeof($timeMasterArr);$i++){
            if($travelArr[1] == $timeMasterArr['0'][1][$i]){
                $trains = $i+1;
            }
        }

        return $trains;
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
$self = new View_Timetable();
$timeWeekendArr = [
    '5:30',
    '6:00',
    '6:30',
    '7:00',
    '7:30',
    '8:00',
    '8:30',
    '9:00',
    '9:30',
    '10:00',
    '10:30',
    '11:00',
    '11:30',
    '12:00',
    '12:30',
    '13:00',
    '13:30',
    '14:00',
    '14:30',
    '15:00',
    '15:30',
    '16:00',
    '16:30',
    '17:00',
    '17:30',
    '18:00',
    '18:30',
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
/*
$weekTimeMaster = array(
    ['Montag',$timeWeekdayArr],
    ['Dienstag',$timeWeekdayArr],
    ['Mittwoch',$timeWeekdayArr],
    ['Donnerstag',$timeWeekdayArr],
    ['Freitag',$timeWeekdayArr],
    ['Samstag',$timeWeekendArr],
    ['Sonntag',$timeWeekendArr],
);*/

$weekTimeMaster = array(
    '0' => ['Wochentag',$timeWeekdayArr],
    '1' => ['Wochenende',$timeWeekendArr],
);


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
        <h2>Fahrplan</h2>

        <?php for($i=0;$i<sizeof($self->routes);$i++): ?>
        <?php $travelTimeArr = array(); ?>
        <div>
            <br>
            <h3><?php echo $self->routes[$i]->name; ?></h3>
            <?php
                //time table stuff
                $currentRoute = $self->routes[$i];
                $currentConnections = $self->getConnections($currentRoute->id);
            ?>
            <?php for($j=0;$j<sizeof($weekTimeMaster);$j++): ?>
            <div>
                <br>
                <h4><?php echo $weekTimeMaster[$j][0]; ?></h4>
                <table class="table">
                    <thead>
                    <tr>
                        <?php for($k=0;$k<sizeof($currentConnections);$k++): ?>
                        <?php if($k==0): ?>
                        <th scope="col"><?php echo $currentConnections[$k]->fromStation->name ?></th>
                        <?php else: ?>
                        <th scope="col"><?php echo $currentConnections[$k]->fromStation->name ?></th>
                        <th scope="col">&nbsp;</th>
                        <?php endif; ?>
                        <?php if($k+1 == sizeof($currentConnections)): ?>
                        <th scope="col"><?php echo $currentConnections[$k]->toStation->name ?></th>
                        <?php endif; ?>
                        <?php endfor; ?>
                    </tr>
                    <tr>
                        <?php for($k=0;$k<sizeof($currentConnections);$k++): ?>
                        <?php if($k == 0): ?>
                        <th scope="col">Ab</th>
                        <?php else: ?>
                        <th scope="col">An</th>
                        <th scope="col">Ab</th>
                        <?php endif; ?>
                        <?php if($k+1 == sizeof($currentConnections)): ?>
                        <th scope="col">An</th>
                        <?php endif; ?>
                        <?php endfor; ?>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    if($j == 0){
                        $timeMaster = $weekTimeMaster['0'][1];
                    } else {
                        $timeMaster = $weekTimeMaster['1'][1];
                    }
                    ?>
                        <?php for($l=0;$l<sizeof($timeMaster);$l++): ?>
                        <tr>
                            <?php for($k=0;$k<sizeof($currentConnections);$k++): ?>
                            <?php if($k == 0): ?>
                            <td scope="col"><?php echo $timeMaster[$l]; ?></td>
                            <?php
                                $currTimeString = $timeMaster[$l];
                                $currTime = $self->stringToMin($currTimeString);
                            ?>

                            <?php else: ?>
                            <?php
                                $traveltime = (int)$currentConnections[$k-1]->travelTime;
                                $currTime = $currTime + $traveltime;
                                $stringTime = $self->minToString($currTime);
                            ?>
                            <td scope="col"><?php echo $stringTime ?></td>
                            <?php
                                $currTime += $currentConnections[$k]->fromStation->wait;
                                $stringTime = $self->minToString($currTime);
                            ?>
                            <td scope="col"><?php echo $stringTime ?></td>
                            <?php endif; ?>

                            <?php if($k+1 == sizeof($currentConnections)): ?>
                            <?php
                                $currTime = $currTime + $traveltime;

                                $currTime -= $currentConnections[$k]->fromStation->wait;

                                $stringTime = $self->minToString($currTime);
                            ?>
                            <td scope="col"><?php echo $stringTime; ?></td>
                            <?php array_push($travelTimeArr, $stringTime) ?>
                            <?php endif; ?>

                            <?php endfor; ?>
                        </tr>
                        <?php endfor; ?>
                    </tbody>
                </table>

                <br>

                <table class="table">
                    <thead>
                    <tr>
                        <?php for($k=sizeof($currentConnections)-1;$k>=0;$k--): ?>
                            <?php if($k+1 == sizeof($currentConnections)): ?>
                                <th scope="col"><?php echo $currentConnections[$k]->toStation->name ?></th>
                            <?php else: ?>
                                <th scope="col"><?php echo $currentConnections[$k]->toStation->name ?></th>
                                <th scope="col">&nbsp;</th>
                            <?php endif; ?>
                            <?php if($k == 0): ?>
                                <th scope="col"><?php echo $currentConnections[$k]->fromStation->name ?></th>
                            <?php endif; ?>
                        <?php endfor; ?>
                    </tr>
                    <tr>
                        <?php for($k=sizeof($currentConnections)-1;$k>=0;$k--): ?>
                            <?php if($k+1 == sizeof($currentConnections)): ?>
                                <th scope="col">Ab</th>
                            <?php else: ?>
                                <th scope="col">An</th>
                                <th scope="col">Ab</th>
                            <?php endif; ?>
                            <?php if($k == 0): ?>
                                <th scope="col">An</th>
                            <?php endif; ?>
                        <?php endfor; ?>
                    </tr>
                    </thead>
                    <tbody>
                    <tbody>
                    <?php for($ll=0;$ll<sizeof($timeMaster);$ll++): ?>
                        <tr>
                            <?php for($k=sizeof($currentConnections)-1;$k>=0;$k--): ?>
                                <?php if($k+1 == sizeof($currentConnections)): ?>
                                    <td scope="col"><?php echo $timeMaster[$ll]; ?></td>
                                    <?php
                                    $currTimeString = $timeMaster[$ll];
                                    $currTime = $self->stringToMin($currTimeString);
                                    ?>

                                <?php else: ?>
                                    <?php
                                    $traveltime = (int)$currentConnections[$k+1]->travelTime;
                                    $currTime = $currTime + $traveltime;
                                    $stringTime = $self->minToString($currTime);
                                    ?>
                                    <td scope="col"><?php echo $stringTime ?></td>
                                    <?php
                                    $currTime += $currentConnections[$k]->toStation->wait;
                                    $stringTime = $self->minToString($currTime);
                                    ?>
                                    <td scope="col"><?php echo $stringTime ?></td>
                                <?php endif; ?>

                                <?php if($k <= 0): ?>
                                    <?php
                                    $traveltime = (int)$currentConnections[$k]->travelTime;
                                    $currTime = $currTime + $traveltime;

                                    //$currTime -= $currentConnections[$k]->toStation->wait;

                                    $stringTime = $self->minToString($currTime);
                                    ?>
                                    <td scope="col"><?php echo $stringTime; ?></td>
                                <?php endif; ?>

                            <?php endfor; ?>
                        </tr>
                    <?php endfor; ?>
                    </tbody>
                    </tbody>
                </table>
            </div>
            <?php endfor; ?>
        </div>
        <?php endfor; ?>
    </div>
</div>
<?php include '../res/js.php'; ?>
</body>
</html>