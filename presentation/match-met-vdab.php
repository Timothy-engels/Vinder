<!DOCTYPE html>
<html lang="nl">
    <head>
        <meta charset="UTF-8">
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no" name="viewport">
        <title>Vinder | Match met VDAB</title>
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
                                            <h4>Match met VDAB</h4>
                                        </div>
                                        <div class="card-body">
                                            
                                            <?php if ($message !== '') : ?>
                                                <p><?= $message?></p>
                                            <?php else : ?>
            
                                                <form action="match-met-vdab.php" method="post">

                                                    <p>Geef je wachtwoord in om de accounts zonder matches te matchen met de VDAB.</p>
                                                    
                                                    <div class="form-group">
                                                        
                                                        <label for="password">Wachtwoord <i class="ion ion-android-star"></i></label>
                                                        <input type="password" id="password" name="password" class="form-control <?php if (array_key_exists('password', $errors)) : ?>is-invalid<?php endif; ?>" autofocus/>
                                                        <?php if (array_key_exists('password', $errors)) : ?>
                                                            <div class="invalid-feedback"><?= $errors['password']; ?></div>
                                                        <?php endif; ?>

                                                    </div>
                                                    
                                                    <div class="form-group">
                                                        <input type="submit" class="btn btn-sm btn-primary mt-2 mb-3" name="submit" value="Match met VDAB">
                                                    </div>
                                                    
                                                    <p class="text-muted italic"><small>Velden met een <i class="ion ion-android-star"></i> zijn verplicht in te vullen.</small></p>
                                                </form>
                                                
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