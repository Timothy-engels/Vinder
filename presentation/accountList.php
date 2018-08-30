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
          { ?>
            <div>
                userId: <? $account->getId(); ?>
            </div>
    <?php }
    ?>
</body>
</html>