<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no"
          name="viewport">
    <title>Vinder | Account aanpassen</title>
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
        foreach ($allExps as $expertise){ ?>
        expertises.push("<?php echo $expertise->getId(); ?>");

        <?php }?>
    </script>
</head>
<body>
<form action="editProfile.php" method="post" enctype="multipart/form-data">
    <div id="app">
        <div class="main-wrapper">
            <?php include('includes/mainHeader.php'); ?>
            <div class="main-sidebar">
                <?php include('includes/mainSideBar.php'); ?>
            </div>
            <div class="main-content">
                <section class="section">
                    <h1 class="section-header">
                        <div><a href="dashboard.php"><img src="images/icon.png" alt="Vinder" style="width: 2rem;"></a>&nbsp;&nbsp;Profiel wijzigen</div>
                    </h1>
                    <div class="section-body"><div class="row">
                        <div class="col-12">
                            <div class="card card-primary">
                                <div class="card-header"><h4>Logo</h4></div><div class="card-body">
                                    <div class="container">
                                        
                                        <?php if ($account->getLogo()): ?>
                                        
                                            <div class="row justify-content-center">
                                                <div id="company_logo" style="margin: auto">
                                                    <img id="logo" src="images/<?php echo $account->getLogo(); ?>" alt="Logo" style="max-width: 150px;">
                                                </div>
                                            </div>
                                            <div class="row justify-content-center">
                                                <div>
                                                <button id="removelogo" style="margin: 10px" type="button" class="btn btn-primary btn-sm" onclick="remove_logo()">Verwijder logo</button>
                                                </div>
                                            </div>
                                        
                                        <?php endif; 
                                        if (!$account->getLogo()) echo "<p>Geen logo</p>"; ?>
                                        
                                            <div class="form-group inputDnD">
                                                <label class="sr-only" for="inputFile">File Upload</label>
                                                <input type="file" name="fileToUpload" class="form-control-file text-primary font-weight-bold" id="inputFile" accept="image/*" onchange="readUrl(this)" data-title="Toevoeg logo. Max 10MB">
                                            </div>
                                        
                                            <?php if (isset($_SESSION['msg2'])) {
                                                echo "<div class=\"alert alert-danger\">" . $_SESSION['msg2'] . "</div>";
                                                $_SESSION['msg2'] = null;
                                            } ?>
                                            <?php if (isset($_SESSION['msg'])) {
                                                echo "<div class=\"alert alert-success\">" . $_SESSION['msg'] . "</div>";
                                                $_SESSION['msg'] = null;
                                            } ?>
                                        
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h4>Omschrijving en website</h4>
                                    </div>
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="Info">Korte omschrijving :</label>
                                            <textarea class="form-control" type="text" id="Info" name="Info" placeholder=""><?php echo $account->getInfo(); ?></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label for="website">Website :</label>
                                            <input class="form-control" id="url_input" type="url" id="website" name="website" placeholder="" value="<?php echo $account->getWebsite(); ?>" onblur="check_url()">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header"><h4>Uw expertisen:</h4></div>
                                    <div class="card-body">

                                        <?php foreach ($allExps as $expertise) : 
                                            $status = "";
                                            $info = '';
                                            foreach ($exps as $exp) {
                                                if (($exp->getId() === $expertise->getId()) or isset($_POST['inputexpertise' . $expertise->getId()])) {
                                                    $status = "checked";
                                                    $info = $exp->getInfo();
                                                }
                                            } ?>

                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="form-check-input expertise"
                                                       id="expertise<?php echo $expertise->getId(); ?>"
                                                       name="expertise<?php echo $expertise->getId(); ?>" <?php echo $status; ?> >
                                                <label class="form-check-label"
                                                       for="expertise<?php echo $expertise->getId(); ?>"><?php echo $expertise->getExpertise(); ?>
                                                </label>
                                            </div>
                                        
                                            <?php if ($status === "checked") { ?>
                                                <div class="form-check">
                                                    <label style="margin-left: 12px" id="inputlabelexpertise<?php echo $expertise->getId(); ?>"
                                                    >Meer info: </label>
                                                    <input style="margin-left: 12px; margin-bottom: 12px" id="inputexpertise<?php echo $expertise->getId(); ?>" name="inputexpertise<?php echo $expertise->getId(); ?>" type="text" class="form-control" value="<?php echo $info; ?>">
                                                </div>
                                            <?php } 
                                        endforeach; ?>

                                        <div class="form-group">
                                            <label id="extra" style="margin-top: 12px">Extra expertise: </label>
                                            <input id="extraexpertise" class="form-control" name="extraexpertise" type="text" class="row" value="<?php if (isset($_POST['extraexpertise'])) echo $_POST['extraexpertise']; elseif ($extraExp) { echo $extraExp->getExpertise(); } ?>">
                                            <label id="extraexpertiseinfo" style="margin-top: 12px">Meer info over extra expertise: </label>
                                            <input id="extraexpertiseinfo" class="form-control" name="extraexpertiseinfo" type="text" class="row" value="<?php if (isset($_POST['extraexpertiseinfo'])) echo $_POST['extraexpertiseinfo']; elseif ($extraExp) { echo $extraExp->getInfo(); } ?>">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h4>Waarover wil ik informatie?</h4>
                                    </div>
                                    <div class="card-body">
                                        
                                        <?php foreach ($allExps as $expertise) : ?>
                                            <div class="custom-control custom-checkbox">
                                                <?php
                                                $status = '';
                                                $info = '';
                                                foreach ($expExps as $exp2) {
                                                    if ($exp2->getId() === $expertise->getId()) {
                                                        $status = "checked";
                                                        if (isset($_POST['inputexpected' . $expertise->getId()])) {
                                                            $info = $_POST['inputexpected' . $expertise->getId()];
                                                        } else $info = $exp2->getInfo();
                                                    }
                                                }
                                                ?>
                                                <input type="checkbox" class="form-check-input expectedExpertise" id="expected<?php echo $expertise->getId(); ?>" name="expected<?php echo $expertise->getId(); ?>" <?= $status; ?>>
                                                <label class="form-check-label" for="expected<?= $expertise->getId(); ?>"><?php echo $expertise->getExpertise(); ?></label>
                                            </div>
                                        
                                            <?php if ($status === "checked") { ?>
                                                <div class="form-check">
                                                    <label style="margin-left: 12px;" id="inputlabelexpected<?php echo $expertise->getId(); ?>">Meer info: </label>
                                                    <input style="margin-left: 12px; margin-bottom: 12px" name="inputexpected<?php echo $expertise->getId(); ?>" type="text" class="form-control" value="<?php echo $info; ?>">
                                                </div>
                                            <?php }
                                        endforeach; ?>

                                        <div class="form-group">
                                            <label id="extraexpected" style="margin-top: 12px">Extra expertise: </label>
                                            <input class="form-control" id="extraexpected" name="extraexpected" type="text" class="row" value="<?php if (isset($_POST['extraexpected'])) echo $_POST['extraexpected']; elseif ($extraExpExp) { echo $extraExpExp->getExpertise(); } ?>">
                                            <label id="extraexpectedinfo" style="margin-top: 12px">Meer info over extra expertise: </label>
                                            <input class="form-control" id="extraexpectedinfo" name="extraexpectedinfo" type="text" class="row" value="<?php if (isset($_POST['extraexpectedinfo'])) echo $_POST['extraexpectedinfo']; elseif ($extraExpExp) { echo $extraExpExp->getInfo(); } ?>">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h4>Opslaan</h4>
                                    </div>
                                    <div class="card-body">
                                        <input type="submit" class="btn" name="submit" value="Opslaan">
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