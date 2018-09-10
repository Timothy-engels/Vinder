<!DOCTYPE HTML>
<html>
<head>
    <meta charset=utf-8>
    <title>Inloggen</title>
    <style>
        body {
            margin: 0px auto;
            text-align: center;
        }
    </style>
</head> 

<body>
    <h1>Inloggen</h1>
    <form action="logIn.php" method="POST">
        <p><label for="mail">E-mail: </label><input type="email" name="mail" id="mail" required></p>
        <p><label for="pass">Wachtwoord: </label><input type="password" name="pass" id="pass" required></p>
        <p><input type="submit" value="Inloggen"></p>
    </form>
    <!--<a href="business/forgotPassword.php">Wachtwoord vergeten</a><br>-->
    <a href="register.php">Account aanmaken</a>
</body>
    
</html>