<div class="navbar-bg"></div>
<nav class="navbar navbar-expand-lg main-navbar">
    <form class="form-inline mr-auto">
        <ul class="navbar-nav mr-3">
            <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="ion ion-navicon-round"></i></a></li>
        </ul>
    </form>
    <ul class="navbar-nav navbar-right">
        <li>
            <a href="#" class="nav-link nav-link-lg">
                <div class="d-sm-none d-lg-inline-block">Welkom, <?= $loggedInAccount->getContactPerson(); ?></div>
            </a>
        </li>
    </ul>
</nav>
            