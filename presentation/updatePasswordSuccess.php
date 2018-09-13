<!DOCTYPE html>
<html lang="nl">
    <head>
        <meta charset="UTF-8">
        <title>Vinder | Registreer</title>
    </head>
    <body>
        <?php
        if ($showMenu) {
            include('menu.php');
        }
        ?>
        
        <main>
            <section id="register">
                
                <h1>Wachtwoord wijzigen</h1>
                
                <p>Je wachtwoord is met success gewijzigd.</p>
                <?php if ($code !== '') : ?>
                <p><a href="logIn.php">Klik hier om je opnieuw in te loggen.</a></p>
                <?php endif; ?>
                
            </section>
        </main>
    </body>
</html>