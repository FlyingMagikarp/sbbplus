<?php

require '../Controller.php';
include '../res/head.php';
include 'Nav.php';

class View_StationOverview
{
    public $controller;

    public function __construct(){
        $this->controller = new Controller();
    }

    public function getStations(){
        return $this->controller->getStations();
    }

    public function deleteStation($id){
        $this->controller->deleteStation($id);
    }

}
$self = new View_StationOverview();
$stationData = $self->getStations();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if(isset($_POST['delete'])) {
        if ($_POST['delete'] == 'true') {
            $self->deleteStation($_POST['id']);
        }
    }

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
    <div class="col-md-12 col-sm-12">
        <br>
        <div><a class="btn btn-dark" href="View_StationNew.php" role="button">Station erfassen</a></div>
        <br>
        <table class="table">
            <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Name</th>
                <th scope="col">Wartezeit</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            <?php if(sizeof($stationData) > 0): ?>
                <?php for($i=0;$i < sizeof($stationData);$i++): ?>
                    <tr>
                        <td><?php echo $stationData[$i]->id; ?></td>
                        <td><?php echo $stationData[$i]->name; ?></td>
                        <td><?php echo $stationData[$i]->wait; ?></td>
                        <td>
                            <form name="deleteMaterial" action=<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?> method="post">
                                <input name="id" value="<?php echo $stationData[$i]->id ?>" hidden><input name="delete" value="true" hidden><button type="submit" class="btn btn-sm btn-white" onclick="return confirm('Are you sure?');"><img class="glyph" src="/sbbplus/Res/Glyph/svg/si-glyph-trash.svg"></button>
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