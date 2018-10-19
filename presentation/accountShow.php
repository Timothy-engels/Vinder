<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no" name="viewport">
    <title>Vinder | Profiel bekijken</title>
    <link rel="stylesheet" href="modules/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="modules/ionicons/css/ionicons.min.css">
    <link rel="stylesheet" href="modules/fontawesome/web-fonts-with-css/css/fontawesome-all.min.css">
    <link rel="stylesheet" href="css/style.css">    
    <link rel="stylesheet" href="css/skins/vinder.css">
    <link rel="stylesheet" href="css/custom.css">
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
                                        <h4>Profiel bekijken</h4>
                                    </div>
                                    <div class="card-body">
                                        
                                        <div class="row">
                                            <div class="col-12 col-sm-8 col-md-9 col-lg-9 col-xl-10">
                                                <?php
                                                $logo = 'no-image.png';
                                                if ($account->getLogo() !== null && $account->getLogo() !== '') {
                                                    $logo = $account->getLogo();
                                                }
                                                ?>
                                                <img style="vertical-align:middle; max-height: 3rem; max-width: 3rem;" src="images/<?= $logo; ?>">
                                                <span class="h6"><?= $account->getName(); ?></span>
                                            </div>
                                            <?php if ($loggedInAccount->getAdministrator() === "1") : ?>
                                                <div class="col-12 col-sm-4 col-md-3 col-lg-3 col-xl-2">
                                                    <?php if ($account->getConfirmed() === "1") : ?>
                                                        <div class='badge badge-success'>Bevestigd</div>
                                                    <?php else : ?>
                                                        <div class='badge badge-danger'>Niet bevestigd</div>
                                                    <?php endif; ?>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                        
                                        <?php if ($account->getInfo() !== null && $account->getInfo() !== '') : ?>
                                            <p class="mt-3"><?= $account->getInfo(); ?></p>
                                        <?php endif; ?>
                                    </div>
                                            
                                    <div class="card-header">
                                        <h4>Contactgegevens</h4>
                                    </div>
                                       
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-12 col-sm-4 col-md-3 col-lg-3 col-xl-2">
                                                Contactpersoon
                                            </div>
                                            <div class="col-12 col-sm-8 col-md-9 col-lg-9 col-xl-10">
                                                <?= $account->getContactPerson(); ?>
                                            </div>
                                        </div>
                                        
                                        <div class="row">
                                            <div class="col-12 col-sm-4 col-md-3 col-lg-3 col-xl-2">
                                                E-mail
                                            </div>
                                            <div class="col-12 col-sm-8 col-md-9 col-lg-9 col-xl-10">
                                                <?= $account->getEmail(); ?>
                                            </div>
                                        </div>
                                        
                                        <div class="row">
                                            <div class="col-12 col-sm-4 col-md-3 col-lg-3 col-xl-2">
                                                Website
                                            </div>
                                            <div class="col-12 col-sm-8 col-md-9 col-lg-9 col-xl-10">
                                                <?php if ($account->getWebsite()) : ?>
                                                    <a href="<?= $account->getWebsite(); ?>" target="_blank">
                                                        <?= $account->getWebsite(); ?>
                                                    </a>
                                                <?php endif; ?>
                                            </div>
                                        </div>   
                                    </div>
                                    
                                    <div class="card-header">
                                        <h4>Expertises</h4>
                                    </div>
                                    
                                    <div class="card-body">
                                        
                                        <?php if ($exps || $extraExp) : ?>
                                        
                                            <ul>

                                                <?php foreach ($exps as $expertise) : ?>
                                                    <li>
                                                        <strong><?= $expertise->getExpertise(); ?></strong>
                                                        <?php
                                                        if ($expertise->getInfo()) {
                                                            echo '<br>' . $expertise->getInfo();
                                                        }
                                                        ?>
                                                    </li>
                                                <?php endforeach; ?>
                                                    
                                                <?php if ($extraExp) :?>
                                                    <li>
                                                        <strong><?= $extraExp->getExpertise(); ?></strong>
                                                        <?php
                                                        if ($extraExp->getInfo()) {
                                                            echo '<br>' . $extraExp->getInfo();
                                                        }
                                                        ?>
                                                    </li>
                                                <?php endif; ?>

                                            </ul>
                                        
                                        <?php else: ?>
                                        
                                            <p>Geen expertises gevonden!</p>
                                            
                                        <?php endif; ?>
                                            
                                    </div>
                                    
                                    
                                    <div class="card-header">
                                        <h4>Gewenste expertises</h4>
                                    </div>
                                    
                                    <div class="card-body">
                                        
                                        <?php if ($expExps || $extraExpExp) : ?>
                                        
                                            <ul>

                                                <?php foreach ($expExps as $expertise) : ?>
                                                    <li>
                                                        <strong><?= $expertise->getExpertise(); ?></strong>
                                                        <?php
                                                        if ($expertise->getInfo()) {
                                                            echo '<br>' . $expertise->getInfo();
                                                        }
                                                        ?>
                                                    </li>
                                                <?php endforeach; ?>
                                                    
                                                <?php if ($extraExpExp) :?>
                                                    <li>
                                                        <strong><?= $extraExpExp->getExpertise(); ?></strong>
                                                        <?php
                                                        if ($extraExpExp->getInfo()) {
                                                            echo '<br>' . $extraExpExp->getInfo();
                                                        }
                                                        ?>
                                                    </li>
                                                <?php endif; ?>

                                            </ul>
                                        
                                        <?php else: ?>
                                        
                                            <p>Geen expertises gevonden!</p>
                                            
                                        <?php endif; ?>
                                            
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
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