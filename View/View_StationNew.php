<?php

require '../Controller.php';
include '../res/head.php';
include 'Nav.php';

class View_StationNew
{
    public $controller;

    public function __construct(){
        $this->controller = new Controller();
    }

    public function addStation($station){
        $this->controller->addStation($station);
    }
}
$self = new View_StationNew();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $wait = $_POST['wait'];

    $station = new Model_Station($name,$wait);
    $self->addStation($station);

    header("Location: View_StationOverview.php");
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
                    <label for="wait">Wartezeit</label>
                    <input type="text" class="form-control" id="wait" name="wait" required>
                </div>
                <button type="submit" class="btn btn-dark">Submit</button>
            </form>
        </div>
    </div>
</div>
<?php include '../res/js.php'; ?>
</body>
</html>
