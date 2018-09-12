<!DOCTYPE HTML>
<html>
    <head>
        <meta charset=utf-8>
	<title>Vinder | Wachtwoord vergeten?</title>
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
        <h1>Wachtwoord vergeten?</h1>
        <p>Gelieve uw e-mailadres in te geven.<br>We sturen je een e-mail waarmee je je wachtwoord kan resetten.</p>
        <form action="forgotPassword.php" method="POST">
            <label for="mail">E-mail : </label>
            <input type="text" name="mail">
            <?php if (array_key_exists('mail', $errors)) : ?>
                <div class="error"><?= $errors['mail']; ?></div>
            <?php endif; ?>
                        
            <input type="submit" value="Verzenden">
        </form>
    </body>
</html>