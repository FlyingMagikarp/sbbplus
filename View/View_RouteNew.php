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

    public function  addRoute($route){

    }
}
$self = new View_RouteNew();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];

    $route = new Model_RouteData($name);
    $self->addRoute($route);

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
                <button type="submit" class="btn btn-dark">Submit</button>
            </form>
        </div>
    </div>
</div>
<?php include '../res/js.php'; ?>
</body>
</html>
