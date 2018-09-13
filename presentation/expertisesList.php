<!DOCTYPE HTML> <!-- presentation/commentlist.php -->
<html>
<head>
    <meta charset=utf-8>
    <title>users</title>
    <style>
        body{
            font-family: 'Lato', sans-serif;
            font-size: 21px;
            margin: 0px auto;
            text-align: center;
        }
        ul {
            list-style-type: none;
        }
        a {
            padding: 0 25px;
        }
    </style>
    <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">
</head>
<body>
    <?php include('menu.php'); ?>
    
    <h1>Expertises</h1>
    <ul>
        <?php
        foreach($expertises as $expertise) { 
            print("<li><a href='expertiseDelete.php?edid=" . $expertise->getId() . "'>Verwijderen</a>" . $expertise->getExpertise() . "<a href='expertiseAdjust.php?eaid=" . $expertise->getId() . "'>Wijzigen</a></li>");
        }
        ?>
    </ul>
    <form action="expertises.php" method="POST">
        <input type="text" name="newExpertise">
        <input type="submit" value="Toevoegen">
    </form>
</body>
</html>