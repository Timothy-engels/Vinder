
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
		<h1>Password reseten</h1>
		<form action="resetPassword.php" method="POST">
            <p><label for="mail">E-mail: </label><input type="email" name="mail" required></p>
            <input type="hidden" name ="process" value="1">
            <p><input type="submit" value="Reset"></p>
		</form>
    </body>
</html>