<?php

require '../Controller.php';
include '../res/head.php';
include 'Nav.php';

class View_WorkerNew
{
    public $controller;

    public function __construct(){
        $this->controller = new Controller();
    }

    public function getRoles(){
        return $this->controller->getRoles();
    }

    public function addWorker($worker){
        $this->controller->addWorker($worker);
    }

}
$self = new View_WorkerNew();

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $workerId = $_POST['workerId'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $role = $_POST['role'];
    $worker = new Model_Worker($workerId,$firstname,$lastname,$role);

    $self->addWorker($worker);

    header("Location: View_WorkerOverview.php");
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
        <div><a class="btn btn-dark" href="View_WorkerNew.php" role="button">Arbeiter erfassen</a></div>
        <br>
        <form name="newWorker" action=<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?> method="post">
            <div class="form-group">
                <label for="workerId">Personalnummer</label>
                <input type="text" class="form-control" id="workerId" name="workerId" required>
            </div>
            <div class="form-group">
                <label for="firstname">Vorname</label>
                <input type="text" class="form-control" id="firstname" name="firstname" required>
            </div>
            <div class="form-group">
                <label for="lastname">Nachname</label>
                <input type="text" class="form-control" id="lastname" name="lastname" required>
            </div>
            <div class="form-group">
                <?php
                    $roleArr = $self->getRoles();
                ?>
                <label for="role">Position</label>
                <select class="form-control" id="role" name="role" required>
                    <?php for ($i=0;$i<sizeof($roleArr);$i++): ?>
                    <option><?php echo $roleArr[$i] ?></option>
                    <?php endfor; ?>
                </select>
            </div>
            <button type="submit" class="btn btn-dark">Submit</button>
        </form>
    </div>
    </div>
</div>
<?php include '../res/js.php'; ?>
</body>
</html>