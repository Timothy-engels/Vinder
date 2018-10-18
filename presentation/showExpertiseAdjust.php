<!DOCTYPE HTML>
<html lang="nl">
<head>
    <meta charset=utf-8>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no" name="viewport">
    <title>Vinder | Profiel wijzigen</title>
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
                                        <h4>Expertise wijzigen</h4>
                                    </div>
                                    <div class="card-body">
                            
                                        <?php if (isset($registerMsg) && $registerMsg !== '') :  $registerMsg; else : ?>
                                
                                            <form name="frmExpAdjust" method="POST" action="expertiseAdjust.php?eaid=<?=$eaid;?>">
                                        
                                                <div class="form-group">
                                                    <label for="expertise">Expertise *</label>
                                                    <input type="text" id="expertise" name="expertise" class="form-control <?php if ($expertiseNameErrors !== '') : ?>is-invalid<?php endif; ?>" value="<?= $expertiseName; ?>" autofocus/>
                                                    <?php if ($expertiseNameErrors !== '') : ?>
                                                        <div class="invalid-feedback"><?= $expertiseNameErrors; ?></div>
                                                    <?php endif; ?>
                                                </div>
                                                
                                                <div class="form-group">
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" class="custom-control-input" id="active" name="active" value="1" <?php if ($expertiseActive === "1") { echo "checked"; } ?>>
                                                        <label class="custom-control-label" for="active">Actief</label>
                                                    </div>
                                                </div>
                                                
                                                <div class="form-group">
                                                    <button type="submit" class="btn btn-sm btn-primary">Wijzigen</button>
                                                </div>
                                                
                                            </form>
                                        
                                            <p><small>Velden met een * zijn verplicht in te vullen.</small></p>
                                
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