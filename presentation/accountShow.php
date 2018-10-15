<!DOCTYPE html>
<html lang="nl">
<head>
<<<<<<< HEAD
    <meta charset=utf-8>
=======
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no"
          name="viewport">
>>>>>>> 85fe669116aa01484873bfe5ab07577780589af7
    <title>Vinder | Profiel</title>
    <link rel="stylesheet" href="modules/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="modules/ionicons/css/ionicons.min.css">
    <link rel="stylesheet" href="modules/fontawesome/web-fonts-with-css/css/fontawesome-all.min.css">
<<<<<<< HEAD
    <link rel="stylesheet" href="css/style.css">    
    <link rel="stylesheet" href="css/skins/vinder.css">
    <link rel="stylesheet" href="css/custom.css">
    <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">
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
                            <div class="col-12 col-md-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h4>Profiel</h4>
                                    </div>
                                    <div class="card-body">
                                        <ul class="list-unstyled list-unstyled-border">
                                            <li class="media">
                                                <img class="mr-3 rounded-circle" width="50" src="images/<?= $account->getLogo(); ?>" alt="logo">
                                            </li>
                                            <li class="media">
                                                Id: <?php echo $account->getId(); ?>
                                            </li>
                                            <li class="media">
                                                Bedrijf: <?php echo $account->getName(); ?>
                                            </li>
                                            <li class="media">
                                                Contactpersoon: <?php echo $account->getContactPerson(); ?>
                                            </li>
                                            <li class="media">
                                                E-mail: <?php echo $account->getEmail(); ?>
                                            </li>
                                            <li class="media">
                                                Website: 
                                                
                                                <?php if ($account->getWebsite()) : ?>
                                                
                                                    <a href="<?= $account->getWebsite(); ?>" target="_blank">
                                                        <?= $account->getWebsite(); ?>
                                                    </a>
                                                
                                                <?php else: ?>
                                    
                                                    Geen website.
                   
                                                <?php endif; ?>
                                                
                                            </li><li class="media">
                                                Info: 
                                            
                                                <?php if ($account->getInfo()) { echo $account->getInfo(); } else echo "Geen info"; ?>
                                            
                                            </li>
                                            <li class="media">
                                               <?php 
                                                    if($loggedInAsAdmin) {
                                                        $registered = $account->getConfirmed();
                                                        if($registered==1) {
                                                            $answer = "Ja";
                                                        }
                                                        else {
                                                            $answer = "Nee";
                                                        }
                                                        print("<div>Geregistreerd: " . $answer . "</div>");
                                                    }
                                                ?> 
                                            </li>
                                        </ul>
                                    </div>
                                    
                                    <?php if($exps) { ?>
                                    
                                        <div class="card-header">
                                            <h4>Expertises</h4>
                                        </div>
                                        <div class="card-body">
                                            <ul class="list-unstyled list-unstyled-border">
                                                
                                                <?php foreach ($exps as $expertise) { ?>
                                                    <li class="media">
                                                        <?php echo $expertise->getExpertise(); ?>
                                                    </li>
                                                    <li class="media">
                                                        Meer info: 
                                                        <?php if ($expertise->getInfo()) {
                                                            echo $expertise->getInfo();
                                                        }
                                                        else echo "Geen info";
                                                        ?>
                                                    </li>
                                                <?php 
                                                }
                                            ?>
                                            </ul>
                                        </div>
                                    
                                    <?php } else echo"<div class='card-header'><h4>Geen expertises</h4></div>";
                                    if($extraExp) { ?>
                                    
                                        <div class="card-header">
                                            <h4>Extra info</h4>
                                        </div>
                                        <div class="card-body">
                                            <ul class="list-unstyled list-unstyled-border">
                                                <li class="media">
                                                    Extra info: <?php echo $extraExpExp->getExpertise();?>
                                                </li>
                                                <li class="media">
                                                    Meer info: <?php if($extraExpExp->getInfo()) { echo $extraExpExp->getInfo();} else echo "Geen info" ?>
                                                </li>
                                            </ul>
                                        </div>
                                    
                                    <?php } 
                                    if($expExps) { ?>
                                    
                                        <div class="card-header">
                                            <h4>Meer info willen hebben</h4>
                                        </div>
                                        <div class="card-body">
                                            <ul class="list-unstyled list-unstyled-border">
                                                <?php if($expExps) {
                                                    foreach ($expExps as $expertise) { ?>
                                                        <li class="media">
                                                            Expertise: <?php echo $expertise->getExpertise(); ?>
                                                        </li>
                                                        <li class="media">
                                                            Meer info: <?php echo $expertise->getInfo(); ?>
                                                        </li>
                                                    <?php } 
                                                } ?>
                                            </ul>
                                        </div>
                                    
                                    <?php } else { echo "<div class='card-header'><h4>Geen extra info nodig</h4></div>"; } 
                                    if($extraExpExp){ ?>
                                        
                                        <div class="card-header">
                                            <h4>Extra Expertise</h4>
                                        </div>
                                        <div class="card-body">
                                            <ul class="list-unstyled list-unstyled-border">
                                                <li class="media">
                                                    Extra expertise: <?php echo $extraExpExp->getExpertise();?>
                                                </li>
                                                <li class="media">
                                                    Meer info: <?php if($extraExpExp->getInfo()) { echo $extraExpExp->getInfo();} else echo "Geen info" ?>
                                                </li>
                                            </ul>
                                        </div>
                                    
                                    <?php } else { echo "<div class='card-header'><h4>Geen extra expertise</h4></div>"; } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>


                                    
<!--                                            
    

