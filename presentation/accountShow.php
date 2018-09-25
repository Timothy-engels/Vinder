<!DOCTYPE HTML> <!-- presentation/commentlist.php -->
<html>
<head>
    <meta charset=utf-8>
    <title><?php echo $account->getName(); ?> Profile</title>
    <style>
        body{
            font-family: 'Lato', sans-serif;
            font-size: 21px;
        }
    </style>
    <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">
</head>
<body>

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
            </div>
        <?php
        }
    }

    else { echo "Geen expertises"; }
    ?>
</div>
<?php if($extraExpExp){ ?>

<div>Extra expertise: <?php echo $extraExpExp->getExpertise();?></div>

<div>Meer info: <?php if($extraExpExp->getInfo()) { echo $extraExpExp->getInfo();} else echo "Geen info" ?></div>
<?php }?>
</body>
</html>