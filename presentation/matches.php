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
                            var_dump($match->getLogo());
                    ?>
                        <li>
                            <?php 
                                if (($match->getLogo() !== NULL) && ($match->getLogo() !== "")){
                            ?>   
                            <img src="images/<?php echo $match->getLogo(); ?>" alt="Logo" style="max-width: 150px">
                            <?php
                                    }
                            ?>
                            <?php
                                print($match->getName());
                                print($match->getContactPerson());
                            ?>
                            <a href="?id=<?= $match->getId(); ?>"><button>profiel</button></a>
                        </li>
                    <?php    
                        }
                    ?>
                </ul>
        </article>
    </body>
</html>