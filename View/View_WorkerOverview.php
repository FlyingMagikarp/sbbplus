<?php

require '../Controller.php';
include '../res/head.php';
include 'Nav.php';

class View_WorkerOverview
{
    public $controller;

    public function __construct(){
        $this->controller = new Controller();
    }

    // gets all workers
    public function getWorkers(){
        return $this->controller->getWorkers();
    }

    // updates worker's Absent status
    public function updateAbsent($val, $id){
        $this->controller->updateAbsent($val,$id);
    }
}
$self = new View_WorkerOverview();
$workerData = $self->getWorkers();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if($_POST['set'] == 'true'){
        $self->updateAbsent(true,$_POST['id']);
    } elseif($_POST['set'] == 'false') {
        $self->updateAbsent(false,$_POST['id']);
    }

    header("Location: View_WorkerOverview.php");
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
            <div><a class="btn btn-dark" href="View_WorkerNew.php" role="button">Arbeiter erfassen</a></div>
            <br>
            <table class="table">
                <thead>
                <tr>
                    <th scope="col">Personalnummer</th>
                    <th scope="col">Vorname</th>
                    <th scope="col">Nachname</th>
                    <th scope="col">Position</th>
                    <th scope="col">Anwesend</th>
                </tr>
                </thead>
                <tbody>
                <?php if(sizeof($workerData) > 0): ?>
                <?php for($i=0;$i < sizeof($workerData);$i++): ?>
                <tr>
                    <td><?php echo $workerData[$i]->workerID; ?></td>
                    <td><?php echo $workerData[$i]->firstname; ?></td>
                    <td><?php echo $workerData[$i]->lastname; ?></td>
                    <td><?php echo $workerData[$i]->role; ?></td>
                    <td>
                        <?php if($workerData[$i]->absent == false): ?>
                            <form name="setAbsentTrue" action=<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?> method="post">
                                <img class="glyph" src="/sbbplus/Res/Glyph/svg/si-glyph-checked.svg"/>
                                <input name="id" value="<?php echo $workerData[$i]->id ?>" hidden><input name="set" value="true" hidden><button type="submit" class="btn btn-sm btn-dark">Change</button>
                            </form>
                        <?php else: ?>
                            <form name="setAbsentFalse" action=<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?> method="post">
                                <img class="glyph" src="/sbbplus/Res/Glyph/svg/si-glyph-delete.svg"/>
                                <input name="id" value="<?php echo $workerData[$i]->id ?>" hidden><input name="set" value="false" hidden><button type="submit" class="btn btn-sm btn-dark">Change</button>
                            </form>
                        <?php endif; ?>
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