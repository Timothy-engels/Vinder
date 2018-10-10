<!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8">
    <title>Vinder | Lijst gebruikers</title>
    <link rel="stylesheet" href="modules/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="modules/ionicons/css/ionicons.min.css">
    <link rel="stylesheet" href="modules/fontawesome/web-fonts-with-css/css/fontawesome-all.min.css">
    <link rel="stylesheet" href="css/style.css">    
    <link rel="stylesheet" href="css/skins/vinder.css">
</head>
<body>
    <div id="app">
        <div class="main-wrapper">
            <?php //include('includes/mainHeader.php'); ?>
            <div class="main-sidebar">
                <?php //include('includes/mainSideBar.php'); ?>
            </div>
            <div class="main-content">
                <section class="section">
                    <h1 class="section-header">
                        <div><a href="dashboard.php"><img src="images/icon.png" alt="Vinder" style="width: 2rem;"></a>&nbsp;&nbsp;Vinder</div>
                    </h1>
                    <div class="section-body">
                        <div class="row">
                            <div class="col-12 col-md-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h4>Lijst Gebruikers</h4>
                                    </div>
                                    <div class="card-body">
                                        <ul class="list-unstyled list-unstyled-border">
                                            <?php foreach($list as $row) : ?>
                                                <li class="media">
                                                    <img class="mr-3 rounded-circle" width="50" src="images/<?= $row->getLogo(); ?>" alt="logo">
                                                    <div class="media-body">
                                                        <div class="float-right">
                                                            <a href="deleteAccount.php?id=<?php print($row->getId()); ?>">
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
</html>