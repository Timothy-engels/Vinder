<?php
    
    session_start();
    
    if (isset($_SESSION["ID"])) {
        $id = $_SESSION["ID"];
    }
    else {
        header("location: logInForm.php");
    }
    
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Aangemeld!</title>
        <meta charset="windows-1252">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <style>
            body {
		margin: 0px auto;
		text-align: center;
            }
        </style>
    </head>
    <body>
        <div><h1>END</h1></div>
        <?php
            print("De SESSION id is: " . $id . "<br>De sessie wordt nu ook opnieuw afgesloten.");
            session_destroy();
        ?>
    </body>
</html>
