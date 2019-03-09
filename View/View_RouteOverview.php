<?php

require '../Controller.php';
include '../res/head.php';
include 'Nav.php';

class View_RouteOverview
{
    public $controller;

    public function __construct(){
        $this->controller = new Controller();
    }

    public function getRoutes(){
        return $this->controller->getRoutes();
    }

    public function deleteRoute($id){
        $this->controller->deleteRoute($id);
    }

}
$self = new View_RouteOverview();
$routeData = $self->getRoutes();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if(isset($_POST['delete'])) {
        if ($_POST['delete'] == 'true') {
            $self->deleteRoute($_POST['id']);
        }
    }

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
    <div class="col-md-12 col-sm-12">
        <br>
        <div><a class="btn btn-dark" href="View_RouteNew.php" role="button">Linie erfassen</a></div>
        <br>
        <table class="table">
            <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Name</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            <?php if(sizeof($routeData) > 0): ?>
                <?php for($i=0;$i < sizeof($routeData);$i++): ?>
                    <tr>
                        <td><?php echo $routeData[$i]->id; ?></td>
                        <td><?php echo $routeData[$i]->name; ?></td>
                        <td>
                            <form name="deleteMaterial" action=<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?> method="post">
                                <input name="id" value="<?php echo $routeData[$i]->id ?>" hidden><input name="delete" value="true" hidden><button type="submit" class="btn btn-sm btn-white" onclick="return confirm('Are you sure?');"><img class="glyph" src="/sbbplus/Res/Glyph/svg/si-glyph-trash.svg"></button>
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