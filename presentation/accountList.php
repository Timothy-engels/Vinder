<!DOCTYPE HTML> <!-- presentation/commentlist.php -->
<html>
<head>
    <meta charset=utf-8>
    <title>users</title>
    <style>
        body{
            font-family: 'Lato', sans-serif;
            font-size: 21px;
        }
    </style>
    <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">
</head>
<body>

<h1>Users</h1>


    <?php
    foreach ($accounts as $account)
          { 
            ?>
            <img src="images/<?php echo $account->getLogo(); ?>" alt="Logo" style="max-width: 150px">
            <div>
                <span>
                    Id: <? echo $account->getId(); ?>
                </span>
                <span>
                    Name: <? echo $account->getName(); ?>
                </span>
                <span>
                    Contact person: <? echo $account->getContactPerson(); ?>
                </span>
                <span>
                    E-mail: <? echo $account->getEmail(); ?>
                </span>
                <span>
                    Is confirmed?: <? echo $account->getConfirmed(); ?>
                </span>
                <span>
                    Website: <? echo $account->getWebsite(); ?>
                </span>
                <span>
                    Info: <? echo $account->getInfo(); ?>
                </span>
                <span>
                    Is Admin?: <? print_r($account->getAdministrator()); ?>
                </span>
            </div>
    <?php }
    ?>
</body>
</html>