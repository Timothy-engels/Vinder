<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>Profiel Pagina</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    </head>
    <body>
        <h1> Hoofding </h1>

        <form action="aanpassenProfiel.php" method="post">
            <img src="#" alt="Logo">
            <p>jouw logo</p>
            <input type="submit" name="upload" value="upload">
            <br>
            naam : <input type="text" name="naam" placeholder="<?php print($accounts->getName()); ?>" />
            <br>
            meer informatie : <input type="text" name="Info" placeholder="<?php print($accounts->getInfo());?>">
            <br>
            contactpersooon : <input type="text" name="contactpersoon" placeholder="<?php print($accounts->getContactperson()); ?>">
            <br>
            <div class="dropdown">
                expertise <input class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <a class="dropdown-item" href="#">Action</a>
                    <a class="dropdown-item" href="#">Another action</a>
                    <a class="dropdown-item" href="#">Something else here</a>
                </div>
            </div>
            <br>
            e-mail : <input type="email" name="email" placeholder="<?php print($accounts->getemail()); ?>">
            <br>
            website : <input type="url" name="website" placeholder="<?php print($accounts->getwebsite()); ?>">
            <br>
            <input type="submit" name="submit" value ="aanpassen">
        </form>
    </body>
</html>