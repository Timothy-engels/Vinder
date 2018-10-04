<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Vinder | Wijzig wachtwoord</title>
    <style>
        label, input, .error {
            display: block;
        }
        
        .error {
            color: red;
            font-weight: bold;
        }
        
        .message {
            color: green;
            font-weight: bold;
        }
    </style>
    <link rel="stylesheet" href="modules/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="modules/ionicons/css/ionicons.min.css">
    <link rel="stylesheet" href="modules/fontawesome/web-fonts-with-css/css/fontawesome-all.min.css">
    <link rel="stylesheet" href="css/style.css">    
    <link rel="stylesheet" href="css/skins/vinder.css">
</head>
<body>
    
    <?php
    if ($showMenu) {
        include('menu.php');
    }
    ?>
    
    <div id="app">
        <section class="section">
            <div class="container mt-5">
                <div class="row">
                    <div class="col-12 col-sm-10 offset-sm-1 col-md-8 offset-md-2 col-lg-8 offset-lg-2 col-xl-8 offset-xl-2">
                        <div class="login-brand">
                            <a href="logIn.php"><img src="images/logo.png" alt="Vinder" style="width: 15rem;"></a>
                        </div>
                        <div class="card card-primary">
                            <div class="card-header">
                                <h4>Wachtwoord wijzigen</h4>
                            </div>
                            <div class="card-body">
                            
                                <?php if (isset($registerMsg) && $registerMsg !== '') :  $registerMsg; else : ?>
                                
                                    <form name="frmRegister" method="POST" action="updatePassword.php">
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
                                            <button type="submit" class="btn btn-primary btn-block">Wijzig</button>
                                        </div>
                                    </form>
                                    <p>
                                        <small>Velden met een * zijn verplicht in te vullen.</small>
                                    </p>
                                
                                <?php endif; ?>
                                
                            </div>
                        </div>
                        <div class="simple-footer">
                            Copyright &copy; VDAB 2018
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</body>    
</html>