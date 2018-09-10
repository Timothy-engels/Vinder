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
                    Website: <? echo $account->getWebsite(); ?>
                </div>
                <div>
                    Info: <? echo $account->getInfo(); ?>
                </div>
    </div>
    <h3>Expertises:</h3>
    <div>
        <?
        foreach($exps as $expertise){ ?>
            <div>
                <?= $expertise->getExpertise(); ?>
            </div>
            <div>
                Meer info: <?= $expertise->getInfo(); ?>
            </div>
        <?}?>
    </div>
<div>Extra expertise: <?= $extraExp->getExpertise();?></div>
<div>Meer info: <?= $extraExp->getInfo();?></div>
<h3>Meer info willen hebben:</h3>
<div>
    <?
    foreach($expExps as $expertise){ ?>
        <div>
            Expertise: <?= $expertise->getExpertise(); ?>
        </div>
        <div>
            Meer info: <?= $expertise->getInfo(); ?>
        </div>
    <?}?>
</div>
<div>Extra expertise: <?= $extraExpExp->getExpertise();?></div>
<div>Meer info: <?= $extraExpExp->getInfo();?></div>
</body>
</html>