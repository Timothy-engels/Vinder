<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Vinder | Wijzig wachtwoord</title>
    <link rel="stylesheet" href="modules/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="modules/ionicons/css/ionicons.min.css">
    <link rel="stylesheet" href="modules/fontawesome/web-fonts-with-css/css/fontawesome-all.min.css">
    <link rel="stylesheet" href="css/style.css">    
    <link rel="stylesheet" href="css/skins/vinder.css">
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
                        <div><a href="dashboard.php"><img src="images/icon.png" alt="Vinder" style="width: 2rem;"></a>&nbsp;&nbsp;Vinder</div>
                    </h1>

                    <div class="section-body">

                        <div class="row">
                            <div class="col-12 col-md-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h4>Wachtwoord wijzigen</h4>
                                    </div>
                                    <div class="card-body">
                            
                                        <?php if (isset($registerMsg) && $registerMsg !== '') :  $registerMsg; else : ?>
                                
                                            <form name="frmUpdatePassword" method="POST" action="updatePassword.php">
                                        
                                                <?php if ($message !== '') : ?>
                                                    <div class="message"><?= $message; ?></div>
                                                <?php endif; ?>
                                        
                                                <div class="form-group">
                                                    <label for="password">Wachtwoord *</label>
                                                    <input type="password" id="password" name="password" maxlength="10" autofocus/>
                                                    
                                                    <?php if (array_key_exists('password', $errors)) : ?>
                                                        <div class="invalid-feedback"><?= $errors['password']; ?></div>
                                                    <?php endif; ?>
                                                    
                                                </div>
                                                <div class="form-group">
                                                    <label for="repeatPassword">Herhaal wachtwoord *</label>
                                                    <input type="password" id="repeatPassword" name="repeatPassword" maxlength="10" />
                                                    
                                                    <?php if (array_key_exists('repeatPassword', $errors)) : ?>
                                                        <div class="invalid-feedback"><?= $errors['repeatPassword']; ?></div>
                                                    <?php endif; ?>
                                                    
                                                </div>
                                                <div class="form-group">
                                                    <button type="submit" class="btn btn-sm btn-primary">Wijzig</button>
                                                </div>
                                            </form>
                                            <p>
                                                <small>Velden met een * zijn verplicht in te vullen.</small>
                                            </p>
                                
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