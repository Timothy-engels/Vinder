<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no" name="viewport">
    <title>Vinder | Profiel wijzigen</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <link rel="stylesheet" href="modules/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="modules/ionicons/css/ionicons.min.css">
    <link rel="stylesheet" href="modules/fontawesome/web-fonts-with-css/css/fontawesome-all.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/skins/vinder.css">
    <link rel="stylesheet" href="css/custom.css">
    <link rel="stylesheet" href="style/photoupload.css">
    <?php include('includes/nativeAppMeta.php'); ?>
    <script>
        var expertises = [];
        <?php
        foreach ($allExps as $expertise) { ?>
            expertises.push("<?= $expertise->getId(); ?>");
        <?php }?>
    </script>
</head>
<body>
<form action="profiel-wijzigen.php" method="post" enctype="multipart/form-data">
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
                                        <h4>Profiel wijzigen</h4>
                                    </div>
                                    <div class="card-body">
                                    
                                        <?php if ($msg !== '') : ?>
                                            <div class="alert alert-success"><?= $msg; ?></div>
                                        <?php endif; ?>
                                            
                                        <div class="form-group">
                                            <label>Logo</label>
                                            
                                            <?php
                                            $logo = 'no-image.png';
                                            if ($loggedInAccount->getLogo() !== null && $loggedInAccount->getLogo() !== '') {
                                                $logo = $loggedInAccount->getLogo();
                                            }
                                            ?>
                                            
                                            <div class="row justify-content-center">
                                                <div id="company_logo" style="margin: auto">
                                                    <img id="logo" src="images/<?= $logo; ?>" alt="Logo" style="max-width: 15rem;">
                                                </div>
                                            </div>
                                            
                                            <?php if ($loggedInAccount->getLogo()): ?>

                                                <div class="row justify-content-center">
                                                    <button id="removelogo" style="margin: 10px" type="button" class="btn btn-primary btn-sm" onclick="remove_logo()">Verwijder logo</button>
                                                </div>
       
                                            <?php endif; ?>
                                        
                                            <div class="form-group inputDnD">
                                                <label class="sr-only" for="inputFile">File Upload</label>
                                                <input type="file" name="fileToUpload" class="form-control-file text-primary font-weight-bold" id="inputFile" accept="image/*" onchange="readUrl(this)" data-title="Toevoeg logo. Max 10MB">
                                            </div>

                                            <?php if (array_key_exists('logo', $errors)) : ?>
                                                <div><?= $errors['logo']; ?></div>
                                            <?php endif; ?>
                                        </div>

                                        <div class="form-group mt-4">
                                            <label for="info">Korte omschrijving <i class="ion ion-android-star"></i></label>
                                            <textarea class="form-control <?php if (array_key_exists('info', $errors)) : ?>is-invalid<?php endif; ?>" type="text" id="info" name="info" ><?= $info; ?></textarea>
                                            <?php if (array_key_exists('info', $errors)) : ?>
                                                <div class="invalid-feedback"><?= $errors['info']; ?></div>
                                            <?php endif; ?>
                                        </div>

                                        <div class="form-group">
                                            <label for="website">Website</label>
                                            <input class="form-control <?php if (array_key_exists('website', $errors)) : ?>is-invalid<?php endif; ?>" type="url" id="url_input" name="website" value="<?= $website; ?>" onblur="check_url()" >
                                            <?php if (array_key_exists('info', $errors)) : ?>
                                                <div class="invalid-feedback"><?= $errors['website']; ?></div>
                                            <?php endif; ?>
                                        </div>
                                        
                                    </div>
                                    <div class="card-header"><h4>Expertises</h4></div>
                                    <div class="card-body">

                                        <?php foreach ($allExps as $expertise) : ?>

                                            <div class="custom-control custom-checkbox form-group">
                                                <input type="checkbox" class="custom-control-input expertise" id="expertise<?= $expertise->getId(); ?>" name="expertise<?= $expertise->getId(); ?>" <?php if (array_key_exists($expertise->getId(), $myExpertises)) { echo "checked"; } ?> >
                                                <label class="custom-control-label" for="expertise<?= $expertise->getId(); ?>"><?= $expertise->getExpertise(); ?></label>
                                                <br>
                                                <label id="inputlabelexpertise<?= $expertise->getId(); ?>">Meer info</label>
                                                <textarea id="inputexpertise<?= $expertise->getId(); ?>" name="inputexpertise<?= $expertise->getId(); ?>" class="form-control"><?php if (array_key_exists($expertise->getId(), $myExpertises)) { echo $myExpertises[$expertise->getId()]; } ?></textarea>
                                            </div>
                                        
                                        <?php endforeach; ?>

                                        <div class="form-group">
                                            <label for="extraexpertise">Extra expertise</label>
                                            <input id="extraexpertise" class="form-control" name="extraexpertise" type="text" value="<?= $extraExpertise ?>">
                                            <label for="extraexpertiseinfo">Meer info</label>
                                            <textarea id="extraexpertiseinfo" class="form-control" name="extraexpertiseinfo"><?= $extraExpertiseInfo; ?></textarea>
                                        </div>
                                        
                                    </div>
                                    <div class="card-header">
                                        <h4>Gewenste expertises</h4>
                                    </div>
                                    <div class="card-body">
                                        
                                        <?php foreach ($allExps as $expertise) : ?>
                                            <div class="custom-control custom-checkbox form-group">
                                                <input type="checkbox" class="custom-control-input" id="expected<?= $expertise->getId(); ?>" name="expected<?= $expertise->getId(); ?>" <?php if (array_key_exists($expertise->getId(), $expectedExpertises)) { echo "checked"; } ?>>
                                                <label class="custom-control-label" for="expected<?= $expertise->getId(); ?>"><?= $expertise->getExpertise(); ?></label>
                                                <br>
                                                <label id="inputlabelexpected<?= $expertise->getId(); ?>">Meer info</label>
                                                <textarea name="inputexpected<?= $expertise->getId(); ?>" class="form-control"><?php if (array_key_exists($expertise->getId(), $expectedExpertises)) { echo $expectedExpertises[$expertise->getId()]; } ?></textarea>
                                            </div>
                                        <?php endforeach; ?>

                                        <div class="form-group">
                                            <label for="extraexpected">Extra expertise</label>
                                            <input class="form-control" id="extraexpected" name="extraexpected" type="text" value="<?= $extraExpected ?>">
                                            <label id="extraexpectedinfo">Meer info</label>
                                            <textarea class="form-control" id="extraexpectedinfo" name="extraexpectedinfo"><?= $extraExpectedInfo ?></textarea>
                                        </div>

                                        <div class="form-group">
                                            <button type="submit" class="btn btn-sm btn-primary">Wijzig</button>
                                        </div>        
                                        
                                        <p class="text-muted italic"><small>Velden met een <i class="ion ion-android-star"></i> zijn verplicht in te vullen.</small></p>

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
</form>
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
<script src="javascript/javascript.js"></script>
<script src="javascript/photoupload.js"></script>

</html>