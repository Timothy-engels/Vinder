<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no" name="viewport">
    <title>Vinder | Mijn matches</title>
    <link rel="stylesheet" href="modules/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="modules/ionicons/css/ionicons.min.css">
    <link rel="stylesheet" href="modules/fontawesome/web-fonts-with-css/css/fontawesome-all.min.css">
    <link rel="stylesheet" href="style/swipe.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/skins/vinder.css">
    <link rel="stylesheet" href="style/swipe.css">
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
            <?php include('includes/mainHeader.php'); ?>
            <div class="main-sidebar">
                <?php include('includes/mainSideBar.php'); ?>
            </div>
            <div class="main-content">
                <section class="section">
                    <h1 class="section-header">
                        <div><a href="dashboard.php"><img src="images/icon.png" alt="Vinder" style="width: 2rem;"></a>&nbsp;&nbsp;Mijn matches</div>
                    </h1>
                    <div class="section-body">

                        <div class="row">
                            <div class="col-12 col-md-12">
                                <div class="card">                
                                    <div class="card-body"> 
                                        
                                        <?php if (!empty($matchedAccounts)) : ?>
                                        
                                            <div class="row">
                                                
                                                <?php foreach ($matchedAccounts as $account) : ?>
                                                
                                                    <div class="col-12 col-sm-6 col-lg-3">
                                                        <div class="card card-primary">
                                                            <div class="card-header">
                                                                <h4><?= $account->getName(); ?></h4>
                                                            </div>
                                                            <div class="card-body">
                                                                <?php
                                                                $logo = "no-image.png";
                                                                if ($account->getLogo() !== null && $account->getLogo() !== '') :
                                                                    $logo = $account->getLogo();
                                                                endif; ?>
                                                                <div class="logo-wrapper">
                                                                    <img src="images/<?= $logo; ?>">
                                                                </div>
                                                            </div>
                                                            <div class="card-footer">
                                                                <a href="showProfile.php?id=<?= $account->getID(); ?>">
                                                                    Profiel bekijken
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>      
                                                
                                                <?php endforeach; ?>
                                                
                                            </div>
                                                                                        
                                        <?php else: ?>
                                            <p>Er zijn nog geen accounts gemachted aan je profiel.</p>
                                        <?php endif; ?>
                                            
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

    <script src="modules/jquery.min.js"></script>
    <script src="modules/popper.js"></script>
    <script src="modules/tooltip.js"></script>
    <script src="modules/bootstrap/js/bootstrap.min.js"></script>
    <script src="modules/nicescroll/jquery.nicescroll.min.js"></script>
    <script src="modules/scroll-up-bar/dist/scroll-up-bar.min.js"></script>
    <script src="js/sa-functions.js"></script>

    <script src="js/scripts.js"></script>
    <script src="js/custom.js"></script>        
</body>