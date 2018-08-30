<?php
    
    session_start();
        
    if (isset($_SESSION["ID"])) {
        header("location: end.php");
    }
?>
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
	<form action="processor.php" method="POST">
            <p><label for="mail">E-mail: </label><input type="email" name="mail" required></p>
            <p><label for="pass">Wachtwoord: </label><input type="password" name="pass" required></p>
            <input type="hidden" name ="process" value="FALSE">
            <p><input type="submit" value="Inloggen"></p>
	</form>
    </body>
</html>