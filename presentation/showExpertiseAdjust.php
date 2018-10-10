<!DOCTYPE HTML>
<html>
<head>
    <meta charset=utf-8>
    <title>users</title>
    <link rel="stylesheet" href="modules/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="modules/ionicons/css/ionicons.min.css">
    <link rel="stylesheet" href="modules/fontawesome/web-fonts-with-css/css/fontawesome-all.min.css">
    <link rel="stylesheet" href="css/style.css">    
    <link rel="stylesheet" href="css/skins/vinder.css">
    <link rel="stylesheet" href="css/custom.css">
    <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">
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
                            <div class="col-12 col-md-6 col-lg-6">
                                <div class="card">
                                    <div class="card-header">
                                        <h4>Expertise aanpassen</h4>
                                    </div>
                                    <div class="card-body">
                            
                                        <?php if (isset($registerMsg) && $registerMsg !== '') :  $registerMsg; else : ?>
                                
                                            <form name="frmExpAdjust" method="POST" action="expertiseAdjust.php?eaid=<?=$eaid;?>">
                                        
                                                <div class="form-group">
                                                    <label for="expertise" class="d-block">Expertise:</label>
                                                    <input type="text" id="expertise" name="expertise" class="form-control <?php if (array_key_exists('expertise', $errors)) : ?>is-invalid<?php endif; ?>" maxlength="10" value="<?= $expertiseName; ?>"  autofocus/>
                                                    
                                                    <?php if (array_key_exists('expertise', $errors)) : ?>
                                                        <div class="invalid-feedback"><?= $errors['expertise']; ?></div>
                                                    <?php endif; ?>
                                                    
                                                </div>
                                                <div class="form-group">
                                                    <label for="active">Actief:</label>
            
                                                    <?php $checked = '';
                                                    if ($expertiseActive === "1") {
                                                        $checked = "checked";
                                                    } ?>
                                                    <input type="checkbox" name="active" value="1" <?= $checked; ?> />
                                                </div>
                                                <div class="form-group">
                                                    <button type="submit" class="btn btn-sm btn-primary">Wijzigen</button>
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