<!DOCTYPE HTML>
<html>
<head>
    <meta charset=utf-8>
    <title>Vinder | Inloggen</title>
    <style>
        body {
            margin: 0px auto;
            text-align: center;
        }
        
        .error {
            color: red;
            display: block;
        }
    </style>
</head> 

<body>
    <h1>Inloggen</h1>
    <form action="logIn.php" method="POST">
        <?php 
        $pas = "Scrum55_";
        $pass = password_hash($pas, PASSWORD_DEFAULT);
        print($pass);
        if (array_key_exists('general', $errors)) : ?>
            <div class="error"><?= $errors['general']; ?></div>
        <?php endif; ?>
        <p><label for="mail">E-mail: </label><input type="email" name="mail" id="mail" required value="<?= $mail; ?>"></p>
        <?php if (array_key_exists('mail', $errors)) : ?>
            <div class="error"><?= $errors['mail']; ?></div>
        <?php endif; ?>
        <p><label for="pass">Wachtwoord: </label><input type="password" name="pass" id="pass" required></p>
        <?php if (array_key_exists('pass', $errors)) : ?>
            <div class="error"><?= $errors['pass']; ?></div>
        <?php endif; ?>
        <p><input type="submit" value="Inloggen"></p>
    </form>
    <a href="forgotPassword.php">Wachtwoord vergeten</a><br>
    <a href="register.php">Account aanmaken</a>
</body>
    
</html>