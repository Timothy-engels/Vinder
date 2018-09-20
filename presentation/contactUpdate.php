<!DOCTYPE html>
<html lang="nl">
    <head>
        <meta charset="UTF-8">
        <title>Vinder | Contactpersoon wijzigen</title>
        <style>
            label, input, .error {
                display: block;
            }
            
            .error {
                color: red;
                font-weight: bold;
            }
            
            .message {
                color: green;
                font-weight: bold;
            }
        </style>
    </head>
    <body>
        <?php include('menu.php'); ?>
        
        <main>
            <section id="contactUpdate">
                <h1>Wijzig uw contactgegevens</h1>
                
                <?php if ($msg !== '') : ?>
                    <div class="message"><?= $msg; ?></div>
                <?php endif; ?>
                
                <form name="frmContactUpdate" method="POST" action="contactUpdate.php">
                    
                    <p><small>Velden met een * zijn verplicht in te vullen</small></p>
                    
                    <label for="name">Bedrijfsnaam * </label>
                    <input type="text" id="name" name="name" maxlength="255" value="<?= $name; ?>" autofocus />
                    <?php if (array_key_exists('name', $errors)) : ?>
                        <div class="error"><?= $errors['name']; ?></div>
                    <?php endif; ?>
                    
                    <label for="contactPerson">Contactpersoon *</label>
                    <input type="text" id="contactPerson" name="contactPerson" maxlength="255" value="<?= $contactPerson; ?>" />
                    <?php if (array_key_exists('contactPerson', $errors)) : ?>
                        <div class="error"><?= $errors['contactPerson']; ?></div>
                    <?php endif; ?>
                        
                    <label for="email">E-mail * </label>
                    <input type="email" id="email" name="email" maxlength="255" value="<?= $email; ?>" />
                    <?php if (array_key_exists('email', $errors)) : ?>
                        <div class="error"><?= $errors['email']; ?>
                    <?php endif; ?>
                            
                    <input type="submit" value="Wijzigen" />
                        
                </form>
            </section>
        </main>
    </body>
</html>