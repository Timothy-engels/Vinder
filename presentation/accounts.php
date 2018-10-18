<!DOCTYPE HTML>
<html lang="nl">
<head>
    <meta charset=utf-8>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no" name="viewport">
    <title>Vinder | Lijst gebruikers</title>
    <link rel="stylesheet" href="modules/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="modules/ionicons/css/ionicons.min.css">
    <link rel="stylesheet" href="modules/fontawesome/web-fonts-with-css/css/fontawesome-all.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/skins/vinder.css">
    <link rel="stylesheet" href="css/custom.css">
    <?php include('includes/nativeAppMeta.php'); ?>
</head>
<body>
<div id="app">
    <div class="main-wrapper">
        <?php include('includes/mainHeader.php'); ?>
        <div class="main-sidebar">
            <?php include('includes/mainSideBar.php'); ?>
        </div>
        <div class="main-content">
            <section class="section">
                <h1 class="section-header">
                    <div><a href="dashboard.php"><img src="images/icon.png" alt="Vinder" style="width: 2rem;"></a>&nbsp;&nbsp;Lijst gebruikers</div>
                </h1>
                <div class="section-body">
                    <div class="row">
                        <div class="col-12 col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4>Lijst gebruikers</h4>
                                </div>
                                <div class="card-body">
                                    <ul class="list-unstyled list-unstyled-border">
                                        <?php foreach($list as $row) : ?>
                                            <li class="media">
                                                <img class="mr-3 rounded-circle" width="50" src="images/<?= $row->getLogo(); ?>" alt="logo">
                                                <div class="media-body">
                                                    <div class="float-right">
                                                        <a href="account-verwijderen.php?id=<?php print($row->getId()); ?>">
                                                            (Delete)
                                                        </a>
                                                    </div>
                                                    <div class="media-title">
                                                        <a href="showProfile.php?id=<?=$row->getId(); ?>">
                                                            <?= $row->getName(); ?>
                                                        </a>
                                                    </div>
                                                </div>
                                            </li>
                                        <?php endforeach; ?>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
        <?php include('includes/mainFooter.php'); ?>
    </div>
</div>
</body>

<script src="modules/jquery.min.js"></script>
<script src="modules/popper.js"></script>
<script src="modules/tooltip.js"></script>
<script src="modules/bootstrap/js/bootstrap.min.js"></script>
<script src="modules/nicescroll/jquery.nicescroll.min.js"></script>
<script src="modules/scroll-up-bar/dist/scroll-up-bar.min.js"></script>
<script src="js/sa-functions.js"></script>

<script src="js/scripts.js"></script>
<script src="js/custom.js"></script>

</html>