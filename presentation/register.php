<!DOCTYPE html>
<html lang="nl">
    <head>
        <meta charset="UTF-8">
        <title>Vinder | Registreer</title>
        <style>
            label, input, .error {
                display: block;
            }
            
            .error {
                color: red;
            }
        </style>
    </head>
    <body>
        <main>
            <section id="register">
                <h1>Registreer</h1>
                           
                <form name="frm-register" method="POST" action="register.php">

                    <p><small>Velden met een * zijn verplicht in te vullen</small></p>

                    <label for="name">Bedrijfsnaam *</label>
                    <input type="text" id="name" name="name" maxlength="255" value="<?= $name; ?>"/>
                    <?php if (array_key_exists('name', $errors)) : ?>
                        <div class="error"><?= $errors['name']; ?></div>
                    <?php endif; ?>

                    <label for="contactPerson">Contactpersoon *</label>
                    <input type="text" id="contactPerson" name="contactPerson" maxlength="255" value="<?= $contactPerson; ?>" />
                    <?php if (array_key_exists('contactPerson', $errors)) : ?>
                        <div class="error"><?= $errors['contactPerson']; ?></div>
                    <?php endif; ?>

                    <label for="email">Email *</label>
                    <input type="email" id="email" name="email" maxlength="255" value="<?= $email; ?>" />
                    <?php if (array_key_exists('email', $errors)) : ?>
                        <div class="error"><?= $errors['email']; ?></div>
                    <?php endif; ?>

                    <label for="password">Wachtwoord *</label>
                    <input type="password" id="password" name="password" maxlength="255" />
                    <?php if (array_key_exists('password', $errors)) : ?>
                        <div class="error"><?= $errors['password']; ?></div>
                    <?php endif; ?>
                        
                    <label for="repeatPassword">Herhaal wachtwoord *</label>
                    <input type="password" id="repeatPassword" name="repeatPassword" maxlength="255" />
                    <?php if (array_key_exists('repeatPassword', $errors)) : ?>
                        <div class="error"><?= $errors['repeatPassword']; ?></div>
                    <?php endif; ?>
                        
                    <input type="submit" value="Registreer" />
                                 
                </form>
                
            </section>
        </main>
    </body>
</html>
