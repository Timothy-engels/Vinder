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
                <div>
                    Id: <?php echo $account->getId(); ?>
                </div>
                <div>
                    Name: <?php echo $account->getName(); ?>
                </div>
               <div>
                    Contact person: <?php echo $account->getContactPerson(); ?>
                </div>
                <div>
                    E-mail: <?php echo $account->getEmail(); ?>
                </div>

                <div>
                    Website: <?php if ($account->getWebsite()) {
                        echo $account->getWebsite();
                    } else echo "Geen website";
                    ?>
                </div>
                <div>
                    Info: <?php if ($account->getInfo()) {
                        echo $account->getInfo();
                    } else echo "Geen info";
                    ?>
                </div>
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
        <?
        }
    }

    else echo "Geen expertises";
    ?>
</div>
<?php if($extraExpExp){ ?>
<div>Extra expertise: <?= $extraExpExp->getExpertise();?></div>

<div>Meer info: <? if($extraExpExp->getInfo()) { echo $extraExpExp->getInfo();} else echo "Geen info" ?></div>
<?php }?>
</body>
</html>