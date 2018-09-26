<!DOCTYPE HTML>
<html>
    <head>
        <title> matches </title>
    </head>
    <body>
        <header>
            <?php include('presentation/menu.php') ?>
        </header>
        <article>
            <h2>lijst van matches</h2>
                <?php
                    foreach ($mO as $match){
                ?>
                <ul>
                    <li>
                        <?php
                            print('<img src='.$match->getLogo().' />');
                        ?>
                    </li>
                    <li>
                        <?php
                            print($match->getName());
                        ?>
                    </li>
                    <li>
                        <?php
                            print($match->getContactPerson());
                        ?>
                    </li>
                    <li>
                        <a href="showProfile.php?id=<?= $match->getId(); ?>"><button>profiel</button></a>
                    </li>
                </ul>
                <?php    
                    }
                ?>
        </article>
    </body>
</html>