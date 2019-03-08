<?php
include 'res/head.php';
include 'View/Nav.php';
require 'Model/Model.php';
?>
<html>
<head>
    <title>SBB Plus</title>
</head>
<body>
    <div>
        <?php echo getNavbar(); ?>
    </div>
    <div class="wrapper">
        <div class="col-md-12" align="center">
            <button type="button" class="btn btn-dark">Zeitplan generieren</button>
        </div>
    </div>
<?php include 'res/js.php'; ?>
</body>
</html>
