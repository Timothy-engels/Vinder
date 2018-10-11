<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Vinder | Contactpersoon wijzigen</title>
    <link rel="stylesheet" href="modules/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="modules/ionicons/css/ionicons.min.css">
    <link rel="stylesheet" href="modules/fontawesome/web-fonts-with-css/css/fontawesome-all.min.css">
    <link rel="stylesheet" href="css/style.css">    
    <link rel="stylesheet" href="css/skins/vinder.css">
</head>
<body>
    <div id="app">
        <div class="main-wrapper">
            <?php //include('includes/mainHeader.php'); ?>
            <div class="main-sidebar">
                <?php //include('includes/mainSideBar.php'); ?>
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
                                        <h4>Wijzig uw contactgegevens</h4>
                                    </div>
                                    <div class="card-body">
                            
                                        <?php if (isset($registerMsg) && $registerMsg !== '') :  $registerMsg; else : ?>
                                
                                            <form name="frmContactUpdate" method="POST" action="contactUpdate.php">
                                        
                                                <!-- dit stuk geeft problemen, wie heeft dit geschreven?
                                                <?php if ($message !== '') : ?>
                                                    <div class="message"><?= $message; ?></div>
                                                <?php endif; ?>
                                                -->
                                        
                                                <div class="form-group">
                                                    <label for="name">Bedrijfsnaam * </label>
                                                    <input type="text" class="form-control <?php if (array_key_exists('name', $errors)) : ?>is-invalid<?php endif; ?>" id="name" name="name" maxlength="255" value="<?= $name; ?>" autofocus />
                    
                                                    <?php if (array_key_exists('name', $errors)) : ?>
                                                        <div class="invalid-feedback"><?= $errors['name']; ?></div>
                                                    <?php endif; ?>
                                                    
                                                </div>
                                                <div class="form-group">
                                                    <label for="repeatPassword">Herhaal wachtwoord *</label>
                                                    <input type="password" id="repeatPassword" class="form-control <?php if (array_key_exists('repeatPassword', $errors)) : ?>is-invalid<?php endif; ?>" name="repeatPassword" maxlength="10" />
                                                    
                                                    <?php if (array_key_exists('repeatPassword', $errors)) : ?>
                                                        <div class="invalid-feedback"><?= $errors['repeatPassword']; ?></div>
                                                    <?php endif; ?>
                                                    
                                                </div>
                                                <div class="form-group">
                                                    <label for="email">E-mail * </label>
                                                    <input type="email" id="email" class="form-control <?php if (array_key_exists('email', $errors)) : ?>is-invalid<?php endif; ?>" name="email" maxlength="255" value="<?= $email; ?>" />
                                                    
                                                    <?php if (array_key_exists('email', $errors)) : ?>
                                                        <div class="invalid-feedback"><?= $errors['email']; ?>
                                                    </div>
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
</html>