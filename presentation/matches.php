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
                            <img src="images/<?php echo $account->getLogo(); ?>" alt="Logo" style="max-width: 150px">
                            <?php
                                print($match->getName());
                                print($match->getContactPerson());
                                print($match->getId());
                            ?>
                            <form action="showProfile.php" method="post">
                                <input type="hidden" name="id" value="<?php print($match->getId()); ?>" />
                                <input type="submit" value="bekijk profiel" />
                            </form>
                        </li>
                    <?php    
                        }
                    ?>
                </ul>
        </article>
    </body>
</html>