<!DOCTYPE HTML>
<html>
    <head>
        <title> matches </title>
    </head>
    <body>
        <header>
            <?php include('menu.php') ?>
        </header>
        <article>
            <h2>lijst van matches</h2>
                <ul>
                    <?php
                        foreach ($mO as $match){
                    ?>
                        <li>
                            <?php
                                print('<img src='.$match->getLogo().' />');
                                print($match->getName());
                                print($match->getContactPerson());
                            ?>
                            <a href="showProfile.php?id=<?= $match->getId(); ?>"><button>profiel</button></a>
                        </li>
                    <?php    
                        }
                    ?>
                </ul>
        </article>
    </body>
</html>