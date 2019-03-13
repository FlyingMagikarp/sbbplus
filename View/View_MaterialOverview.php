<?php

require '../Controller.php';
include '../res/head.php';
include 'Nav.php';

class View_MaterialOverview
{
    public $controller;

    public function __construct(){
        $this->controller = new Controller();
    }

    // gets all workers
    public function getMaterials(){
        return $this->controller->getMaterials();
    }

    // updates material's availability
    public function updateAvailable($val, $id){
        $this->controller->updateAvailable($val,$id);
    }

    public function deleteMaterial($id){
        $this->controller->deleteMaterial($id);
    }

}
$self = new View_MaterialOverview();
$materialData = $self->getMaterials();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if(isset($_POST['set'])) {
        if ($_POST['set'] == 'true') {
            $self->updateAvailable(true, $_POST['id']);
        } elseif ($_POST['set'] == 'false') {
            $self->updateAvailable(false, $_POST['id']);
        }
    }

    if(isset($_POST['delete'])) {
        if ($_POST['delete'] == 'true') {
            $self->deleteMaterial($_POST['id']);
        }
    }

    header("Location: View_MaterialOverview.php");
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
        <div><a class="btn btn-dark" href="View_MaterialNew.php" role="button">Material erfassen</a></div>
        <br>
        <table class="table">
            <thead>
            <tr>
                <th scope="col">SerienNummer</th>
                <th scope="col">Typ</th>
                <th scope="col">Datum Inbetriebnahme</th>
                <th scope="col">Letzte Revision</th>
                <th scope="col">Nächste Revision</th>
                <th class="materialWagen" scope="col">Klasse</th>
                <th class="materialWagen" scope="col">Platz</th>
                <th scope="col">Verfügbar</th>
            </tr>
            </thead>
            <tbody>
            <?php if(sizeof($materialData) > 0): ?>
                <?php for($i=0;$i < sizeof($materialData);$i++): ?>
                    <tr>
                        <td><?php echo $materialData[$i]->sn; ?></td>
                        <td><?php echo $materialData[$i]->type; ?></td>
                        <td><?php echo $materialData[$i]->dateStart; ?></td>
                        <td><?php echo $materialData[$i]->lastCheck; ?></td>
                        <td><?php echo $materialData[$i]->nextCheck; ?></td>
                        <td><?php echo $materialData[$i]->class; ?></td>
                        <td><?php echo $materialData[$i]->space; ?></td>
                        <td>
                            <?php if($materialData[$i]->available == true): ?>
                                <form name="setAvailableTrue" action=<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?> method="post">
                                    <img class="glyph" src="/sbbplus/Res/Glyph/svg/si-glyph-checked.svg"/>
                                    <input name="id" value="<?php echo $materialData[$i]->id ?>" hidden><input name="set" value="false" hidden><button type="submit" class="btn btn-sm btn-dark">Change</button>
                                </form>
                            <?php else: ?>
                                <form name="setAvailableFalse" action=<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?> method="post">
                                    <img class="glyph" src="/sbbplus/Res/Glyph/svg/si-glyph-delete.svg"/>
                                    <input name="id" value="<?php echo $materialData[$i]->id ?>" hidden><input name="set" value="true" hidden><button type="submit" class="btn btn-sm btn-dark">Change</button>
                                </form>
                            <?php endif; ?>
                        </td>
                        <td>
                            <form name="deleteMaterial" action=<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?> method="post">
                                <input name="id" value="<?php echo $materialData[$i]->id ?>" hidden><input name="delete" value="true" hidden><button type="submit" class="btn btn-sm btn-white" onclick="return confirm('Are you sure?');"><img class="glyph" src="/sbbplus/Res/Glyph/svg/si-glyph-trash.svg"></button>
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