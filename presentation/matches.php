<!DOCTYPE HTML>
<html>
    <head>
        <title> matches </title>
        <style>
            #companyInfoFlexBoxContainer {
                display: flex;
                flex-direction: row;
                flex-wrap: row;
                justify-content: flex-start; 
            }
            
            .companyInfoFlexBox {
                width: 14rem;
                height: 12rem;
                text-align: center;
                border: 1px solid lightgray;
                padding: 1rem;
                margin: 1rem;
            }
            
            .logoImg {
                max-height: 9rem;
                max-width: 9rem;
            }
        </style>
    </head>
    <body>
        <header>
            <?php include('menu.php') ?>
        </header>
        <article>
            <h2>lijst van matches</h2>
            <div id="companyInfoFlexBoxContainer">
                <?php
                    foreach ($mO as $match){ ?>
                        <div class="companyInfoFlexBox">
                            <a href="showProfile.php?id=<?= $match->getId(); ?>">
                            <?php 
                                if (($match->getLogo() !== NULL) && ($match->getLogo() !== "")){
                            ?>   
                            <img src="images/<?php echo $match->getLogo(); ?>" alt="Logo" class="logoImg">
                            <?php
                                    }
                            ?>
                            <?php
                                print("<p>" . $match->getName() . "</p>");
                                print("<p>" . $match->getContactPerson() . "</p>");
                            ?>
                            </a>
                        </div>                        
                    <?php    
                        }
                ?>
            </div>
        </article>
    </body>
</html>