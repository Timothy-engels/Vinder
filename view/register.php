<!DOCTYPE html>
<html lang="nl">
    <head>
        <meta charset="UTF-8">
        <title>Vinder | Register</title>
    </head>
    <body>
        <main>
            <section id="register">
                <h1>Registreer</h1>
                           
                <form name="frm-register" method="POST" action="register.php">

                    <small>Velden met een * zijn verplicht in te vullen</small>

                    <label for="name">Naam *</label>
                    <input type="text" id="name" maxlength="255" value="test" />
                    <?php if (array_key_exists('name', $errors)) : ?>
                        <div class="error"><?= $errors['name']; ?></div>
                    <?php endif; ?>

                    <label for="contactPerson">Contactpersoon *</label>
                    <input type="text" id="contactPerson" maxlength="255" />

                    <label for="email">Email *</label>
                    <input type="text" id="email" maxlength="255" />                  

                    <label for="password">Wachtwoord *</label>
                    <input type="text" id="password" maxlength="255" />
                        
                    <label for="repeat-password">Herhaal wachtwoord *</label>
                    <input type="text" id="repeat-password" maxlength="255" />
                        
                    <input type="submit" value="Registreer" />
                                 
                </form>
                
            </section>
        </main>
    </body>
</html>
