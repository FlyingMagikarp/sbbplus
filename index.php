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
            <a class="btn btn-dark" href="#" role="button">Zeitplan generieren</a>
        </div>
        <div class="col-md-3" >
            <h1>TODO List</h1>
            <ul class="list-group">
                <li class="list-group-item">delete worker</li>
                <li class="list-group-item">add, delete material</li>
                <li class="list-group-item">add delete routes</li>
                <li class="list-group-item">add delete stations</li>
                <li class="list-group-item">modify routes with stations</li>
                <li class="list-group-item">generate Timetable</li>
                <li class="list-group-item">calc trains & workers</li>
            </ul>
        </div>
    </div>
<?php include 'res/js.php'; ?>
</body>
</html>