<?php include('menu.php'); ?>

<h1><?php echo $account->getName(); ?> profiel pagina</h1>


    <div>
        <img src="images/<?php echo $account->getLogo(); ?>" alt="Logo" style="max-width: 150px">
                <div>
                    Id: <?php echo $account->getId(); ?>
                </div>
                <div>
                    Bedrijf: <?php echo $account->getName(); ?>
                </div>
                <div>
                    Contactpersoon: <?php echo $account->getContactPerson(); ?>
                </div>
                <div>
                    E-mail: <?php echo $account->getEmail(); ?>
                </div>

                <div>
                    Website: 
                    <?php if ($account->getWebsite()) : ?>
                        <a href="<?= $account->getWebsite(); ?>" target="_blank"><?= $account->getWebsite(); ?></a>
                    <?php else: ?>
                        Geen website
                    <?php endif; ?>
                </div>
                <div>
                    Info: <?php if ($account->getInfo()) {
                        echo $account->getInfo();
                    } else echo "Geen info";
                    ?>
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
    <h3>Expertises:</h3>

    <div>
        <?php if($exps) {
            foreach ($exps as $expertise) { ?>
                <div>
                    <?php echo $expertise->getExpertise(); ?>
                </div>
                <div>
                    Meer info: <?php if ($expertise->getInfo()) {
                        echo $expertise->getInfo();
                    }
                    else echo "Geen info";
                    ?>
                </div>
            <?php
            }
        }
        else echo "Geen expertises";
        ?>
    </div>
    
<?php if($extraExp){ ?>
<div>Extra expertise: <?php echo $extraExp->getExpertise();?></div>

<div>Meer info: <?php if($extraExp->getInfo()) { echo $extraExp->getInfo();} else echo "Geen info" ?></div>
<?php }?>
    
<h3>Meer info willen hebben:</h3>
<div>
    <?php
    if($expExps) {
        foreach ($expExps as $expertise) { ?>
            <div>
                Expertise: <?php echo $expertise->getExpertise(); ?>
            </div>
            <div>
                Meer info: <?php echo $expertise->getInfo(); ?>
=======
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
>>>>>>> 85fe669116aa01484873bfe5ab07577780589af7
            </div>
            <div class="main-content">
                <section class="section">
                    <h1 class="section-header">
                        <div><a href="dashboard.php"><img src="images/icon.png" alt="Vinder" style="width: 2rem;"></a>&nbsp;&nbsp;Profiel bekijken</div>
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

<<<<<<< HEAD
    else { echo "Geen expertises"; }
    ?>
</div>
    
<?php if($extraExpExp){ ?>
=======
                                        <div>
                                            <div>
                                                Naam van de bedrijf: <?php echo $account->getName(); ?>
                                            </div>
                                            <div>
                                                Contactpersoon: <?php echo $account->getContactPerson(); ?>
                                            </div>
                                            <div>
                                                E-mail: <a href="mailto:<?= $account->getEmail(); ?>"><?php echo $account->getEmail(); ?></a>
                                            </div>
>>>>>>> 85fe669116aa01484873bfe5ab07577780589af7

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

<<<<<<< HEAD
<div>Meer info: <?php if($extraExpExp->getInfo()) { echo $extraExpExp->getInfo();} else echo "Geen info" ?></div>
<?php }?> -->
=======

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
                                                    <div>
                                                        <?php echo $expertise->getExpertise(); ?>
                                                    </div>
                                                    <div style="margin-left: 4px; margin-bottom: 10px">
                                                        <?php if ($expertise->getInfo()) {
                                                            echo "<i class=\"fa fa-info-circle\"></i> ".$expertise->getInfo();
                                                        }
                                                        ?>
                                                    </div>
                                                    <?php
                                                }
                                            }
                                            else echo "Geen expertisen";
                                            ?>
                                        </div>
                                        <?php if($extraExp!=null){ ?>
                                            <?php if ($extraExp->getExpertise()!==''){ ?>
                                                <div>Extra
                                                    expertise: <?php echo $extraExp->getExpertise(); ?></div>

                                                <div style="margin-left: 4px; margin-bottom: 10px"><?php if ($extraExp->getInfo()) {
                                                        echo "<i class=\"fa fa-info-circle\"></i> ".$extraExp->getInfo();
                                                    }?></div>
                                            <?php } else echo "Geen extra expertsise" ?>
                                        <?php }
                                        else echo "Geen extra expertsise"
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
                                                    <div>
                                                        <?php echo $expertise->getExpertise(); ?>
                                                    </div>
                                                    <div style="margin-left: 4px; margin-bottom: 10px">
                                                        <?php echo "<i class=\"fa fa-info-circle\"></i> ".$expertise->getInfo(); ?>
                                                    </div>
                                                    <?php
                                                }
                                            }

                                            else { echo "Geen expertisen"; }
                                            ?>
                                        </div>
                                        <?php if($extraExpExp!=null){ ?>
                                            <?php if ($extraExp->getExpertise()!==''){ ?>
                                                <div>Extra
                                                    expertise: <?php echo $extraExpExp->getExpertise(); ?></div>
                                                <div style="margin-left: 4px; margin-bottom: 10px"><?php if ($extraExpExp->getInfo()) {
                                                        echo "<i class=\"fa fa-info-circle\"></i> ".$extraExpExp->getInfo();
                                                    } ?></div>
                                            <?php } else echo "Geen extra expertsise"?>
                                        <?php }
                                        else echo "Geen extra expertsise"?>

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
>>>>>>> 85fe669116aa01484873bfe5ab07577780589af7
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