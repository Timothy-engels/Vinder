<!DOCTYPE HTML>
<html lang="nl">
<head>
    <meta charset=utf-8>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no" name="viewport">
    <title>Vinder | Alle accounts</title>
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
                    <div><a href="dashboard.php"><img src="images/logo.png" alt="Vinder" class="logo-small"></a></div>
                </h1>
                <div class="section-body">
                    <div class="row">
                        <div class="col-12 col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4>Alle accounts</h4>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-striped">
                                            <thead>
                                                <tr>
                                                    <th>Naam</th>
                                                    <th>Registratie bevestigd</th>
                                                    <th>Opties</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            <?php foreach($list as $row) : ?>
                                                <tr>
                                                    <td>
                                                        <?php
                                                        $logo = "no-image.png";
                                                        if ($row->getLogo() !== null && $row->getLogo() !== '') :
                                                            $logo = $row->getLogo();
                                                        endif;
                                                        ?>
                                                        <a href="showProfile.php?id=<?= $row->getId(); ?>">
                                                            <div class="logo-wrapper-small mr-3">
                                                                <img class="rounded-circle" src="images/<?= $logo; ?>" alt="logo">
                                                            </div>
                                                            <?= $row->getName(); ?>
                                                        </a>
                                                    </td>
                                                    <td>
                                                        <?php if ($row->getConfirmed() === "1") : ?>
                                                            <div class='badge badge-success'>Bevestigd</div>
                                                        <?php else : ?>
                                                            <div class='badge badge-danger'>Niet bevestigd</div>
                                                        <?php endif; ?>
                                                    </td>
                                                    <td>
                                                        <a href="showProfile.php?id=<?= $row->getId(); ?>">
                                                            Bekijken
                                                        </a> |
                                                        <a href="account-verwijderen.php?id=<?= $row->getId(); ?>">
                                                            Verwijderen
                                                        </a>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                            </tbody>
                                        </table>
                                    </div>
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