<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no"
          name="viewport">
    <title>Vinder | Account wijzigen</title>
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
                        <div><a href="dashboard.php"><img src="images/logo.png" alt="Vinder" class="logo-small"></a>
                        </div>
                    </h1>

                    <div class="section-body">


                        <div class="row">
                            <div class="col-12">
                                <div class="card card-primary">
                                    <div class="card-header"><h4><?php echo $account->getName();?></h4></div>

                                    <div class="card-body">

                                        <?php if ($account->getLogo()): ?>
                                        <div>
                                            <div class="row justify-content-center">
                                                <div id="company_logo" style="margin: auto">
                                                    <img id="logo" src="images/<?php echo $account->getLogo(); ?>"
                                                         alt="Logo"
                                                         style="max-width: 150px;">
                                                </div>
                                            </div>
                                        </div>
                                            <?php endif ?>

                                        <?php if (!$account->getLogo()) echo "<p>Geen logo</p>"; ?>


                                        </div>
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header"><h4>Info</h4></div>

                                    <div class="card-body">
                                        <div>
                                            <?php if ($account->getInfo()) {
                                                echo $account->getInfo();
                                            } else echo "Geen info";
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header"><h4>Gegevens</h4></div>

                                    <div class="card-body">

                                        <div>
                                            <div>
                                                Bedrijf name: <?php echo $account->getName(); ?>
                                            </div>
                                            <div>
                                                Contactpersoon: <?php echo $account->getContactPerson(); ?>
                                            </div>
                                            <div>
                                                E-mail: <a href="mailto:<?= $account->getEmail(); ?>"><?php echo $account->getEmail(); ?></a>
                                            </div>

                                            <div>
                                                Website:
                                                <?php if ($account->getWebsite()) : ?>
                                                    <a href="<?= $account->getWebsite(); ?>" target="_blank"><?= $account->getWebsite(); ?></a>
                                                <?php else: ?>
                                                    Geen website
                                                <?php endif; ?>
                                            </div>
                                            <?php
                                            if($loggedInAsAdmin) {
                                                $registered = $account->getConfirmed();
                                                if($registered==1) {
                                                    $answer = "Ja";
                                                }
                                                else {
                                                    $answer = "Nee";
                                                }
                                                print(
                                                    "<div>Geregistreerd: " . $answer . "</div>"
                                                );
                                            }
                                            ?>
                                        </div>


                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header"><h4>Expertisen</h4></div>

                                    <div class="card-body">

                                        <div>
                                            <?php if($exps) {
                                                foreach ($exps as $expertise) { ?>
                                                    <div style="font-weight: bold">
                                                        <?php echo $expertise->getExpertise(); ?>
                                                    </div>
                                                    <div style="margin: 8px;">
                                                        Meer info: <?php if ($expertise->getInfo()) {
                                                            echo $expertise->getInfo();
                                                        }
                                                        else echo "Geen info";
                                                        ?>
                                                    </div>
                                                    <?php
                                                }
                                            }
                                            else echo "Geen expertisen";
                                            ?>
                                        </div>
                                        <?php if($extraExp!=null){ ?>
                                            <div style="font-weight: bold">Extra expertise: <?php echo $extraExp->getExpertise();?></div>

                                            <div style="margin: 8px;">Meer info: <?php if($extraExp->getInfo()) { echo $extraExp->getInfo();} else echo "Geen info" ?></div>
                                        <?php }
                                        else echo "Geen extra expertsisen"
                                        ?>

                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="card">

                                    <div class="card-header"><h4>Waarover wil informatie hebben?</h4></div>

                                    <div class="card-body">


                                        <div>
                                            <?php
                                            if($expExps) {
                                                foreach ($expExps as $expertise) { ?>
                                                    <div style="font-weight: bold">
                                                        <?php echo $expertise->getExpertise(); ?>
                                                    </div>
                                                    <div style="margin: 8px;">
                                                        Meer info: <?php echo $expertise->getInfo(); ?>
                                                    </div>
                                                    <?php
                                                }
                                            }

                                            else { echo "Geen expertisen"; }
                                            ?>
                                        </div>
                                        <?php if($extraExpExp!=null){ ?>

                                            <div style="font-weight: bold">Extra expertise: <?php echo $extraExpExp->getExpertise();?></div>

                                            <div style="margin: 8px;">Meer info: <?php if($extraExpExp->getInfo()) { echo $extraExpExp->getInfo();} else echo "Geen info" ?></div>
                                        <?php }
                                        else echo "Geen extra expertsisen"?>

                                    </div>
                                </div>
                            </div>



                        </div>
                    </div>
                </section>
            </div>
            <?php
            include('includes/mainFooter.php'); ?>
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