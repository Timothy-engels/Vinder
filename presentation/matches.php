<!DOCTYPE HTML>
<html>
    <head>
        <title> matches </title>
    </head>
    <body>
        <header>
            <h1>inclunde menu hier</h1>
        </header>
        <article>
            <h2>lijst van matches</h2>
            <ul>
                <?php
                    foreach ($mO as $match){
                ?>
                <li>
                    <?php
                        print($match->getName() .",". $match->getContactPerson());
                    ?>
                </li>
                <?php    
                    }
                ?>
            </ul>
        </article>
    </body>
</html>