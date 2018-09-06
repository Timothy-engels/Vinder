<!DOCTYPE html>
<html lang="nl">
    <head>
        <meta charset="UTF-8">
        <title>Vinder | Wijzig wachtwoord</title>
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
        <main>
            <section id="changePassword">
                
                <h1>Wachtwoord wijzigen</h1>
                
                <form name="frmChangePassword" method="POST" action="updatePassword.php">
                    
                    <p><small>Velden met een * zijn verplicht in te vullen.</small></p>
                    
                    <label for="password">Wachtwoord *</label>
                    <input type="password" id="password" name="password" maxlength="50" />
                    <?php if (array_key_exists('password', $errors)) : ?>
                        <div class="error"><?= $errors['password']; ?></div>
                    <?php endif; ?>
                        
                    <label for="repeatPassword">Herhaal wachtwoord *</label>
                    <input type="password" id="repeatPassword" name="repeatPassword" maxlength="50" />
                    <?php if (array_key_exists('repeatPassword', $errors)) : ?>
                        <div class="error"><?= $errors['repeatPassword']; ?></div>
                    <?php endif; ?>
                        
                    <input type="submit" value="Wijzigen" />
                    
                </form>
                
            </section>
        </main>
    </body>
    
</html>