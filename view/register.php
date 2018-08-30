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
                    <input type="text" id="name" name="name" maxlength="255" />
                    <?php if (array_key_exists('name', $errors)) : ?>
                        <div class="error"><?= $errors['name']; ?></div>
                    <?php endif; ?>

                    <label for="contactPerson">Contactpersoon *</label>
                    <input type="text" id="contactPerson" name="contactPerson" maxlength="255" />
                    <?php if (array_key_exists('contactPerson', $errors)) : ?>
                        <div class="error"><?= $errors['contactPerson']; ?></div>
                    <?php endif; ?>

                    <label for="email">Email *</label>
                    <input type="text" id="email" name="email" maxlength="255" />
                    <?php if (array_key_exists('email', $errors)) : ?>
                        <div class="error"><?= $errors['email']; ?></div>
                    <?php endif; ?>

                    <label for="password">Wachtwoord *</label>
                    <input type="text" id="password" name="password" maxlength="255" />
                    <?php if (array_key_exists('password', $errors)) : ?>
                        <div class="error"><?= $errors['password']; ?></div>
                    <?php endif; ?>
                        
                    <label for="repeat-password">Herhaal wachtwoord *</label>
                    <input type="text" id="repeat-password" name="repeat-password" maxlength="255" />
                    <?php if (array_key_exists('repeat-password', $errors)) : ?>
                        <div class="error"><?= $errors['repeat-password']; ?></div>
                    <?php endif; ?>
                        
                    <input type="submit" value="Registreer" />
                                 
                </form>
                
            </section>
        </main>
    </body>
</html>
