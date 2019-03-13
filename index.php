<?php
include 'res/head.php';
include 'View/Nav.php';
?>
<html>
<head>
    <title>SBB Plus</title>
</head>
<body>
    <div>
        <?php echo getNavbar(); ?>
    </div>
    <div class="container-fluid" align="center">
        <div class="col-md-12" align="center">
            <br>
            <a class="btn btn-dark" href="View/View_Timetable.php" role="button">Zeitplan generieren</a>
            <br>
            <br>
            <a class="btn btn-dark" href="View/View_MaterialCheck.php" role="button">Material Prüfen</a>
        </div>
    </div>
<?php include 'res/js.php'; ?>
</body>
</html>
