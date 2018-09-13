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
    </style>
    <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">
</head>
<body>
    <?php include('menu.php'); ?>
    
    <h1>Expertises</h1>
    <ul>
        <?php
        foreach($expertises as $expertise) { 
            print("<li><a href='expertiseAdjust.php?eaid=" . $expertise->getId() . "'>" . $expertise->getExpertise() . "</a></li>");
        }
        ?>
    </ul>
    <form action="expertises.php" method="POST">
        <inpuyt type="text" name="newExpertise">
        <input type="submit" value="Toevoegen">
    </form>
</body>
</html>