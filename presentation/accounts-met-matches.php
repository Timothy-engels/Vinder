<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no" name="viewport">
    <title>Vinder | <?= $title; ?></title>
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
                        <div><a href="dashboard.php"><img src="images/icon.png" alt="Vinder" style="width: 2rem;"></a>&nbsp;&nbsp;<?= $title; ?></div>
                    </h1>
  
                    <div class="section-body">

                        <div class="row">
                            <div class="col-12 col-md-12">
                                <div class="card">                
                                    <div class="card-body">                    
                                      
                                        <?php if (!empty($matchedCompanies)) : ?>
                                        
                                            <div class="row">
                                                <?php foreach ($matchedCompanies as $company) : ?>
                                                    <div class="col-12 col-sm-6 col-lg-3">
                                                        <div class="card card-primary">
                                                            <div class="card-header">
                                                                <h4><?= $company->getName(); ?></h4>
                                                            </div>
                                                            <div class="card-body">
                                                                <?php
                                                                $logo = "no-image.png";
                                                                if ($company->getLogo() !== null && $company->getLogo() !== '') :
                                                                    $logo = $company->getLogo();
                                                                endif;
                                                                ?>
                                                                <div class="logo-wrapper">
                                                                    <img src="images/<?= $logo; ?>">
                                                                </div>
                                                            </div>
                                                            <div class="card-footer">
                                                                <?php if ($accountInfo === null) : ?>
                                                                    <a href="accounts-met-matches.php?id=<?= $company->getID(); ?>">
                                                                        <div class="badge badge-primary mb-2 width-100-perc"><?= $amountMatches[$company->getID()]; ?> match(es)</div> 
                                                                    </a><br/>
                                                                <?php endif; ?>
                                                                <a href="showProfile.php?id=<?= $company->getID(); ?>">
                                                                    Profiel bekijken
                                                                </a>
                                                                <?php if ($accountInfo === null) : ?>
                                                                    <br>
                                                                    <a href="accounts-met-matches.php?id=<?= $company->getID(); ?>">
                                                                        Match(es) bekijken
                                                                    </a>
                                                                <?php endif; ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                <?php endforeach; ?>
                                            </div>

                                        <?php else: ?>
                                        
                                            <p>Er zijn geen accounts gematched.</p>
                                            
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