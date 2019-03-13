<?php

require '../Controller.php';
include '../res/head.php';
include 'Nav.php';

class View_MaterialNew
{
    public $controller;

    public function __construct(){
        $this->controller = new Controller();
    }

    public function getTypes(){
        return $this->controller->getTypes();
    }

    public function addMaterial($material){
        $this->controller->addMaterial($material);
    }

}
$self = new View_MaterialNew();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $sn = $_POST['sn'];
    $dateStart = $_POST['dateStart'];
    $lastCheck = $_POST['lastCheck'];
    $nextCheck = $_POST['nextCheck'];
    $type = $_POST['type'];
    $class = $_POST['class'];
    $space = $_POST['place'];
    $available = 1;

    $material = new Model_Material($sn,$type,$dateStart,$lastCheck,$nextCheck,$available,$class,$space);
    $self->addMaterial($material);

    header("Location: View_MaterialOverview.php");
    exit();
}

//escape sepcial characters and html tags
function check_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
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
            <form name="newMaterial" action=<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?> method="post">
                <div class="form-group">
                    <label for="sn">Seriennummer</label>
                    <input type="text" class="form-control" id="sn" name="sn" required>
                </div>
                <div class="form-group">
                    <label for="dateStart">Datum Inbetriebnahme</label>
                    <input type="date" class="form-control" id="dateStart" name="dateStart" required>
                </div>
                <div class="form-group">
                    <label for="lastCheck">Letzte Revision</label>
                    <input type="date" class="form-control" id="lastCheck" name="lastCheck" required>
                </div>
                <div class="form-group">
                    <label for="nextCheck">Nächste Revision</label>
                    <input type="date" class="form-control" id="nextCheck" name="nextCheck" required>
                </div>
                <div class="form-group">
                    <?php
                    $typeArr = $self->getTypes();
                    ?>
                    <label for="type">Position</label>
                    <select class="form-control" id="type" name="type" required>
                        <?php for ($i=0;$i<sizeof($typeArr);$i++): ?>
                            <option value="<?php echo $i ?>"><?php echo $typeArr[$i] ?></option>
                        <?php endfor; ?>
                    </select>
                </div>
                <div class="form-group wagen">
                    <label for="class">Klasse</label>
                    <input type="text" class="form-control" id="class" name="class" required>
                </div>
                <div class="form-group wagen">
                    <label for="place">Platz</label>
                    <input type="text" class="form-control" id="place" name="place" required>
                </div>
                <button type="submit" class="btn btn-dark">Submit</button>
            </form>
        </div>
    </div>
</div>
<?php include '../res/js.php'; ?>
</body>
</html>