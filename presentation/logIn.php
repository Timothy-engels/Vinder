<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no" name="viewport">
    <title>Vinder | Log in</title>
    <link rel="stylesheet" href="modules/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="modules/ionicons/css/ionicons.min.css">
    <link rel="stylesheet" href="modules/fontawesome/web-fonts-with-css/css/fontawesome-all.min.css">
    <link rel="stylesheet" href="css/style.css">    
    <link rel="stylesheet" href="css/skins/vinder.css">
    <link rel="stylesheet" href="css/custom.css">
</head>

<body>
    <div id="app">
        <section class="section">
            <div class="container mt-5">
                <div class="row">
                    <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
                        <div class="login-brand">
                            <img src="images/logo.png" alt="Vinder" class="logo-middle">
                        </div>

                        <div class="card card-primary">
                            <div class="card-header"><h4>Login</h4></div>

                            <div class="card-body">
                                <form method="POST" action="logIn.php" class="needs-validation" novalidate="">
                                    
                                    <?php
                                    if (array_key_exists('general', $errors)) : ?>
                                        <div class="alert alert-danger"><i class="ion ion-android-alert"></i> <?= $errors['general']; ?></div>
                                    <?php endif; ?>

                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input id="mail" type="email" class="form-control <?php if (array_key_exists('mail', $errors)) : ?>is-invalid<?php endif; ?>" name="mail" tabindex="1" value="<?= $mail; ?>" required autofocus >
                                        
                                        <?php if (array_key_exists('mail', $errors)) : ?>
                                            <div class="invalid-feedback"><?= $errors['mail']; ?></div>
                                        <?php endif; ?>
                                        
                                    </div>

                                    <div class="form-group">
                                        <label for="password" class="d-block">Wachtwoord
                                            <div class="float-right">
                                                <a href="wachtwoord-vergeten.php">Wachtwoord vergeten?</a>
                                            </div>
                                        </label>
                                        <input id="pass" type="password" class="form-control <?php if (array_key_exists('pass', $errors)) : ?>is-invalid<?php endif; ?>" name="pass" tabindex="2" required>

                                        <?php if (array_key_exists('pass', $errors)) : ?>
                                            <div class="invalid-feedback"><?= $errors['pass']; ?></div>
                                        <?php endif; ?>
                                        
                                    </div>

                                    <div class="form-group">
                                        <input type="submit" class="btn btn-sm btn-primary" tabindex="4" value="Login">
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="mt-5 text-muted text-center">
                            Nog geen account? <a href="registreren.php">Registreer nu!</a>
                        </div>
                        <?php include('includes/mainFooter.php'); ?>
                    </div>
                </div>
            </div>
        </section>
    </div>
</body>
</html>