<!DOCTYPE HTML> <!-- presentation/commentlist.php -->
<html>
<head>
    <meta charset=utf-8>
    <title><? echo $account->getName(); ?> Profile</title>
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
    
<h1><? echo $account->getName(); ?> profiel pagina</h1>


    <div>
                <div>
                    Id: <? echo $account->getId(); ?>
                </div>
                <div>
                    Name: <? echo $account->getName(); ?>
                </div>
               <div>
                    Contact person: <? echo $account->getContactPerson(); ?>
                </div>
                <div>
                    E-mail: <? echo $account->getEmail(); ?>
                </div>

                <div>
                    Website: <? if ($account->getWebsite()) {
                        echo $account->getWebsite();
                    } else echo "Geen website";
                    ?>
                </div>
                <div>
                    Info: <? if ($account->getInfo()) {
                        echo $account->getInfo();
                    } else echo "Geen info";
                    ?>
                </div>
    </div>
    <h3>Expertises:</h3>

    <div>
        <? if($exps) {
            foreach ($exps as $expertise) { ?>
                <div>
                    <?= $expertise->getExpertise(); ?>
                </div>
                <div>
                    Meer info: <? if ($expertise->getInfo()) {
                        echo $expertise->getInfo();
                    }
                    else echo "Geen info";
                    ?>
                </div>
            <?
            }
        }
        else echo "Geen expertises";
        ?>
    </div>
<? if($extraExp){ ?>
<div>Extra expertise: <?= $extraExp->getExpertise();?></div>

<div>Meer info: <? if($extraExp->getInfo()) { echo $extraExp->getInfo();} else echo "Geen info" ?></div>
<? }?>
<h3>Meer info willen hebben:</h3>
<div>
    <?
    if($expExps) {
        foreach ($expExps as $expertise) { ?>
            <div>
                Expertise: <?= $expertise->getExpertise(); ?>
            </div>
            <div>
                Meer info: <?= $expertise->getInfo(); ?>
            </div>
        <?
        }
    }

    else echo "Geen expertises";
    ?>
</div>
<? if($extraExpExp){ ?>
<div>Extra expertise: <?= $extraExpExp->getExpertise();?></div>

<div>Meer info: <? if($extraExpExp->getInfo()) { echo $extraExpExp->getInfo();} else echo "Geen info" ?></div>
<?}?>
</body>
</html>