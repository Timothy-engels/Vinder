<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>Profiel Pagina</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
    </head>
    <body>
        <h1> Hoofding </h1>

        <form action="#" method="post">
            <img src="#" alt="Logo">
            <p>jouw logo</p>
            <input type="submit" name="upload" value="upload">
            <br>
            meer informatie : <input type="text" name="Info" placeholder="<?php print($accounts->getInfo());?>">
            <br>
            naam : <input type="text" name="naam" placeholder="<?php print($accounts->getName()); ?>" />
            <br>
            contactpersooon : <input type="text" name="contactpersoon" placeholder="<?php print($accounts->getContactperson()); ?>">
            <br>
            e-mail : <input type="email" name="email" placeholder="<?php print($accounts->getemail()); ?>">
            <br>
            website : <input type="url" name="website" placeholder="<?php print($accounts->getwebsite()); ?>">
            <br>
            
        </form>
    </body>
</html>