<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no"
          name="viewport">
    <title>Vinder | Account aanpassen</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <link rel="stylesheet" href="modules/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="modules/ionicons/css/ionicons.min.css">
    <link rel="stylesheet" href="modules/fontawesome/web-fonts-with-css/css/fontawesome-all.min.css">
    <link rel="stylesheet" href="style/swipe.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/skins/vinder.css">
    <link rel="stylesheet" href="style/photoupload.css">
    <script>
        var expertises = [];
        <?php
        foreach ($allExps as $expertise){ ?>
        expertises.push("<?php echo $expertise->getId(); ?>");

        <?php }?>
    </script>
</head>
<body class="sidebar-gone">

<div id="app">
    <div class="main-wrapper">
        <div class="navbar-bg"></div>
        <nav class="navbar navbar-expand-lg main-navbar">
            <form class="form-inline mr-auto">
            </form>
            <ul class="navbar-nav navbar-right">
                <li class="dropdown"><a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg">
                        <i class="ion ion-android-person d-lg-none"></i>
                        <div class="d-sm-none d-lg-inline-block">Hoi, <?= $account->getContactPerson(); ?></div></a>
                    <div class="dropdown-menu dropdown-menu-right">
                        <?php include('menu.php'); ?>
                    </div>
                </li>
            </ul>
        </nav>

        <div class="main-content">
            <section class="section">
                <h1 class="section-header">
                    <div><a href="dashboard.php"><img src="images/icon.png" alt="Vinder" style="width: 2rem;"></a>&nbsp;&nbsp;Profiel
                        wijzigen
                    </div>
                </h1>

                <div class="section-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="card card-primary">
                                <div class="card-header"><h4>Logo</h4></div>

                                <div class="card-body">

                                    <form action="editProfile.php" method="post" enctype="multipart/form-data">

                                        <div class="container">
                                            <div class="row justify-content-center">
                                                <div class="col-6">
                                        <img id="logo" src="images/<?php echo $account->getLogo(); ?>" alt="Logo"
                                             style="max-width: 150px">
                                                </div>
                                            </div>
                                            <div class="row justify-content-center">
                                                <div class="col col-6">
                                                <button id="removelogo" type="button" class="btn btn-primary btn-sm"
                                                        onclick="remove_logo()">Verwijdert logo
                                                </button>
                                                </div>
                                            </div>
                                        </div>





                                        <button type="button" class="btn btn-primary btn-block"
                                                onclick="document.getElementById('inputFile').click()">Add Image
                                        </button>
                                        <div class="form-group inputDnD">
                                            <label class="sr-only" for="inputFile">File Upload</label>
                                            <input type="file" name="fileToUpload"
                                                   class="form-control-file text-primary font-weight-bold"
                                                   id="inputFile" accept="image/*" onchange="readUrl(this)"
                                                   data-title="Drag and drop a file. Max 10MB">
                                        </div>
                                        <?php if ($msg2) {
                                            echo "<div class=\"alert alert-danger\">" . $msg2 . "</div>";
                                        }; ?>
                                        <?php if ($msg) {
                                            echo "<div class=\"alert alert-success\">" . $msg . "</div>";
                                        }; ?>



                                    </form>


                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header"><h4>Omschrijving en website</h4></div>

                                <div class="card-body">

                                    <form action="editProfile.php" method="post" enctype="multipart/form-data">
                                        <div class="form-group">
                                        <label for="Info">Korte omschrijving :</label>
                                        <textarea class="form-control" type="text" id="Info" name="Info"
                                                  placeholder=""><?php echo $account->getInfo(); ?></textarea>
                                    </div>

                                    <div class="form-group">
                                        <label for="website">Website :</label>
                                        <input class="form-control" id="url_input" type="url" id="website"
                                               name="website" placeholder=""
                                               value="<?php echo $account->getWebsite(); ?>" onblur="check_url()">
                                    </div></form>


                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header"><h4>Uw expertisen:</h4></div>
                                <form action="editProfile.php" method="post" enctype="multipart/form-data">


                                    <?php foreach ($allExps as $expertise) : ?>
                                        <?php
                                        $status = '';
                                        $info = '';
                                        foreach ($exps as $exp) {
                                            if ($exp->getId() === $expertise->getId()) {
                                                $status = "checked";
                                                if (isset($_POST['inputexpertise' . $expertise->getId()])) {
                                                    $info = $_POST['inputexpertise' . $expertise->getId()];
                                                } else $info = $exp->getInfo();
                                            }
                                        };
                                        ?>

                                        <div class="form-check">
                                            <input style="margin: 5px;" type="checkbox" class="form-check-input expertise"
                                                   id="expertise<?php echo $expertise->getId(); ?>"
                                                   name="expertise<?php echo $expertise->getId(); ?>" <?php echo $status; ?> >
                                            <label style="margin-left: 25px;" class="form-check-label"
                                                   for="expertise<?php echo $expertise->getId(); ?>"><?php echo $expertise->getExpertise(); ?>
                                            </label>

                                        </div>
                                        <?php if ($status === "checked") { ?>
                                            <div class="form-check">
                                                <label style="margin-left: 12px" id="inputlabelexpertise<?php echo $expertise->getId(); ?>"
                                                >Meer info: </label>
                                                <input style="margin-left: 12px" id="inputexpertise<?php echo $expertise->getId(); ?>"
                                                       name="inputexpertise<?php echo $expertise->getId(); ?>"
                                                       type="text" class="form-control"
                                                       value="<?php echo $info; ?>">
                                            </div>
                                        <?php } ?>
                                    <?php endforeach; ?>


                                    <label id="extraexpected" class="row">Extra expertise: </label>
                                    <input id="extraexpertise" name="extraexpertise" type="text" class="row"
                                           value="<?php if (isset($_POST['extraexpertise'])) echo $_POST['extraexpertise']; elseif ($extraExp) {
                                               echo $extraExp->getExpertise();
                                           } ?>">
                                    <label id="extraexpertiseinfo" class="row">Meer info: </label>
                                    <input id="extraexpertiseinfo" name="extraexpertiseinfo" type="text" class="row"
                                           value="<?php if (isset($_POST['extraexpertiseinfo'])) echo $_POST['extraexpertiseinfo']; elseif ($extraExp) {
                                               echo $extraExp->getInfo();
                                           } ?>">


                                    Waarover wil ik informatie?:

                                    <?php foreach ($allExps as $expertise) : ?>
                                        <div class="custom-control custom-checkbox container">
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
                                            <input type="checkbox"
                                                   class="row expectedExpertise custom-control-input"
                                                   id="expected<?php echo $expertise->getId(); ?>"
                                                   name="expected<?php echo $expertise->getId(); ?>" <?= $status; ?>>
                                            <label class="row custom-control-label"
                                                   for="expected<?= $expertise->getId(); ?>"><?php echo $expertise->getExpertise(); ?></label>
                                            <?php if ($status === "checked") { ?>
                                                <label id="inputlabelexpected<?php echo $expertise->getId(); ?>"
                                                       class="row">Meer info: </label>
                                                <input id="inputexpected<?php echo $expertise->getId(); ?>"
                                                       name="inputexpected<?php echo $expertise->getId(); ?>"
                                                       type="text" class="row" value="<?php echo $info; ?>">
                                            <?php } ?>
                                        </div>
                                    <?php endforeach; ?>


                                    <label id="extraexpected" class="row">Extra expertise: </label>
                                    <input id="extraexpected" name="extraexpected" type="text" class="row"
                                           value="<?php if (isset($_POST['extraexpected'])) echo $_POST['extraexpected']; elseif ($extraExpExp) {
                                               echo $extraExpExp->getExpertise();
                                           } ?>">
                                    <label id="extraexpectedinfo" class="row">Meer info: </label>
                                    <input id="extraexpectedinfo" name="extraexpectedinfo" type="text" class="row"
                                           value="<?php if (isset($_POST['extraexpectedinfo'])) echo $_POST['extraexpectedinfo']; elseif ($extraExpExp) {
                                               echo $extraExpExp->getInfo();
                                           } ?>">


                                    <input type="submit" class="btn" name="submit" value="Save">
                                </form>
                                <div class="card-body">




                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header"><h4>Mijn expertise:</h4></div>

                                <div class="card-body">




                                </div>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="card">
                                <div class="card-header"><h4>Mijn expertise:</h4></div>

                                <div class="card-body">




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

<script src="modules/jquery.min.js"></script>
<script src="modules/popper.js"></script>
<script src="modules/tooltip.js"></script>
<script src="modules/bootstrap/js/bootstrap.min.js"></script>
<script src="modules/nicescroll/jquery.nicescroll.min.js"></script>
<script src="modules/scroll-up-bar/dist/scroll-up-bar.min.js"></script>
<script src="js/sa-functions.js"></script>
<script src="js/scripts.js"></script>
<script src="js/custom.js"></script>
<script src="js/demo.js"></script>
<script src="javascript/javascript.js">
</script>
</body>
</html>