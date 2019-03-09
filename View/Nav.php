<?php
function getNavbar(){
    return ('
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="/sbbplus">Ländliche Ostbahnen AG</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        
        
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="/sbbplus/View/View_WorkerOverview.php">Personal</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/sbbplus/View/View_MaterialOverview.php">Material</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/sbbplus/View/View_RouteOverview.php">Linien</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/sbbplus/View/View_StationOverview.php">Stationen</a>
                </li>
            </ul>
        </div>
    </nav>
    ');
}
?>