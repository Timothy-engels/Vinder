<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no" name="viewport">
    <title>Vinder | Wijzig de datum instellingen</title>    
    <link rel="stylesheet" href="modules/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="modules/ionicons/css/ionicons.min.css">
    <link rel="stylesheet" href="modules/fontawesome/web-fonts-with-css/css/fontawesome-all.min.css">
    <link rel="stylesheet" href="css/style.css">    
    <link rel="stylesheet" href="css/skins/vinder.css">
    <link rel="stylesheet" href="css/custom.css">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
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
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h4>Datums wijzigen</h4>
                                    </div>
                                    <div class="card-body">
                            
                                        <?php if (isset($registerMsg) && $registerMsg !== '') :  $registerMsg; else : ?>
                                
                                            <form name="frmRegisterDate" method="POST" action="updateDateSettings.php">
                                        
                                                <?php if ($message !== '') : ?>
                                                    <div class="alert alert-success"><?= $message; ?></div>
                                                <?php endif; ?>
                                        
                                                <div class="form-group">
                                                    <label for="registerDate" class="d-block">Einddatum registratie / Startdatum swipen <i class="ion ion-android-star"></i></label>
                                                    <input type="text" id="registerDate" class="form-control <?php if (array_key_exists('registerDate', $errors)) : ?>is-invalid<?php endif; ?>" name="registerDate" maxlength/>
                                                    
                                                    <?php if (array_key_exists('registerDate', $errors)) : ?>
                                                        <div class="invalid-feedback"><?= $errors['registerDate']; ?></div>
                                                    <?php endif; ?>
                                                    
                                                </div>
                                                <div class="form-group">
                                                    <label for="swipeDate" class="d-block">Einddatum swipen <i class="ion ion-android-star"></i></label>
                                                    <input type="text" id="swipeDate" class="form-control <?php if (array_key_exists('swipeDate', $errors)) : ?>is-invalid<?php endif; ?>" name="swipeDate" maxlength="10" />
                                                    
                                                    <?php if (array_key_exists('swipeDate', $errors)) : ?>
                                                        <div class="invalid-feedback"><?= $errors['swipeDate']; ?></div>
                                                    <?php endif; ?>
                                                    
                                                </div>
                                                <div class="form-group">
                                                    <button type="submit" class="btn btn-sm btn-primary mt-2 mb-3">Wijzig</button>
                                                </div>
                                            </form>
                                        
                                            <p class="text-muted italic"><small>Velden met een <i class="ion ion-android-star"></i> zijn verplicht in te vullen.</small></p>
                                
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
   
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

<script>
    // werkt niet wegens eerdere comment
    $(document).ready(function() {
        $("#registerDate").datepicker({
            dateFormat: "dd-mm-yy"
        });

        $("#swipeDate").datepicker({
            dateFormat: "dd-mm-yy"
        });

        $("#registerDate").datepicker("setDate", "<?= $registerDate; ?>");
        $("#swipeDate").datepicker("setDate", "<?= $swipeDate; ?>");


     });
</script>

</html>

