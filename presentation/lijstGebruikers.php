<!DOCTYPE HTML>
<html>
    <head>
        <meta charset="utf-8">
        <title>Gebruikers Lijst</title>
    </head>
    <body>
        <side>
            <p>hier komt de banner</p>
        </side>
        <header>
            <h1>Lijst Gebruikers</h1>
        </header>
        <nav>
            <ul>
                <?php foreach($lijst as $rij){ ?>
                <li>
                <?php 
                    print ($rij->getLogo());
                    print ($rij->getName());
                ?>
                </li>
                <?php } ?>
            </ul>
        </nav>
    </body>
</html>