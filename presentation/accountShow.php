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
    <div>
        <? foreach($expertises as $expertise){
            echo $expertise->getId;
        }?>
    </div>
</body>
</html>