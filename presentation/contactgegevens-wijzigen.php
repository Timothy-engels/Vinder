<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no" name="viewport">
    <title>Vinder | Contactpersoon wijzigen</title>
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
                        <div><a href="dashboard.php"><img src="images/icon.png" alt="Vinder" style="width: 2rem;"></a>&nbsp;&nbsp;Contactgegevens</div>
                    </h1>

                    <div class="section-body">

                        <div class="row">
                            <div class="col-12 col-md-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h4>Contactgegevens wijzigen</h4>
                                    </div>
                                    <div class="card-body">
                            
                                        <?php if (isset($registerMsg) && $registerMsg !== '') :  $registerMsg; else : ?>
                                
                                            <form name="frmContactUpdate" method="POST" action="contactgegevens-wijzigen.php">
                                        
                                                <?php if ($msg !== '') : ?>
                                                    <div class="alert alert-success"><?= $msg; ?></div>
                                                <?php endif; ?>
                                        
                                                <div class="form-group">
                                                    <label for="name">Bedrijfsnaam * </label>
                                                    <input type="text" class="form-control <?php if (array_key_exists('name', $errors)) : ?>is-invalid<?php endif; ?>" id="name" name="name" maxlength="255" value="<?= $name; ?>" autofocus />
                    
                                                    <?php if (array_key_exists('name', $errors)) : ?>
                                                        <div class="invalid-feedback"><?= $errors['name']; ?></div>
                                                    <?php endif; ?>
                                                    
                                                </div>
                                                <div class="form-group">
                                                    <label for="contactPerson">Contactpersoon *</label>
                                                    <input type="text" id="contactPerson" class="form-control <?php if (array_key_exists('contactPerson', $errors)) : ?>is-invalid<?php endif; ?>" name="contactPerson" value="<?= $contactPerson; ?>" maxlength="255" />
                                                    
                                                    <?php if (array_key_exists('contactPerson', $errors)) : ?>
                                                        <div class="invalid-feedback"><?= $errors['contactPerson']; ?></div>
                                                    <?php endif; ?>
                                                    
                                                </div>
                                                <div class="form-group">
                                                    <label for="email">E-mail * </label>
                                                    <input type="email" id="email" class="form-control <?php if (array_key_exists('email', $errors)) : ?>is-invalid<?php endif; ?>" name="email" maxlength="255" value="<?= $email; ?>" />
                                                    
                                                    <?php if (array_key_exists('email', $errors)) : ?>
                                                        <div class="invalid-feedback"><?= $errors['email']; ?></div>
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