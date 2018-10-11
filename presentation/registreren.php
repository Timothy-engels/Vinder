<!DOCTYPE html>
<html lang="nl">
    <head>
        <meta charset="UTF-8">
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no" name="viewport">
        <title>Vinder | Registreer</title>
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
                        <div class="col-12 col-sm-10 offset-sm-1 col-md-8 offset-md-2 col-lg-8 offset-lg-2 col-xl-8 offset-xl-2">
                            <div class="login-brand"><a href="logIn.php"><img src="images/logo.png" alt="Vinder" style="width: 15rem;"></a></div>

                            <div class="card card-primary">
                                <div class="card-header"><h4>Registreren</h4></div>

                                <div class="card-body">
                                    
                                    <?php if (isset($registerMsg) && $registerMsg !== '') : ?>
                                    
                                        <?= $registerMsg; ?>
                                    
                                    <?php else : ?>
                                    
                                        <form name="frmRegister" method="POST" action="registreren.php">
                                            <div class="form-group">
                                                <label for="name">Bedrijfsnaam *</label>
                                                <input type="text" id="name" name="name" class="form-control <?php if (array_key_exists('name', $errors)) : ?>is-invalid <?php endif; ?>" maxlength="255" value="<?= $name; ?>" autofocus />
                                                
                                                <?php if (array_key_exists('name', $errors)) : ?>
                                                    <div class="invalid-feedback"><?= $errors['name']; ?></div>
                                                <?php endif; ?>
                                                
                                            </div>

                                            <div class="form-group">  
                                                <label for="contactPerson">Contactpersoon *</label>
                                                <input type="text" id="contactPerson" name="contactPerson" class="form-control <?php if (array_key_exists('contactPerson', $errors)) : ?>is-invalid <?php endif; ?>" maxlength="255" value="<?= $contactPerson; ?>" />
                                                
                                                <?php if (array_key_exists('contactPerson', $errors)) : ?>
                                                    <div class="invalid-feedback"><?= $errors['contactPerson']; ?></div>
                                                <?php endif; ?>
                                                
                                            </div>

                                            <div class="form-group">
                                                <label for="email">Email *</label>
                                                <input type="email" id="email" name="email" class="form-control <?php if (array_key_exists('email', $errors)) : ?>is-invalid <?php endif; ?>" maxlength="255" value="<?= $email; ?>" />
                                                
                                                <?php if (array_key_exists('email', $errors)) : ?>
                                                    <div class="invalid-feedback"><?= $errors['email']; ?></div>
                                                <?php endif; ?>
                                                
                                            </div>

                                            <div class="form-group">
                                                <label for="password">Wachtwoord *</label>
                                                <input type="password" id="password" class="form-control <?php if (array_key_exists('password', $errors)) : ?>is-invalid <?php endif; ?>" name="password" maxlength="50" />
                                                
                                                <?php if (array_key_exists('password', $errors)) : ?>
                                                    <div class="invalid-feedback"><?= $errors['password']; ?></div>
                                                <?php endif; ?>
                                                
                                            </div>
                                            
                                            <div class="form-group">
                                                <label for="repeatPassword">Herhaal wachtwoord *</label>
                                                <input type="password" id="repeatPassword" class="form-control <?php if (array_key_exists('repeatPassword', $errors)) : ?>is-invalid <?php endif; ?>" name="repeatPassword" maxlength="50" />
                                                
                                                <?php if (array_key_exists('repeatPassword', $errors)) : ?>
                                                    <div class="invalid-feedback"><?= $errors['repeatPassword']; ?></div>
                                                <?php endif; ?>
                                                
                                            </div>

                                            <div class="form-group">
                                                <button type="submit" class="btn btn-sm btn-primary">Registeer</button>
                                            </div>
                                        </form>
                                    
                                    <?php endif; ?>
                                </div>
                            </div>
                            <?php include('includes/mainFooter.php'); ?>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </body>
</html>
