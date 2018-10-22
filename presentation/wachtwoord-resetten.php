<!DOCTYPE html>
<html lang="nl">
    <head>
        <meta charset="UTF-8">
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no" name="viewport">
        <title>Vinder | Wachtwoord resetten</title>
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
            <section class="section">
                <div class="container mt-5">
                    <div class="row">
                        <div class="col-12 col-sm-10 offset-sm-1 col-md-8 offset-md-2 col-lg-8 offset-lg-2 col-xl-8 offset-xl-2">
                            <div class="login-brand"><a href="logIn.php"><img src="images/logo.png" alt="Vinder" style="width: 15rem;"></a></div>

                            <div class="card card-primary">
                                <div class="card-header"><h4>Wachtwoord resetten</h4></div>

                                <div class="card-body">
                                    
                                    <?php if (isset($message) && $message !== '') : ?>
                                    
                                        <?= $message; ?>
                                    
                                    <?php else : ?>
                                    
                                        <form name="frmWachtwoordResetten" method="POST" action="wachtwoord-resetten.php?code=<?= $code; ?>">

                                            <div class="form-group">
                                                <label for="password">Wachtwoord <i class="ion ion-android-star"></i></label>
                                                <input type="password" id="password" class="form-control <?php if (array_key_exists('password', $errors)) : ?>is-invalid <?php endif; ?>" name="password" maxlength="50" />
                                                <?php if (array_key_exists('password', $errors)) : ?>
                                                    <div class="invalid-feedback"><?= $errors['password']; ?></div>
                                                <?php endif; ?>
                                            </div>
                                            
                                            <div class="form-group">
                                                <label for="repeatPassword">Herhaal wachtwoord <i class="ion ion-android-star"></i></label>
                                                <input type="password" id="repeatPassword" class="form-control <?php if (array_key_exists('repeatPassword', $errors)) : ?>is-invalid <?php endif; ?>" name="repeatPassword" maxlength="50" />
                                                <?php if (array_key_exists('repeatPassword', $errors)) : ?>
                                                    <div class="invalid-feedback"><?= $errors['repeatPassword']; ?></div>
                                                <?php endif; ?>
                                            </div>

                                            <div class="form-group">
                                                <button type="submit" class="btn btn-sm btn-primary">Reset</button>
                                            </div>
                                            
                                            <p class="text-muted italic"><small>Velden met een <i class="ion ion-android-star"></i> zijn verplicht in te vullen.</small></p>

                                        </form>
                                    
                                    <?php endif; ?>
                                </div>
                            </div>
                            <?php include('includes/simpleFooter.php'); ?>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </body>
</html>
